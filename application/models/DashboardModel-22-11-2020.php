<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardModel extends CI_Model {

	function teacherDashboardData($email,$query)
	{
		$this->db->select('*');
		$this->db->from('teacher');
		$this->db->where('T_Email',$email);
		$teacher=$this->db->get();
			$Total_Steps=0;
					$Total_Meters=0;
					$Total_Jumps=0;
		if(isset($teacher->row()->T_Class)) {
		foreach (json_decode($teacher->row()->T_Class)->C_ID as $key => $value) {
			$this->db->select('S_BraceletID');
			$this->db->from('student');
			$this->db->where('S_Class', $value);
			$student=$this->db->get();
			foreach ($student->result_array() as $key1 => $value1) {
				foreach ($value1 as $key2 => $value2) {
					$this->db->select('Total_Steps,Total_Meters,Total_Jumps');
					$this->db->where('Bracelet_ID',$value2);
					$this->db->where($query);
					$Bracelet_data=$this->db->get('activity_data');
					$i=0;
					foreach ($Bracelet_data->result_array() as $key3 => $value3) {
						if($i>0){continue;}
						$Total_Steps+=$value3['Total_Steps'];
						$Total_Meters+=$value3['Total_Meters'];
						$Total_Jumps+=$value3['Total_Jumps'];
						$i++;
					}
					
				}
			}
		}
	}
		$data=array(
			'Total_Steps'=>$Total_Steps,
			'Total_Meters'=>$Total_Meters,
			'Total_Jumps'=>$Total_Jumps,
		);
		return $data;
	}	
	function schoolDashboardData($email,$query)
	{
		if ($this->session->userdata('role')==3) {
			$this->db->select('*');
		$this->db->from('school');
		$this->db->where('Sc_Email',$email);
		$school=$this->db->get();
	
			$this->db->select('S_BraceletID');
			$this->db->from('student');
			$this->db->where('S_School', $school->row()->Sc_ID);
			$student=$this->db->get();
			
				$Total_Jumps=0;
					$Total_Steps=0;
					$Total_Meters=0;	
			foreach ($student->result_array() as $key1 => $value1) {

				foreach ($value1 as $key2 => $value2) {
					$this->db->select('Total_Steps,Total_Meters,Total_Jumps');
					$this->db->where('Bracelet_ID',$value2);
					$this->db->where($query);
					$Bracelet_data=$this->db->get('activity_data_dev');
					$i=0;
					
					foreach ($Bracelet_data->result_array() as $key3 => $value3) {
						if($i>0){continue;}
						$Total_Steps+=$value3['Total_Steps'];
						$Total_Meters+=$value3['Total_Meters'];
						$Total_Jumps+=$value3['Total_Jumps'];
						$i++;
					}
						
				}
			}
		
		$data=array(
			'Total_Steps'=>$Total_Steps,
			'Total_Meters'=>$Total_Meters,
			'Total_Jumps'=>$Total_Jumps,
		);
		return $data;
		}
	}
	function classDashboardData($id,$query)
	{
		if ($this->session->userdata('role')==3) {	
			$this->db->select('C_ID');
			$this->db->where('Sc_ID',$id);
			$class=$this->db->get('class');
			foreach ($class->result_array() as $key => $value) {
				$this->db->select('S_BraceletID');
				$this->db->from('student');
				$this->db->where('S_Class', $value['C_ID']);
				$student=$this->db->get();
				
							$Total_Jumps=0;
							$Total_Steps=0;
							$Total_Meters=0;	
				foreach ($student->result_array() as $key1 => $value1) {

					foreach ($value1 as $key2 => $value2) {
						$this->db->select('Total_Steps,Total_Meters,Total_Jumps');
						$this->db->where('Bracelet_ID',$value2);
						$this->db->where($query);
						$Bracelet_data=$this->db->get('activity_data_dev');
						$i=0;
						
						foreach ($Bracelet_data->result_array() as $key3 => $value3) {
							if($i>0){continue;}
							$Total_Steps+=$value3['Total_Steps'];
							$Total_Meters+=$value3['Total_Meters'];
							$Total_Jumps+=$value3['Total_Jumps'];
							$i++;
						}
					}
				}
						$Total_Steps_Class[$value['C_ID']]=$Total_Steps;
						$Total_Meters_Class[$value['C_ID']]=$Total_Meters;
						$Total_Jumps_Class[$value['C_ID']]=$Total_Jumps;
			}
			$data=array(
			'Total_Steps'=>$Total_Steps_Class,
			'Total_Meters'=>$Total_Meters_Class,
			'Total_Jumps'=>$Total_Jumps_Class,
		);
		return $data;
		}
		if($this->session->userdata('role')==2)
		{
			$this->db->select('T_Class');
			$this->db->where('T_Email',$id);
			$teacher=$this->db->get('teacher');
			if(isset($teacher->row()->T_Class)) {
			foreach (json_decode($teacher->row()->T_Class)->C_ID as $key => $value) {
				$this->db->select('S_BraceletID');
				$this->db->from('student');
				$this->db->where('S_Class', $value);
				$student=$this->db->get();
				
							$Total_Jumps=0;
							$Total_Steps=0;
							$Total_Meters=0;	
				foreach ($student->result_array() as $key1 => $value1) {

					foreach ($value1 as $key2 => $value2) {
						$this->db->select('Total_Steps,Total_Meters,Total_Jumps');
						$this->db->where('Bracelet_ID',$value2);
						$this->db->where($query);
						$Bracelet_data=$this->db->get('activity_data_dev');
						$i=0;
						
						foreach ($Bracelet_data->result_array() as $key3 => $value3) {
							if($i>0){continue;}
							$Total_Steps+=$value3['Total_Steps'];
							$Total_Meters+=$value3['Total_Meters'];
							$Total_Jumps+=$value3['Total_Jumps'];
							$i++;
						}
					}
				}

						$Total_Steps_Class[$value]=$Total_Steps;
						$Total_Meters_Class[$value]=$Total_Meters;
						$Total_Jumps_Class[$value]=$Total_Jumps;
			}
		} else {
			$Total_Steps_Class = 0;
			$Total_Meters_Class = 0;
			$Total_Jumps_Class = 0;
		}
			$data=array(
			'Total_Steps'=>$Total_Steps_Class,
			'Total_Meters'=>$Total_Meters_Class,
			'Total_Jumps'=>$Total_Jumps_Class,
		);
		return $data;
		}

	}
	function classData($school_id)
	{
		if ($this->session->userdata('role')==3) {
			$this->db->select('*');
		$this->db->where('Sc_ID', $school_id);
		$classes=$this->db->get('class');
		
		return $classes->result_array();	
		}
		if($this->session->userdata('role')==2)
		{
			$this->db->select('T_Class');
			$this->db->where('T_Email',$school_id);
			$teacher=$this->db->get('teacher');
			$classes=array();
			if(isset($teacher->row()->T_Class)) {
			foreach (json_decode($teacher->row()->T_Class)->C_ID as $key => $value) {
					$this->db->select('*');
					$this->db->where('C_ID',$value);
					$class=$this->db->get('class')->result_array();
					
					array_push($classes, $class[0]);
			}
		}
			return $classes;
		}
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
}

/* End of file DashboardModel.php */
/* Location: ./application/models/DashboardModel.php */