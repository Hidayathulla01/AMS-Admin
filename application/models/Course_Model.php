<?php
class Course_Model extends CI_model{

	function __construct(){			
		parent::__construct();      
		$this->tbl_courses = 'tbl_courses';		
		$this->tbl_masjids = 'tbl_masjids';		
	}	
	
	public function ViewCourses(){
		$this->db->select("*");
		$this->db->from($this->tbl_courses);
		$where_array = array("delete_status" => 1);
		$this->db->where($where_array);
		$query = $this->db->get(); 
		//print_r($this->db->last_query());die();
		$result = $query->result_array();
		$data1 = array();
		$i = 1;
        foreach ($result as $row) {		
			$iId = $i; 			
			$course_id = $row['course_id'];	
			$course_name = $row['course_name'];	
			$masjid_name = $row['masjid_name'];
			$student_type = $row['student_type'];			
			$MasjidId = $this->getMasjidName($masjid_name);
			$Masjid_Id = $MasjidId['masjid_name'];	
	
			
			$Delete = base_url('Course_Controller/delete_Course').'/'.$course_id;
			$DeleteLink = '<a type="button" href="#" onclick="confirmDelete(\''.$Delete.'\')" class=" btn-sm btn btn btn-danger m-1"><i class="fa fa-trash p-2" aria-hidden="true"></i></a>';														
			
			$EditLink = '<a type="button" class="btn-sm btn btn-secondary m-1" href="' . base_url('Course_Controller/updateCourse/') . $course_id . '" aria-hidden="true"><i class="fa fa-edit p-2" aria-hidden="true"></i></a>';
			
			$ViewLink = '<a type="button" class="btn-sm btn btn-info m-1" href="' . base_url('Course_Controller/CourseDetails/') . $course_id . '" aria-hidden="true"><i class="fa fa-eye p-2" aria-hidden="true"></i></a>';
			
			$Action = $EditLink. $ViewLink .$DeleteLink;

			$row = array();
			$row[] = $iId;
			$row[] = $course_id;
			$row[] = $course_name;
			$row[] = $Masjid_Id;
			$row[] = $student_type;			
			$row[] = $Action;
			$data1[] = $row;
			$i++;
			
		}
		$output = array("data" => $data1);
		return $output;		
	}
	
	public function getMasjidName($getMasjidName) {
		$this->db->from($this->tbl_masjids);
		$where_array = array("masjid_id" => $getMasjidName);
		$this->db->where($where_array);
		$query = $this->db->get();
		$result = $query->row_array();
		return $result;
	}
	

	
	public function savedata($data) {			
		$this->db->insert('tbl_courses', $data);			
		return true;
	}			
			
	/*** Delete data ***/
	public function del_data($course_id){
		$where_array_upd = array("course_id" => $course_id); 
		$this->db->where($where_array_upd); 
		$this->db->update($this->tbl_courses, array("delete_status" => 0));
		return true;
	}
			
	public function ViewDetails($course_id){
		$query = $this->db->get_where('tbl_courses', array('course_id' => $course_id));		
		return $query->row();
	}
	
	//update data//
	public function select($course_id){
		$query = $this->db->get_where('tbl_courses', array('course_id' => $course_id));		
		return $query->row();
	}
	
	public function update($data) {
		$where_array_upd = array("course_id" =>  $data['course_id']);
		$this->db->where($where_array_upd);

		$update_data = array(
			"masjid_name" => $data['masjid_name'],
			"student_type" => $data['student_type'],
			"gender" => $data['gender'],
			"course_name" => $data['course_name'],
			"title" => $data['title'],
			"description" => $data['description'],
		);

		return $this->db->update($this->tbl_courses, $update_data);
	}

}

?>