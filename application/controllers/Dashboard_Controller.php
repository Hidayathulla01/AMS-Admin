<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_Controller  extends CI_controller{
	
	public function __construct(){
		parent::__construct ();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->model('Teacher_Model');
		$this->load->model('Student_Model');
		$this->load->model('Masjid_Model');
		$this->load->model('Course_Model');
		$this->load->model('Admin_Model');
		$this->load->helper(array('form', 'url', 'string', 'download'));
		if (empty($this->session->userdata('user_data'))) {
            redirect(base_url());
        }		
		$userData = $this->session->userdata('user_data');
		$id = $userData['admin_id'];
		$this->data['AdminData'] = $this->Admin_Model->getAdminDataById($id);
	}
		
	public function DashboardIndex(){
		$GetTotalCount['MasjidCount'] = $this->Masjid_Model->ViewMasjids();
		$GetTotalCount['CourseCount'] = $this->Course_Model->ViewCourses();
		$GetTotalCount['TeacherCount'] = $this->Teacher_Model->ViewTeachers();
		$GetTotalCount['StudentCount'] = $this->Student_Model->ViewStudents();
		$GetTotalCount['AdminData'] = $this->data['AdminData'];
		//pr($GetTotalCount);
		$this->load->view('Dashboard.php',$GetTotalCount);
	}
		
	public function EditProfileIndex(){
		$userData = $this->session->userdata('user_data');
		$id = $userData['admin_id'];	
		$data['AdminData'] = $this->Admin_Model->getAdminDataById($id);
		$this->load->view('EditProfile.php',$data);
	}
}