<?php 

class TeacherModel extends CI_Model
{
	function teacherSave($data){
		$this->db->insert('teacher',$data);
		return $this->db->insert_id();
	}


	function addTeacherClass($data){
		return $this->db->insert_batch('teacher_class', $data);
	}

	function teacher_get_data(){
		$query = $this->db->get('teacher');
		return $query->num_rows();
	}
	
	function class_get_data(){
		$query = $this->db->get('class');
		return $query->num_rows();
	}

	function allteacher_count()
	{   
		$this->db->select('*');
		$this->db->from('teacher');
		$this->db->join('school', 'school.Sc_ID = teacher.T_School', 'left');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function get_class_teacher_data($ids){

		$this->db->select('*');
		$this->db->from('class');
		$this->db->where_in('C_ID',$ids);
		$query = $this->db->get();
		return $query->result(); 
	}

	function allteacher($limit,$start,$col,$dir)
	{   		
		$this->db->select('*');
		$this->db->from('teacher');
		$this->db->join('school', 'school.Sc_ID = teacher.T_School', 'left');
		//$this->db->join('teacher_class', 'teacher_class.T_ID = teacher.T_ID', 'left');
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
	
	function teacher_search($limit,$start,$search,$col,$dir)
	{	
		$this->db->select('*');
		$this->db->from('teacher');
		$this->db->join('school', 'school.Sc_ID = teacher.T_School', 'left');
		$query = $this->db->like('T_Username',$search)
			->or_like('T_Dob',$search)
			->or_like('T_Email',$search)
			->or_like('T_Phone',$search)
			->or_like('T_Created_date',$search)
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

	function teacher_search_count($search)
	{
		$this->db->select('*');
		$this->db->from('teacher');
		$this->db->join('school', 'school.Sc_ID = teacher.T_School', 'left');
		$query = $this->db->like('T_Username',$search)
			->or_like('T_Dob',$search)
			->or_like('T_Email',$search)
			->or_like('T_Phone',$search)
			->or_like('T_Created_date',$search)
			->limit($limit,$start)
			->order_by($col,$dir)
			->get();
	
		return $query->num_rows();
	}

	function get_teacher_row($id){
		$this->db->where('T_ID',$id);
		$get_query = $this->db->get('teacher');
		return $get_query->row_array();
	}

	function teacherUpdate($id,$data){
		$this->db->where('T_ID',$id);
		$update = $this->db->update('teacher',$data);
		if($update){
			return true;
		}else{
			return false;
		}
	}

	function delete_teacher_data($id){
		$this ->db->where('T_ID', $id);
		$delete =$this->db->delete('teacher');
		
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

	function delete_teacher_class_data($id){
		$this ->db->where('T_ID', $id);
		$delete =$this->db->delete('teacher_class');
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
		$this->db->where('T_Email', $email);
		$query = $this->db->get('teacher');
		if( $query->num_rows() > 0 )
		{ 
		   return true; 
		} 
		else 
		{ 
		   return false; 
		}
	}
	function getTeacherId()
	{
		$this->db->select('T_ID');
		$this->db->order_by('T_ID', 'desc');
		return $this->db->get('teacher',1)->row();
	}
}
?>