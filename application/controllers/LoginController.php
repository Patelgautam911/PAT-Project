<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->_init();
		$this->load->model('LoginModel');
		$this->load->library('email');
	}

	private function _init()
	{
		$this->output->set_template('login_layout');
	}

	public function index()
	{
		$this->output->set_title("Login");
		$this->load->view('login');
	}

	public function loginusercheck(){
		$email = $this->input->post('email',TRUE);
		$password = md5($this->input->post('password',TRUE));
		$login_data = $this->LoginModel->loginMe($email,$password);
		if(!empty($login_data)){
			$Username  = $login_data['Username'];
			$Email  = $login_data['Email'];
			$user_id = $login_data['ID'];
			$role = $login_data['Role'];
			$BraceletID = $login_data['BraceletID'];
			if($role==1)
			{
				redirect('/admin');
			}
			$sesdata = array(
				'user_id'  => $user_id,
				'email'     => $email,
				'role'     => $role,
				'username'     => $Username,
				'BraceletID'     => $BraceletID,
				'logged_in' => TRUE
			);
			$this->session->set_userdata($sesdata);
			$data = array(
				'Last_login' => date('Y-m-d H:i:s'),
				'Ip_address' => $_SERVER['REMOTE_ADDR'],
			);
			$this->LoginModel->updateLastlogin($this->session->userdata('email'), $data);
			// access login for User
			redirect('dashboard');
		}else{
			$this->session->set_flashdata('msg','Email or Password is Wrong.');
			redirect('login');
		}
	}

	public function ForgotPassword(){
		$this->output->set_title("ForgotPassword");
		$this->load->view('forgotpassword');
	}

	function generateRandomString($length = 50) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	public function forgotpasswordCheck(){
		$email = !empty($this->input->post('email',TRUE)) ? $this->input->post('email',TRUE) : '';
		$check_email = $this->LoginModel->check_email($email);		
		if(!empty($check_email)){
			$random_string = $this->generateRandomString();
			$token_data = array(
				'remeber_token'=>$random_string,
			);
			$update_token = $this->LoginModel->update_rember_token($token_data,$email);
			$get_email_data = $this->LoginModel->get_email_data($email);
			$data = array(
				'Username' => $get_email_data->Username,
				'url' => base_url().'resetpassword/'.$get_email_data->remeber_token,
			);
			$mesg = $this->load->view('email/resetpassword',$data,true);
			$mail_config['smtp_host'] = 'smtp.googlemail.com';
			$mail_config['smtp_port'] = '587';
			$mail_config['smtp_user'] = 'bgautamp.gp912@gmail.com';
			$mail_config['_smtp_auth'] = TRUE;
			$mail_config['smtp_pass'] = 'gautam@911';
			$mail_config['smtp_crypto'] = 'tls';
			$mail_config['protocol'] = 'smtp';
			$mail_config['mailtype'] = 'html';
			$mail_config['send_multipart'] = FALSE;
			$mail_config['charset'] = 'utf-8';
			$mail_config['wordwrap'] = TRUE;
			$this->email->initialize($mail_config);
			$from_email = "bgautamp.gp@gmail.com"; 
			$to_email = $this->input->post('email',TRUE); 
			//$to_email = "bgautamp.gp912@gmail.com"; 
			$this->email->from($from_email, 'Gautam Patel'); 
			$this->email->to($to_email);
			$this->email->subject('Reset Passwrod'); 
			$this->email->message($mesg); 
			$this->email->set_newline("\r\n");
	   
			if($this->email->send()) {
				$this->session->set_flashdata("success","Email sent successfully.");
				redirect('forgotpassword');
			}
			else{
				$this->session->set_flashdata("msg","Error in sending Email.");
				redirect('forgotpassword');
			}

		}else{
			$this->session->set_flashdata('msg','Email not exists.');
			redirect('forgotpassword');
		}
	}
	
	public function resetpassword($token){
		$this->output->set_title("Reset Password");
		if(!empty($token)){
			if($this->input->post('resetpassword',TRUE)){
				$password_data = array(
					'Password' => md5($this->input->post('confirmpassword',TRUE)),
					'remeber_token'=> NULL,
				);
				$rember_token = $this->input->post('rember_token',TRUE);
				$result = $this->LoginModel->update_reset_password($password_data,$rember_token);
				if(!empty($result)){
					$this->session->set_flashdata('sucess','Password change successfully.');
					redirect('login');
				}else{
					$this->session->set_flashdata('msg','Something went Wrong.');
					redirect('login');
				}
			}
		}else{
			redirect('login');
		}
		$this->load->view('resetpassword',array('token'=>$token));
	}
	
	public function logout()
	{
		if(session_destroy())
		{
			$session_data = array(
				'user_id'  => $this->session->userdata('user_id'),
				'email'     => $this->session->userdata('email'),
				'role'     => $this->session->userdata('role'),
				'username'     => $this->session->userdata('username'),
				'logged_in' => FALSE
			);
			$this->session->unset_userdata($session_data); 
			$this->session->sess_destroy();
			redirect('login');
		}
	}
}