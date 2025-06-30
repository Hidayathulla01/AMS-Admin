<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher_Controller  extends CI_controller{
	
	public function __construct(){
		parent::__construct ();
		$this->load->database();
		$this->load->model('Teacher_Model');
		$this->load->model('Admin_Model');
		$this->load->library('session');
		$this->load->helper(array('form', 'url', 'string', 'download','common_helper'));
		if (empty($this->session->userdata('user_data'))) {
            redirect(base_url());
        }
		$userData = $this->session->userdata('user_data');
		$id = $userData['admin_id'];
		$this->data['AdminData'] = $this->Admin_Model->getAdminDataById($id);
	}
	
	/* public function TeacherIndex(){
        $this->load->view('Teacher_Table_View');
	} */
	
	public function TeacherIndex(){
		$userData = $this->session->userdata('user_data');
		//pr($email);
        $data['TeacherList'] = $this->Teacher_Model->ViewTeachers();
		$data['AdminData'] = $this->data['AdminData'];
		$this->load->view('TeachersTableView', $data);
	}
	
	public function addTeacher(){	
        if ($this->input->post('Addsubmit')) {			
            $data['fullname'] = $this->input->post('fullname');
			$data['email'] = $this->input->post('email');
			$data['password'] = $this->input->post('password');
			$data['gender'] = $this->input->post('gender');		
			$data['dob'] = $this->input->post('dob');				
			$data['mobile_no'] = $this->input->post('mobile_no');
			$data['address'] = $this->input->post('address');
			$data['date_of_join'] = $this->input->post('date_of_join');
			$data['date_of_resigning'] = $this->input->post('date_of_resigning');		
			if (!empty($_FILES['profile_picture']['name'])) {
				/**** Call the Helper for Profile pic Upload ****/
				 $upload_result = upload_file('profile_picture', './assets/images/TeacherImages/');
				if ($upload_result['status']) {
					$data['profile_picture'] = $upload_result['file_path'];
				} else {
					$this->session->set_flashdata('error', $upload_result['error']);
					redirect('TeacherIndex');
					return;
				} 
			}
            $resp = $this->Teacher_Model->savedata($data);
            if ($resp == true) {
				$this->session->set_flashdata('success', 'Data Created Successfully');
				redirect('TeacherIndex');		
            }
		}
    }
	
	public function GetTeachersList(){
		$data['TeachersList'] = $this->Teacher_Model->ViewTeachers();
		$this->load->view('TeachersTableView.php', $data);
	}
	
	public function getTeacherData() {
		$id = $this->input->post('id');
		$data = $this->Teacher_Model->getTeacherDataById($id);
		//log_message('error',$data);
		echo json_encode($data);
	}
	
	public function UpdateTeacherData() {
		$teacher_id = $this->input->post('EditTeacherId');
		$OldProfilePic = $this->Teacher_Model->getTeacherDataById($teacher_id);

		$ImgUpdate = [];
		$new_image_uploaded = false;

		if (!empty($_FILES['EditProfilePicture']['name'])) { 
			$upload_result = upload_file('EditProfilePicture', './assets/images/TeacherImages/');  

			if ($upload_result['status']) {
				$ImgUpdate['profile_picture'] = $upload_result['file_path'];
				$new_image_uploaded = true;
				
				// Delete old image only if a new one is successfully uploaded
				if (!empty($OldProfilePic['profile_picture']) && file_exists(FCPATH . $OldProfilePic['profile_picture'])) {
					unlink(FCPATH . $OldProfilePic['profile_picture']);
				}
			} else {
				$this->session->set_flashdata('error', $upload_result['error']);
				redirect('TeacherIndex');
				return;
			}
		}

		$data = array(
			'fullname'          => $this->input->post('EditFullname'),
			'email'             => $this->input->post('EditEmail'),
			'mobile_no'         => $this->input->post('EditMobile'),
			'gender'            => $this->input->post('EditGender'),
			'dob'               => $this->input->post('EditDob'),
			'date_of_join'      => $this->input->post('EditDateofjoin'),
			'date_of_resigning' => $this->input->post('EditDateofResigning'),
			'address'           => $this->input->post('EditAddress')
		);

		// Update password only if a new password is provided
		$password = $this->input->post('EditPassword');
		if (!empty($password)) {
			$data['password'] = password_hash($password, PASSWORD_BCRYPT);
		}

		// Only update profile picture if a new image was uploaded
		if ($new_image_uploaded) {
			$data['profile_picture'] = $ImgUpdate['profile_picture'];
		}

		$updateStatus = $this->Teacher_Model->UpdateTeacher($teacher_id, $data);

		if ($updateStatus) {
			$this->session->set_flashdata('success', 'Data updated successfully');
		} else {
			$this->session->set_flashdata('error', 'Failed to update data');
		}

		redirect('TeacherIndex');
	}

	
	public function DeleteTeacher($id) {
		//pr($id);
		$deleted = $this->Teacher_Model->DeleteTeacherData($id);  // Call the model's delete function
		if ($deleted) {
			echo json_encode(['status' => 'success', 'message' => 'Student deleted successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to delete student.']);
		}
	}
}
?>