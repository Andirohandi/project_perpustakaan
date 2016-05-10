<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_arus_buku extends CI_Model {

	private $table = "table_arus_stok a";
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
	
	function getAllDetailArus($like='', $limit='', $offset='') {
		
		if($like)
			$this->db->where($like);
		
		$this->db->order_by("tgl_input","DESC");
		
		if(!$limit && !$offset)
			$query = $this->db->get("table_arus_detail");
		else                                     
			$query = $this->db->get("table_arus_detail", $limit, $offset);
		
		return $query;
		$query->free_result();
	}
	
	function getCountDetailArus($like='') {

		if($like)
			$this->db->where($like);
		
		$query = $this->db->get("table_arus_detail");
		
		return $query->num_rows();
		$query->free_result();
	}
	
	function getStokByIdBuku($id_buku){
		$query = $this->db->where('id_buku',$id_buku)->get("table_arus_stok");
		return $query->row_array();
		$query->free_result();
	}
	
	function getUpdate($data,$id_buku){
		return $this->db->set($data)->where('id_buku',$id_buku)->update("table_arus_stok");
	}
	
}