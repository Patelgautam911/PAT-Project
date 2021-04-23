<?php 

class LoginModel extends CI_Model
{

	function loginMe($email, $password,$role){
		$this->db->where('Email',$email);
		$this->db->where('Password',$password);
		$this->db->where('Role',$role);
		$result = $this->db->get('login');
		if($result->num_rows() > 0){
			return $result->row_array();
		}
	}

	function updateLastlogin($email,$data){
		$this->db->where('Email', $email);
		$update = $this->db->update('login', $data);
		if($update)
		{
			return true;
		}
		else
		{
		   return false;
		}
	}
	
}


?>