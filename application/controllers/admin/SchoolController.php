<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SchoolController extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->_init();
		$this->load->model('admin/SchoolModel');
		$this->load->model('admin/StudentModel');
	}

	private function _init()
	{
		$this->output->set_template('admin');

	}

	public function index()
	{
		$this->output->set_title("School");
		$all_school  = $this->SchoolModel->school_get();
		$this->load->view('admin/school',array("allSchool"=>$all_school));
	}

	public function addschool(){
		$this->output->set_title("Add School");
		$this->load->view('admin/addschool');
	}

	public function save(){
		$schoolName = array(
			'Sc_Name' => $this->input->post('schoolname'),
			'Sc_Email'=>$this->input->post('schoolemail'),
			'Sc_Phone'=> $this->input->post('schoolphone'),
			'Created_date' => date('Y-m-d H:i:s')
		);
		$loginData=array(
			'Username'=>$this->input->post('schoolname'),
			'Email'=>$this->input->post('schoolemail'),
			'Role'=>'3',
			'Password'=>md5($this->input->post('schoolemail')),
			'Created_date' => date('Y-m-d H:i:s')
		);
		$schooldata = $this->SchoolModel->schoolSave($loginData,$schoolName);
		if(!empty($schooldata)){
			$this->session->set_flashdata('msg','School Added Successfully.');
			redirect('admin/school');
		}
	}

	public function editSchool($id){
		$this->output->set_title("Edit School");
		$school_data = $this->SchoolModel->get_school_data($id);
		$this->load->view('admin/addschool',array("school_data"=>$school_data));
	}

	public function edit($id){
		$school_edit = array(
			'Sc_Name' => $this->input->post('schoolname'),
			'Sc_Phone'=>$this->input->post('schoolphone'),
		);
		$login_edit=array(
			'Username'=>$this->input->post('schoolname'),
		);
		$school_data = $this->SchoolModel->updateSchool($id,$school_edit,$this->input->post('schoolemail'),$login_edit);
		if(!empty($school_data)){
			$this->session->set_flashdata('msg','School Updated Successfully.');
			redirect('admin/school');
		}
	}

	public function classes(){
		$this->output->set_title("Class");
		$this->load->view('admin/class');
	}

	public function getClassList(){
		$columns = array( 
			0 =>'Sc_ID',
			1 =>'C_Class_Name',
			2=> 'class.Created_date',
			3=> 'Action',
		);
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];

		$totalData = $this->SchoolModel->allclass_count();
		$totalFiltered = $totalData;

		if(empty($this->input->post('search')['value']))
		{
			$class_data = $this->SchoolModel->allclass($limit,$start,$order,$dir);
		}
		else {
			$search = $this->input->post('search')['value']; 

			$class_data =  $this->SchoolModel->class_search($limit,$start,$search,$order,$dir);

			$totalFiltered = $this->SchoolModel->class_search_count($search);
		}

		$data = array();
		if(!empty($class_data))
		{
			foreach ($class_data as $row)
			{
				$nestedData['Sc_Name'] = $row->Sc_Name;
				$nestedData['C_Class_Name'] = $row->C_Class_Name;
				$nestedData['Created_date'] = $row->Created_date;
				$nestedData[''] = '<a href="editclass/'.$row->C_ID.'"><i class="fas fa-edit"></i></a>';
				$data[] = $nestedData;
			}
		}
		 // | <a href="javascript:void(0);" class="classesremove" data-id='.$row->C_ID.'><i class="fa fa-trash" aria-hidden="true"></i></a>
		$json_data = array(
			"draw"            => intval($this->input->post('draw')),  
			"recordsTotal"    => intval($totalData),  
			"recordsFiltered" => intval($totalFiltered), 
			"data"            => $data   
		);
		echo json_encode($json_data); exit;
	}

	public function addclass(){
		$this->output->set_title("Add Class");
		$School_data = $this->StudentModel->school_get();
		$this->load->view('admin/add-editclass.php',array('School_data'=>$School_data));
	}

	public function saveclass(){
		$class_Data = array(
			'Sc_ID' => $this->input->post('schoolname'),
			'C_Class_Name' => $this->input->post('classname'),
			'Created_date' => date('Y-m-d H:i:s'),
		);
		$classsave = $this->SchoolModel->classSave($class_Data);
		if(!empty($classsave)){
			$this->session->set_flashdata('msg','Class Added Successfully.');
			redirect('admin/class');
		}
	}

	public function editclass($id){
		$this->output->set_title("Edit Class");
		$School_data = $this->StudentModel->school_get();
		$class_data = $this->SchoolModel->get_class_data($id);
		$this->load->view('admin/add-editclass',array("School_data"=>$School_data,'class_data'=>$class_data));
	}

	public function classedit($id){
		$class_Data = array(
			'Sc_ID' => $this->input->post('schoolname'),
			'C_Class_Name' => $this->input->post('classname'),
			'Created_date' => date('Y-m-d H:i:s'),
		);
		$classupdate = $this->SchoolModel->classUpdate($id,$class_Data);
		if(!empty($classupdate)){
			$this->session->set_flashdata('msg','Class Updated Successfully.');
			redirect('admin/class');
		}
	}

	public function deleteclass($id){
		$class_Delete = $this->SchoolModel->delete_class_data($id);
		$html = '';
		if(!empty($class_Delete)){
			$html.= 'Delete Student Successfully.';
			echo $html;
		}
		exit;
	}
}
