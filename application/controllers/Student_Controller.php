<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Student_Controller  extends CI_controller{
	
	public function __construct(){
		parent::__construct ();
		$this->load->database();
		$this->load->model('Student_Model');
		$this->load->helper(array('form', 'url', 'string', 'download'));		
	}	
	
	public function StudentIndex(){
        $this->load->view('Student_Table_View');
	}	
	
	public function DashboardIndex(){
		$this->load->view('Dashboard.php');
	}	
	
    public function addStudent(){
		$this->load->view('Add_Student_Form');	
        if ($this->input->post('submit')) {
			$course_id = $this->input->post('course_name');			
			$masjid_id = $this->Student_Model->getMasjidId($course_id);
			$MasjidId = $masjid_id['masjid_name'];
			
			$data['student_course_id'] = $this->input->post('course_name');
			$data['role'] = 'Student';
			$data['user_name'] = $this->input->post('student_name');
            $data['gender'] = $this->input->post('gender');            
			$data['profile_picture'] = $this->input->post('profile_picture');
			$data['mobile_no'] = $this->input->post('mobile_no');
			$data['email'] = $this->input->post('email');
			$data['password'] = $this->input->post('password');
			$data['dob'] = $this->input->post('dob');
			$data['country'] = $this->input->post('country');
			$data['parent_name'] = $this->input->post('parent_name');
			$data['relation'] = $this->input->post('relation');
			$data['parent_mobile'] = $this->input->post('parent_mobile');
			$data['payment_method'] = $this->input->post('payment_method');			
			$data['masjid_id'] = $MasjidId;
            $resp = $this->Student_Model->savedata($data);
            if ($resp == true) {
				redirect('StudentIndex');		
            }
		}
	}	
	
	public function GetStudentsList(){
		$data = $this->Student_Model->ViewStudents();
        echo json_encode($data);
		//print_r($data);
	}
	
	/***for delete func ***/
	public function delete_Student($student_id){
		$response=$this->Student_Model->del_data($student_id);
		 if ($response == true) {			 
			redirect('StudentIndex');
		}
	}
	
    public function StudentDetails($student_id) {
		$data['response'] = $this->Student_Model->ViewStudent($student_id);
		$courseId = $data['response']->student_course_id;
		$data['response1'] = $this->Student_Model->GetcourseName($courseId);
		$data['formAction'] = base_url('Student_Controller/upd_Student/' . $student_id); 
		$this->load->view('Student_Details_View.php', $data);
	}		
	
	//for Update
	public function updateStudent($student_id) {
		$data['response'] = $this->Student_Model->select($student_id);
		$data['formAction'] = base_url('Student_Controller/upd_Student/' . $student_id); 
		$this->load->view('Student_UpdateForm.php', $data);
	}
	
    public function upd_Student($student_id) {
		$course_id = $this->input->post('course_name');
		$masjid_id = $this->Student_Model->getMasjidId($course_id);	
		$update_data = array(				
			'student_id' => $student_id,
			'masjid_id' => $masjid_id['masjid_name'],
			'course_name' => $this->input->post('course_name'),
			'student_name' => $this->input->post('student_name'),
			'gender' => $this->input->post('gender'),
			'profile_picture' => $this->input->post('profile_picture'),
			'mobile_no' => $this->input->post('mobile_no'),
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			'dob' => $this->input->post('dob'),
			'country' => $this->input->post('country'),
			'parent_name' => $this->input->post('parent_name'),
			'relation' => $this->input->post('relation'),
			'parent_mobile' => $this->input->post('parent_mobile'),
			'payment_method' => $this->input->post('payment_method'),
		);		
		$res = $this->Student_Model->update($update_data);
		if ($res) {
				redirect('StudentIndex');
		} else{
		    die('dfi');
		}
	}
	
	public function import_csv() {
        if (isset($_FILES['csv_file']['name']) && $_FILES['csv_file']['name'] != '') {
            $fileName = $_FILES['csv_file']['name'];
			echo '<pre>';

            $config['upload_path'] = FCPATH . 'uploads/';
            $config['file_name'] = $fileName;
            $config['allowed_types'] = 'csv';
            $config['max_size'] = 10000;

            $this->load->library('upload');
			$this->upload->initialize($config);
            if ($this->upload->do_upload('csv_file')) {
                $fileData = $this->upload->data();
                $file_path = './uploads/' . $fileData['file_name'];

                // Open the CSV file and read its content
                if (($handle = fopen($file_path, 'r')) !== false) {
                    $data = [];

                    // Skip the first row if it contains headers
                    $first_row = true;

                    while (($row = fgetcsv($handle, 1000, ",")) !== false) {
                        if ($first_row) {
                            $first_row = false; // Skip the header row
                            continue;
                        }

                        // Assuming the CSV columns are: Student Name, Address, Course ID
                        $data1[] = [
                            'student_course_id' => $row[0],
                            'user_name' => $row[1],
                            'dob' => $row[2],
                            'gender' => $row[3],
                            'email' => $row[4],
                            'password' => $row[5],
                            'mobile_no' => $row[6],
                            'country' => $row[7],
                            'parent_name' => $row[8],
                            'parent_mobile' => $row[9],
                            'payment_method' => $row[10],
                            'role' => 'Student'
                        ];
                    }
                    fclose($handle);

                    if (!empty($data1)) {
						foreach ($data1 as $data) {
							$this->Student_Model->savedata($data);  
						}
                        $this->session->set_flashdata('success', 'Data imported successfully!');
                         redirect('StudentIndex');
                    } else {
                        $this->session->set_flashdata('error', 'No data found in the file!');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Unable to open the file!');
                }
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
            }
           
        }
         redirect('StudentIndex');
    }
	
}
?>