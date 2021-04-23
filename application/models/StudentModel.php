<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentModel extends CI_Model {

	function getTeachers($id)
	{ 
		$this->db->select('*');
		$teachers=$this->db->get('teacher');
		$teachers=$teachers->result_array();
		$teachers_data=array();
		foreach ($teachers as $key => $value) {
			$class_id = json_decode($value['T_Class']);
			if(!empty($class_id->C_ID)) {
			foreach ($class_id as $key1 => $value1) {
				foreach ($value1 as $key2 => $value2) {
					if($id==$value2)
					{
						array_push($teachers_data,$value);
					}
				}
			}
			}
		}
		return $teachers_data;
	} 
	function getStudents($id,$limit,$start)
	{
		$this->db->select('*');
		$this->db->where($id);
		$this->db->limit($limit, $start);
		$this->db->join('login', 'login.Email=student.S_Email', 'left');
		$this->db->join('activity_data', 'activity_data.Bracelet_ID = student.S_BraceletID', 'left');
		$this->db->group_by('student.S_ID');
		$student_data = $this->db->get('student');
		return $student_data->result_array();
	}

	function total_student_count($id){
		$this->db->select('*');
		$this->db->where($id);
		$this->db->join('login', 'login.Email=student.S_Email', 'left');
		$this->db->join('activity_data', 'activity_data.Bracelet_ID = student.S_BraceletID', 'left');
		$this->db->group_by('student.S_ID');
		$student_data = $this->db->get('student');
		return $student_data->result_array();
	}
	function getStudents_track_data($id){
		$this->db->select("*");
		$this->db->select_avg('Total_Steps','Average_Steps');
		$this->db->select_sum('Total_Steps');
		$this->db->select_sum('Total_Meters');
		$this->db->select_sum('Activity_Time');
		$this->db->select_sum('Total_Jumps');
		$this->db->select_sum('Goal');
		$this->db->where($id);
		$this->db->join('activity_data', 'activity_data.Bracelet_ID = student.S_BraceletID', 'left');
		$this->db->order_by('activity_data.ID','desc');
		$this->db->group_by('student.S_BraceletID');
		$student_data=$this->db->get('student');
		return $student_data->result_array();
	}

	function countGetStudents($id)
	{
		$this->db->select('*');
		$this->db->where($id);
		$this->db->join('login', 'login.Email=student.S_Email', 'left');
		$this->db->group_by('student.S_ID');
		$student_data=$this->db->get('student');
		return $student_data->num_rows();
	}
	function searchStudents($id,$name,$limit,$start)
	{
		$this->db->select('*');
		$this->db->where($id);
		$this->db->like('S_Name',$name);
		$this->db->limit($limit, $start);
		$this->db->join('login', 'login.Email=student.S_Email', 'left');
		$this->db->group_by('student.S_ID');
		$student_data=$this->db->get('student');
		return $student_data->result_array();
	}
	function search_getStudents_track_data($id,$name,$limit,$start){
		$this->db->select('*');
		$this->db->select_avg('Total_Steps','Average_Steps');
		$this->db->select_sum('Total_Steps');
		$this->db->select_sum('Total_Meters');
		$this->db->select_sum('Activity_Time');
		$this->db->select_sum('Total_Jumps');
		$this->db->select_sum('Goal');
		$this->db->where($id); 
		$this->db->like('S_Name',$name);
		$this->db->limit($limit, $start);
		$this->db->join('activity_data', 'activity_data.Bracelet_ID = student.S_BraceletID', 'left');
		$this->db->join('login', 'login.Email=student.S_Email', 'left');
		$this->db->group_by('student.S_ID');
		$student_data=$this->db->get('student');
		return $student_data->result_array();
	}
	function countSearchStudents($id,$name)
	{
		 
		$this->db->select('*');
		$this->db->where($id);
		$this->db->like('S_Name',$name);
		$this->db->join('activity_data', 'activity_data.Bracelet_ID = student.S_BraceletID', 'left');
		
		$this->db->join('login', 'login.Email=student.S_Email', 'left');
		$this->db->group_by('student.S_ID');
		$student_data=$this->db->get('student');	
		return $student_data->num_rows();
	}
	function get_class_name($id){
		$this->db->select('C_Class_Name');
		$this->db->where('C_ID',$id);
		$query = $this->db->get('class');
		return $query->row()->C_Class_Name;
	}
	function get_school($email)
	{
		if($this->session->userdata('role')==2)
		{
			$this->db->select("*");
		$this->db->from("teacher");
	 	$this->db->where("T_Email",$email);
		$result=$this->db->get();
		return $result->row();
		}
		if($this->session->userdata('role')==3)
		{
			$this->db->select("*");
		$this->db->from("school");
	 	$this->db->where("Sc_Email",$email);
		$result=$this->db->get();
		return $result->row();
		}
	}
	function getClasses()
	{
		$this->db->where('Sc_ID', $this->session->userdata('Sc_ID'));
		$this->db->select('*');
		$this->db->order_by('C_Class_Name', 'asc');
		$data=$this->db->get('class');
		return $data->result_array();
	}
	function add_student($student_data,$student_login)
	{
		return $this->db->insert('student', $student_data) && $this->db->insert('login', $student_login);
	}
	function edit_student($student_data,$student_login,$email)
	{
		$this->db->where('S_Email', $email);
		$data1=$this->db->update('student', $student_data);
		$this->db->where('Email', $email);
		$data2=$this->db->update('login', $student_login);
		return $data1 && $data2;
	}
	function edit_student_password($student_password_login,$email)
	{
		$this->db->where('Email', $email);
		$data2=$this->db->update('login', $student_password_login);
		return $data2;
	}
	function delete_student($id,$email)
	{
		$this->db->where('S_ID', $id);
		$t_delete=$this->db->delete('student');
		$this->db->where('Email',$email);
		$login_delete=$this->db->delete('login');
		return $t_delete && $login_delete;
	}
	function getStudentId()
	{
		$this->db->select('S_ID');
		$this->db->order_by('S_ID', 'desc');
		return $this->db->get('student',1)->row();
	}
	function get_next_row_id($id){
		$this->db->select('C_ID');
		$this->db->where('C_ID >',$id);
		$this->db->limit(1);
		$query = $this->db->get('class')->row();
		if(!empty($query)){
			return $query->C_ID;
		}
	}

	function get_prev_row_id($id){
		$this->db->select('C_ID');
		$this->db->where('C_ID <',$id);
		$this->db->order_by('C_ID','DESC');
		$this->db->limit(1);
		$query = $this->db->get('class')->row();
		if(!empty($query)){
			return $query->C_ID;
		}
	}

	public function get_student_info($email){
		$this->db->where('Email',$email);
		$query = $this->db->get('login');
		if(!empty($query)){
			return $query->row();
		}
	}
	public function get_teacher_info($email){
		$this->db->where('T_Email',$email);
		$query = $this->db->get('teacher');
		if(!empty($query)){
			return $query->row();
		}
	}
} 

/* End of file StudentModel.php */
/* Location: ./application/models/StudentModel.php */