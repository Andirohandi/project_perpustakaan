<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_kategori_buku extends CI_Model {

	private $table = "table_kategori_buku";
	private $id = "id_ktgr";
	
	function getAll($where='', $limit='', $offset='') {

		if($where)
			$this->db->where($where);
		
		if(!$limit && !$offset)
			$query = $this->db->get($this->table);
		else                                     
			$query = $this->db->get($this->table, $limit, $offset);
		
		return $query;
		$query->free_result();
	}
	
	function getAllActive(){
		
		$query = $this->db->where('status',1)->get($this->table);
		return $query;
		$query->free_result();
	}
	
	function getKodeKategori(){
		$query = $this->db->order_by('id_ktgr','DESC')->limit('1')->get($this->table);
		return $query->row_array();
		$query->free_result();
	}
	
	function getCount($where='') {
		
		if($where)
			$this->db->where($where);
		
		$query = $this->db->get($this->table);
		
		return $query->num_rows();
		$query->free_result();
	}
	
	function getInsert($data){
		return $this->db->set($data)->insert($this->table);
	}
	
	function getUpdate($data,$id){
		return $this->db->set($data)->where($this->id,$id)->update($this->table);
	}
	
	function getNamaKtgrByNama($nama){
		return $this->db->where('nama_ktgr',$nama)->get($this->table);
	}
	
	function getKodeKtgrByKode($kode){
		return $this->db->where('kode_ktgr',$kode)->get($this->table);
	}
	
	function getNamaKtgrById($id){
		return $this->db->where('id_ktgr',$id)->get($this->table)->row_array();
	}
	
	function getKodeKtgrById($id){
		return $this->db->where('id_ktgr',$id)->get($this->table)->row_array();
	}

	function getDelete($id_ktgr){
		return $this->db->where($this->id,$id_ktgr)->delete($this->table);
	}
}