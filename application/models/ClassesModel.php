<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClassesModel extends CI_Model {
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
	function getClasses($class_teach_data=null,$school_id,$limit,$start)
	{
		$this->db->select('*');
		if(!empty($class_teach_data)){
			$this->db->where_in('C_ID',explode(",", $class_teach_data));	
		}
		$this->db->where('Sc_ID',$school_id);
		$this->db->limit($limit, $start);
		$this->db->order_by('C_ID', 'desc');
		$classes_date=$this->db->get('class');
		return $classes_date->result_array();
	}
	function countGetClasses($class_teach_data=null,$school_id,$class_name=null)
	{
		$this->db->select('*');
		if(!empty($class_teach_data)){
			$this->db->where_in('C_ID',explode(",", $class_teach_data));	
		}
		$this->db->where('Sc_ID',$school_id);
		$this->db->like('C_Class_Name', $class_name);
		$this->db->order_by('C_ID', 'desc');
		$classes_date=$this->db->get('class');
		return $classes_date->num_rows();
	}
	function searchClasses($class_teach_data=null,$school_id,$class_name,$limit,$start)
	{
		$this->db->select('*');
		if(!empty($class_teach_data)){
			$this->db->where_in('C_ID',explode(",", $class_teach_data));	
		}
		$this->db->where('Sc_ID',$school_id);
		$this->db->like('C_Class_Name', $class_name);
		$this->db->limit($limit, $start);
		$this->db->order_by('C_Class_Name', 'asc');
		$classes_date=$this->db->get('class');
		return $classes_date->result_array();
	}
	function countSearchClasses($school_id,$class_name)
	{
		$this->db->where('Sc_ID',$school_id);
		$this->db->like('C_Class_Name', $class_name);
		$this->db->select('*');
		$this->db->order_by('C_Class_Name', 'asc');
		$classes_date=$this->db->get('class');
		return $classes_date->num_rows();
	}
	function countStudents($class_id,$school_id)
	{
		$this->db->where('S_Class', $class_id);
		$this->db->where('S_School',$school_id);
		$this->db->select('*');
		$students_count=$this->db->get('student');
		return $students_count->num_rows();
	}
	function getStudents($school_id)
	{
		$this->db->where('S_School', $school_id);
		$this->db->select('*');
		$students_data=$this->db->get('student');
		return $students_data->result_array();
	}
	function getTeachers($school_id)
	{
		$this->db->where('T_School',$school_id);
		$this->db->select('*');
		$teachers_data=$this->db->get('teacher');
		return $teachers_data->result_array();
	}
	function getClassTeacher($teacher_id)
	{
		$this->db->where('T_ID',$teacher_id);
		$this->db->select('T_Class');
		$class_teacher=$this->db->get('teacher');
		return $class_teacher->result_array();
	}
	function add_class($data)
	{
		$this->db->insert('class', $data);
		return $this->db->insert_id();
	}
	function edit_class($data,$id)
	{
		$data=str_replace('"', '', $data);
		$this->db->where('C_ID', $id);
		$this->db->update('class', $data);
		
	}
	function addClassTeacher($id,$data)
	{
		$this->db->where('T_ID', $id);
		$ans=$this->db->update('teacher', $data);
		return $ans;
	}
	function getClassId()
	{
		$this->db->select('C_ID');
		$this->db->order_by('C_ID', 'desc');
		return $this->db->get('class',1)->row()	;
	}
	function deleteClass($id)
	{
		$this->db->where('C_ID',$id , FALSE);
		$class_del=$this->db->delete('class');
		return $class_del;
	}
}
 
/* End of file ClassesModel.php */
/* Location: ./application/models/admin/ClassesModel.php */