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
		$Activity_Time=0;
		$Pat_Points=0;
		$Activity_date = array();
		if(isset($teacher->row()->T_Class)) {
			foreach (json_decode($teacher->row()->T_Class)->C_ID as $key => $value) {
				$this->db->select('S_BraceletID');
				$this->db->from('student'); 
				$this->db->where('S_Class', $value);
				$student=$this->db->get();
				foreach ($student->result_array() as $key1 => $value1) {
					foreach ($value1 as $key2 => $value2) {
						$this->db->where('Bracelet_ID',$value2);
						$this->db->select('ID,Bracelet_ID,Timestamp,Calories,Created_date,Updated_date');
						$this->db->select_avg('Total_Steps','Average_Steps');
						$this->db->select_sum('Total_Steps');
						$this->db->select_sum('Total_Meters');
						$this->db->select_sum('Activity_Time');
						$this->db->select_sum('Total_Jumps');
						$this->db->select_sum('Goal');
						$this->db->where($query);
						$this->db->order_by("ID", "DESC");
						$Bracelet_data = $this->db->get('activity_data');
						foreach ($Bracelet_data->result_array() as $key3 => $value3) {
							
							$Total_Steps+=$value3['Total_Steps'];
							$Total_Meters+=$value3['Total_Meters'];
							$Total_Jumps+=$value3['Total_Jumps'];
							$Activity_Time+=$value3['Activity_Time'];
							$Pat_Points+=($value3['Activity_Time']*($value3['Average_Steps']))/10;
							if(!empty($value3['Created_date']))
							{
								$Activity_date[] = $value3['Created_date'];
							}

						}

					}
				}
			}
		}
		$data=array(
			'Total_Steps'=>$Total_Steps,
			'Total_Meters'=>$Total_Meters,
			'Total_Jumps'=>$Total_Jumps,
			'Pat_Points'=>$Pat_Points,
			'Activity_date'=> !empty($Activity_date[0]) ? $Activity_date[0] : '',	
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
			$Activity_Time=0;
			$Average_Steps=0;
			$Pat_Points=0;
			$Activity_date = array();
			foreach ($student->result_array() as $key1 => $value1) {
				foreach ($value1 as $key2 => $value2) {
					$this->db->where('Bracelet_ID',$value2);
					$this->db->select('ID,Bracelet_ID,Timestamp,Calories,Created_date,Updated_date');
					$this->db->select_avg('Total_Steps','Average_Steps');
					$this->db->select_sum('Total_Steps');
					$this->db->select_sum('Total_Meters');
					$this->db->select_sum('Activity_Time');
					$this->db->select_sum('Total_Jumps');
					$this->db->select_sum('Goal');
					$this->db->where($query);
					$this->db->order_by("ID", "DESC");
					$Bracelet_data = $this->db->get('activity_data');
					foreach ($Bracelet_data->result_array() as $key3 => $value3) {
						$Total_Steps+=$value3['Total_Steps'];
						$Total_Meters+=$value3['Total_Meters'];
						$Total_Jumps+=$value3['Total_Jumps'];
						$Activity_Time+=$value3['Activity_Time'];
						$Pat_Points+=($value3['Activity_Time']*($value3['Average_Steps']))/10;
						$Activity_date[] = $value3['Created_date'];
					}	
				}
			}
			$data=array(
				'Total_Steps'=>$Total_Steps,
				'Total_Meters'=>$Total_Meters,
				'Total_Jumps'=>$Total_Jumps,
				'Pat_Points'=>$Pat_Points,
				'Activity_date'=>!empty($Activity_date[0]) ? $Activity_date[0] : '',
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
				$Activity_Time=0;
				$Average_Steps=0;
				$Pat_Points=0;
				foreach ($student->result_array() as $key1 => $value1) {
					foreach ($value1 as $key2 => $value2) {
						$this->db->where('Bracelet_ID',$value2);
						$this->db->select('ID,Bracelet_ID,Timestamp,Calories,Created_date,Updated_date');
						$this->db->select_avg('Total_Steps','Average_Steps');
						$this->db->select_sum('Total_Steps');
						$this->db->select_sum('Total_Meters');
						$this->db->select_sum('Activity_Time');
						$this->db->select_sum('Total_Jumps');
						$this->db->select_sum('Goal');
						$this->db->where($query);
						$this->db->order_by("ID", "DESC");
						$Bracelet_data = $this->db->get('activity_data');
						foreach ($Bracelet_data->result_array() as $key3 => $value3) {
							$Total_Steps+=$value3['Total_Steps'];
							$Total_Meters+=$value3['Total_Meters'];
							$Total_Jumps+=$value3['Total_Jumps'];
							$Activity_Time+=$value3['Activity_Time'];
							$Pat_Points+=($value3['Activity_Time']*($value3['Average_Steps']))/10;
						}
					}
				}
				$Total_Steps_Class[$value['C_ID']]=$Total_Steps;
				$Total_Meters_Class[$value['C_ID']]=$Total_Meters;
				$Total_Jumps_Class[$value['C_ID']]=$Total_Jumps;
				$Pat_Points_Class[$value['C_ID']]=$Pat_Points;
			}
			$data=array(
				'Total_Steps'=> !empty($Total_Steps_Class) ? $Total_Steps_Class :'',
				'Total_Meters'=>!empty($Total_Meters_Class) ? $Total_Meters_Class : '',
				'Total_Jumps'=>!empty($Total_Jumps_Class) ? $Total_Jumps_Class : '',
				'Pat_Points'=>!empty($Pat_Points_Class) ? $Pat_Points_Class : '',
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
					$Activity_Time=0;
					$Pat_Points=0;	
					foreach ($student->result_array() as $key1 => $value1) {
						foreach ($value1 as $key2 => $value2) {
							$this->db->where('Bracelet_ID',$value2);
							$this->db->select('ID,Bracelet_ID,Timestamp,Calories,Created_date,Updated_date');
							$this->db->select_avg('Total_Steps','Average_Steps');
							$this->db->select_sum('Total_Steps');
							$this->db->select_sum('Total_Meters');
							$this->db->select_sum('Activity_Time');
							$this->db->select_sum('Total_Jumps');
							$this->db->select_sum('Goal');
							$this->db->where($query);
							$this->db->order_by("ID", "DESC");
							$Bracelet_data = $this->db->get('activity_data');
							foreach ($Bracelet_data->result_array() as $key3 => $value3) {
								$Total_Steps+=$value3['Total_Steps'];
								$Total_Meters+=$value3['Total_Meters'];
								$Total_Jumps+=$value3['Total_Jumps'];
								$Activity_Time+=$value3['Activity_Time'];
								$Pat_Points+=($value3['Activity_Time']*($value3['Average_Steps']))/10;
							}
						}
					}
					$Total_Steps_Class[$value]=$Total_Steps;
					$Total_Meters_Class[$value]=$Total_Meters;
					$Total_Jumps_Class[$value]=$Total_Jumps;
					$Pat_Points_Class[$value]=$Pat_Points;
				}
			} else {
				$Total_Steps_Class = 0;
				$Total_Meters_Class = 0;
				$Total_Jumps_Class = 0;
				$Pat_Points_Class=0;
			}
			$data=array(
				'Total_Steps'=>$Total_Steps_Class,
				'Total_Meters'=>$Total_Meters_Class,
				'Total_Jumps'=>$Total_Jumps_Class,
				'Pat_Points'=>$Pat_Points_Class,
			);
			return $data;
		}
	}
	function classData($school_id)
	{
		if ($this->session->userdata('role')==3) {
			$this->db->select('*');
			$this->db->where('Sc_ID', $school_id);
			$this->db->order_by('C_ID','desc');
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

	function get_school_profile($id){
		$this->db->select('*');
		$this->db->from('login');
		$this->db->join('school sc','sc.Sc_Email = login.Email','left');
		$this->db->where('login.ID',$id);
		$query = $this->db->get();
		return $query->row();
	}

	function update_school_profile($school_data,$email){
		$this->db->where('Sc_Email', $email);
		$update_school = $this->db->update('school', $school_data);
		return $update_school;
	}

	function get_teacher_profile($id){
		$this->db->select('*');
		$this->db->from('login');
		$this->db->join('teacher te','te.T_Email = login.Email','left');
		$this->db->where('login.ID',$id);
		$query = $this->db->get();
		return $query->row();
	}
	function update_teacher_profile($teacher_data,$email){
		$this->db->where('T_Email', $email);
		$update_teacher = $this->db->update('teacher', $teacher_data);
		return $update_teacher;
	}
	function get_parent_profile($id){
		$this->db->select('*');
		$this->db->from('login');
		$this->db->join('parent pa','pa.P_Email = login.Email','left');
		$this->db->where('login.ID',$id);
		$query = $this->db->get();
		return $query->row();
	}
	function get_student_profile($id){
		$this->db->select('*');
		$this->db->from('login');
		$this->db->join('student pa','pa.S_Email = login.Email','left');
		$this->db->where('login.ID',$id);
		$query = $this->db->get();
		return $query->row();
	}
	function update_student_profile($parent_data,$email){
		$this->db->where('S_Email', $email);
		$update_parent = $this->db->update('student', $parent_data);
		return $update_parent;
	}
	function update_parent_profile($parent_data,$email){
		$this->db->where('P_Email', $email);
		$update_parent = $this->db->update('parent', $parent_data);
		return $update_parent;
	}
	function save_support_data($support_data){
		return $this->db->insert('support',$support_data);
	}
}




/* End of file DashboardModel.php */
/* Location: ./application/models/DashboardModel.php */