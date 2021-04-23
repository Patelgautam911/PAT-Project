<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('admin/StudentModel');
		$this->load->model('admin/TeacherModel');
		$this->load->model('admin/ParentModel');

		$this->_init();
	}

	private function _init()
	{
		$this->output->set_template('admin');

	}

	public function index()
	{
		if($this->session->userdata('logged_in') == TRUE){
			$this->output->set_title("Home");
			$School_data = $this->StudentModel->school_get();
			$teacher_data = $this->TeacherModel->teacher_get_data();
			$class_data = $this->TeacherModel->class_get_data();
			$parent_data = $this->ParentModel->allparent_count();
			$student_data = $this->StudentModel->student_count();
			$this->load->view('admin/home',array('school_count'=>count($School_data),'teacher_count'=>$teacher_data,'class_count'=>$class_data,'parent_count'=>$parent_data,'student_count'=>$student_data));
		}else{
			redirect('admin/login');
		}
	}
}
