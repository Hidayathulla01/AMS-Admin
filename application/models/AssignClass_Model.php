<?php
class AssignClass_Model extends CI_model{

	function __construct(){			
		parent::__construct();      
		$this->tbl_courses = 'tbl_courses';		
		$this->tbl_masjids = 'tbl_masjids';		
		$this->tbl_teacher = 'tbl_teacher';		
		$this->tbl_assignclasses = 'tbl_assignclasses';		
	}	
	
	/*public function ViewAssignClasses(){		
		//pr('ok');
		$this->db->select('a.*, m.masjid_name, c.course_name, t.fullname');
		$this->db->from($this->tbl_assignclasses . ' as a');
		$this->db->join('tbl_masjids as m', 'a.masjid_id = m.masjid_id', 'left');
		$this->db->join('tbl_teacher as t', 'a.teacher_id = t.teacher_id', 'left');
		$this->db->join('tbl_courses as c', 'a.courses_id = c.course_id', 'left');
		$this->db->where('a.delete_status', 1);
		$query = $this->db->get();
		//pr($this->db->last_query());
		//log_message('error'.$query);
		$result = $query->result_array();
		return $result;		
	}	*/
	
	public function ViewAssignClasses() {
		$this->db->select('a.*, m.masjid_name, t.fullname, GROUP_CONCAT(c.course_name ORDER BY c.course_id ASC SEPARATOR ", ") as course_names');
		$this->db->from($this->tbl_assignclasses . ' as a');
		$this->db->join('tbl_masjids as m', 'a.masjid_id = m.masjid_id', 'left');
		$this->db->join('tbl_teacher as t', 'a.teacher_id = t.teacher_id', 'left');
		$this->db->join('tbl_courses as c', 'FIND_IN_SET(c.course_id, a.courses_id)', 'left');
		$this->db->where('a.delete_status', 1);
		$this->db->group_by('a.class_id');
		$this->db->order_by('a.class_id','DESC');
		$query = $this->db->get();
		//log_message('error in query'.$query);
		//pr($this->db->last_query());
		
		$result = $query->result_array();
		return $result;
	}	
	
	public function getAssignClassById($id) {
		$this->db->select('tbl_assignclasses.*, tbl_teacher.fullname AS teacherName, tbl_masjids.masjid_name AS MasjidName, GROUP_CONCAT(tbl_courses.course_name ORDER BY tbl_courses.course_id ASC SEPARATOR ", ") as CoursesName');
		$this->db->from('tbl_assignclasses');
		$this->db->join('tbl_teacher', 'tbl_assignclasses.teacher_id = tbl_teacher.teacher_id', 'left');
		$this->db->join('tbl_masjids', 'tbl_assignclasses.masjid_id = tbl_masjids.masjid_id', 'left');
		$this->db->join('tbl_courses', 'FIND_IN_SET(tbl_courses.course_id, tbl_assignclasses.courses_id)', 'left');
		$this->db->where('tbl_assignclasses.class_id', $id);
		$query = $this->db->get();
		//pr($this->db->last_query());
		return $query->row_array();
	}

	
	public function savedata($Finaldata) {
		$query= $this->db->insert('tbl_assignclasses', $Finaldata);	
		//log_message('error in query'.$query);
		//pr($this->db->last_query());
		return true;
	}
	
	public function UpdateAssignClass($class_id, $data){
		$this->db->where('class_id', $class_id);
		$studentUpdate = $this->db->update('tbl_assignclasses', $data);
		return true;  	
	}
	
	public function DeleteClassData($id) {
		$this->db->where('class_id', $id);
		return $this->db->update('tbl_assignclasses', array('delete_status' => 0)); 
	}
}

?>