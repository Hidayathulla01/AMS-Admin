<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller  extends CI_controller{
	
	public function __construct(){
		parent::__construct ();
		$this->load->database();
		$this->load->model('Admin_Model');
		$this->load->helper(array('form', 'url', 'string', 'download'));
		$this->load->library('session');
		if (empty($this->session->userdata('user_data'))) {
            redirect(base_url());
        }
		$userData = $this->session->userdata('user_data');
		$id = $userData['admin_id'];
		$this->data['AdminData'] = $this->Admin_Model->getAdminDataById($id);
	}	
		
	public function AdminIndex(){
		$data['AdminList'] = $this->Admin_Model->ViewAdmins();
		$data['AdminData'] = $this->data['AdminData'];
		$this->load->view('AdminsTableView', $data); 
	}
	
	public function AddAdmin(){
        if ($this->input->post('Addsubmit')) {
            $data['fullname'] = $this->input->post('fullname');
			$data['email'] = $this->input->post('email');
			$data['password'] = $this->input->post('password');
			$data['mobile_no'] = $this->input->post('mobile_no');	         
			$data['gender'] = $this->input->post('gender');
			$data['dob'] = $this->input->post('dob');
			$data['address'] = $this->input->post('address');
			
			/**** Call the Helper for Profile pic Upload ****/
			 $upload_result = upload_file('profile_picture', './assets/images/AdminImages/');
			 if (!empty($_FILES['profile_picture']['name'])) {
				if ($upload_result['status']) {
					$data['profile_picture'] = $upload_result['file_path'];
				} else {
					$this->session->set_flashdata('error', $upload_result['error']);
					redirect('AdminIndex');
					return;
				} 
			}
            $resp = $this->Admin_Model->savedata($data);
            if ($resp == true) {
				$this->session->set_flashdata('success', 'Data Created Successfully');
				redirect('AdminIndex');		
            }
		}
    }
	
	public function getAdminData() {
		$id = $this->input->post('id');
		$data = $this->Admin_Model->getAdminDataById($id);
		echo json_encode($data);
	}
	
	public function UpdateAdminData() {
		$admin_id = $this->input->post('admin_id');
		$OldProfilePic = $this->Admin_Model->getAdminDataById($admin_id);

		$ImgUpdate = [];
		$new_image_uploaded = false;

		if (!empty($_FILES['EditProfilePicture']['name'])) { 
			$upload_result = upload_file('EditProfilePicture', './assets/images/AdminImages/');  
			
			if ($upload_result['status']) {
				$ImgUpdate['profile_picture'] = $upload_result['file_path'];
				$new_image_uploaded = true;
				
				// Delete old image only if a new one is successfully uploaded
				if (!empty($OldProfilePic['profile_picture']) && file_exists(FCPATH . $OldProfilePic['profile_picture'])) {
					unlink(FCPATH . $OldProfilePic['profile_picture']);
				}
			} else {
				$this->session->set_flashdata('error', $upload_result['error']);
				redirect('AdminIndex');
				return;
			}
		}

		$data = array(
			'fullname'   => $this->input->post('fullname'),
			'email'      => $this->input->post('email'),
			'password'   => $this->input->post('password'),
			'dob'        => $this->input->post('dob'),
			'gender'     => $this->input->post('EditGender'),
			'mobile_no'  => $this->input->post('mobile_no'),
			'address'    => $this->input->post('address')
		);

		// Only update profile picture if a new image was uploaded
		if ($new_image_uploaded) {
			$data['profile_picture'] = $ImgUpdate['profile_picture'];
		}

		$updateStatus = $this->Admin_Model->UpdateAdmin($admin_id, $data);

		if ($updateStatus) {
			$this->session->set_flashdata('success', 'Data updated successfully');
		} else {
			$this->session->set_flashdata('error', 'Failed to update data');
		}		
		redirect('AdminIndex');
	}

	
	public function DeleteAdmin($id) {
		//pr($id);
		$deleted = $this->Admin_Model->DeleteAdminData($id);  // Call the model's delete function
		//log_message('error',$deleted );
		if ($deleted) {
			echo json_encode(['status' => 'success', 'message' => 'Student deleted successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to delete student.']);
		}
	}
	
	
	
}