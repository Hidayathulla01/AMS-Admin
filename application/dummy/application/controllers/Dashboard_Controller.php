<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_Controller  extends CI_controller{
	
	public function __construct(){
		parent::__construct ();
		$this->load->library('session');
		$this->load->library('form_validation');
		$userData = $this->session->userdata('user_data');
		if (empty($userData)) {
			$username = $userData['user_id'];
			$masjid_id = $userData['masjid_id'];
			return redirect('login');
		}
		$this->load->database();
		$this->load->model('Users_Model');
		$this->load->helper(array('form', 'url', 'string', 'download'));
		
	}
	
	
	public function DashboardIndex(){		
		$this->load->view('AdminDashboard.php');
	}
	
}