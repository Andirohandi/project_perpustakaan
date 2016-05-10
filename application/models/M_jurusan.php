<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_jurusan extends CI_Model {
	
	private $table = "table_jurusan";
	private $id = "id_jurusan";
	
	function getAll($like='', $where='', $limit='', $offset='') {

		if($like)
			$this->db->where($like);
		
		if($where)
			$this->db->where($where);
		
		if(!$limit && !$offset)
			$query = $this->db->get($this->table);
		else                                     
			$query = $this->db->get($this->table, $limit, $offset);
		
		return $query;
		$query->free_result();
	}
}