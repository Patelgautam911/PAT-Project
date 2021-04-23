<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/StudentModel');
		$this->_init();
	}

	private function _init()
	{
		$this->output->set_template('admin');
	}

	public function index()
	{
		$this->output->set_title("Student");
		$this->load->view('admin/student');
	}

	public function addStudent()
	{
		$this->output->set_title("Add Student");
		$School_data = $this->StudentModel->school_get();
		$parent_data = $this->StudentModel->parent_get();
		$this->load->view('admin/addstudent', array('School_data'=>$School_data,'parent_data'=>$parent_data));
	}

	public function save()
	{
		$student = array(
			'S_Name' => $this->input->post('username'),
			'S_Email' => $this->input->post('email'),
			'S_Surname' => $this->input->post('surname'),
			'S_Username' => $this->input->post('username'),
			'S_BraceletID' => $this->input->post('deviceid'),
			'S_School' => $this->input->post('school'),
			'S_Class' => $this->input->post('class'),
			'S_P_ID' => $this->input->post('parent'),
			'Created_date' => date('Y-m-d H:i:s'),
		);
		$Student_data = $this->StudentModel->studentSave($student);
		if(!empty($Student_data)){
			$student_login = array(
				'Username' => $this->input->post('username'),
				'Email' => $this->input->post('email'),
				'Password' => md5($this->input->post('email')),
				'Role' => '4',
				'Created_date' => date('Y-m-d H:i:s'),
			);
			$login_student = $this->StudentModel->login_student_data($student_login);
			if(!empty($login_student)){
				$this->session->set_flashdata('msg','Student Added Successfully.');
				redirect('admin/student');
			}else{
				$this->session->set_flashdata('msg','Something went wrong.');
			}
		}else{
			$this->session->set_flashdata('msg','Something went wrong.');
			redirect('admin/addstudent');
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


	public function getStudentList(){
		$columns = array( 
			0 =>'S_Name',
			1 =>'S_Surname',
			2=> 'S_Email',
			3=> 'S_BraceletID',
			4=> 'S_P_ID',
			5=> 'Sc_Name',
			6=> 'C_Class_Name',
			7=> 'student.Created_date',
			8=> 'Action',
		);
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];

		$totalData = $this->StudentModel->allstudnet_count();
		$totalFiltered = $totalData;

		if(empty($this->input->post('search')['value']))
		{
			$student_data = $this->StudentModel->allstudent($limit,$start,$order,$dir);
		}
		else {
			$search = $this->input->post('search')['value']; 

			$student_data =  $this->StudentModel->student_search($limit,$start,$search,$order,$dir);

			$totalFiltered = $this->StudentModel->student_search_count($search);
		}

		$data = array();
		if(!empty($student_data))
		{
			foreach ($student_data as $row)
			{
				$nestedData['S_Name'] = $row->S_Name;
				$nestedData['S_Surname'] = $row->S_Surname;
				$nestedData['S_Email'] = $row->S_Email;
				$nestedData['S_BraceletID'] = $row->S_BraceletID;
				$nestedData['S_P_ID'] = $row->P_Name;
				$nestedData['Sc_Name'] = $row->Sc_Name;
				$nestedData['C_Class_Name'] = $row->C_Class_Name;
				$nestedData['Created_date'] = $row->Created_date;
				$nestedData[''] = '<a href="editStudent/'.$row->S_ID.'"><i class="fas fa-edit"></i></a> | <a href="javascript:void(0);" class="removestudent" data-id='.$row->S_ID.'><i class="fa fa-trash" aria-hidden="true"></i></a>';
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

	public function editStudent($id){
		$this->output->set_title("Edit Student");
		$data = $this->StudentModel->get_student_data($id);
		$school_id = $data['S_School'];
		$class_data = $this->StudentModel->get_class_data($school_id);
		$School_data = $this->StudentModel->school_get();
		$parent_data = $this->StudentModel->parent_get();
		$this->load->view('admin/editstudent',array('student_data'=>$data,'School_data'=>$School_data,'class_data'=>$class_data,'parent_data'=>$parent_data));
	}

	public function edit($id){
		$data = $this->StudentModel->get_student_data($id);
		if(!empty($this->input->post('parent'))){
			$parent = $this->input->post('parent');
		}else{
			$parent = $data['S_P_ID'];
		}
		$update_data = array(
			'S_Name' => $this->input->post('username'),
			'S_Email' => $this->input->post('email'),
			'S_P_ID' => $parent,
			'S_BraceletID' => $this->input->post('deviceid'),
			'S_Surname' => $this->input->post('surname'),
			'S_Username' => $this->input->post('username'),
			'S_School' => $this->input->post('school'),
			'S_Class' => $this->input->post('class'),
		);
		$edit_data = $this->StudentModel->update_student($id,$update_data);
		if(!empty($edit_data)){
			$this->session->set_flashdata('msg','Student Updated Successfully.');
			redirect('admin/student');
		}
	}

	public function deleteStudent($id){
		$student_get = $this->StudentModel->get_student_data($id);
		$email = $student_get['S_Email'];
		$student_login = $this->StudentModel->delete_login_data($email);
		$studentDelete = $this->StudentModel->delete_student_data($id);
		$html = '';
		if(!empty($studentDelete)){
			$html.= 'Delete Student Successfully.';
			echo $html;
		}
		exit;
	}

	public function email_exists()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		$email = $this->input->post('email');
		$usercheck = $this->StudentModel->checkuser($email);
		if($usercheck){
			echo 'false';

		}else{
			echo 'true';
		}
		exit;
	}

	public function parent_exists()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		$parent = $this->input->post('parent');
		$usercheck = $this->StudentModel->checkparent($parent);
		if($usercheck){
			echo 'false';

		}else{
			echo 'true';
		}
		exit;
	}
}