<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class StudentController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->_init();
		$this->load->model('StudentModel');

		if($this->session->userdata('logged_in') != TRUE){
			redirect('login');
		}
		if($this->session->userdata('role')==4){
			redirect('dashboard');	
		}
		if($this->session->userdata('role')==3)
		{
			$data=$this->StudentModel->get_school($this->session->userdata('email'));
			$array = array(
				'Sc_ID' => $data->Sc_ID,
			);
		}
		if($this->session->userdata('role')==2)
		{

			$data=$this->StudentModel->get_school($this->session->userdata('email'));
			if(isset($data->T_School)) { 
			$array = array(
				'Sc_ID' => $data->T_School,
			);
			} else {
				$array = array();
			}
		}
		$this->session->set_userdata( $array );
	}

	private function _init()
	{
		$this->output->set_template('frontend');
		if($this->session->userdata('role') == "4"){
			redirect('/');
		}
	}
	public function student($id)
	{
		$this->output->set_title("Student");
		$teachers_data = $this->StudentModel->getTeachers($id);
		$email_add = $this->session->userdata('email');
		if($this->session->userdata('role') == "2"){
			$get_teacher_info = $this->StudentModel->get_teacher_info($email_add);
			$teacher_class = !empty($get_teacher_info->T_Class) ? json_decode($get_teacher_info->T_Class) : '';
			$prev_id = '';
			$data = array_search($id, $teacher_class->C_ID);
			if(array_key_exists($data+1, $teacher_class->C_ID)){
				$next_id = $teacher_class->C_ID[$data + 1];
			}
			if(array_key_exists($data-1, $teacher_class->C_ID)){
				$prev_id = $teacher_class->C_ID[$data - 1];
			}
		}else{
			$next_id = $this->StudentModel->get_next_row_id($id);
			$prev_id = $this->StudentModel->get_prev_row_id($id);
		}
		$whr=array(
			'student.S_Class'=>$id,
			'student.S_School'=>$this->session->userdata('Sc_ID'),
		);
		$class_name = $this->StudentModel->get_class_name($id);
		if(!empty($this->input->get('search')))
		{
			$name=$this->input->get('search');
			$number_of_page = ceil ($this->StudentModel->countSearchStudents($whr,$name) / 10);
			$total = $this->StudentModel->countSearchStudents($whr,$name);
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
				$html .='<li><a href="'.base_url().'student/'.$id.'?'.$query_result.'"><i class="material-icons left">chevron_left</i><span>Previous</span></a></li>';
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
						$html .='<li><a href="'.base_url().'student/'.$id.'?'.$query_result.'">'.$i.'</a></li>';
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
				$html .='<li><a href="'.base_url().'student/'.$id.'?'.($query_result).'"><i class="material-icons right">chevron_right</i> <span>Next</span></a></li>';
			}else{
				$html .='<li></li>';
			}
			$html .= '</ul></div>';
			$html .='<div class="next-prev-cls">';
			if(!empty($next_id)){
				$html .='<a href="'.base_url().'student/'.$next_id.'" id="prev-page-cls"><i class="material-icons left">chevron_left</i><span>Previous Class</span></a>';
			}
			if($prev_id !=0){
				$html .='<a href="'.base_url().'student/'.$prev_id.'" id="next-page-cls"><i class="material-icons right">chevron_right</i><span>Next Class</span></a>';
			}
			$html .='</div>';
			$start = ($cur_page-1) * 10;
			$student_data = $this->StudentModel->searchStudents($whr,$name,$limit,$start);
			$student_track_data = $this->StudentModel->search_getStudents_track_data($whr,$name,$limit,$start);
			$totalstudentCount = $this->StudentModel->total_student_count($whr);
		}
		else
		{
			$number_of_page = ceil ($this->StudentModel->countGetStudents($whr) / 10);
			$total = $this->StudentModel->countGetStudents($whr);
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
				$html .='<li><a href="'.base_url().'student/'.$id.'?'.$query_result.'"><i class="material-icons left">chevron_left</i><span>Previous</span></a></li>';
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
						$html .='<li><a href="'.base_url().'student/'.$id.'?'.$query_result.'">'.$i.'</a></li>';
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
				$html .='<li><a href="'.base_url().'student/'.$id.'?'.($query_result).'"><i class="material-icons right">chevron_right</i> <span>Next</span></a></li>';
			}else{
				$html .='<li></li>';
			}
			$html .= '</ul></div>';
			$html .='<div class="next-prev-cls">';
			if(!empty($next_id)){
				$html .='<a href="'.base_url().'student/'.$next_id.'" id="prev-page-cls"><i class="material-icons left">chevron_left</i><span>Previous Class</span></a>';
			}
			if($prev_id !=0 || !empty($prev_id)){
				$html .='<a href="'.base_url().'student/'.$prev_id.'" id="next-page-cls"><i class="material-icons right">chevron_right</i><span>Next Class</span></a>';
			}
			$html .='</div>';
			$start = ($cur_page-1) * 10;
			$student_data = $this->StudentModel->getStudents($whr,$limit,$start);
			$student_track_data = $this->StudentModel->getStudents_track_data($whr);
			$totalstudentCount = $this->StudentModel->total_student_count($whr);
		}
		$class_data=$this->StudentModel->getClasses();
		$data=array(
			'teachers_data'=>$teachers_data,
			'student_data'=>$student_data,
			'class_data'=>$class_data,
			'student_track_data'=>$student_track_data,
			'totalstudentCount'=>$totalstudentCount,
			'class_name'=>$class_name,
			'pages'=>$html,
			'class_id'=>$id,
			'student_id'=>$this->StudentModel->getStudentId()->S_ID+1,
		);
		$this->load->view('student',$data);
	}
	public function add_student()
	{
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
			echo "<pre>";
			print_r ($error);
			echo "</pre>";
		}
		else{
			$data = array('upload_data' => $this->upload->data());
			
		}
		$student_data=array(
			'S_Name'=>$this->input->post('name',TRUE),
			'S_Class'=>$this->input->post('class',TRUE),
			'S_BraceletID'=>$this->input->post('braceletid',TRUE),
			'S_Email'=>$this->input->post('email',TRUE),
			'S_HeightFeet'=>$this->input->post('heightft',TRUE),
			'S_HeightInch'=>$this->input->post('heightinch',TRUE),
			'S_Weight'=>$this->input->post('weight',TRUE),
			'S_BMI'=>$this->input->post('bmi',TRUE),
			'S_School'=>$this->session->userdata('Sc_ID'),
			'S_Dob'=>$this->input->post('dob',TRUE),
			'S_Gender'=>$this->input->post('gender',TRUE),
			'S_Phone'=>$this->input->post('phone',TRUE),
			'Created_date'=>date('Y-m-d H:i:s'),
			'S_Image'=>$data['upload_data']['file_name'],
			'Student_ID'=>$this->input->post('student_id', TRUE),
		);
		$student_login=array(
			'Username'=>$this->input->post('name',TRUE),
			'Email'=>$this->input->post('email',TRUE),
			'Password'=> md5($this->input->post('password',TRUE)),
			'Role'=>'4',
			'Created_date'=>date('Y-m-d H:i:s'),
		);
		$data=$this->StudentModel->add_student($student_data,$student_login);
		if(!empty($data)){
			$this->session->set_flashdata('msg','Add Student Successfully.');
			redirect('student/'.$this->input->post('class',TRUE));
		}else{
			$this->session->set_flashdata('msg','Something went wrong.');
			redirect('student/'.$this->input->post('class',TRUE));
		}
	}
	public function edit_student()
	{
		if(!empty($_FILES["profile_image"]["name"])){
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
		}

		$student_data=array(
			'S_Name'=>$this->input->post('edit_name',TRUE),
			'S_Class'=>$this->input->post('edit_class',TRUE),
			'S_BraceletID'=>$this->input->post('edit_braceletid',TRUE),
			'S_Email'=>$this->input->post('edit_email',TRUE),
			'S_HeightFeet'=>$this->input->post('edit_heightft',TRUE),
			'S_HeightInch'=>$this->input->post('edit_heightinch',TRUE),
			'S_Weight'=>$this->input->post('edit_weight',TRUE),
			'S_BMI'=>$this->input->post('edit_bmi',TRUE),
			'S_School'=>$this->session->userdata('Sc_ID'),
			'S_Dob'=>$this->input->post('edit_dob',TRUE),
			'S_Gender'=>$this->input->post('edit_gender',TRUE),
			'S_Phone'=>$this->input->post('edit_phone',TRUE),
			'S_Image'=>!empty($data['upload_data']['file_name']) ? $data['upload_data']['file_name'] : '',
		);
		$student_login=array(
			'Username'=>$this->input->post('edit_name',TRUE),
			'Email'=>$this->input->post('edit_email',TRUE),
			'Role'=>'4',
		);
		$email=$this->input->post('update_email',TRUE);
		$data=$this->StudentModel->edit_student($student_data,$student_login,$email);
		$get_student_info = $this->StudentModel->get_student_info($this->input->post('edit_email',TRUE));
		
		if(!empty($get_student_info)){
			if($get_student_info->Password != $this->input->post('edit_password',TRUE)){
				$password = md5($this->input->post('edit_password',TRUE));
			}else{
				$password = $get_student_info->Password;
			}
		}
		$student__password_login=array(
			'Password'=>$password
		);
		$update_data=$this->StudentModel->edit_student_password($student__password_login,$this->input->post('edit_email',TRUE));
		if(!empty($data)){
			$this->session->set_flashdata('msg','Student updated Successfully.');
			redirect('student/'.$this->input->post('edit_class',TRUE));
		}else{
			$this->session->set_flashdata('msg','Something went wrong.');
			redirect('student/'.$this->input->post('edit_class',TRUE));
		}
	}
	public function delete_student()
	{
		$id=$this->input->post('delete_id',TRUE);
		$email=$this->input->post("delete_email",TRUE);
		$ans=$this->StudentModel->delete_student($id,$email);
		if(!empty($ans)){
			$this->session->set_flashdata('msg','Teacher Deleted Successfully.');
			$this->load->library('user_agent');
			if ($this->agent->is_referral())
			{
				echo $this->agent->referrer();
			}
		}else{
			$this->session->set_flashdata('msg','Something went wrong.');	
			$this->load->library('user_agent');
			if ($this->agent->is_referral())
			{
				echo $this->agent->referrer();
			}
		}
	}
}