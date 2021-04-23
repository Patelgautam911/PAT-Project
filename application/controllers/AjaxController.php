<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AjaxController extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('LoginModel');
	}

	public function check_parent_email()
	{
		$email=!empty($this->input->post()['query']['email']) ? $this->input->post()['query']['email'] : '' ;
		$email_data=$this->LoginModel->check_parent_email($email);
		if(!empty($email_data))
		{
			echo "true";
		}
		else
		{
			echo "false";
		}
	}
	public function update_check_parent_email()
	{
		$email=!empty($this->input->post()['query']['email']) ? $this->input->post()['query']['email'] : '' ;
		$id=!empty($this->input->post()['query']['id']) ? $this->input->post()['query']['id'] : '' ;
		$email_data=$this->LoginModel->update_check_parent_email($email,$id);
			
			if($email_data)
			{
				echo "true";
			}
			else
			{
				echo "false";
			}
		
	}
	public function check_bracelet_id()
	{
		$braceletid=!empty($this->input->post()['query']['braceletid']) ? $this->input->post()['query']['braceletid'] : '' ;
		$braceletid_data=$this->LoginModel->check_bracelet_id($braceletid);
		if(!empty($braceletid_data))
		{
			echo "true";
		}
		else
		{
			echo "false";
		}
	}
	public function update_check_bracelet_id()
	{
		$braceletid=!empty($this->input->post()['query']['braceletid']) ? $this->input->post()['query']['braceletid'] : '' ;
		$id=!empty($this->input->post()['query']['id']) ? $this->input->post()['query']['id'] : '' ;
		$class=!empty($this->input->post()['query']['class']) ? $this->input->post()['query']['class'] : '' ;
		$braceletid_data=$this->LoginModel->update_check_bracelet_id($braceletid,$id,$class);
		if(!empty($braceletid_data))
		{
			if($braceletid_data)
			{
				echo "true";
			}
			else
			{
				echo "false";
			}
		}
		else
		{
			echo "false";
		}
	}
}

/* End of file controller.php */
/* Location: ./application/controllers/controller.php */