<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TeacherController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/TeacherModel');
		$this->load->model('admin/StudentModel');
		$this->_init();
	}

	private function _init()
	{
		$this->output->set_template('admin');

	}

	public function index()
	{
		$this->output->set_title("Teacher");
		$this->load->view('admin/teacher');
	}

	public function getTeacherList(){
		$columns = array( 
			0 =>'T_Username',
			1 =>'T_Dob',
			2=> 'T_Email',
			3=> 'T_Phone',
			4=> 'Sc_Name',
			5=> 'T_Created_date',
			6=> 'Action',
		);
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];

		$totalData = $this->TeacherModel->allteacher_count();
		$totalFiltered = $totalData;

		if(empty($this->input->post('search')['value']))
		{
			$teacher_data = $this->TeacherModel->allteacher($limit,$start,$order,$dir);
		}
		else {
			$search = $this->input->post('search')['value']; 

			$teacher_data =  $this->TeacherModel->teacher_search($limit,$start,$search,$order,$dir);

			$totalFiltered = $this->TeacherModel->teacher_search_count($search);
		}
		$data = array();
		if(!empty($teacher_data))
		{
			foreach ($teacher_data as $row)
			{
				$nestedData['T_Username'] = $row->T_Username;
				$nestedData['T_Dob'] = $row->T_Dob;
				$nestedData['T_Email'] = $row->T_Email;
				$nestedData['T_Phone'] = $row->T_Phone;
				$nestedData['Sc_Name'] = !empty($row->Sc_Name) ? $row->Sc_Name : '';
				$nestedData['T_Created_date'] = $row->T_Created_date;
				$nestedData[''] = '<a href="editteacher/'.$row->T_ID.'"><i class="fas fa-edit"></i></a> | <a href="javascript:void(0);" class="removeteacher" data-id='.$row->T_ID.'><i class="fa fa-trash" aria-hidden="true"></i></a>';
				$data[] = $nestedData;
			}
		}
		$json_data = array(
			"draw"            => intval($this->input->post('draw')),  
			"recordsTotal"    => intval($totalData),  
			"recordsFiltered" => intval($totalFiltered), 
			"data"            => $data   
		);
		echo json_encode($json_data); exit;
	}


	public function addteacher(){
		$this->output->set_title("Add Teacher");

		if($this->input->post('submit')){
			$class_json["C_ID"]=array();

			foreach ($this->input->post('addclass',TRUE) as $value) {
				array_push($class_json['C_ID'], $value);
			}
			sort($class_json['C_ID']);
			$json=json_encode($class_json);
			$teacher = array(
				'T_Username' => $this->input->post('username'),
				'T_Email' => $this->input->post('email'),
				'T_Class'=>$json,
				'T_School' => $this->input->post('school'),
				'Teacher_ID'=>$this->input->post('teacher_id', TRUE),
				'T_Created_date' => date('Y-m-d H:i:s'),
			);
			$teacher_data = $this->TeacherModel->teacherSave($teacher);
			if(!empty($teacher_data)){
				$teacherClassarray = array();
				foreach ($this->input->post('class') as $key => $value) {
					$teacherClassarray[] = array("T_ID" => $teacher_data,
												"CT_ID" => $value);
				}
				$add_teacher_class = $this->TeacherModel->addTeacherClass($teacherClassarray);
				
				$teacher_login = array(
					'Username' => $this->input->post('username'),
					'Email' => $this->input->post('email'),
					'Password' => md5($this->input->post('email')),
					'Role' => '2',
					'Created_date' => date('Y-m-d H:i:s'),
				);
				$login_student = $this->StudentModel->login_student_data($teacher_login);
				if(!empty($login_student)){
					$this->session->set_flashdata('msg','Teacher Added Successfully.');
					redirect('admin/teacher');
				}else{
					$this->session->set_flashdata('msg','Something went wrong.');
				}
			}else{
				$this->session->set_flashdata('msg','Something went wrong.');
			}
		}else{
			$School_data = $this->StudentModel->school_get();
			$teacher_data_id=$this->TeacherModel->getTeacherId()->T_ID+1;
			$this->load->view('admin/add-editteacher',array('School_data'=>$School_data,'teacher_data_id'=>$teacher_data_id));
		}
	}

	public function editteacher($id){
		$this->output->set_title("Edit Teacher");
		if($this->input->post('submit')){
			$class_json["C_ID"]=array();

			if(!empty($this->input->post('class[]',TRUE))){
				foreach ($this->input->post('class[]',TRUE) as $value) {
					array_push($class_json['C_ID'], $value);
				}
			}
			sort($class_json['C_ID']);
			$json=json_encode($class_json);
			$teacher_update = array(
				'T_Email' => $this->input->post('email'),
				'T_Username' => $this->input->post('username'),
				'T_Class'=>$json,
				'T_School' => $this->input->post('school'),
			);
			$teacherClassDelete = $this->TeacherModel->delete_teacher_class_data($id);
			$teacherClassarray = array();
			foreach ($this->input->post('class') as $key => $value) {
				$teacherClassarray[] = array("T_ID" => $id,
											"CT_ID" => $value);
			}
			$add_teacher_class = $this->TeacherModel->addTeacherClass($teacherClassarray);
			$teacher_update_data = $this->TeacherModel->teacherUpdate($id,$teacher_update);
			if(!empty($teacher_update_data)){
				$this->session->set_flashdata('msg','Teacher Updated Successfully.');
				redirect('admin/teacher');
			}else{
				$this->session->set_flashdata('msg','Something went wrong.');
			}
		}else{
			$teacher_data_id=$this->TeacherModel->getTeacherId()->T_ID+1;
			$teacherData = $this->TeacherModel->get_teacher_row($id);
			//$data = json_decode($teacherData['T_Class']);
			$school_id = $teacherData['T_School'];
			$class_data = $this->StudentModel->get_class_data($school_id);
			$School_data = $this->StudentModel->school_get();
			$this->load->view('admin/add-editteacher',array('teacherData'=>$teacherData,'School_data'=>$School_data,'class_data'=>$class_data,'teacher_data_id'=>$teacher_data_id));
		}
	}

	public function getClasses(){
		$id = $this->input->post('id');
		$Class_data = $this->StudentModel->getschoolClasses($id);
		$html = '';
		foreach($Class_data as $row){
			$html.= '<option value='.$row['C_ID'].'>'.$row['C_Class_Name'].'</option>';
		}
		echo $html;
		exit;
	}

	public function deleteTeacher($id){
		$teacher_get = $this->TeacherModel->get_teacher_row($id);
		$email = $teacher_get['T_Email'];
		$teacher_login = $this->TeacherModel->delete_login_data($email);
		$teacherDelete = $this->TeacherModel->delete_teacher_data($id);
		$teacherClassDelete = $this->TeacherModel->delete_teacher_class_data($id);
		$html = '';
		if(!empty($teacherDelete)){
			$html.= 'Delete Student Successfully.';
			echo $html;
		}
		exit;
	}

	public function teacher_email_exists()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		$email = $this->input->post('email');
		$usercheck = $this->TeacherModel->checkuser($email);
		if($usercheck){
			echo 'false';

		}else{
			echo 'true';
		}
		exit;
	}
}
?>