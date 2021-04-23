<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class TeacherController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->_init();
		$this->load->model('TeacherModel');
		$this->load->library('upload');
		if($this->session->userdata('role')!=3){
			redirect('dashboard');	
		}
	}

	private function _init()
	{
		$this->output->set_template('frontend');
		if($this->session->userdata('logged_in') != TRUE){
			redirect('login');
		}
	}

	public function index(){
		$this->output->set_title("Teacher");
		if(!empty($this->input->get('search',TRUE)))
		{
			$name=$this->input->get('search',TRUE);	
			$data=$this->TeacherModel->get_school($this->session->userdata('email'));
			$number_of_page = ceil ($this->TeacherModel->count_search_teacher_list($name,$data[0]['Sc_ID']) / 10);
			$total = $this->TeacherModel->count_search_teacher_list($name,$data[0]['Sc_ID']);
			if (isset($_GET["page"])) {
				$cur_page = $_GET["page"];  
			}
			else {  
				$cur_page = 1;  
			};  
			$ends_count = 1;
			$middle_count = 2;
			$dots = false;
			$limit=10;
			$offset = ($cur_page - 1)  * $limit;
			$start_page = $offset + 1;
    		$end = min(($offset + $limit), $total);
			$html = '';
			$html .='<div id="paging">Showing '.$start_page.' to '.$end.' of '.$total.'entries</div>';
			$html .='<div class="row valign-wrapper"><ul class="pagination">';
			$prev_next = false;
			if ($cur_page > 1) {
				$query = $_GET;
				$query['page'] = $cur_page-1;
				$query_result = http_build_query($query);
				$html .='<li><a href="'.base_url().'teacher?'.$query_result.'"><i class="material-icons left">chevron_left</i><span>Previous Teacher</span></a></li>';
			}else{
				$html .='<li></li>';
			}

			for ($i = 1; $i <= $number_of_page; $i++) {
				if ($i == $cur_page) {
					$html .='<li class="active"><a>'.$i.'</a></li>';
					$dots = true;
				} else {
					if ($i <= $ends_count || ($cur_page && $i >= $cur_page - $middle_count && $i <= $cur_page + $middle_count) || $i > $number_of_page - $ends_count) { 
						$query = $_GET;
						$query['page'] = $i;
						$query_result = http_build_query($query);
						$html .='<li><a href="'.base_url().'teacher?'.$query_result.'">'.$i.'</a></li>';
						$dots = true;
					} elseif ($dots) {
						$html .='<li><a>…</a></li>';
						$dots = false;
					}
				}
			}

			if ($cur_page < $number_of_page || -1 == $number_of_page) { 
				$query = $_GET;
				$query['page'] = $cur_page+1;
				$query_result = http_build_query($query);
				$html .='<li><a href="'.base_url().'teacher?'.($query_result).'"><i class="material-icons right">chevron_right</i> <span>Next Teacher</span></a></li>';
			}else{
				$html .='<li></li>';
			}
			$html .= '</ul></div>';
			$start = ($cur_page-1) * 10;
			$list=$this->TeacherModel->search_teacher_list($name,$data[0]['Sc_ID'],$limit,$start);
			$class=$this->TeacherModel->get_class_list($data[0]['Sc_ID']);
			$array = array(
			'Sc_ID' => $data[0]['Sc_ID'],
			);
			$send=array(
				'school_data'=>$data,
				'teacher_data'=>$list,
				'class_data'=>$class,
				'pages'=>$html,
				'teacher_id'=>$this->TeacherModel->getTeacherId()->T_ID+1,
			);
			$this->load->view('teacher',$send);
			$this->session->set_userdata( $array );
		}
		else {
			$data=$this->TeacherModel->get_school($this->session->userdata('email'));
			$number_of_page = ceil ($this->TeacherModel->count_get_teacher_list($data[0]['Sc_ID']) / 10);
			$total = $this->TeacherModel->count_get_teacher_list($data[0]['Sc_ID']);
			if (isset($_GET["page"])) {
				$cur_page = $_GET["page"];  
			}
			else {  
				$cur_page = 1;  
			};  
			$ends_count = 1;
			$middle_count = 2;
			$dots = false;
			$limit=10;
			$offset = ($cur_page - 1)  * $limit;
			$start_page = $offset + 1;
    		$end = min(($offset + $limit), $total);
			$html = '';
			$html .='<div id="paging">Showing '.$start_page.' to '.$end.' of '.$total.'entries</div>';
			$html .='<div class="row valign-wrapper"><ul class="pagination">';
			$prev_next = false;
			if ($cur_page > 1) {
				$query = $_GET;
				$query['page'] = $cur_page-1;
				$query_result = http_build_query($query);
				$html .='<li><a href="'.base_url().'teacher?'.$query_result.'"><i class="material-icons left">chevron_left</i><span>Previous Teacher</span></a></li>';
			}else{
				$html .='<li></li>';
			}
			
			for ($i = 1; $i <= $number_of_page; $i++) {
				if ($i == $cur_page) {
					$html .='<li class="active"><a>'.$i.'</a></li>';
					$dots = true;
				} else {
					if ($i <= $ends_count || ($cur_page && $i >= $cur_page - $middle_count && $i <= $cur_page + $middle_count) || $i > $number_of_page - $ends_count) { 
						$query = $_GET;
						$query['page'] = $i;
						$query_result = http_build_query($query);
						$html .='<li><a href="'.base_url().'teacher?'.$query_result.'">'.$i.'</a></li>';
						$dots = true;
					} elseif ($dots) {
						$html .='<li><a>…</a></li>';
						$dots = false;
					}
				}
			}

			if ($cur_page < $number_of_page || -1 == $number_of_page) { 
				$query = $_GET;
				$query['page'] = $cur_page+1;
				$query_result = http_build_query($query);
				$html .='<li><a href="'.base_url().'teacher?'.($query_result).'"><i class="material-icons right">chevron_right</i> <span>Next Teacher</span></a></li>';
			}else{
				$html .='<li></li>';
			}
			$html .= '</ul></div>';
			$start = ($cur_page-1) * 10;
			$list=$this->TeacherModel->get_teacher_list($data[0]['Sc_ID'],$limit,$start);
			$class=$this->TeacherModel->get_class_list($data[0]['Sc_ID']);

			$array = array(
				'Sc_ID' => $data[0]['Sc_ID'],
			);
			
			$this->session->set_userdata( $array );
			$send=array(
				'school_data'=>$data,
				'teacher_data'=>$list,
				'class_data'=>$class,
				'pages'=>$html,
				'teacher_id'=>$this->TeacherModel->getTeacherId()->T_ID+1,
			);
			$this->load->view('teacher',$send);
		}
		
	}
	public function add_teacher()
	{
		$class_json["C_ID"]=array();

		foreach ($this->input->post('addclass',TRUE) as $value) {
			array_push($class_json['C_ID'], $value);
		}
		sort($class_json['C_ID']);
		$json=json_encode($class_json);
		$config['upload_path']          = './assets/images/';
        $config['allowed_types']        = '*';
        $config['max_size']             = 100000;
        $config['max_width']            = 10240;
        $config['max_height']           = 7680;
        $config['file_name'] = time()."_".$_FILES["profile_image"]["name"];
		
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload('profile_image')){
			$error = array('error' => $this->upload->display_errors());
		}
		else{
			$data = array('upload_data' => $this->upload->data());
			
		}

		$teacher_data=array(
			'T_Username'=>$this->input->post('addusername',TRUE),
			'T_Email'=>$this->input->post('addemail',TRUE),
			'T_Phone'=>$this->input->post('addphone',TRUE),
			'T_Class'=>$json,
			'T_School'=>$this->session->userdata('Sc_ID'),
			'T_HeightFeet'=>$this->input->post('addheightft',TRUE),
			'T_HeightInch'=>$this->input->post('addheightinch',TRUE),
			'T_Weight'=>$this->input->post('addweight',TRUE),
			'T_BMI'=>$this->input->post('addbmi',TRUE),
			'T_Dob'=>$this->input->post('adddob',TRUE),
			'T_UserId'=>$this->input->post('adduserid',TRUE),
			'T_Created_date'=>date('Y-m-d H:i:s'),
			'T_Image'=>$data['upload_data']['file_name'],
			'Teacher_ID'=>$this->input->post('teacher_id', TRUE),
		);
		$login_data=array(
			'Username'=>$this->input->post('addusername',TRUE),
			'Email'=>$this->input->post('addemail',TRUE),
			'Role'=>2,
			'Password'=>md5($this->input->post('addpassword',TRUE)),
			'Created_date'=>date('Y-m-d H:i:s'),
		);
		$config['upload_path'] = './images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']  = '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload()){
			$error = array('error' => $this->upload->display_errors());
		}
		else{
			$data = array('upload_data' => $this->upload->data());
			echo "success";
		}
		$data=$this->TeacherModel->add_teacher($teacher_data,$login_data);
		if(!empty($data)){
				$this->session->set_flashdata('msg','Register Successfully.');
				redirect('teacher');
			}else{
				$this->session->set_flashdata('msg','Something went wrong.');
				redirect('teacher');
			} 
	}
	public function edit_teacher()
	{
		$class_json["C_ID"]=array();

		if(!empty($this->input->post('class[]',TRUE))){
			foreach ($this->input->post('class[]',TRUE) as $value) {
				array_push($class_json['C_ID'], $value);
			}
		}
		sort($class_json['C_ID']);
		$json=json_encode($class_json);
		$config['upload_path']          = './assets/images/';
        $config['allowed_types']        = '*';
        $config['max_size']             = 100000;
        $config['max_width']            = 10240;
        $config['max_height']           = 7680;
        $config['file_name'] = time()."_".$_FILES["profile_image"]["name"];
		
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload('profile_image')){
			$error = array('error' => $this->upload->display_errors());
		}
		else{
			$data = array('upload_data' => $this->upload->data());
		}
		
		$teacher_data=array(
			'T_Username'=>$this->input->post('username',TRUE),
			'T_Email'=>$this->input->post('email',TRUE),
			'T_Phone'=>$this->input->post('phone',TRUE),
			'T_Class'=>$json,
			'T_HeightFeet'=>$this->input->post('heightft',TRUE),
			'T_HeightInch'=>$this->input->post('heightinch',TRUE),
			'T_Weight'=>$this->input->post('weight',TRUE),
			'T_BMI'=>$this->input->post('bmi',TRUE),
			'T_Dob'=>$this->input->post('dob',TRUE),
			'T_UserId'=>$this->input->post('userid',TRUE),
			'T_Image'=>$data['upload_data']['file_name'],
		);
		$login_data=array(
			'Username'=>$this->input->post('username',TRUE),
			'Email'=>$this->input->post('email',TRUE),
			'Role'=>'2',
		);
		$data=$this->TeacherModel->edit_teacher($this->input->post('id',TRUE),$teacher_data,$login_data);	
		$get_student_info = $this->TeacherModel->get_teacher_info($this->input->post('email',TRUE));
		if(!empty($get_student_info)){
			if($get_student_info->Password != $this->input->post('password',TRUE)){
				$password = md5($this->input->post('password',TRUE));
			}else{
				$password = $get_student_info->Password;
			}
		}
		$teacher_password_login=array(
			'Password'=>$password
		);
		$email = $this->input->post('email',TRUE);
		$update_data=$this->TeacherModel->edit_teacher_password($email,$teacher_password_login);
		if(!empty($data)){
			$this->session->set_flashdata('msg','Teacher Updated Successfully.');
			redirect('teacher');
		}else{
			$this->session->set_flashdata('msg','Something went wrong.');	
			redirect('teacher');
		}
	}
	public function delete_teacher()
	{
		$id=$this->input->post('delete_id',TRUE);
		$email=$this->input->post("delete_email",TRUE);
		$ans=$this->TeacherModel->delete_teacher($id,$email);
		if(!empty($ans)){
				$this->session->set_flashdata('msg','Teacher Deleted Successfully.');
				redirect('teacher');
			}else{
				$this->session->set_flashdata('msg','Something went wrong.');	
				redirect('teacher');
			}
	}
}
?>
