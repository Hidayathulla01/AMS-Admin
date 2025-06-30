<?php
class Course_Model extends CI_model{

	function __construct(){			
		parent::__construct();      
		$this->tbl_courses = 'tbl_courses';		
		$this->tbl_masjids = 'tbl_masjids';		
	}	
	
	public function ViewCourses(){		
		$this->db->select("c.*,(SELECT COUNT(course_id) FROM {$this->tbl_courses} WHERE delete_status = 1) AS TotalCourses,m.masjid_name");	
		$this->db->from("{$this->tbl_courses} as c");
		$this->db->join("tbl_masjids as m", "c.masjid_name = m.masjid_id", "left");
		$this->db->where("c.delete_status", 1);
		$query = $this->db->get();		
		$result = $query->result_array();
		return $result;		
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
	
	public function getCourseDataById($id) {
		return $this->db->where('course_id', $id)->get('tbl_courses')->row_array();
	}
	
	public function UpdateCourse($course_id, $data){
		$this->db->where('course_id', $course_id);
		$query =  $this->db->update('tbl_courses', $data);
		//pr($this->db->last_query());
		return $query;
	}
	
	public function DeleteCourseData($id) {
		$this->db->where('course_id', $id);
		return $this->db->update('tbl_courses', array('delete_status' => 0)); 
	}
}

?>