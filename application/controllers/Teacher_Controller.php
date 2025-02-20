<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher_Controller  extends CI_controller{
	
	public function __construct(){
		parent::__construct ();
		$this->load->database();
		$this->load->model('Teacher_Model');
		$this->load->helper(array('form', 'url', 'string', 'download','common_helper'));
	}
	
	public function TeacherIndex(){
        $this->load->view('Teacher_Table_View');
	}
	
	public function imageIndex(){
        $this->load->view('welcome_message');
	}	
	
	public function DashboardIndex(){
		$this->load->view('Dashboard.php');
	}
	
	public function addTeacher(){
		
		$this->load->view('Add_Teacher_Form');	
        if ($this->input->post('submit')) {
			//print_r('ok');die();
            $data['user_name'] = $this->input->post('user_name');
            $data['title'] = $this->input->post('title');			
            $data['role'] = 'Teacher';			
			$course_name = $this->input->post('course_name');			 
				foreach ($course_name as $Coursesvalue) {
					$CoursesCheck .=  rtrim($Coursesvalue . ',');
				}
			$data['teacher_course_id'] = rtrim($CoursesCheck, ',');
			$data['dob'] = $this->input->post('dob');			
			$data['gender'] = $this->input->post('gender');			
			$data['description'] = $this->input->post('description');
			$data['mobile_no'] = $this->input->post('mobile_no');
			$data['country'] = $this->input->post('country');
			$data['email'] = $this->input->post('email');
			$data['password'] = $this->input->post('password');
			$data['pin'] = $this->input->post('pin');
			$data['date_of_join'] = $this->input->post('date_of_join');
			$data['date_of_resigning'] = $this->input->post('date_of_resigning');		
			
			/**** Call the Helper for Profile pic Upload ****/
			$upload_result = upload_file('profile_picture', './assets/uploads/');
			if ($upload_result['status']) {
				$data['profile_picture'] = $upload_result['file_path'];
			} else {
				$this->session->set_flashdata('error', $upload_result['error']);
				redirect('TeacherIndex');
				return;
			}
            $resp = $this->Teacher_Model->savedata($data);
            if ($resp == true) {
				redirect('TeacherIndex');		
            }
		}
    }
	
	public function GetTeachersList(){
		$data = $this->Teacher_Model->ViewTeachers();
        echo json_encode($data);
	}
	
	/***for delete func ***/
	public function delete_User($user_id){
		$response=$this->Teacher_Model->del_data($user_id);
		 if ($response == true) {			 
			redirect('TeacherIndex');
		}
	}
	
	//View User's Details
	public function TeacherDetails($user_id) {
		$data['response'] = $this->Teacher_Model->ViewDetails($user_id);
		$data['formAction'] = base_url('Teacher_Controller/upd_User/' . $id); 
		$this->load->view('Teacher_Details_View.php', $data);
	}
	
	//for Update
	public function updateUser($user_id) {
		$data['response'] = $this->Teacher_Model->select($user_id);
		$data['formAction'] = base_url('Teacher_Controller/upd_User/' . $user_id); 
		$this->load->view('Teacher_UpdateForm.php', $data);
	}

	public function upd_User($user_id) {		
		$existing_data = $this->Teacher_Model->select($user_id);		
		$file_path = $existing_data->profile_picture;
		if (!empty($_FILES['profile_picture']['name'])){			
			$upload_result = upload_file('profile_picture', './assets/uploads/');
			if ($upload_result['status']) {
				$file_path = $upload_result['file_path'];
			} else {
				$this->session->set_flashdata('error', $upload_result['error']);
				redirect('TeacherIndex');
			}
		}
		$update_data = array(
			'user_id' => $user_id,
			'user_name' => $this->input->post('user_name'),
			'title' => $this->input->post('title'),			
			'profile_picture' => $file_path,
			'gender' => $this->input->post('gender'),
			'dob' => $this->input->post('dob'),
			'description' => $this->input->post('description'),
			'mobile_no' => $this->input->post('mobile_no'),
			'country' => $this->input->post('country'),
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			'pin' => $this->input->post('pin'),
			'date_of_join' => $this->input->post('date_of_join'),
			'date_of_resigning' => $this->input->post('date_of_resigning')
			
		);
		$res = $this->Teacher_Model->update($update_data);
		if ($res) {
				redirect('TeacherIndex');
		} 
	}
	
	
	
	/*public function upload() {
		$this->load->view('imageupload.php');
	}*/
	
	 public function upload() {
		$this->load->view('imageupload.php');
        if ($this->input->post('submit')) {
            $config['upload_path']   = './uploads/'; 
            $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
            $config['max_size']      = 10048; 

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('profile_picture')) {
                $upload_data = $this->upload->data();
                $image = $upload_data['file_name'];
            } else {
                $error = $this->upload->display_errors();
                print_r($error) ; die();
            }

            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $this->Teacher_Model->insertTeacher($email, $password, $image);

            redirect('TeacherIndex'); 
        }
    }
}
?>