<?php 

class ImportModel extends CI_Model
{

	function importdata($data){
		return $this->db->insert('import_data_json', $data);
	}
}


?>