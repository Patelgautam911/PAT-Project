<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HomeController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('LoginModel');
		$this->load->model('admin/ParentModel');
		$this->load->model('DashboardModel');
		$this->_init();
		if($this->session->userdata('role')==3)
		{
			$data=$this->DashboardModel->get_school($this->session->userdata('email'));
			$array = array(
				'Sc_ID' => !empty($data->Sc_ID) ? $data->Sc_ID : '',
				'Sc_Image' => !empty($data->Sc_Image) ? $data->Sc_Image : '',
				'Sc_Name' => !empty($data->Sc_Name) ? $data->Sc_Name : '',
			);
			$this->session->set_userdata( $array );
		}
		if($this->session->userdata('role')==2)
		{
			$data=$this->DashboardModel->get_school($this->session->userdata('email'));
			if(isset($data->T_School)) {
				$array = array(
					'Sc_ID' => $data->T_School,
				);
			} else {
				$array = array();
			}
		
			$this->session->set_userdata( $array );
		}
	}

	private function _init()
	{
		$this->output->set_template('frontend');
		if($this->session->userdata('logged_in') != TRUE){
			redirect('login');
		}
	}

	public function index()
	{
		$to_date = $from_date = '';
		if(!empty($this->input->get('days')))
		{
			$to_date = date('d-M-Y');

			if($this->input->get('days')==1)
			{
				$query='Created_date BETWEEN DATE_SUB(NOW(), INTERVAL 1 DAY) AND NOW()';
				$from_date = date('d-M-Y', strtotime($to_date .' -1 day'));
			}else if($this->input->get('days')==7)
			{
				$query='Created_date BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()';
				$from_date = date('d-M-Y', strtotime($to_date .' -7 day'));
			}else if($this->input->get('days')==30)
			{
				$query='Created_date BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()';
				$from_date = date('d-M-Y', strtotime($to_date .' -1 month'));
			}else if($this->input->get('days')==90)
			{
				$query='Created_date BETWEEN DATE_SUB(NOW(), INTERVAL 90 DAY) AND NOW()';
				$from_date = date('d-M-Y', strtotime($to_date .' -3 month'));
			}
			else if(!empty($this->input->get('days')))
			{
				$explode_date=explode('-',$this->input->get_post('days',TRUE));
				// set the filter date FROM & TO
				$to_date = date('d-M-Y',strtotime($explode_date[1]));
				$from_date = date('d-M-Y',strtotime($explode_date[0]));

				$query="Created_date BETWEEN '".@date_format(@date_create(trim($explode_date[0])),'Y-m-d')."' AND '".@date_format(@date_create(trim($explode_date[1])),'Y-m-d')."'";
			}
		}
		else
		{
			$query="Created_date IS NOT NULL";
		}
		
		$this->output->set_title("Home");
		$id = $this->session->userdata('BraceletID');
		if($this->session->userdata('role') != 4)
		{
			if($this->session->userdata('role')==2)
			{
				$parent_data=$this->DashboardModel->teacherDashboardData($this->session->userdata('email'),$query);
				$classes=$this->DashboardModel->classData($this->session->userdata('email'));
				$classStudentData=$this->DashboardModel->classDashboardData($this->session->userdata('email'),$query);
			}
			else if ($this->session->userdata('role')==3) {
				$parent_data=$this->DashboardModel->schoolDashboardData($this->session->userdata('email'),$query);
				$classes=$this->DashboardModel->classData($this->session->userdata('Sc_ID'));
				$classStudentData=$this->DashboardModel->classDashboardData($this->session->userdata('Sc_ID'),$query);
			}
			else
			{
				$parent_data="";
				$classes = '';
				$classStudentData = '';
			}
			
		$this->load->view('home',array('parent_data'=>$parent_data,"classes_data"=>$classes,"classStudentData"=>$classStudentData,'from_date'=>$from_date,'to_date'=>$to_date));
		}
		if($this->session->userdata('role')==4)
		{
			$activity_date = $this->ParentModel->get_activity_date($id);
			$parent_data = $this->ParentModel->parent_Bracelet_data($id,$query);
			$Total_Steps=0;
			$Total_Meters=0;
			$Total_Jumps=0;
			$Activity_Time=0;
			$Average_Steps=0;
			$i=0;
			foreach ($parent_data->result_array() as $key => $value) {
				$Total_Steps+=$value['Total_Steps'];
				$Total_Meters+=$value['Total_Meters'];
				$Total_Jumps+=$value['Total_Jumps'];
				$Activity_Time+=$value['Activity_Time'];
				$i++;
			}
			$Pat_Points=($Activity_Time*($value['Average_Steps']))/10;
			if (!empty($parent_data->row_array())) {
				$p_data=array();
				$p_data['ID']=$parent_data->row_array()['ID'];
				$p_data['Bracelet_ID']=$parent_data->row_array()['Bracelet_ID'];
				$p_data['Timestamp']=$parent_data->row_array()['Timestamp'];
				$p_data['Total_Steps']=$Total_Steps;
				$p_data['Total_Meters']=$Total_Meters;
				$p_data['Total_Jumps']=$Total_Jumps;
				$p_data['Activity_Time']=$parent_data->row_array()['Activity_Time'];
				$p_data['Pat_Points']=$Pat_Points;
				$p_data['Calories']=$parent_data->row_array()['Calories'];
				$p_data['Goal']=$parent_data->row_array()['Goal'];
				$p_data['Created_date']=$parent_data->row_array()['Created_date'];
				$p_data['Updated_date']=$parent_data->row_array()['Updated_date'];
				$this->load->view('home',array('parent_data'=>$p_data,'from_date'=>$from_date,'to_date'=>$to_date,'activity_date'=>$activity_date));
			}
			else{
				$this->load->view('home',array('parent_data'=>$parent_data->row_array(),'from_date'=>$from_date,'to_date'=>$to_date,'activity_date'=>$activity_date));	
			}
		}
	}
	public function helpCenter()
	{
		$this->output->set_title("Help Center");
		$this->load->view('help-center');
	}
	public function aboutus()
	{
		$this->output->set_title("About Us");
		$this->load->view('aboutus');
	}
	public function talkWithus()
	{
		$this->output->set_title("Talk With Us");
		$this->load->view('talkWithus');
	}

	public function support(){
		$this->output->set_title("Support");
		$this->load->view('support');
	}

	public function SaveSupport(){
		if($this->input->post('submit')){
			$support_data=array(
				'Name'=>$this->input->post('uname'),
				'email_address'=>$this->input->post('email'),
				'phone'=> !empty($this->input->post('phone')) ? $this->input->post('phone') : '',
				'message'=>$this->input->post('message'),
			);
			$data = $this->DashboardModel->save_support_data($support_data);
			if(!empty($data)){
				$this->session->set_flashdata('sucess','Thank you. We will get back to soon.');
				redirect('support');
			}else{
				$this->session->set_flashdata('msg','Something Went Wrong.');
				redirect('support');
			}
		}
	}
	
	public function Profile(){
		$this->output->set_title("Profile");
		if($this->session->userdata('role')==3){
			$school_profile = $this->DashboardModel->get_school_profile($this->session->userdata('user_id'));
			if($this->input->post('submit',TRUE)){
				if(!empty($_FILES["profile_image"])){
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
				$school_data=array(
					'Sc_Name'=>$this->input->post('school_name',TRUE),
					'Sc_Phone'=>$this->input->post('school_phone',TRUE),
					'Sc_Image'=> !empty($data['upload_data']['file_name']) ? $data['upload_data']['file_name'] : $school_profile->Sc_Image,
				);
				$email = $this->session->userdata('email');
				$data = $this->DashboardModel->update_school_profile($school_data,$email);
				if(!empty($data)){
					$this->session->set_flashdata('sucess','Profile Update Successfully.');
					redirect('profile');
				}else{
					$this->session->set_flashdata('msg','Something Went Wrong.');
					redirect('profile');
				}
			}
			$this->load->view('school_profile',array('school_profile'=>$school_profile));
		}
		if($this->session->userdata('role') == 2){
			$teacher_profile = $this->DashboardModel->get_teacher_profile($this->session->userdata('user_id'));
			if($this->input->post('submit',TRUE)){
				if(!empty($_FILES["profile_image"])){
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
				$teacher_data=array(
					'T_Dob'=>$this->input->post('teacher_dob',TRUE),
					'T_Phone'=>$this->input->post('teacher_phone',TRUE),
					'T_HeightFeet'=>$this->input->post('teacher_heightft',TRUE),
					'T_HeightInch'=>$this->input->post('teacher_heightinch',TRUE),
					'T_Weight'=>$this->input->post('teacher_weight',TRUE),
					'T_Image'=> !empty($data['upload_data']['file_name']) ? $data['upload_data']['file_name'] : $teacher_profile->T_Image,
				);
				$email = $this->session->userdata('email');
				$data = $this->DashboardModel->update_teacher_profile($teacher_data,$email);
				if(!empty($data)){
					$this->session->set_flashdata('sucess','Profile Update Successfully.');
					redirect('profile');
				}else{
					$this->session->set_flashdata('msg','Something Went Wrong.');
					redirect('profile');
				}
			}
			$this->load->view('teacher_profile',array('teacher_profile'=>$teacher_profile));
		}
		if($this->session->userdata('role') == 4){
			$student_profile = '';
			$parent_profile = $this->DashboardModel->get_parent_profile($this->session->userdata('user_id'));
			if(empty($parent_profile->P_ID)){
				$student_profile = $this->DashboardModel->get_student_profile($this->session->userdata('user_id'));
			}
			if($this->input->post('submit',TRUE)){
				if(!empty($parent_profile->P_ID)){
					if(!empty($_FILES["profile_image"])){
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
					$parent_data=array(
						'P_Phone'=>$this->input->post('parent_phone',TRUE),
						'P_image'=> !empty($data['upload_data']['file_name']) ? $data['upload_data']['file_name'] : $parent_profile->P_image,
					);
					$email = $this->session->userdata('email');
					$data = $this->DashboardModel->update_parent_profile($parent_data,$email);
				}else{
					if(!empty($_FILES["profile_image"]['name'])){
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
					$parent_data=array(
						'S_Phone'=>$this->input->post('parent_phone',TRUE),
						'S_Image'=> !empty($_FILES["profile_image"]['name']) ? $data['upload_data']['file_name'] : $student_profile->S_Image,
					);
					$email = $this->session->userdata('email');
					$data = $this->DashboardModel->update_student_profile($parent_data,$email);
				}
				if(!empty($data)){
					$this->session->set_flashdata('sucess','Profile Update Successfully.');
					redirect('profile');
				}else{
					$this->session->set_flashdata('msg','Something Went Wrong.');
					redirect('profile');
				}
			}
			$this->load->view('parent_profile',array('parent_profile'=>$parent_profile,'student_profile'=>$student_profile));
		}
	}
}