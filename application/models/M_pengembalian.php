<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_pengembalian extends CI_Model {

	private $table = "table_pengembalian a";
	private $id = "id_pengembalian a";
	
	function getAll($like='', $where='', $limit='', $offset='') {
		
		$this->db->select("a.*, b.*, a.id_pengembalian as id_pengembalian, a.tgl_pengembalian as tgl_pengembalian")
			->join("table_peminjaman b","a.id_peminjaman = b.id_peminjaman","left")
			->order_by("a.id_pengembalian","DESC");
		
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

		$this->db->select("a.*, b.*")
			->join("table_peminjaman b","a.id_peminjaman = b.id_peminjaman","left")
			->order_by("a.id_pengembalian","DESC");
			
		if($like)
			$this->db->where($like);
		
		if($where)
			$this->db->where($where);
		
		$query = $this->db->get($this->table);
		
		return $query->num_rows();
		$query->free_result();
	}
	
	function getLastId(){
		return $this->db->order_by("id_pengembalian","DESC")->limit(1)->get("table_pengembalian")->row_array();
	}
	
	function getNewNomorPengembalian(){
		$query = $this->db->order_by("id_pengembalian",'DESC')->limit('1')->get("table_pengembalian");
		return $query->row_array();
		$query->free_result();
	}
	
	function getInsert($data){
		return $this->db->set($data)->insert('table_pengembalian');
	}
	
	function getInsertPmbDetail($data){
		return $this->db->set($data)->insert('table_pengembalian_detail');
	}
	
	function getUpdate($data,$id){
		return $this->db->set($data)->where("id_pengembalian",$id)->update('table_pengembalian');
	}

	function getDelete($id_pengembalian){
		return $this->db->where('id_pengembalian',$id_pengembalian)->delete('table_pengembalian');
	}
	
	function getDataPmbDetail($where=''){
		$this->db->select("a.*, b.id_buku, b.kode_buku, b.judul_buku, c.id_pengembalian")
			->join("table_pengembalian c","a.id_pengembalian = c.id_pengembalian","left")
			->join("table_buku b","a.id_buku = b.id_buku","left");
		
		if($where)
			$this->db->where($where);
		
		$query = $this->db->get("table_pengembalian_detail a");
	
		
		return $query;
		$query->free_result();
	}
	
	
	//report
	function getReportPengembalian($like='', $where='', $limit='', $offset='') {
		
		$this->db->select("a.*, b.*, c.id_buku, c.kode_buku, c.judul_buku, d.id_peminjaman, d.nomor_peminjaman, d.tgl_peminjaman, b.tgl_pengembalian as tgl_pengembalian, a.denda as denda_buku ")
			->join("table_pengembalian b","a.id_pengembalian = b.id_pengembalian","left")
			->join("table_buku c","a.id_buku = c.id_buku","left")
			->join("table_peminjaman d","b.id_peminjaman = d.id_peminjaman","left");
			
		if($like)
			$this->db->where($like);
		
		if($where)
			$this->db->where($where);
		
		if(!$limit && !$offset)
			$query = $this->db->get("table_pengembalian_detail a");
		else                                     
			$query = $this->db->get("table_pengembalian_detail a", $limit, $offset);
		
		return $query;
		$query->free_result();
	}
	
	function getCountReportPengembalian($like='', $where=''){
		
		$this->db->select("a.*, b.*, c.id_buku, c.kode_buku, c.judul_buku, d.id_peminjaman, d.nomor_peminjaman, d.tgl_peminjaman, b.tgl_pengembalian as tgl_pengembalian, a.denda as denda_buku")
			->join("table_pengembalian b","a.id_pengembalian = b.id_pengembalian","left")
			->join("table_buku c","a.id_buku = c.id_buku","left")
			->join("table_peminjaman d","b.id_peminjaman = d.id_peminjaman","left");
			
		if($like)
			$this->db->where($like);
		
		if($where)
			$this->db->where($where);
		
		$query = $this->db->get("table_pengembalian_detail a");
		
		return $query->num_rows();
		$query->free_result();
	}
}