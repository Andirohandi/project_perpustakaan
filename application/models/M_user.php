<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_user extends CI_Model {
	
	private $table	= "table_anggota";
	private $id		= "id_anggota";
	
	function getAll($like='', $where='', $limit='', $offset='') {
		
		$this->db->select("a.*, b.*, c.*")
			->join("table_kategori_anggota b","a.id_kategori_anggota = b.id_kategori_anggota","left")
			->join("table_jurusan c","a.id_jurusan = c.id_jurusan","left");
		
		if($like)
			$this->db->where($like);
		
		if($where)
			$this->db->where($where);
		
		if(!$limit && !$offset)
			$query = $this->db->get("table_anggota a");
		else                                     
			$query = $this->db->get("table_anggota a", $limit, $offset);
		
		return $query;
		$query->free_result();
	}
	
	function getCount($like='', $where='') {
		
		$this->db->select("a.*, b.*, c.*")
			->join("table_kategori_anggota b","a.id_kategori_anggota = b.id_kategori_anggota","left")
			->join("table_jurusan c","a.id_jurusan = c.id_jurusan","left");
			
		if($like)
			$this->db->where($like);
		
		if($where)
			$this->db->where($where);
		
		$query = $this->db->get("table_anggota a");
		
		return $query->num_rows();
		$query->free_result();
	}
	
	function getInsert($data){
		return $this->db->set($data)->insert("table_anggota");
	}
	
	function getUpdate($data,$id){
		return $this->db->set($data)->where($id)->update("table_anggota");
	}
	
	function getCountAnggotaPerpust($where){
		return $this->db->where($where)->get("table_anggota");
	}
	
	function getAuthentification($where){
		return $this->db->where($where)->get("table_admin")->row_array();
	}
	
	function getAllKategori(){
		return $this->db->get("table_kategori_anggota");
	}
	
	//table admin
	function getUpdatePass($data,$where){
		return $this->db->set($data)->where($where)->update("table_admin");
	}
}