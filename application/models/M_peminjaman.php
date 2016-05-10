<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_peminjaman extends CI_Model {

	private $table = "table_peminjaman";
	private $id = "id_peminjaman";
	
	function getAll($like='', $where='', $limit='', $offset='') {
		
		$this->db->select("a.*,b.*")
			->join("table_anggota b","a.id_peminjam = b.id_anggota","left");
		
		$this->db->order_by("a.id_peminjaman","DESC");
		
		if($like)
			$this->db->where($like);
		
		if($where)
			$this->db->where($where);
		
		if(!$limit && !$offset)
			$query = $this->db->get("table_peminjaman a");
		else                                     
			$query = $this->db->get("table_peminjaman a", $limit, $offset);
		
		return $query;
		$query->free_result();
	}
	
	function getAllCari($like='', $where='', $limit='', $offset='', $level='') {
		
		$table	= '';
		$field	= '';
		if($level == 1){
			$table	= 'iwu_admin b';
			$field	= 'b.id_admin';
		}else if($level == 2){
			$table = 'iwu_pustakawan b';
			$field	= 'b.id_pustakawan';
		}else if($level == 3){
			$table = 'iwu_dosen b';
			$field	= 'b.id_dosen';
		}else if($level == 4){
			$table = 'iwu_mahasiswa b';
			$field	= 'b.id_mhs';
		}else{
			$table = $level;
			$field	= $level;
		}
		
		$this->db->select("a.*,b.*")
			->join($table,"a.id_peminjam =".$field,"left");
		
		if($like)
			$this->db->where($like);
		
		if($where)
			$this->db->where($where);
		
		if(!$limit && !$offset)
			$query = $this->db->get("table_peminjaman a");
		else                                     
			$query = $this->db->get("table_peminjaman a", $limit, $offset);
		
		return $query;
		$query->free_result();
	}
	
	function getCountCari($like='', $where='', $level = '') {
		
		$table	= '';
		$field	= '';
		if($level == 1){
			$table	= 'iwu_admin b';
			$field	= 'b.id_admin';
		}else if($level == 2){
			$table = 'iwu_pustakawan b';
			$field	= 'b.id_pustakawan';
		}else if($level == 3){
			$table = 'iwu_dosen b';
			$field	= 'b.id_dosen';
		}else if($level == 4){
			$table = 'iwu_mahasiswa b';
			$field	= 'b.id_mhs';
		}
		
		$this->db->select("a.*,b.*")
			->join($table,"a.id_peminjam =".$field,"left");
			
		if($like)
			$this->db->where($like);
		
		if($where)
			$this->db->where($where);
		
		$query = $this->db->get("table_peminjaman a");
		
		return $query->num_rows();
		$query->free_result();
	}
	
	
	function getPeminjamanByParam($where){
		return $this->db->where($where)->get($this->table)->row_array();
	}
	
	function getlastPeminjaman(){
		return $this->db->order_by($this->id,"DESC")->limit("1")->get($this->table)->row_array();
	}
	
	function getPeminjamanTransitByParam($where){
		$this->db->select("a.*,b.id_buku,b.kode_buku,b.judul_buku")->join("table_buku b","a.id_buku = b.id_buku","left");
		return $this->db->where($where)->get("table_peminjaman_detail_transit a");
	}
	
	function getSumBookOnTransitDetail($data){
		return $this->db->select('id_peminjaman, sum(jumlah) as jumlah')->where($data)->get('table_peminjaman_detail_transit')->row_array();
	}
	
	function getPeminjamanDetailByParam($where){
		$this->db->select("a.*,b.id_buku,b.kode_buku,b.judul_buku")->join("table_buku b","a.id_buku = b.id_buku","left");
		return $this->db->where($where)->get("table_peminjaman_detail a");
	}
	
	function getCount($like='', $where='') {
		$this->db->select("a.*,b.*")
			->join("table_anggota b","a.id_peminjam = b.id_anggota","left");
			
		if($like)
			$this->db->where($like);
		
		if($where)
			$this->db->where($where);
		
		$query = $this->db->get("table_peminjaman a");
		
		return $query->num_rows();
		$query->free_result();
	}
	
	function getNewNomorPeminjaman(){
		$query = $this->db->order_by($this->id,'DESC')->limit('1')->get($this->table);
		return $query->row_array();
		$query->free_result();
	}
	
	function getLastID(){
		$query = $this->db->order_by($this->id,'DESC')->limit('1')->get($this->table);
		return $query->row_array();
		$query->free_result();
	}
	
	function getLastIdDetail(){
		$query = $this->db->order_by($this->id,'DESC')->limit('1')->get("table_peminjaman_detail");
		return $query->row_array();
		$query->free_result();
	}
	
	function getInsert($data){
		return $this->db->set($data)->insert('table_peminjaman');
	}
	
	function getInsertDetail($data){
		return $this->db->set($data)->insert('table_peminjaman_detail');
	}
	
	function getInsertDetailTransit($data){
		return $this->db->set($data)->insert('table_peminjaman_detail_transit');
	}
	
	function getUpdate($data,$id){
		return $this->db->set($data)->where("id_peminjaman",$id)->update('table_peminjaman');
	}

	function getDeleteDetailTransit($id){
		return $this->db->where('id_peminjaman_detail_transit',$id)->delete('table_peminjaman_detail_transit');
	}
	
	function getDeleteDetailTransitByIdPmnjmn($id){
		return $this->db->where('id_peminjaman',$id)->delete('table_peminjaman_detail_transit');
	}
	
	function getDelete($id_peminjaman){
		return $this->db->where('id_peminjaman',$id_peminjaman)->delete('table_peminjaman');
	}
	
	//REPORT
	function getReportPeminjaman($like='', $where='', $limit='', $offset=''){
		
		$this->db->select("a.*, b.*, c.kode_buku, c.judul_buku, c.id_buku")
			->join("table_peminjaman b","a.id_peminjaman = b.id_peminjaman","left")
			->join("table_buku c","a.id_buku = c.id_buku","left");
		
		if($like)
			$this->db->where($like);
		
		if($where)
			$this->db->where($where);
		
		if(!$limit && !$offset)
			$query = $this->db->get("table_peminjaman_detail a");
		else                                     
			$query = $this->db->get("table_peminjaman_detail a", $limit, $offset);
		
		return $query;
		$query->free_result();
	}
	
	function getCountReportPeminjaman($where='', $like=''){
		
		$this->db->select("a.*, b.*, c.kode_buku, c.judul_buku, c.id_buku")
			->join("table_peminjaman b","a.id_peminjaman = b.id_peminjaman","left")
			->join("table_buku c","a.id_buku = c.id_buku","left");
			
		if($like)
			$this->db->where($like);
		
		if($where)
			$this->db->where($where);
		
		$query = $this->db->get("table_peminjaman_detail a");
		
		return $query->num_rows();
		$query->free_result();
	}
}