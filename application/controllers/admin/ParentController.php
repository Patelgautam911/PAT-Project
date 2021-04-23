<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ParentController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/ParentModel');
		$this->load->model('admin/StudentModel');
		$this->_init();
	}

	private function _init()
	{
		$this->output->set_template('admin');

	}

	public function index()
	{
		$this->output->set_title("Parent");
		$this->load->view('admin/parent');
	}

	public function getParentList(){
		$columns = array( 
			0 =>'P_Name',
			1 =>'P_Email',
			2=> 'P_Created_date',
			3=> 'Action',
		);
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$order = $columns[$this->input->post('order')[0]['column']];
		$dir = $this->input->post('order')[0]['dir'];

		$totalData = $this->ParentModel->allparent_count();
		$totalFiltered = $totalData;

		if(empty($this->input->post('search')['value']))
		{
			$parent_data = $this->ParentModel->allparent($limit,$start,$order,$dir);
		}
		else {
			$search = $this->input->post('search')['value']; 

			$parent_data =  $this->ParentModel->parent_search($limit,$start,$search,$order,$dir);

			$totalFiltered = $this->ParentModel->parent_search_count($search);
		}

		$data = array();
		if(!empty($parent_data))
		{
			foreach ($parent_data as $row)
			{
				$nestedData['P_Name'] = $row->P_Name;
				$nestedData['P_Email'] = $row->P_Email;
				$nestedData['P_Created_date'] = $row->P_Created_date;
				$nestedData[''] = '<a href="editparent/'.$row->P_ID.'"><i class="fas fa-edit"></i></a> | <a href="javascript:void(0);" class="removeparent" data-id='.$row->P_ID.'><i class="fa fa-trash" aria-hidden="true"></i></a>';
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

	public function addparent(){
		$this->output->set_title("Add Parent");
		if($this->input->post('submit')){
			$parent = array(
				'P_Name' => $this->input->post('username'),
				'P_Email' => $this->input->post('email'),
				'P_Phone' => $this->input->post('phone'),
				'P_Created_date' => date('Y-m-d H:i:s'),
			);
			$parent_data = $this->ParentModel->parentSave($parent);
			if(!empty($parent_data)){
				$parent_login = array(
					'Username' => $this->input->post('username'),
					'Email' => $this->input->post('email'),
					'Password' => md5($this->input->post('email')),
					'Role' => '4',
					'Created_date' => date('Y-m-d H:i:s'),
				);
				$login_parent = $this->StudentModel->login_student_data($parent_login);
				if(!empty($login_parent)){
					$this->session->set_flashdata('msg','Parent Added Successfully.');
					redirect('admin/parent');
				}else{
					$this->session->set_flashdata('msg','Something went wrong.');
				}
			}
		}else{
			$this->load->view('admin/add-edit-parent');
		}
	}

	public function editparent($id){
		$this->output->set_title("Edit Parent");
		if($this->input->post('submit')){
			$parent_update = array(
				'P_Name' => $this->input->post('username'),
				'P_Phone' => $this->input->post('phone'),
			);
			$parent_update_data = $this->ParentModel->parentUpdate($id,$parent_update);
			if(!empty($parent_update_data)){
				$this->session->set_flashdata('msg','Parent Updated Successfully.');
				redirect('admin/parent');
			}else{
				$this->session->set_flashdata('msg','Something went wrong.');
			}
		}else{
			$parent_data['parent_data'] = $this->ParentModel->parent_get($id);
			$this->load->view('admin/add-edit-parent',$parent_data);
		}
	}

	public function parent_email_exists()
	{
		if (!$this->input->is_ajax_request()) {
			show_404();
		}
		$email = $this->input->post('email');
		$usercheck = $this->ParentModel->checkparentUser($email);
		if($usercheck){
			echo 'false';

		}else{
			echo 'true';
		}
		exit;
	}

	public function deleteParent($id){
		$parent_get = $this->ParentModel->parent_get($id);
		$email = $parent_get['P_Email'];
		$parent_login = $this->StudentModel->delete_login_data($email);
		$parentDelete = $this->ParentModel->delete_parent_data($id);
		$html = '';
		if(!empty($parentDelete)){
			$html.= 'Delete Parent Successfully.';
			echo $html;
		}
		exit;
	}
}
?>