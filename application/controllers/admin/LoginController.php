<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/LoginModel');
	}

	public function index()
	{
		$this->output->set_title("Login");
		$this->load->view('admin/login');
	}

	public function login(){
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));
		$role = "1";
		$login_data = $this->LoginModel->loginMe($email,$password,$role);
		if(!empty($login_data)){
			$Username  = $login_data['Username'];
			$Email  = $login_data['Email'];
			$user_id = $login_data['ID'];
			$role = $login_data['Role'];
			$sesdata = array(
				'user_id'  => $user_id,
				'email'     => $email,
				'role'     => $role,
				'username'     => $Username,
				'logged_in' => TRUE
			);
			$this->session->set_userdata($sesdata);
			$data = array(
				'Last_login' => date('Y-m-d H:i:s'),
				'Ip_address' => $_SERVER['REMOTE_ADDR'],
			);
			$this->LoginModel->updateLastlogin($this->session->userdata('email'), $data);
			// access login for admin
			if($role === '1'){
				redirect('admin/home');
			}
		}else{
			$this->session->set_flashdata('msg','Email or Password is Wrong.');
			redirect('admin/login');
		}
	}

	public function logout()
	{
		if(session_destroy())
		{
			$session_data = array(
				'user_id'  => $this->session->userdata('user_id'),
				'email'     => $this->session->userdata('email'),
				'role'     => $this->session->userdata('role'),
				'logged_in' => FALSE
			);
			$this->session->unset_userdata($session_data); 
			$this->session->sess_destroy();
			redirect('admin/login');
		}
	}
}
