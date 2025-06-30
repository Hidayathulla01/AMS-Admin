<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Student_Controller  extends CI_controller{
	
	public function __construct(){
		parent::__construct ();
		$this->load->database();
		$this->load->model('Student_Model');
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
	
	public function StudentIndex1(){
		$data['StudentList'] = $this->Student_Model->ViewStudents();
		$data['AdminData'] = $this->data['AdminData'];
		//pr($data);
		$this->load->view('StudentsTableView1', $data);
	}		
	
	public function StudentIndex(){
		$data['StudentList'] = $this->Student_Model->ViewStudents();
		$data['AdminData'] = $this->data['AdminData'];
		//pr($data);
		$this->load->view('StudentsTableView', $data);
	}	
	
	public function DashboardIndex(){
		$this->load->view('Dashboard.php');
	}	
	
	public function AddStudent() {
		if ($this->input->post('Addsubmit')) {
			//pr('fg');
			$newParentName = $this->input->post('Parentfullname_new');
			$existingParentId = $this->input->post('Parentfullname_existing');	
			$parentId = null;
			if (!empty($newParentName)) {
				$Parentsdata = [
					'fullname' => $newParentName,
					'email' => $this->input->post('email'),
					'password' => $this->input->post('password'),
					'parent_mobile' => $this->input->post('parent_mobile'),
					'address' => $this->input->post('address'),
				];
				
				$this->db->insert('tbl_parents', $Parentsdata);
				$parentId = $this->db->insert_id(); 
			}elseif (!empty($existingParentId)) {
				$parentId = $existingParentId;
			}			
			//pr($Parentsdata);
			$Studentsdata = [
				'fullname' => $this->input->post('fullname'),
				'masjid_id' => $this->input->post('masjid_id'),
				'parent_id' => $parentId, 
				'course_id' => $this->input->post('selected_courses'),
				'mobile_no' => $this->input->post('mobile_no'),
				'gender' => $this->input->post('gender'),
				'dob' => $this->input->post('dob'),
				'relation' => $this->input->post('relation'),
				'payment_method' => $this->input->post('payment_method'),
			];
			//pr($Studentsdata);
			$upload_result = upload_file('profile_picture', './assets/images/StudentImages/');
			if (!empty($_FILES['profile_picture']['name'])) {
				if ($upload_result['status']) {
					$Studentsdata['profile_picture'] = $upload_result['file_path'];
				} else {
					$this->session->set_flashdata('error', $upload_result['error']);
					redirect('StudentIndex');
					return;
				}
			}
			$resp = $this->Student_Model->saveStudent($Studentsdata);
			if ($resp) {
				$this->session->set_flashdata('success', 'Data Created Successfully');
				redirect('StudentIndex');
			}
		} 
	}	
	
	public function GetParentData() {
		if ($this->input->post('ParentId')) {
			$parentId = $this->input->post('ParentId');			
			$this->db->select('*');
			$this->db->from('tbl_parents');
			$this->db->where('parent_id', $parentId);
			$this->db->where('delete_status', '1');
			$query = $this->db->get();
			
			if ($query->num_rows() > 0) {
				echo json_encode($query->result_array());
			} else {
				echo json_encode([]);
			}
		} else {
			echo json_encode(['error' => 'Invalid Parent ID']);
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
	
	public function getStudentData(){
		$id = $this->input->post('id');
		$data = $this->Student_Model->getStudentDataById($id);
		//log_message('error',$data);
		echo json_encode($data);
	}
	
	public function UpdateStudentData() {
		$id = $this->input->post('EditStudentId');
		
		$EditnewParentName = $this->input->post('EditParentfullname_new');
		$parentId = null;
		$ParentData = [];
		$OldProfilePic = $this->Student_Model->getStudentDataById($id);
		
		// If a new parent is created
		if (!empty($EditnewParentName)) {
			//pr('ok');
			$ParentData = [
				'fullname'      => $EditnewParentName,
				'email'         => $this->input->post('EditEmail'),
				'password'      => $this->input->post('EditPassword'),
				'parent_mobile' => $this->input->post('EditParentMobile'),
				'address'       => $this->input->post('EditAddress'),
			];
			$this->db->insert('tbl_parents', $ParentData);
			$parentId = $this->db->insert_id();  // New parent ID
			
		}elseif (!empty($this->input->post('EditParentfullname_existing'))) {
			//pr('osk');
			$parentId = $this->input->post('EditParentfullname_existing');
			//pr($parentId);
			$ParentData = [
				'email'         => $this->input->post('EditEmail'),
				'password'      => $this->input->post('EditPassword'),
				'parent_mobile' => $this->input->post('EditParentMobile'),
				'address'       => $this->input->post('EditAddress'),
			];
		}
		
		$upload_result = upload_file('EditProfilePicture', './assets/images/StudentImages/');
			if (!empty($_FILES['EditProfilePicture']['name'])) {
				if ($upload_result['status']) {
					$ImgUpdate['EditProfilePicture'] = $upload_result['file_path'];
					 // Delete old image only when a new one is successfully uploaded
					if (!empty($OldProfilePic['profile_picture']) && file_exists(FCPATH . $OldProfilePic['profile_picture'])) {
						unlink(FCPATH . $OldProfilePic['profile_picture']);
					}
				} else {
					$this->session->set_flashdata('error', $upload_result['error']);
					redirect('StudentIndex');
					return;
				}
			}

		$StudentData = [
			'fullname'       => $this->input->post('EditFullname'),
			'masjid_id'      => $this->input->post('Editmasjid_id'),
			'parent_id'      => $parentId,
			'gender'         => $this->input->post('EditGender'),
			'dob'            => $this->input->post('EditDob'),
			'mobile_no'      => $this->input->post('EditMobile'),
			'relation'       => $this->input->post('EditRelation'),
			'payment_method' => $this->input->post('EditPaymentMethod'),
			'course_id'      => $this->input->post('EditselectedCourses')
		];
		
		if (!empty($ImgUpdate['EditProfilePicture'])) {
			$StudentData['profile_picture'] = $ImgUpdate['EditProfilePicture'];
		}
		
		pr($StudentData);
		$updateStatus = $this->Student_Model->UpdateStudent($StudentData, $ParentData, $id, $parentId);

		if ($updateStatus) {
			$this->session->set_flashdata('success', 'Data updated successfully');
		} else {
			$this->session->set_flashdata('error', 'Failed to update data');
		}

		redirect('StudentIndex');
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
	
	public function get_courses_by_masjid() {
		$masjid_id = $this->input->post('masjid_id'); // Get the selected Masjid ID

		$courses = $this->db->select('course_name, course_id')
							->from('tbl_courses')
							->where('masjid_name', $masjid_id) // Ensure the correct column name
							->where('delete_status', '1') // Optional: To filter only active courses
							->order_by('course_name', 'ASC')
							->get()
							->result_array();

		echo json_encode($courses);
	}
	
	public function DeleteStudent($id) {
		//pr($id);
		$deleted = $this->Student_Model->DeleteStudentData($id);  // Call the model's delete function
		//log_message('error',$deleted );
		if ($deleted) {
			echo json_encode(['status' => 'success', 'message' => 'Student deleted successfully.']);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Failed to delete student.']);
		}
	}
	
	public function CheckEmailExist() {
		$email = $this->input->post('email');
		$this->db->where(array('email' => $email, 'delete_status' => 1));
		$parent_query = $this->db->get('tbl_parents');

		// Check in tbl_teacher
		$this->db->where(array('email' => $email, 'delete_status' => 1));
		$teacher_query = $this->db->get('tbl_teacher');

		if ($parent_query->num_rows() > 0 || $teacher_query->num_rows() > 0) {
			echo json_encode(['status' => 'error', 'message' => 'This Email already exists.']);
		} else {
			echo json_encode(['status' => 'success']);
		}
	}

	
}
?>