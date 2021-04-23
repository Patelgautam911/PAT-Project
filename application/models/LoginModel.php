<?php 

class LoginModel extends CI_Model
{

	function loginMe($email, $password){
		$this->db->where('Email',$email);
		$this->db->where('Password',$password);
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

	function parentRegister($parent,$parent_info){
		$this->db->where('Email',$parent['Email']);
		$result_login=$this->db->get('login');
		$this->db->where('P_Email',$parent_info['P_Email']);
		$result_parent=$this->db->get('parent');
		if(!($result_login->num_rows()>0 && $result_parent->num_rows()>0))
		{
			return $this->db->insert('login',$parent) && $this->db->insert('parent',$parent_info);
		}
	}
	function check_parent_email($email){
		$this->db->where('Email',$email);
		$result=$this->db->get('login');
		if( $result->num_rows() > 0 )
		{ 
		   return false; 
		} 
		else 
		{ 
		   return true; 
		}
	}
	function update_check_parent_email($email,$id){
		$this->db->where('S_ID', $id);
		$current_email=$this->db->get('student')->row()->S_Email;
		$this->db->where('Email',$email);	
		$this->db->where('Email!=',$current_email);	
		$result=$this->db->get('login');
		if( $result->num_rows() > 0 )
		{ 
		   return false; 
		} 
		else 
		{ 
		   return true; 
		}
	}
	function check_bracelet_id($braceletid){
		$this->db->where('S_BraceletID',$braceletid);
		$result=$this->db->get('student');
		if( $result->num_rows() > 0 )
		{ 
		   return false; 
		} 
		else 
		{ 
		   return true; 
		}
	}
	function update_check_bracelet_id($braceletid,$id,$class){
		$this->db->where('S_ID != ', $id);
		$this->db->where('S_Class', $class);
		$this->db->where('S_BraceletID',$braceletid);
		$result=$this->db->get('student');
		//echo $this->db->last_query();
		if( $result->num_rows() > 0 )
		{ 
		   return false; 
		} 
		else 
		{ 
		   return true; 
		}
	}
	function check_email($email){
		$this->db->where('Email',$email);
		$result = $this->db->get('login');
		if( $result->num_rows() > 0 )
		{ 
		   return true; 
		} 
		else 
		{ 
		   return false; 
		}
	}
	function update_rember_token($data,$email){
		$this->db->where('Email', $email);
		$update_parent = $this->db->update('login', $data);
		return $update_parent;
	}

	function update_reset_password($data,$token){
		$this->db->where('remeber_token', $token);
		$update_parent = $this->db->update('login', $data);
		return $update_parent;	
	}

	function get_email_data($email){
		$this->db->where('Email',$email);
		$query = $this->db->get('login');
		return $query->row();
	}
}


?>