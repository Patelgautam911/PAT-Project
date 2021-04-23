<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ParentController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('LoginModel');
		$this->load->model('admin/ParentModel');
		$this->_init();
	}

	private function _init()
	{
		$this->output->set_template('frontend');
		
	}

	public function index(){
		$this->output->set_title("Dashborad");
		$id = $this->session->userdata('BraceletID');
		$parent_data = $this->ParentModel->parent_Bracelet_data($id);
		$this->load->view('parent',array('parent_data'=>$parent_data));
	}
}
?>