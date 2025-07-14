<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AttendanceReportsModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_masjids()
    {
        return $this->db->where('delete_status', '1')->get('tbl_masjids')->result();
    }

    public function get_all_courses()
    {
        return $this->db->where('delete_status', '1')->get('tbl_courses')->result();
    }

    public function get_courses_by_masjid($masjid_id)
    {
        return $this->db
            ->where('masjid_name', $masjid_id)
            ->where('delete_status', '1')
            ->get('tbl_courses')
            ->result();
    }
    public function get_all_remarks_by_student($student_id)
    {
        return $this->db->select('created_date, attendance_status, remark, late_time')
            ->from('tbl_attendance')
            ->where('student_id', $student_id)
            ->where('remark IS NOT NULL', null, false)
            ->where('remark !=', '')
            ->where('delete_status', '1')
            ->order_by('created_date', 'DESC')
            ->get()
            ->result();
    }

    public function get_attendance_remarks($masjid_id, $course_id, $from, $to)
    {
        $remarks = [];
        $attRows = $this->db->where('masjid_id', $masjid_id)
            ->where('course_id', $course_id)
            ->where("DATE(created_date) >=", $from)
            ->where("DATE(created_date) <=", $to)
            ->where("delete_status", '1')
            ->get('tbl_attendance')
            ->result();

        foreach ($attRows as $row) {
            $date = date('Y-m-d', strtotime($row->created_date));
            $remarks[$row->student_id][$date] = [
                'status' => $row->attendance_status,
                'remark' => $row->remark,
                'late_time' => $row->late_time
            ];
        }

        return $remarks;
    }

    public function get_attendance_report($masjid_id, $course_id, $from, $to, $filter = null)
    {
        $teacherRow = $this->db->where([
            'masjid_id' => $masjid_id,
            'courses_id' => $course_id,
            'delete_status' => '1'
        ])->get('tbl_assignclasses')->row();

        if (!$teacherRow) return [];

        $teacher_id = $teacherRow->teacher_id;
        $teacher = $this->db->where('teacher_id', $teacher_id)->get('tbl_teacher')->row();
        $teacher_name = $teacher ? $teacher->fullname : 'Unknown';

        $students = $this->db->where([
            'course_id' => $course_id,
            'delete_status' => '1'
        ])->get('tbl_student')->result();

        $attRows = $this->db->where([
            'masjid_id' => $masjid_id,
            'course_id' => $course_id,
            'teacher_id' => $teacher_id,
            'delete_status' => '1'
        ])
            ->where("DATE(created_date) >=", $from)
            ->where("DATE(created_date) <=", $to)
            ->get('tbl_attendance')
            ->result();

        $attendance = [];
        $filtered_dates = [];

        foreach ($attRows as $row) {
            $day = date('Y-m-d', strtotime($row->created_date));

            switch ($row->attendance_status) {
                case '1':
                    $icon = 'present';
                    break;
                case '2':
                    $icon = 'absent';
                    break;
                case '3':
                    $icon = 'late';
                    break;
                case '4':
                    $icon = 'leave';
                    break;
                case '5':
                    $icon = 'holiday';
                    break;
                default:
                    $icon = '-';
            }

            // Save if matches filter
            if (!$filter || $filter == 'all' || $filter === $icon) {
                $attendance[$row->student_id][$day] = $icon;
                $filtered_dates[$day] = true;
            }
        }

        // Sort filtered dates
        $filtered_dates = array_keys($filtered_dates);
        sort($filtered_dates);

        $result = [
            'teacher_name' => $teacher_name,
            'students' => [],
            'filtered_dates' => $filtered_dates
        ];

        foreach ($students as $s) {
            $studentData = [];
            $hasMatch = false;

            foreach ($filtered_dates as $cur) {
                $status = $attendance[$s->student_id][$cur] ?? null;
                $studentData[$cur] = $status ?? '-';

                if ($status === $filter || $filter === 'all' || !$filter) {
                    $hasMatch = true;
                }
            }

            if ($filter && $filter !== 'all' && !$hasMatch) {
                continue; // Skip student if no matching data
            }

            $result['students'][] = [
                'student_id' => $s->student_id,
                'name' => $s->fullname,
                'attendance' => $studentData,
                'profile_picture' => $s->profile_picture ?? null
            ];
        }

        return $result;
    }
    public function get_student_by_id($student_id)
    {
        return $this->db
            ->select('student_id, fullname, mobile_no, roll_number, email, address, profile_picture') // Include missing fields
            ->where('student_id', $student_id)
            ->where('delete_status', '1')
            ->get('tbl_student')
            ->row();
    }


    public function get_attendance_by_student($student_id)
    {
        $rows = $this->db
            ->where('student_id', $student_id)
            ->where('delete_status', '1')
            ->order_by('created_date', 'DESC')
            ->get('tbl_attendance')
            ->result();

        $data = [];

        foreach ($rows as $row) {
            $day = date('Y-m-d', strtotime($row->created_date));
            switch ($row->attendance_status) {
                case '1':
                    $status = 'present';
                    break;
                case '2':
                    $status = 'absent';
                    break;
                case '3':
                    $status = 'late';
                    break;
                case '4':
                    $status = 'leave';
                    break;
                case '5':
                    $status = 'holiday';
                    break;
                default:
                    $status = '-';
            }

            $data[] = [
                'date' => $day,
                'status' => $status,
                'remark' => $row->remark,
                'late_time' => $row->late_time
            ];
        }

        return $data;
    }

    public function get_masjid_name($masjid_id)
    {
        return $this->db->select('masjid_name')
            ->where('masjid_id', $masjid_id)
            ->get('tbl_masjids')
            ->row()
            ->masjid_name ?? '';
    }

    public function get_course_name($course_id)
    {
        return $this->db->select('course_name')
            ->where('course_id', $course_id)
            ->get('tbl_courses')
            ->row()
            ->course_name ?? '';
    }
}
