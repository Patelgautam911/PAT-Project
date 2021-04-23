<?php 

class StudentModel extends CI_Model
{
	function studentSave($data){
		return $this->db->insert('student', $data);
	}

	function login_student_data($data){
		return $this->db->insert('login', $data);
	}

	function school_get(){
		$query = $this->db->get('school');
		return  $query->result_array();
	}

	function student_count(){
		$query = $this->db->get('student');
		return  $query->num_rows();
	}

	function getschoolClasses($id){
		$this->db->select('*');
		$this->db->from('school');
		$this->db->where('school.Sc_ID', $id);
		$this->db->join('class', 'class.Sc_ID = school.Sc_ID', 'left');
		$query = $this->db->get();
		return  $query->result_array();
	}

	function allstudnet_count()
	{   
		$this->db->select('*');
		$this->db->from('student');
		$this->db->join('school', 'school.Sc_ID = student.S_School', 'left');
		$this->db->join('class', 'class.C_ID = student.S_Class', 'left');
		$this->db->join('parent', 'student.S_P_ID = parent.P_ID', 'left');
		$query = $this->db->get();
		return $query->num_rows();  
	}

	function allstudent($limit,$start,$col,$dir)
	{   
		$this->db->select('*');
		$this->db->from('student');
		$this->db->join('school', 'school.Sc_ID = student.S_School', 'left');
		$this->db->join('class', 'class.C_ID = student.S_Class', 'left');
		$this->db->join('parent', 'student.S_P_ID = parent.P_ID', 'left');
		$query = $this->db->limit($limit,$start)->order_by($col,$dir)->get();
		
		if($query->num_rows()>0)
		{
			return $query->result(); 
		}
		else
		{
			return null;
		}
		
	}
	
	function student_search($limit,$start,$search,$col,$dir)
	{
		$this->db->select('*');
		$this->db->from('student');
		$this->db->join('school', 'school.Sc_ID = student.S_School', 'left');
		$this->db->join('class', 'class.C_ID = student.S_Class', 'left');
		$this->db->join('parent', 'student.S_P_ID = parent.P_ID', 'left');
		$query = $this->db->like('S_Name',$search)
			->or_like('S_Email',$search)
			->or_like('S_Surname',$search)
			->or_like('S_Device_ID',$search)
			->or_like('P_Name',$search)
			->or_like('Sc_Name',$search)
			->or_like('C_Class_Name',$search)
			->or_like('student.Created_date',$search)
			->limit($limit,$start)
			->order_by($col,$dir)
			->get();
		if($query->num_rows()>0)
		{
			return $query->result();  
		}
		else
		{
			return null;
		}
	}

	function student_search_count($search)
	{
		$this->db->select('*');
		$this->db->from('student');
		$this->db->join('school', 'school.Sc_ID = student.S_School', 'left');
		$this->db->join('class', 'class.C_ID = student.S_Class', 'left');
		$this->db->join('parent', 'student.S_P_ID = parent.P_ID', 'left');
		$query = $this->db
				->like('S_Name',$search)
				->or_like('S_Email',$search)
				->or_like('S_Surname',$search)
				->or_like('S_Device_ID',$search)
				->or_like('P_Name',$search)
				->or_like('Sc_Name',$search)
				->or_like('C_Class_Name',$search)
				->or_like('student.Created_date',$search)
				->get();
	
		return $query->num_rows();
	} 

	function get_student_data($id){
		$this->db->where('S_ID',$id);
		$query = $this->db->get('student');
		return $query->row_array();

	}

	function parent_get(){
		$query = $this->db->get('parent');
		return $query->result_array();
	}

	function get_class_data($id){
		$this->db->select('*');
		$this->db->from('school');
		$this->db->join('class', 'class.Sc_ID = school.Sc_ID', 'left');
		$this->db->where('school.Sc_ID', $id);
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			return $query->result();  
		}
		else
		{
			return null;
		}
	}

	function update_student($id,$data){
		$this->db->where('S_ID', $id);
		$update = $this->db->update('student', $data);
		if($update)
		{
			return true;
		}
		else
		{
		   return false;
		}
	}
	function delete_student_data($id){
		$this ->db->where('S_ID', $id);
		$delete =$this->db->delete('student');
		
		if($delete)
		{
			return true;
		}
		else
		{
		   return false;
		}
	}

	function delete_login_data($email){
		$this ->db->where('Email', $email);
		$delete =$this->db->delete('login');
		if($delete)
		{
			return true;
		}
		else
		{
		   return false;
		}
	}

	function checkuser($email){
		$this->db->where('S_Email', $email);
		$query = $this->db->get('student');
		if( $query->num_rows() > 0 ){ 
		   return true; 
		} else {
		   return false; 
		}
	}

	function checkparent($id){
		$this->db->where('S_P_ID', $id);
		$query = $this->db->get('student');
		if( $query->num_rows() > 0 ){ 
		   return true; 
		} else {
		   return false; 
		}
	}
	
}

?>