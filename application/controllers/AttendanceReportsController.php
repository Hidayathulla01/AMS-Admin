<?php
class AttendanceReportsController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('AttendanceReportsModel');
    }

    public function AttendanceReports() {
        $data['masjids'] = $this->AttendanceReportsModel->get_all_masjids();
        $data['courses'] = []; // initially empty
        $this->load->view('AttendanceReportsView', $data);
    }

    public function get_courses_by_masjid() {
        $masjid_id = $this->input->post('masjid_id');
        $courses = $this->AttendanceReportsModel->get_courses_by_masjid($masjid_id);
        echo json_encode($courses);
    }

    public function AttendanceResult() {
        $masjid_id = $this->input->post('masjid_id');
        $course_id = $this->input->post('course_id');
        $date_mode = $this->input->post('date_mode');

        $from = $to = null;
        if ($date_mode === 'single') {
            $from = $to = $this->input->post('date_single');
        } elseif ($date_mode === 'multi') {
    $date_range = $this->input->post('date_range');
    if ($date_range && strpos($date_range, ' to ') !== false) {
        list($from, $to) = explode(' to ', strtolower($date_range));
        $from = trim($from);
        $to = trim($to);
    }

        } elseif ($date_mode === 'month') {
            $month = $this->input->post('month');
            $year = $this->input->post('year');
            $from = date("Y-m-01", strtotime("$year-$month-01"));
            $to = date("Y-m-t", strtotime($from));
        }

        $data['report'] = $this->AttendanceReportsModel->get_attendance_report($masjid_id, $course_id, $from, $to);
        $data['remarks'] = $this->AttendanceReportsModel->get_attendance_remarks($masjid_id, $course_id, $from, $to);
        $data['masjid_name'] = $this->AttendanceReportsModel->get_masjid_name($masjid_id);
        $data['course_name'] = $this->AttendanceReportsModel->get_course_name($course_id);
        $data['from'] = $from;
        $data['to'] = $to;

        $this->load->view('AttendanceReportsResultView', $data);
    }
}
