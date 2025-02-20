<?php
class Teacher_Model extends CI_model{

	function __construct(){			
		parent::__construct();      
		$this->tbl_users = 'tbl_users';		
	}	
	
	public function ViewTeachers(){
		$this->db->select("*");
        $this->db->from($this->tbl_users);
        $this->db->where('delete_status', 1);
        $this->db->where('role', 'Teacher');
        $query = $this->db->get(); 
		//pr($this->db->last_query());
        $result = $query->result_array();
		
		$data1 = array();
		$i = 1;
        foreach ($result as $row) {
			$iId = $i;
			$user_id = $row['user_id'];			
			$user_name = $row['user_name'];			
			$course_name = $row['course_name'];			
			$gender = $row['gender'];			
			$email = $row['email'];			
			$date_of_join = $row['date_of_join'];		
			
			$Delete = base_url('Teacher_Controller/delete_User').'/'.$user_id;
			$DeleteLink = '<a type="button" href="#" onclick="confirmDelete(\''.$Delete.'\')" class=" btn-sm btn btn btn-danger m-1"><i class="fa fa-trash p-2" aria-hidden="true"></i></a>';
						
			$ViewLink = '<a type="button" class="btn-sm btn btn-info m-1" href="' . base_url('Teacher_Controller/TeacherDetails/') . $user_id . '" aria-hidden="true"><i class="fa fa-eye p-2" aria-hidden="true"></i></a>';
			
			$EditLink = '<a type="button" class="btn-sm btn btn-secondary m-1" href="' . base_url('Teacher_Controller/updateUser/') . $user_id . '" aria-hidden="true"><i class="fa fa-edit p-2" aria-hidden="true"></i></a>';
			            			            
			$Action = $EditLink. $ViewLink .$DeleteLink;

			$row = array();
			$row[] = $iId;
			$row[] = $user_id;
			$row[] = $user_name;
			$row[] = $gender;
			$row[] = $email;
			$row[] = $date_of_join;
			$row[] = $Action;
			$data1[] = $row;
			$i++;			
		}
		$output = array("data" => $data1);
		return $output;		
	}
	
	public function savedata($data) {			
		$this->db->insert('tbl_users', $data);			
		return true;
	}			
			
	/*** Delete data ***/
	public function del_data($user_id){
		$where_array_upd = array("user_id" => $user_id); 
		$this->db->where($where_array_upd); 
		$this->db->update($this->tbl_users, array("delete_status" => 0));
		return true;
	}
		
		
	public function ViewDetails($user_id){
		$query = $this->db->get_where('tbl_users', array('user_id' => $user_id));		
		return $query->row();
	}
	
	//update data//
	public function select($user_id){
		$query = $this->db->get_where('tbl_users', array('user_id' => $user_id));		
		return $query->row();
	}
	
	public function update($data) {
		$where_array_upd = array("user_id" =>  $data['user_id']);
		$this->db->where($where_array_upd);

		$update_data = array(
			"user_name" => $data['user_name'],
			"title" => $data['title'],
			"profile_picture" => $data['profile_picture'],
			"gender" => $data['gender'],
			"description" => $data['description'],
			"mobile_no" => $data['mobile_no'],
			"country" => $data['country'],
			"email" => $data['email'],
			"password" => $data['password'],
			"pin" => $data['pin'],
			"date_of_join" => $data['date_of_join'],
			"date_of_resigning" => $data['date_of_resigning'],
		);

		return $this->db->update($this->tbl_users, $update_data);
		//log_message('error',"Error is".$query);
	}
}

?>