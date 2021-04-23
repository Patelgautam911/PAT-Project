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
//			echo "<br>" . $value['T_Class'];
				$class_id=json_decode($value['T_Class']);
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
		$this->db->join('activity_data', 'activity_data.Bracelet_ID = student.S_BraceletID', 'left');
		$this->db->join('login', 'login.Email=student.S_Email', 'left');
		$this->db->group_by('student.S_ID');
		$student_data=$this->db->get('student');
		return $student_data->result_array();
	}
	function countGetStudents($id)
	{
		 
		$this->db->select('*');
		$this->db->where($id);
		$this->db->join('activity_data', 'activity_data.Bracelet_ID = student.S_BraceletID', 'left');
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
	function get_school($email)
	{
		$this->db->select("*");
		$this->db->from("school");
		$this->db->where("Sc_Email",$email);
		$result=$this->db->get();
		return $result->result_array();
	}
	function getClasses()
	{
		$this->db->where('Sc_ID', $this->session->userdata('Sc_ID'));
		$this->db->select('*');
		$data=$this->db->get('class');
		$this->db->order_by('C_Class_Name', 'asc');
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
	function delete_student($id,$email)
	{
		$this->db->where('S_ID', $id);
		$t_delete=$this->db->delete('student');
		$this->db->where('Email',$email);
		$login_delete=$this->db->delete('login');
		return $t_delete && $login_delete;
	}
}

/* End of file StudentModel.php */
/* Location: ./application/models/StudentModel.php */