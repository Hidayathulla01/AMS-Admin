<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ClearAttendance_Controller  extends CI_controller{
	
	public function __construct(){
		parent::__construct ();
		$this->load->database();
		$this->load->model('AssignClass_Model');
		$this->load->model('Admin_Model');
		$this->load->helper(array('form', 'url', 'string', 'download'));	
		$this->load->library('session');
		$userData = $this->session->userdata('user_data');
		$id = $userData['admin_id'];
		$this->data['AdminData'] = $this->Admin_Model->getAdminDataById($id);
	}
	
	public function ClearAttendanceIndex(){
		$data['AssignClassList'] = $this->AssignClass_Model->ViewAssignClasses();
		$data['AdminData'] = $this->data['AdminData'];
		$this->load->view('ClearAttendance.php', $data);
	}
	
	public function DeleteAttendanceData(){		
	
		$course_id = $this->input->post('course_id');
		$attendance_date = $this->input->post('attendance_date');
		
		$updateStatus = $this->db->where('created_date', $attendance_date);
						$this->db->where('course_id', $course_id);
						$this->db->delete('tbl_attendance');

		//pr($updateStatus);
		if ($updateStatus) {
			//pr($updateStatus);
			$this->session->set_flashdata('success', 'Attendance Deleted successfully');
			redirect('ClearAttendanceIndex');
		} else {
			$this->session->set_flashdata('error', 'Failed to Delete data');
		}
		redirect('ClearAttendanceIndex');
	}
	
}




?>