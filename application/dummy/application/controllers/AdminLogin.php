<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminLogin extends CI_Controller {

	function __construct(){
		parent::__construct();		
		$this->load->helper(array('form', 'url', 'string', 'download'));
		$this->load->model('Login_Model');
		$this->load->library('session');
		$this->load->library('form_validation');
	}

	public function Index(){			
		$this->load->view('login.php');		
	}/**/
		
	public function login() {
	
		$this->form_validation->set_rules('username', 'user_id', 'required', array('required' => 'User Id is required.'));
		$this->form_validation->set_rules('password', 'password', 'required', array('required' => 'Password is required.'));
		//$this->form_validation->set_rules('masjid_id', 'masjid_id', 'required', array('required' => 'Masjid Name is required.'));
			
		if($this->form_validation->run() == false){
			$this->load->view('login'); 
		}else{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$masjid_id = $this->input->post('masjid_id');
			
			$userData = $this->Login_Model->GetUser($masjid_id,$username);
			
			
			$firstElement = $userData[0];
			$Chk_user_id = $firstElement['user_id'];
			$Chk_masjid_id = $firstElement['masjid_id'];
			$Chk_pwd = $firstElement['password'];
			
			if($Chk_user_id == "admin" && $Chk_pwd == "admin@HotMeal"){
				$userData = array(
					'user_id' => $Chk_user_id,
					'masjid_id' => $Chk_masjid_id
				);
				$this->session->set_userdata('user_data', $userData);
				//print_r($userData);
			//die();
			//$this->session->set_userdata("user_id", $Chk_user_id);
				redirect('DashboardIndex');	
			}else{
				
				if($Chk_user_id == $username && $Chk_masjid_id == $masjid_id && $Chk_pwd == $password){
					$userData = array(
					'user_id' => $Chk_user_id,
					'masjid_id' => $Chk_masjid_id
				);
				$this->session->set_userdata('user_data', $userData);
					//die();
					redirect('DashboardIndex');
				}else{
					$this->session->set_flashdata('error', 'Invalid login. Please check the User Id and Password.');
					redirect('login');
				}
			}				
		}		
	}
	
	public function logout() {
        // Destroy admin session and redirect to login
		$this->session->unset_userdata('username');
        redirect('login');
    }
}
