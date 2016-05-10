<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_buku extends CI_Model {

	private $table = "table_buku";
	private $id = "id_buku";
	
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
	
	function getBukuById($data){
		$query = $this->db->where($data)->get($this->table);
		return $query->row_array();
		$query->free_result();
	}
	
	/*function getKodeKategori(){
		$query = $this->db->order_by('id_ktgr','DESC')->limit('1')->get($this->table);
		return $query->row_array();
		$query->free_result();
	}*/
	
	function getCount($like='', $where='') {
		
		if($like)
			$this->db->where($like);
		
		if($where)
			$this->db->where($where);
		
		$query = $this->db->get($this->table);
		
		return $query->num_rows();
		$query->free_result();
	}
	
	function getCountBookOnCategory($id_ktgr){
		$query = $this->db->where('id_ktgr',$id_ktgr)->get($this->table);
		
		return $query->num_rows();
		$query->free_result();
	}
	
	function getNewKodeBuku(){
		$query = $this->db->order_by('id_buku','DESC')->limit('1')->get($this->table);
		return $query->row_array();
		$query->free_result();
	}
	
	function getLastId(){
		$query = $this->db->order_by('id_buku','DESC')->limit('1')->get($this->table);
		return $query->row_array();
		$query->free_result();
	}
	
	function getBukuByKategoriForKode($data){
		$query = $this->db->where($data)->order_by('id_buku','DESC')->limit(1)->get($this->table);
		return $query->row_array();
		$query->free_result();
	}
	
	function getInsert($data){
		return $this->db->set($data)->insert($this->table);
	}
	
	function getUpdate($data,$id){
		return $this->db->set($data)->where($this->id,$id)->update($this->table);
	}
	
	function getUpdateStatusKategori($data,$id){
		return $this->db->set($data)->where('id_ktgr',$id)->update($this->table);
	}
	
	function getNamaKtgr($nama){
		return $this->db->where('nama_ktgr',$nama)->get($this->table);
	}

	function getDelete($id_ktgr){
		return $this->db->where($this->id,$id_ktgr)->delete($this->table);
	}
}