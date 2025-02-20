<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Masjid_Controller  extends CI_controller{
	
	public function __construct(){
		parent::__construct ();
		$this->load->library('session');
		$this->load->library('form_validation');
		$userData = $this->session->userdata('user_data');
		if (empty($userData)) {
			$username = $userData['user_id'];
			$masjid_id = $userData['masjid_id'];
			return redirect('login');
		}
		$this->load->database();
		$this->load->model('Masjid_Model');
		$this->load->helper(array('form', 'url', 'string', 'download'));
		
	}
	
	
	public function MasjidIndex(){
        $this->load->view('Masjids_Table_View');
	}	
	
	public function DashboardIndex(){		
		$this->load->view('AdminDashboard.php');
	}
	
	
	public function add(){		
		$this->load->view('Add_Masjid_Form');
	
        if ($this->input->post('submit')) {
            $data['masjid_id'] = $this->input->post('masjid_id');
            $data['masjid_name'] = $this->input->post('masjid_name');
            $data['masjid_location'] = $this->input->post('masjid_location');
			$data['created_by'] = $this->input->post('masjid_id');
           
            $resp = $this->Masjid_Model->savedata($data);
            if ($resp == true) {
				redirect('Masjid_Controller/MasjidIndex');
		
            }
		}	 
	}
	
	
	public function GetList(){		
		$data = $this->Masjid_Model->ViewMasjids();
        echo json_encode($data);
	}
	
	//for delete func
	public function delete_id($id){
		$response=$this->Masjid_Model->del_data($id);
		 if ($response == true) {			 
			$this->load->view('Masjids_Table_View.php');
		}		
	}
	
	//for Update
	public function updatedata($id) {
		$data['response'] = $this->Masjid_Model->select($id);
		$data['formAction'] = base_url('Masjid_Controller/upd/' . $id); 
		$this->load->view('Masjid_UpdateForm.php', $data);
	}

	public function upd($id) {
		
		$update_data = array(
			'id' => $id,
			'masjid_id' => $this->input->post('masjid_id'),
			'masjid_name' => $this->input->post('masjid_name'),
			'masjid_location' => $this->input->post('masjid_location')
		);
		
		$res = $this->Masjid_Model->update($update_data);
		if ($res) {
				$this->load->view('Masjids_Table_View.php');
		} 
	}
}
?>