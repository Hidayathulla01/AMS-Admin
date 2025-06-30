<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Masjid_Controller  extends CI_controller{
	
	public function __construct(){
		parent::__construct ();
		$this->load->database();
		$this->load->model('Masjid_Model');
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
	
	public function MasjidIndex(){
		$data['MasjidList'] = $this->Masjid_Model->ViewMasjids();
		$data['AdminData'] = $this->data['AdminData'];
		$this->load->view('MasjidsTableView', $data);
	}
	
	public function AddMasjid(){
        if ($this->input->post('Addsubmit')) {
			
            $data['masjid_name'] = $this->input->post('masjid_name');
			$data['address'] = $this->input->post('address');
			$data['contact_person'] = $this->input->post('contact_person');
			$data['mobile_no'] = $this->input->post('mobile_no');	         
			$data['description'] = $this->input->post('description');
			
			/**** Call the Helper for Profile pic Upload ****/
				$upload_result = upload_file('profile_picture', './assets/images/MasjidImages/');
			if (!empty($_FILES['profile_picture']['name'])) {				
				if ($upload_result['status']) {
					$data['profile_picture'] = $upload_result['file_path'];
				} else {
					$this->session->set_flashdata('error', $upload_result['error']);
					redirect('MasjidIndex');
					return;
				} 
				//pr($data);
            }
				$resp = $this->Masjid_Model->savedata($data);
				if ($resp == true) {
					$this->session->set_flashdata('success', 'Data Created Successfully');
					redirect('MasjidIndex');		
				}
		}
    }
	
	/***for delete func ***/
	public function delete_id($masjid_id){
		$response=$this->Masjid_Model->del_data($masjid_id);
		 if ($response == true) {			 
			redirect('MasjidIndex');
		}		
	}
	
	public function getMasjidData() {
		$id = $this->input->post('id');
		$data = $this->Masjid_Model->getMasjidDataById($id);
		//log_message('error',$data);
		echo json_encode($data);
	}
	
	public function UpdateMasjidData(){
		$masjid_id = $this->input->post('EditMasjidId');
		$OldProfilePic = $this->Masjid_Model->getMasjidDataById($masjid_id);		
		if (!empty($OldProfilePic['profile_picture']) && file_exists(FCPATH . $OldProfilePic['profile_picture'])) {
			unlink(FCPATH . $OldProfilePic['profile_picture']); // Delete the old image
		}
		
		$upload_result = upload_file('EditProfilePicture', './assets/images/MasjidImages/');
			if (!empty($_FILES['EditProfilePicture']['name'])) {
				if ($upload_result['status']) {
					$ImgUpdate['EditProfilePicture'] = $upload_result['file_path'];
				} else {
					$this->session->set_flashdata('error', $upload_result['error']);
					redirect('StudentIndex');
					return;
				}
			}
			
		$data = array(
			'masjid_name'   	=> $this->input->post('EditMasjidname'),
			'contact_person'    => $this->input->post('EditContactperson'),
			'profile_picture'   => $ImgUpdate['EditProfilePicture'],
			'mobile_no'         => $this->input->post('EditMobileno'),
			'address'        	=> $this->input->post('EditAddress'),
			'description'     	=> $this->input->post('EditDescription'),
		);
		
		$updateStatus = $this->Masjid_Model->UpdateMasjid($masjid_id, $data);
		if ($updateStatus) {
			//pr($updateStatus);
			$this->session->set_flashdata('success', 'Data updated successfully');
		} else {
			$this->session->set_flashdata('error', 'Failed to update data');
		}
		redirect('MasjidIndex');
	}
	
	public function DeleteMasjid($id) {
		//pr($id);
		$deleted = $this->Masjid_Model->DeleteMasjidData($id);  // Call the model's delete function
		if ($deleted) {
			echo json_encode(['status' => 'success', 'message' => 'Student deleted successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to delete student.']);
		}
	}
}
?>