<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AttendanceReportsModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_all_attendance() {
        $this->db->where('delete_status', '1');
        $query = $this->db->get('ams.tbl_attendance');
        return $query->result();
    }
 public function get_all_masjids() {
    return $this->db->where('delete_status', '1')->get('ams.tbl_masjids')->result();
}
public function get_attendance_remarks($masjid_id, $course_id, $from, $to) {
    $remarks = [];
    $attRows = $this->db->where('masjid_id', $masjid_id)
                        ->where('course_id', $course_id)
                        ->where("DATE(created_date) >=", $from)
                        ->where("DATE(created_date) <=", $to)
                        ->where("delete_status", '1')
                        ->get('ams.tbl_attendance')
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

public function get_all_courses() {
    return $this->db->where('delete_status', '1')->get('ams.tbl_courses')->result();
}
public function get_courses_by_masjid($masjid_id) {
    return $this->db
        ->where('masjid_name', $masjid_id)
        ->where('delete_status', '1')
        ->get('ams.tbl_courses')
        ->result();
}

public function get_attendance_report($masjid_id, $course_id, $from, $to) {
    // 1. Get assigned teacher
    $teacherRow = $this->db->where([
        'masjid_id' => $masjid_id,
        'courses_id' => $course_id,
        'delete_status' => '1'
    ])->get('ams.tbl_assignclasses')->row();

    if (!$teacherRow) return [];

    $teacher_id = $teacherRow->teacher_id;
    $teacher = $this->db->where('teacher_id', $teacher_id)->get('ams.tbl_teacher')->row();
    $teacher_name = $teacher ? $teacher->fullname : 'Unknown';

    // 2. Get students
    $students = $this->db->where([
        'course_id' => $course_id,
        'delete_status' => '1'
    ])->get('ams.tbl_student')->result();

    // 3. Get attendance filtered by date and relevant IDs
    $attendance = [];
    $attRows = $this->db->where('masjid_id', $masjid_id)
                        ->where('course_id', $course_id)
                        ->where('teacher_id', $teacher_id)
                        ->where("DATE(created_date) >=", $from)
                        ->where("DATE(created_date) <=", $to)
                        ->where("delete_status", '1')
                        ->get('ams.tbl_attendance')
                        ->result();

    foreach ($attRows as $row) {
        $day = date('Y-m-d', strtotime($row->created_date));
        $attendance[$row->student_id][$day] = $row->attendance_status;
    }

    // 4. Build report structure
    $result = [
        'teacher_name' => $teacher_name,
        'students' => []
    ];

    foreach ($students as $s) {
        $studentData = [];
        $date = strtotime($from);
        $end = strtotime($to);
        while ($date <= $end) {
            $cur = date('Y-m-d', $date);
            $status = $attendance[$s->student_id][$cur] ?? null;

            switch ($status) {
                case '1': $icon = 'present'; break;
                case '2': $icon = 'absent'; break;
                case '3': $icon = 'late'; break;
                case '4': $icon = 'leave'; break;
                case '5': $icon = 'holiday'; break;
                default:  $icon = '-';
            }

            $studentData[$cur] = $icon;
            $date = strtotime('+1 day', $date);
        }

        $result['students'][] = [
            'student_id' => $s->student_id,
            'name' => $s->fullname,
            'attendance' => $studentData
        ];
    }

    return $result;
}

public function get_masjid_name($masjid_id) {
    return $this->db->select('masjid_name')->where('masjid_id', $masjid_id)->get('ams.tbl_masjids')->row()->masjid_name ?? '';
}

public function get_course_name($course_id) {
    return $this->db->select('course_name')->where('course_id', $course_id)->get('ams.tbl_courses')->row()->course_name ?? '';
}

}
