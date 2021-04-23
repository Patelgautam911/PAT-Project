<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ClassesController extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->_init();
		$this->load->model('ClassesModel');
		if($this->session->userdata('role')!=3 && $this->session->userdata('role')!=2){
			redirect('dashboard');	
		} 
		if($this->session->userdata('role')==3)
		{
			$data=$this->ClassesModel->get_school($this->session->userdata('email'));
			$array = array(
				'Sc_ID' => $data->Sc_ID,
			);
		}
		if($this->session->userdata('role')==2)
		{

			$data=$this->ClassesModel->get_school($this->session->userdata('email'));
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
		if($this->session->userdata('logged_in') != TRUE){
			redirect('login');
		}
		
	}
	public function classes()
	{
		if($this->session->userdata('role')==2)
		{
			$data = $this->ClassesModel->get_school($this->session->userdata('email'));
			$tclass = json_decode($data->T_Class);
			if(!empty($tclass)){
				$class_teach_data = implode(",", $tclass->C_ID);
			}
		}
		$this->output->set_title('Classes');
		$school_id=$this->session->userdata('Sc_ID');
		if(!empty($this->input->get('search')))
		{
			if (isset($_GET["page"])) {
				$cur_page = $_GET["page"];  
			}
			else {
				$cur_page = 1;  
			};  
			$ends_count = 1;
			$middle_count = 2;
			$dots = false;
			$html = '';
			$limit = 10;
			$offset = ($cur_page - 1)  * $limit;
			$start_page = $offset + 1;
    		$start = ($cur_page-1) * 10;
    		$class_name=$this->input->get('search');
			if($this->session->userdata('role')==2){
				$number_of_page = ceil ($this->ClassesModel->countGetClasses($class_teach_data,$this->session->userdata('Sc_ID'),$class_name) / 10);
				$total = $this->ClassesModel->countGetClasses($class_teach_data,$this->session->userdata('Sc_ID'),$class_name);
				$classes_data=$this->ClassesModel->searchClasses($class_teach_data,$school_id,$class_name,$limit,$start);
			}else{
				$class_teach_data = '';
				$number_of_page = ceil ($this->ClassesModel->countGetClasses($class_teach_data,$this->session->userdata('Sc_ID'),$class_name) / 10);
				$total = $this->ClassesModel->countGetClasses($class_teach_data,$this->session->userdata('Sc_ID'),$class_name);
				$classes_data=$this->ClassesModel->searchClasses($class_teach_data,$school_id,$class_name,$limit,$start);
			}
    		$end = min(($offset + $limit), $total);
    		$html .='<div id="paging">Showing '.$start_page.' to '.$end.' of '.$total.'entries</div>';
			$html .='<div class="row valign-wrapper"><ul class="pagination">';
			$prev_next = false;
			if ($cur_page > 1) {
				$query = $_GET;
				$query['page'] = $cur_page-1;
				$query_result = http_build_query($query);
				$html .='<li><a href="'.base_url().'classes?'.$query_result.'"><i class="material-icons left">chevron_left</i><span>Previous</span></a></li>';
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
						$html .='<li><a href="'.base_url().'classes?'.$query_result.'">'.$i.'</a></li>';
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
				$html .='<li><a href="'.base_url().'classes?'.($query_result).'"><i class="material-icons right">chevron_right</i> <span>Next</span></a></li>';
			}else{
				$html .='<li></li>';
			}
			$html .= '</ul></div>';
			
			
			
			
			$i=0;
			foreach ($classes_data as $key => $value) {
				$classes_info[$i]=array();
				array_push($classes_info[$i], $value['C_ID']);
				array_push($classes_info[$i],$value['C_Class_Name']);
				array_push($classes_info[$i],$this->ClassesModel->countStudents($value['C_ID'],$school_id));
				$i++;
			}
			
			$teachers_data=$this->ClassesModel->getTeachers($school_id);
			$data_load=array(
				'classes_data'=>$classes_data,
				'classes_list'=>!empty($classes_info) ? $classes_info : '' ,
				'teachers_data'=>$teachers_data,
				'pages'=>$html,
				'class_id'=>$this->ClassesModel->getClassId()->C_ID+1,
			);
			$this->load->view('classes',$data_load);
		}
		else
		{	
			
			if (isset($_GET["page"])) {
				$cur_page = $_GET["page"];  
			}
			else {  
				$cur_page = 1;  
			};
			$ends_count = 1;
			$middle_count = 2;
			$limit = 10;
			$offset = ($cur_page - 1)  * $limit;
			$start_page = $offset + 1;
    		
			$start = ($cur_page-1) * 10;

			if($this->session->userdata('role')==2){
				$number_of_page = ceil ($this->ClassesModel->countGetClasses($class_teach_data,$this->session->userdata('Sc_ID')) / 10);
				$total = $this->ClassesModel->countGetClasses($class_teach_data,$this->session->userdata('Sc_ID'));
				$classes_data=$this->ClassesModel->getClasses($class_teach_data,$school_id,$limit,$start);
			}else{
				$class_teach_data = '';
				$number_of_page = ceil ($this->ClassesModel->countGetClasses($class_teach_data,$this->session->userdata('Sc_ID')) / 10);
				$total = $this->ClassesModel->countGetClasses($class_teach_data,$this->session->userdata('Sc_ID'));
				$classes_data=$this->ClassesModel->getClasses($class_teach_data,$school_id,$limit,$start);
			}
			$end = min(($offset + $limit), $total);
			$html = '';
			$html .='<div id="paging">Showing '.$start_page.' to '.$end.' of '.$total.'entries</div>';
			$html .='<div class="row valign-wrapper"><ul class="pagination">';
			$prev_next = false;
			if ($cur_page > 1) {
				$html .='<li><a href="'.base_url().'classes?page='.($cur_page-1).'"><i class="material-icons left">chevron_left</i><span>Previous</span></a></li>';
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
						$html .='<li><a href="'.base_url().'classes?'.$query_result.'">'.$i.'</a></li>';
						$dots = true;
					} elseif ($dots) {
						$html .='<li><a>…</a></li>';
						$dots = false;
					}
				}
			}

			if ($cur_page < $number_of_page || -1 == $number_of_page) { 
				$html .='<li><a href="'.base_url().'classes?page='.($cur_page+1).'"><i class="material-icons right">chevron_right</i> <span>Next</span></a></li>';
			}else{
				$html .='<li></li>';
			}
			$html .= '</ul></div>';
			
			
			$i = 0;
			foreach ($classes_data as $key => $value) {
				$classes_info[$i]=array();
				array_push($classes_info[$i], $value['C_ID']);
				array_push($classes_info[$i],$value['C_Class_Name']);
				array_push($classes_info[$i],$this->ClassesModel->countStudents($value['C_ID'],$school_id));
				$i++;
			}

			$teachers_data=$this->ClassesModel->getTeachers($school_id);
			$data_load=array(
				'classes_data'=>$classes_data,
				'classes_list'=>!empty($classes_info) ? $classes_info : '',
				'teachers_data'=>$teachers_data,
				'number_of_page'=>$number_of_page,
				'pages'=>$html,
				'class_id'=>$this->ClassesModel->getClassId()->C_ID+1,
			);
			$this->load->view('classes',$data_load);
		}
	}
	public function add_class()
	{
		$class_data=array(
			'Sc_ID'=>$this->session->userdata('Sc_ID'),
			'C_Class_Name'=>$this->input->post('class_name',TRUE),
			'Class_ID'=>$this->input->post('class_id', TRUE),	
			'Created_date'=>date('Y-m-d H:i:s'),
		);
		$data1=$this->ClassesModel->add_class($class_data);
		foreach ($this->input->post('teachers',TRUE) as $key => $value) {
			
			$teachers_list=$this->ClassesModel->getClassTeacher($value);
			$ary=json_decode($teachers_list[0]['T_Class']);
			array_push($ary->C_ID,"$data1");
			json_encode($ary->C_ID);
			$ans['C_ID']=$ary->C_ID;
			$ans=json_encode($ans);
			$update_data=array(
				'T_Class'=>$ans,
			);
			$data2=$this->ClassesModel->addClassTeacher($value,$update_data);
		}
		if(!empty($data1) && !empty($data2)){
			$this->session->set_flashdata('msg','Register Successfully.');
			redirect('classes');
		}else{
			$this->session->set_flashdata('msg','Something went wrong.');
			redirect('classes');
		}
	}
	public function edit_class()
	{
		$class_data=array(
			'Sc_ID'=>$this->session->userdata('Sc_ID'),
			'C_Class_Name'=>$this->input->post('class_name',TRUE),
			'Class_ID'=>$this->input->post('class_id', TRUE),	
			'Created_date'=>date('Y-m-d H:i:s'),
		);
		$id=$this->input->post('C_ID');
		$this->ClassesModel->edit_class($class_data,$id);

		foreach ($this->input->post('teachers',TRUE) as $key => $value) {
			
			$teachers_list=$this->ClassesModel->getClassTeacher($value);
			$ary=json_decode($teachers_list[0]['T_Class']);

			$flag=0;
			
			foreach ($ary->C_ID as $key1 => $value1) {
				if($id==$value1)
				{
					$flag++;
				}
			}
			if($flag==0)
			{
				array_push($ary->C_ID,$id);
			}
			$ans['C_ID']=$ary->C_ID;	
			$update_data=array(
				'T_Class'=>json_encode($ans,TRUE),
			);

			$data2=$this->ClassesModel->addClassTeacher($value,$update_data);
			$teachers_class_data=$this->ClassesModel->getTeachers($this->session->userdata('Sc_ID'));

			foreach ($teachers_class_data as $tdk => $tdv) {
				if(!(strpos(implode(',',$this->input->post('teachers',TRUE)),$tdv['T_ID'])!==false))
				{
					if (strpos($tdv['T_Class'],$id)!==false) {
						if (($key = array_search($id, $ary->C_ID)) !== false) {
							unset($ary->C_ID[$key]);
						}						$ans['C_ID']=$ary->C_ID;	
						$update_data=array(
							'T_Class'=>json_encode($ans,TRUE),
						);

						$data2=$this->ClassesModel->addClassTeacher($tdv['T_ID'],$update_data);
					}
				}
			}				
		}
		if(!empty($id) && !empty($data2)){
			$this->session->set_flashdata('msg','Updated Successfully.');
			redirect('classes');
		}else{
			$this->session->set_flashdata('msg','Something went wrong.');
			redirect('classes');
		}
	}
	public function delete_class()
	{
		$id=$this->input->post('delete_id');
		$teachers_class_data=$this->ClassesModel->getTeachers($this->session->userdata('Sc_ID'));
		foreach ($teachers_class_data as $tdk => $tdv) {
			$ary=json_decode($tdv['T_Class']);

			if (($key = array_search($id, $ary->C_ID)) !== false) {
				unset($ary->C_ID[$key]);
			}						$ans['C_ID']=$ary->C_ID;	
			$update_data=array(
				'T_Class'=>json_encode($ans,TRUE),
			);

			$data2=$this->ClassesModel->addClassTeacher($tdv['T_ID'],$update_data);
		}
		$this->ClassesModel->deleteClass($id);
	}
}

/* End of file ClassController.php */
/* Location: ./application/controllers/ClassController.php */