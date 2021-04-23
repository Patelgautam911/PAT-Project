<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TeacherModel extends CI_Model {

 	
	function get_school($email)
	{
		$this->db->select("*");
		$this->db->from("school");
		$this->db->where("Sc_Email",$email);
		$result=$this->db->get();
		return $result->result_array();
	}
	function get_teacher_list($id,$limit,$start)
	{
		$this->db->select("*");
		$this->db->from("teacher");
		$this->db->where("T_School",$id);
		$this->db->limit($limit, $start);
		$this->db->join("class","class.C_ID=teacher.T_Class","left");
		$this->db->join("login","login.Email=teacher.T_Email","left");
		$result=$this->db->get();
		return $result->result_array();
	}
	function count_get_teacher_list($id)
	{
		$this->db->select("*");
		$this->db->from("teacher");
		$this->db->where("T_School",$id);
		$this->db->join("class","class.C_ID=teacher.T_Class","left");
		$this->db->join("login","login.Email=teacher.T_Email","left");
		$result=$this->db->get();
		return $result->num_rows();
	}
	function search_teacher_list($name,$id,$limit,$start)
	{
		$this->db->select("*");
		$this->db->from("teacher");
		$this->db->like('T_Username', $name);
		$this->db->where("T_School",$id);
		$this->db->limit($limit, $start);
		$this->db->join("class","class.C_ID=teacher.T_Class","left");
		$this->db->join("login","login.Email=teacher.T_Email","left");
		$result=$this->db->get();
		return $result->result_array();
	}
	function count_search_teacher_list($name,$id)
	{
		$this->db->select("*");
		$this->db->from("teacher");
		$this->db->like('T_Username', $name);
		$this->db->where("T_School",$id);
		$this->db->join("class","class.C_ID=teacher.T_Class","left");
		$this->db->join("login","login.Email=teacher.T_Email","left");
		$result=$this->db->get();
		return $result->num_rows();
	}
	function get_class_list($id)
	{
		$this->db->select("*");
		$this->db->from("class");
		$this->db->where("Sc_ID",$id);
		$this->db->order_by("C_Class_Name");
		$result=$this->db->get();
		return $result->result_array();
	}
	function add_teacher($teacher,$login)
	{
		return $this->db->insert('teacher',$teacher) && $this->db->insert('login',$login);
	}
	function edit_teacher($email,$data,$login)
	{
		$this->db->where('T_Email',$email);
		$teacher=$this->db->update('teacher', $data);
		$this->db->where('Email', $email);
		$logindata=$this->db->update('login', $login);
		return $teacher && $logindata;
	}
	function delete_teacher($id,$email)
	{
		$this->db->where('T_ID', $id);
		$t_delete=$this->db->delete('teacher');
		$this->db->where('Email',$email);
		$login_delete=$this->db->delete('login');
		return $t_delete && $login_delete;
	}
	function get_class_name($id){
		$this->db->select('C_Class_Name');
		$this->db->where_in('C_ID',explode(",",$id));
		$query = $this->db->get('class');
		return $query->result_array();
	}
}

/* End of file teacherModel.php */
/* Location: ./application/models/teacherModel.php */