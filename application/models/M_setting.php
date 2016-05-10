<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_setting extends CI_Model {
	
	function getAll() {
		
		$query = $this->db->limit(1)->get("table_setting");
		return $query->row_array();
		$query->free_result();
	}
}