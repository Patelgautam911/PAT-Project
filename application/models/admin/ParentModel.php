<?php 

class ParentModel extends CI_Model
{
	function parentSave($data){
		return $this->db->insert('parent',$data);
	}

	function parent_get($id){
		$this->db->where('P_ID',$id);
		$query = $this->db->get('parent');
		return $query->row_array();
	}

	function parentUpdate($id,$data){
		$this->db->where('P_ID',$id);
		$update = $this->db->update('parent',$data);
		if($update){
			return true;
		}else{
			return false;
		}
	}

	function allparent_count()
	{   
		$query = $this->db->get('parent');
		return $query->num_rows();  
	}

	function allparent($limit,$start,$col,$dir)
	{   
		$query = $this->db->limit($limit,$start)->order_by($col,$dir)->get('parent');
		
		if($query->num_rows()>0)
		{
			return $query->result(); 
		}
		else
		{
			return null;
		}
		
	}
	
	function parent_search($limit,$start,$search,$col,$dir)
	{
		$query = $this->db->like('P_Name',$search)
			->or_like('P_Email',$search)
			->or_like('P_Created_date',$search)
			->limit($limit,$start)
			->order_by($col,$dir)
			->get('parent');
		if($query->num_rows()>0)
		{
			return $query->result();  
		}
		else
		{
			return null;
		}
	}

	function parent_search_count($search)
	{
		$query = $this->db->like('P_Name',$search)
				->or_like('P_Email',$search)
				->or_like('P_Created_date',$search)
				->get('parent');
		return $query->num_rows();
	}

	function checkparentUser($email){
		$this->db->where('P_Email', $email);
		$query = $this->db->get('parent');
		if( $query->num_rows() > 0 )
		{ 
		   return true; 
		} 
		else 
		{ 
		   return false; 
		}
	}

	function delete_parent_data($id){
		$this ->db->where('P_ID', $id);
		$delete =$this->db->delete('parent');
		if($delete){
			return true;
		}else{
		   return false;
		}
	}

	function parent_Bracelet_data($id,$query){
		$this->db->where('Bracelet_ID',$id);
		$this->db->select('ID,Bracelet_ID,Timestamp,Calories,Created_date,Updated_date');
		$this->db->select_avg('Total_Steps','Average_Steps');
		$this->db->select_sum('Total_Steps');
		$this->db->select_sum('Total_Meters');
		$this->db->select_sum('Activity_Time');
		$this->db->select_sum('Total_Jumps');
		$this->db->select_sum('Goal');
		$this->db->where($query);
		$this->db->order_by("ID", "DESC");
		$query = $this->db->get('activity_data');
		return $query;
	}
	function get_activity_date($id)
	{
		$this->db->where('Bracelet_ID',$id);
		$this->db->limit(1);
		$this->db->select('Created_date');		
		$this->db->order_by("ID", "ASC");
		$query = $this->db->get('activity_data');
		return $query->row();	
	}

}
?>