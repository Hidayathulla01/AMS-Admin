<?php
class Teacher_Model extends CI_model{

	function __construct(){			
		parent::__construct();      
		$this->tbl_teacher = 'tbl_teacher';		
	}	
	
	public function ViewTeachers(){
		$this->db->select("*, (SELECT COUNT(teacher_id) FROM {$this->tbl_teacher} WHERE delete_status = 1) AS TotalTeachers");
		$this->db->from($this->tbl_teacher);
		$this->db->where('delete_status', 1);
		$query = $this->db->get();    
		$result = $query->result_array();
		//pr($result);
		return $result;
	}

	public function savedata($data) {			
		$this->db->insert('tbl_teacher', $data);	
		//pr($this->db->last_query());die();
		return true;
	}
	
	public function getTeacherDataById($id) {
		return $this->db->where('teacher_id', $id)->get('tbl_teacher')->row_array();
	}
	
	public function UpdateTeacher($teacher_id, $data){
		$this->db->where('teacher_id', $teacher_id);
		$wd =  $this->db->update('tbl_teacher', $data);
		//pr($this->db->last_query());
		return $wd;
	}
	
	public function DeleteTeacherData($id) {
		$this->db->where('teacher_id', $id);
		return $this->db->update('tbl_teacher', array('delete_status' => 0)); 
	}
}

?>