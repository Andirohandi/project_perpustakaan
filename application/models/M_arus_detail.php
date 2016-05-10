<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_arus_detail extends CI_Model {

	private $table = "table_arus_detail a";
	private $id = "id_buku";
	
	function getAll($like='', $limit='', $offset='') {
		
		$this->db->select("a.*,b.id_buku,b.kode_buku,b.judul_buku")
			->join("table_buku b","a.id_buku = b.id_buku","left")
			->order_by("a.id_buku","ASC");
			
		if($like)
			$this->db->where($like);
		
		if(!$limit && !$offset)
			$query = $this->db->get($this->table);
		else                                     
			$query = $this->db->get($this->table, $limit, $offset);
		
		return $query;
		$query->free_result();
	}
	
	function getCount($like='', $where='') {
		
		$this->db->select("a.*,b.id_buku,b.kode_buku,b.judul_buku")
			->join("table_buku b","a.id_buku = b.id_buku","left")
			->order_by("a.id_buku","ASC");
			
		if($like)
			$this->db->where($like);
		
		$query = $this->db->get($this->table);
		
		return $query->num_rows();
		$query->free_result();
	}
	
	function getInsert($data){
		return $this->db->set($data)->insert("table_arus_detail");
	}
	
}