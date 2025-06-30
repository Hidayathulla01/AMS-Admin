<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AssignClass_Controller  extends CI_controller{
	
	public function __construct(){
		parent::__construct ();
		$this->load->database();
		$this->load->model('AssignClass_Model');
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
	
	public function AssignClassIndex(){
		$data['AssignClassList'] = $this->AssignClass_Model->ViewAssignClasses();
		$data['AdminData'] = $this->data['AdminData'];
		$this->load->view('AssignClass.php', $data);
	}
	
	public function AssignClass() {
		if ($this->input->post('Addsubmit')) {
			// Basic details
			$data['teacher_id'] = $this->input->post('teacher_id');
			$data['masjid_id'] = $this->input->post('masjid_id');
			$data['courses_id'] = $this->input->post('course_id');

			// Visit type logic
			if ($this->input->post('visit_type') == 'Daily') {
				$data['visit_type'] = '1'; 
			} else {
				$data['visit_type'] = '2'; 
			}

			$selected_days = $this->input->post('selected_days'); 
			$success = true; 
			foreach ($selected_days as $day_id) {
				$start_time = $this->input->post("start_time_$day_id");
				$end_time = $this->input->post("end_time_$day_id");

				if ($start_time && $end_time) {
					$Finaldata = [
						'teacher_id' => $data['teacher_id'],
						'masjid_id' => $data['masjid_id'],
						'courses_id' => $data['courses_id'],
						'visit_type' => $data['visit_type'],
						'days' => $day_id,
						'start_time' => $start_time,
						'end_time' => $end_time
					];
					
					// Insert the data row by row
					$result = $this->AssignClass_Model->savedata($Finaldata);
					if (!$result) {
						$success = false; // Set to false if any insert fails
						break;
					}
				}
			}

			if ($success) {
				$this->session->set_flashdata('success', 'Data Created Successfully');
				redirect('AssignClassIndex'); // Redirect on success
			}
		}
	}	
	
	public function getAssignClassData() {
		$id = $this->input->post('id');
		$data = $this->AssignClass_Model->getAssignClassById($id);
		//log_message('error',$data);
		echo json_encode($data);
	}
	
	public function UpdateAssignClassData(){
		$class_id = $this->input->post('EditAssignClassId');
		$selected_days = $this->input->post('Editselected_days'); 
		$Weekdays = $selected_days[0]; 
		$start_time = $this->input->post("Editstart_time_$Weekdays");
		$end_time = $this->input->post("Editend_time_$Weekdays");
		$data = array(
			'teacher_id'    => $this->input->post('Editteacher_id'),
			'masjid_id'   	=> $this->input->post('Editmasjid_id'),
			'courses_id'    => $this->input->post('EditselectedCourses'),
			'visit_type'    => $this->input->post('EditVisit_type'),
			'days'      	=> $Weekdays,
			'start_time'    => $start_time,
			'end_time'      => $end_time,
		);
		//pr($data);
		$updateStatus = $this->AssignClass_Model->UpdateAssignClass($class_id, $data);
		if ($updateStatus) {
			//pr($updateStatus);
			$this->session->set_flashdata('success', 'Data updated successfully');
		} else {
			$this->session->set_flashdata('error', 'Failed to update data');
		}
		redirect('AssignClassIndex');
	}
	
	public function DeleteClass($id) {
		//pr($id);
		$deleted = $this->AssignClass_Model->DeleteClassData($id);  // Call the model's delete function
		//log_message('error',$deleted );
		if ($deleted) {
			echo json_encode(['status' => 'success', 'message' => 'Student deleted successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to delete student.']);
		}
	}
	
}




?>