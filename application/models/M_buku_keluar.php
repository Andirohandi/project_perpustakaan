<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_buku_keluar extends CI_Model {

	private $table = "table_buku_keluar a";
	private $id = "id_buku_keluar";
	
	function getAll($like='', $where='', $limit='', $offset='') {
		
		$this->db->select("a.*,b.id_buku,b.kode_buku,b.judul_buku")
			->join("table_buku b","a.id_buku = b.id_buku","left")
			->order_by("a.id_buku_keluar","ASC");
			
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
	
	function getCount($like='', $where='') {
		
		$this->db->select("a.*,b.id_buku,b.kode_buku,b.judul_buku")
			->join("table_buku b","a.id_buku = b.id_buku","left")
			->order_by("a.id_buku_keluar","ASC");
			
		if($like)
			$this->db->where($like);
		if($where)
			$this->db->where($where);
		
		$query = $this->db->get($this->table);
		
		return $query->num_rows();
		$query->free_result();
	}
	
	function getInsert($data){
		return $this->db->set($data)->insert("table_buku_keluar");
	}
	
	function getDelete($id){
		return $this->db->where($this->id,$id)->delete("table_buku_keluar");
	}
}