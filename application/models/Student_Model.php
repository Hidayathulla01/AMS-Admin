<?php
class Student_Model extends CI_model{

	function __construct(){			
		parent::__construct();      
		$this->tbl_student = 'tbl_student';		
		$this->tbl_courses = 'tbl_courses';		
		$this->tbl_parents = 'tbl_parents';		
		$this->tbl_masjids = 'tbl_masjids';		
	}	
	
	public function ViewStudents(){
		$this->db->select("s.*,(SELECT COUNT(student_id) FROM {$this->tbl_student} WHERE delete_status = 1) AS TotalStudents,p.email, c.course_name");		
		$this->db->from("{$this->tbl_student} as s");
		$this->db->join("tbl_parents as p", "s.parent_id = p.parent_id", "left");
		$this->db->join("tbl_courses as c", "s.course_id = c.course_id", "left");
		$this->db->where("s.delete_status", 1);
		$this->db->order_by("s.server_date", "DESC");
		$query = $this->db->get(); 
		//pr($this->db->last_query());
		$result = $query->result_array();
		return $result;
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
	
	public function saveStudent($Studentsdata) {
		return $this->db->insert('tbl_student', $Studentsdata);
	}
	
	public function ViewStudent($student_id){
		$query = $this->db->get_where('tbl_users', array('user_id' => $student_id));		
		return $query->row();
	}	
	
	public function getStudentDataById($id) {
		$this->db->select('
			tbl_student.*, 
			tbl_student.fullname AS StudentName, 
			tbl_parents.*, 
			tbl_parents.fullname AS ParentName, 
			tbl_masjids.masjid_name AS MasjidName, 
			GROUP_CONCAT(tbl_courses.course_name ORDER BY tbl_courses.course_id ASC SEPARATOR ", ") as CoursesName
		');
		$this->db->from('tbl_student');
		$this->db->join('tbl_parents', 'tbl_student.parent_id = tbl_parents.parent_id', 'left'); 
		$this->db->join('tbl_masjids', 'tbl_student.masjid_id = tbl_masjids.masjid_id', 'left');
		// Use FIND_IN_SET to match courses_id
		$this->db->join('tbl_courses', 'FIND_IN_SET(tbl_courses.course_id, tbl_student.course_id) > 0', 'left');
		$this->db->where('tbl_student.student_id', $id);
		
		$query = $this->db->get();
		//log_message('error',$query);
		return $query->row_array();
	}
	
	
	public function UpdateStudent($StudentData, $ParentData, $student_id, $parentId) {
		// Update student data
		//pr($student_id);
		$this->db->where('student_id', $student_id);
		$studentUpdate = $this->db->update('tbl_student', $StudentData);

		if ($studentUpdate) {
			if (!empty($ParentData)) {
				$this->db->where('parent_id', $parentId);
				$parentUpdate = $this->db->update('tbl_parents', $ParentData);
				if ($parentUpdate) {
					return true;  
				}
			}
			return true;  
		}
	}
	
	public function DeleteStudentData($id) {
		$this->db->where('student_id', $id);
		return $this->db->update('tbl_student', array('delete_status' => 0));  // Replace 'tbl_student' with your table name
	}

}

?>