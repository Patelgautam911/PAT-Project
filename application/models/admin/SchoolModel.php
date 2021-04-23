<?php 

class SchoolModel extends CI_Model
{
	function school_get(){
		$this->db->order_by('Created_date','desc');
		$query = $this->db->get('school');
		return  $query->result_array();
	}

	function schoolSave($loginData,$schoolData){

		return $this->db->insert('login', $loginData) && $this->db->insert('school',$schoolData);
	}

	function get_school_data($id){

		$this->db->where('Sc_ID',$id);
		$query = $this->db->get('school');
		$this->db->select("*");
		$this->db->from("login");
		$this->db->where("Email",$query->row_array()['Sc_Email']);
		$result=$this->db->get();
		
		return array_merge($query->row_array(),$query->row_array());

	}

	function updateSchool($id,$school,$email,$data){
		$this->db->where('Sc_ID', $id);
		$update = $this->db->update('school', $school);
		$this->db->where('Email', $email);
		$update_data =$this->db->update('login',$data);
		if($update){
			return true;
		}else{
		   return false;
		}
	}

	function allclass_count()
	{   
		$this->db->select('*');
		$this->db->from('class');
		$this->db->join('school', 'school.Sc_ID = class.Sc_ID', 'left');
		$query = $this->db->get();
		return $query->num_rows();  
	}

	function allclass($limit,$start,$order,$dir)
	{   
		$this->db->select('*');
		$this->db->from('class');
		$this->db->join('school', 'school.Sc_ID = class.Sc_ID', 'left');
		$query = $this->db->limit($limit,$start)->order_by($order,$dir)->get();
		
		if($query->num_rows()>0){
			return $query->result(); 
		}else{
			return null;
		}
		
	}
	
	function class_search($limit,$start,$search,$order,$dir)
	{
		$this->db->select('*');
		$this->db->from('class');
		$this->db->join('school', 'school.Sc_ID = class.Sc_ID', 'left');
		$query = $this->db->like('Sc_Name',$search)
			->or_like('C_Class_Name',$search)
			->or_like('class.Created_date',$search)
			->limit($limit,$start)
			->order_by($order,$dir)
			->get();
		if($query->num_rows()>0){
			return $query->result();  
		}else{
			return null;
		}
	}

	function class_search_count($search)
	{
		$this->db->select('*');
		$this->db->from('class');
		$this->db->join('school', 'school.Sc_ID = class.Sc_ID', 'left');
		$query = $this->db
				->like('Sc_Name',$search)
				->or_like('C_Class_Name',$search)
				->or_like('class.Created_date',$search)
				->get();
	
		return $query->num_rows();
	} 

	function classSave($data){
		return $this->db->insert('class',$data);
	}

	function get_class_data($id){
		$this->db->where('C_ID',$id);
		$query = $this->db->get('class');
		return $query->row_array();
	}

	function classUpdate($id,$data){
		$this->db->where('C_ID',$id);
		$update = $this->db->update('class',$data);
		if($update){
			return true;
		}else{
		   return false;
		}
	}

	function delete_class_data($id){
		$this->db->where('C_ID',$id);
		$delete = $this->db->delete('class');
		if($delete){
			return true;
		}else{
			return false;
		}
	}
}
?>