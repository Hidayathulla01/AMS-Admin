<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_Controller  extends CI_controller{
	
	public function __construct(){
		parent::__construct ();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->helper(array('form', 'url', 'string', 'download'));
		
	}
		
	public function DashboardIndex(){		
		$this->load->view('Dashboard.php');
	}
	
}