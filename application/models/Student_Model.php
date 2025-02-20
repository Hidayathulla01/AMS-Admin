<?php
class Student_Model extends CI_model{

	function __construct(){			
		parent::__construct();      
		$this->tbl_users = 'tbl_users';		
		$this->tbl_courses = 'tbl_courses';		
	}	
	
	public function ViewStudents(){
		$this->db->select("*");
		$this->db->from($this->tbl_users);
        $this->db->where('delete_status', 1);
        $this->db->where('role', 'Student');
		$query = $this->db->get(); 
		$result = $query->result_array();
		$data1 = array();
		$i = 1;
        foreach ($result as $row) {
			$iId = $i; 			
			$student_id = $row['user_id'];			
			$student_name = $row['user_name'];			
			$email = $row['email'];						
			$courseId = $row['student_course_id'];			
			$StudentCourseName = $this->GetcourseName($courseId);
			$CourseName = $StudentCourseName['course_name'];	
			
			$Delete = base_url('Student_Controller/delete_Student').'/'.$student_id;
			$DeleteLink = '<a type="button" href="#" onclick="confirmDelete(\''.$Delete.'\')" class=" btn-sm btn btn btn-danger m-1"><i class="fa fa-trash p-2" aria-hidden="true"></i></a>';
									
			$ViewLink = '<a type="button" class="btn-sm btn btn-info m-1" href="' . base_url('Student_Controller/StudentDetails/') . $student_id . '" aria-hidden="true"><i class="fa fa-eye p-2" aria-hidden="true"></i></a>';
			
			$EditLink = '<a type="button" class="btn-sm btn btn-secondary m-1" href="' . base_url('Student_Controller/updateStudent/') . $student_id . '" aria-hidden="true"><i class="fa fa-edit p-2" aria-hidden="true"></i></a>';
			
			            			            
			$Action = $EditLink. $ViewLink .$DeleteLink;

			$row = array();
			$row[] = $iId;
			$row[] = $student_id;
			$row[] = $student_name;
			$row[] = $email;
			$row[] = $CourseName;
			$row[] = $Action;
			$data1[] = $row;
			$i++;
		}
		$output = array("data" => $data1);
		return $output;		
	}
	
	public function GetcourseName($courseId){
		$this->db->select("course_name");
		$this->db->from($this->tbl_courses);
		$where_array = array("course_id" => $courseId);
		$this->db->where($where_array);
		$query = $this->db->get(); 
		
		$result = $query->row_array();
		return $result;		
	}
	
	public function getMasjidId($course_id){
		$this->db->select("masjid_name");
		$this->db->from($this->tbl_courses);
		$where_array = array("course_id" => $course_id);
		$this->db->where($where_array);
		$query = $this->db->get(); 
		
		$result = $query->row_array();
		return $result;		
	}
	
	public function savedata($data) {
		$this->db->insert('tbl_users', $data);
		return true;
	}			
			
	/*** Delete data ***/

	public function del_data($student_id){
		$where_array_upd = array("user_id" => $student_id); 
		$this->db->where($where_array_upd); 
		$this->db->update($this->tbl_users, array("delete_status" => 0));
		return true;
	}
	
	public function ViewStudent($student_id){
		$query = $this->db->get_where('tbl_users', array('user_id' => $student_id));		
		return $query->row();
	}

	//update data//
	public function select($student_id){
		$query = $this->db->get_where('tbl_users', array('user_id' => $student_id));		
		return $query->row();
	}
	
	public function update($data) {
		$where_array_upd = array("user_id" =>  $data['student_id']);
		$this->db->where($where_array_upd);

		$update_data = array(
			"student_course_id" => $data['course_name'],
			"masjid_id" => $data['masjid_id'],
			"user_name" => $data['student_name'],
			"gender" => $data['gender'],
			"profile_picture" => $data['profile_picture'],
			"mobile_no" => $data['mobile_no'],
			"email" => $data['email'],
			"password" => $data['password'],
			"dob" => $data['dob'],
			"country" => $data['country'],
			"parent_name" => $data['parent_name'],
			"relation" => $data['relation'],
			"parent_mobile" => $data['parent_mobile'],
			"payment_method" => $data['payment_method'],
			"role" => 'Student'
		);
        
		return $this->db->update($this->tbl_users, $update_data);
		//print_r($this->db->last_query());die();
	}

}

?>