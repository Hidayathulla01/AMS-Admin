<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminLogin extends CI_Controller {

	function __construct(){
		parent::__construct();		
		$this->load->helper(array('form', 'url', 'string', 'download'));
		$this->load->model('Login_Model');
        $this->load->model('Masjid_Model');
		$this->load->library('session');
		$this->load->library('form_validation');
	}

	 public function index() {
        $data['MasjidsData'] = $this->Masjid_Model->ViewMasjids();
        $this->load->view('Login', $data);
    }

	 public function ForgetPwdIndex() {
        $data['MasjidsData'] = $this->Masjid_Model->ViewMasjids();
        $this->load->view('ForgetPassword', $data);
    }
	
	public function SendResetLink() {
        $email = $this->input->post('email');
        $user = $this->db->get_where('tbl_admin', ['email' => $email])->row();
        if ($user) {			
            $token = bin2hex(random_bytes(50));
            $token_expiration = date('Y-m-d H:i:s', strtotime('+1 hour'));
			
            $result = $this->db->where('email', $email)->update('tbl_admin', [
                'reset_token' => $token,
                'reset_token_expiration' => $token_expiration
            ]);
			//pr($this->db->last_query());
            $reset_link = base_url('AdminLogin/ResetPassword/'.$token);
            $subject = "Password Reset Request";
            $message = "Click the link to reset your password: <a href='".$reset_link."'>Reset Password</a>";

            // Load email library and send email
            $this->load->library('email');
            $config = [
                'protocol'  => 'smtp',
                'smtp_host' => 'smtp.gmail.com',
                'smtp_port' => 587,
                'smtp_user' => 'rq.hidayath@gmail.com',
                'smtp_pass' => 'jsnpeqprjjvlojbs',
				'smtp_crypto' => 'tls',           
                'mailtype'  => 'html',
                'charset'   => 'utf-8'
            ];
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from('rq.hidayath@gmail.com', 'Attendance Management System - Darulilm');
            $this->email->to($email);
            $this->email->subject($subject);
            $this->email->message($message);

            if ($this->email->send()) {
                $this->session->set_flashdata('success', 'Password Reset Link Sent to your Email-Id');
				redirect(base_url('ForgetPwdIndex'));
            }
        }else{
			//pr( '$user');
            $this->session->set_flashdata('error', 'Email not found.');
			redirect(base_url('ForgetPwdIndex'));
        }
    }

    public function ResetPassword($token) {
		//pr($user);
        // Check if token is valid and not expired
        $user = $this->db->get_where('tbl_admin', [
            'reset_token' => $token,
            //'reset_token_expiration >' => date('Y-m-d H:i:s')
        ])->row();
		//pr($this->db->last_query());
        if ($user) {
            $data['token'] = $token; 
			$data['MasjidsData'] = $this->Masjid_Model->ViewMasjids();
            $this->load->view('ResetPassword', $data);
        } else {
            echo "Invalid or expired token.";
        }
    }

    public function update_password() {
        $token = $this->input->post('token');
        $new_password = $this->input->post('password');
        $confirm_password = $this->input->post('password');
        //$this->form_validation->set_rules('new_password', 'New Password', 'required');
       // $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');
       // pr($new_password);
       if($new_password == $confirm_password){
			//pr('success');
            $data['token'] = $token;
			$data['MasjidsData'] = $this->Masjid_Model->ViewMasjids();
            $this->load->view('ResetPassword', $data);
			// Validate and update password
			$user = $this->db->get_where('tbl_admin', [
				'reset_token' => $token,
				//'reset_token_expiration >' => date('Y-m-d H:i:s')
			])->row();

			if ($user) {
				$this->db->where('admin_id', $user->admin_id)->update('tbl_admin', [
					'password' => $new_password,
					'reset_token' => '',
					'reset_token_expiration' => ''
				]);
				pr($this->db->last_query());
				echo "Password updated successfully.";
				redirect(base_url());
			} else {
				echo "Invalid or expired token.";
			}
	   }else{
			$this->session->set_flashdata('error', 'The Confirm Password field does not match the New Password field');
			redirect(base_url('update_password'));
	   }
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
			$admin_id = $firstElement['admin_id'];	
			$fullname = $firstElement['fullname'];	
				
			if($Chk_user_id == $email && $Chk_pwd == $password){
				$userData = array(
				'admin_id' => $admin_id,
				'email' => $Chk_user_id,
				'fullname' => $fullname
			);
			//pr($userData);
				$this->session->set_userdata('user_data', $userData);
				$this->session->set_flashdata('success', 'Login Successful');
				redirect(base_url('DashboardIndex'));
			}else{
				$this->session->set_flashdata('error', 'Invalid Credential');
				redirect(base_url());
			}						
		}		
	}
	
	public function logout() {
        // Destroy admin session and redirect to login
		$this->session->unset_userdata('user_data');
        redirect(base_url());
    }
}
