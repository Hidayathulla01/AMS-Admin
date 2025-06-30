<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Course_Controller  extends CI_controller{
	
	public function __construct(){
		parent::__construct ();
		$this->load->database();
		$this->load->model('Course_Model');
		$this->load->model('Admin_Model');
		$this->load->library('session');
		$this->load->helper(array('form', 'url', 'string', 'download'));	
		if (empty($this->session->userdata('user_data'))) {
            redirect(base_url());
        }	
		$userData = $this->session->userdata('user_data');
		$id = $userData['admin_id'];
		$this->data['AdminData'] = $this->Admin_Model->getAdminDataById($id);
	}	
	
	public function CourseIndex(){
		$userData = $this->session->userdata('user_data');
		$fullname = $userData['fullname']; //pr($userData);
		$data['CourseList'] = $this->Course_Model->ViewCourses();
		$data['AdminData'] = $this->data['AdminData'];
		$this->load->view('CoursesTableView', $data);
	}
	
	public function AddCourse(){
        if ($this->input->post('Addsubmit')) {			
			$data['course_name'] = $this->input->post('course_name');
            $data['masjid_name'] = $this->input->post('masjid_name');
			$data['student_type'] = $this->input->post('student_type');
			$data['title'] = $this->input->post('title');
			$data['description'] = $this->input->post('description');
			
			/**** Call the Helper for Profile pic Upload ****/
			$upload_result = upload_file('profile_picture', './assets/images/CourseImages/');
			if (!empty($_FILES['EditProfilePicture']['name'])) {
				if ($upload_result['status']) {
					$data['profile_picture'] = $upload_result['file_path'];
				} else {
					$this->session->set_flashdata('error', $upload_result['error']);
					redirect('CourseIndex');
					return;
				} 
			} 
            $resp = $this->Course_Model->savedata($data);
			//pr($resp);
            if ($resp == true) {
				$this->session->set_flashdata('success', 'Data Created Successfully');
				redirect('CourseIndex');		
            }
		}
    }
	
	/***for delete func ***/
	public function delete_Course($course_id){
		$response=$this->Course_Model->del_data($course_id);
		 if ($response == true) {			 
			redirect('CourseIndex');
		}		
	}
	
	public function CourseDetails($course_id) {
		$data['response'] = $this->Course_Model->ViewDetails($course_id);
		$data['formAction'] = base_url('Course_Controller/upd_Course/' . $course_id); 
		$this->load->view('Course_Details_View.php', $data);
	}
	
	public function getCourseData() {
		$id = $this->input->post('id');
		$data = $this->Course_Model->getCourseDataById($id);
		//log_message('error',$data);
		echo json_encode($data);
	}
	
	public function UpdateCourseData() {
		$course_id = $this->input->post('EditCourseId');
		$OldProfilePic = $this->Course_Model->getCourseDataById($course_id);

		$ImgUpdate = [];
		$new_image_uploaded = false;

		if (!empty($_FILES['EditProfilePicture']['name'])) { 
			$upload_result = upload_file('EditProfilePicture', './assets/images/CourseImages/');  
			
			if ($upload_result['status']) {
				$ImgUpdate['profile_picture'] = $upload_result['file_path'];
				$new_image_uploaded = true;
				
				// Delete old image only if a new one is successfully uploaded
				if (!empty($OldProfilePic['profile_picture']) && file_exists(FCPATH . $OldProfilePic['profile_picture'])) {
					unlink(FCPATH . $OldProfilePic['profile_picture']);
				}
			} else {
				$this->session->set_flashdata('error', $upload_result['error']);
				redirect('CourseIndex');
				return;
			}
		}

		$data = array(
			'masjid_name'   => $this->input->post('EditMasjidname'),
			'student_type'  => $this->input->post('EditStudentType'),
			'course_name'   => $this->input->post('EditCourseName'),
			'title'         => $this->input->post('EditTitle'),
			'description'   => $this->input->post('EditDescription')
		);

		// Only update profile picture if a new image was uploaded
		if ($new_image_uploaded) {
			$data['profile_picture'] = $ImgUpdate['profile_picture'];
		}

		$updateStatus = $this->Course_Model->UpdateCourse($course_id, $data);

		if ($updateStatus) {
			$this->session->set_flashdata('success', 'Data updated successfully');
		} else {
			$this->session->set_flashdata('error', 'Failed to update data');
		}
		
		redirect('CourseIndex');
	}

	
	public function DeleteCourse($id) {
		//pr($id);
		$deleted = $this->Course_Model->DeleteCourseData($id);  // Call the model's delete function
		if ($deleted) {
			echo json_encode(['status' => 'success', 'message' => 'Student deleted successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to delete student.']);
		}
	}
}
?>