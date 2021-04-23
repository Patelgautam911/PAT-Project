<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->_init();
		$this->load->model('LoginModel');
	}

	private function _init()
	{
		$this->output->set_template('login_layout');
	}
	 
	public function parentRegister(){
		$this->output->set_title("ParentRegister");
		if($this->input->post('submit',TRUE)){
			$parent = array(
				'Username' => $this->input->post('username',TRUE),
				'Email' => $this->input->post('email'),
				'Password' => md5($this->input->post('password',TRUE)),
				'Role' => '4',
				'BraceletID' => $this->input->post('braceletid',TRUE),
				'Created_date' => date('Y-m-d H:i:s'),
			);
			$parent_info=array(
				'P_Name'=>$this->input->post('username',TRUE),
				'P_Email'=>$this->input->post('email',TRUE),
				'P_Phone'=>$this->input->post('phone',TRUE),
				'P_Created_date' => date('Y-m-d H:i:s'),
			);
			$parent_data = $this->LoginModel->parentRegister($parent,$parent_info);
			if(!empty($parent_data)){
				$this->session->set_flashdata('msg','Register Successfully.');
				redirect('login');
			}else{
				$this->session->set_flashdata('msg','Something went wrong.');
			}
		}
		$this->load->view('parentregister');
	}
	public function check_parent_email()
	{
		$email=!empty($this->input->post()['query']['email']) ? $this->input->post()['query']['email'] : '' ;
		$email_data=$this->LoginModel->check_parent_email($email);
		if(!empty($email_data))
		{
			echo 'false';
		}
		else
		{
			echo 'true';
		}
		exit;
	}
}
?>