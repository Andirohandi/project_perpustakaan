<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_helper extends CI_Model {
	
	function getDataLabelBuku(){
		return $this->db->order_by("id_label_buku","DESC")->limit(1)->get('table_label_buku')->row_array();
	}
	
	function getLabelByParam($data){
		return $this->db->where($data)->get("table_label_buku");
	}
	
	function getInsertLabelBuku($data){
		return $this->db->set($data)->insert('table_label_buku');
	}
}