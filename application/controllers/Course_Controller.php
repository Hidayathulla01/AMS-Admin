<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Course_Controller  extends CI_controller{
	
	public function __construct(){
		parent::__construct ();
		$this->load->database();
		$this->load->model('Course_Model');
		$this->load->helper(array('form', 'url', 'string', 'download'));		
	}	
	
	public function CourseIndex(){
        $this->load->view('Course_Table_View');
	}	
	
	public function addCourse(){
		$this->load->view('Add_Course_Form');	
        if ($this->input->post('submit')) {       
            $data['masjid_name'] = $this->input->post('masjid_name');
			$data['student_type'] = $this->input->post('student_type');			
			$data['gender'] = $this->input->post('gender');			
			$data['course_name'] = $this->input->post('course_name');
            $data['title'] = $this->input->post('title');            
			$data['description'] = $this->input->post('description');
           
            $resp = $this->Course_Model->savedata($data);
            if ($resp == true) {
				redirect('CourseIndex');		
            }
		}
	}	
	
	public function GetCoursesList(){
		$data = $this->Course_Model->ViewCourses();
        echo json_encode($data);
		//print_r($data);
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
	
	//for Update
	public function updateCourse($course_id) {
		$data['response'] = $this->Course_Model->select($course_id);
		$data['formAction'] = base_url('Course_Controller/upd_Course/' . $course_id); 
		$this->load->view('Course_UpdateForm.php', $data);
	}	
		
	public function upd_Course($course_id) {
		$update_data = array(
			'course_id' => $course_id,
			'masjid_name' => $this->input->post('masjid_name'),
			'student_type' => $this->input->post('student_type'),
			'gender' => $this->input->post('gender'),
			'course_name' => $this->input->post('course_name'),
			'title' => $this->input->post('title'),
			'description' => $this->input->post('description')
		);
		
		$res = $this->Course_Model->update($update_data);
		if ($res) {
				redirect('CourseIndex');
		} 
	}
}
?>