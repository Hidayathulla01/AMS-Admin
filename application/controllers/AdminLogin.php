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
		$this->load->view('LoginForm.php');		
	}
		
	public function login() {
		$this->form_validation->set_rules('email', 'email', 'required', array('required' => 'email is required.'));
		$this->form_validation->set_rules('password', 'password', 'required', array('required' => 'Password is required.'));
		
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
			
		if($this->form_validation->run() == false){
			$this->session->set_flashdata('Invalid', 'Please fill required fields');
			redirect(base_url());
		}else{
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$userData = $this->Login_Model->GetUser($email,$password);			
			
			$firstElement = $userData[0];
			$Chk_user_id = $firstElement['email'];
			$Chk_pwd = $firstElement['password'];	
				
			if($Chk_user_id == $email && $Chk_pwd == $password){
				$userData = array(
				'email' => $Chk_user_id,
				'password' => $password
			);
			$this->session->set_userdata('user_data', $userData);
				redirect('DashboardIndex ');
			}else{
				$this->session->set_flashdata('error', 'Invalid login');
				redirect(base_url());
			}						
		}		
	}
	
	public function logout() {
        // Destroy admin session and redirect to login
		$this->session->unset_userdata('email');
        redirect(base_url());
    }
}
