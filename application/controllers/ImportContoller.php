<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ImportContoller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ImportModel');
	}

	public function index()
	{
		$this->output->set_title("Import Data");
	}

	public function importData(){
		$json = file_get_contents('php://input');
		$data = json_decode($json);
		if(!empty($data)){
			$json_data = array(
				'Full_response' => json_encode($data),
				'Created_data' => date('Y-m-d H:i:s'),
			);
			$importdata = $this->ImportModel->importdata($json_data);
			if(!empty($importdata)){
				echo "Inserted Data.";
			}
		}
	}
}
