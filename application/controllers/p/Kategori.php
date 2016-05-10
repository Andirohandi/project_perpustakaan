<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logged_in_pustakawan')){
			redirect('verify','refresh');
		}
		$this->load->model(array('m_kategori_buku','m_buku'));
		$this->load->helper('general_helper');
		$this->load->library('form_validation');

	}

	public function index(){
		
		$data['title']	= "Kategori Buku ";
		$data['pg']		= 'p_kategori';
		
		$this->load->view('back/layout/vwNavbar',$data);
		$this->load->view('back/layout/vwSidebar');
		$this->load->view('back/p/kategori/vwIndex');
		$this->load->view('back/layout/vwFooter');
	}
	
	function read($pg=1){
		
		$key	= trim($this->input->post('cari',true));
		$limit	= trim($this->input->post('limit',true));
		$offset = ($limit*$pg)-$limit;
		$like	= '';
		
		if($key) $like = "(kode_ktgr LIKE '%$key%' OR nama_ktgr LIKE '%$key%' )";
		
		$page 	= array();
        $page['limit'] 		= $limit;
        $page['count_row'] 	= $this->m_kategori_buku->getCount($like);
        $page['current'] 	= $pg;
        $page['list'] 		= gen_paging($page);

        $data['paging'] = $page;
		$data['key']	= $key;
		$data['last']	= ceil($this->m_kategori_buku->getCount($like) / $limit);
		$data['list']	= $this->m_kategori_buku->getAll($like, $limit, $offset);
		
		$this->load->view('back/p/kategori/vwList',$data);
	}
	
	function simpan(){
		
		$kode	= trim($this->input->post('kode',true));
		$nama	= trim($this->input->post('nama',true));
		$status	= trim($this->input->post('status',true));
		$data	= array();
		
		if($kode == '' || $nama == '' || $status == ''){
			$data	= array('result'=>'0','message'=>'Silahkan lengkapi data inputan terlebih dahulu');
		}else{
			$insert	= array(
				'kode_ktgr'	=> $kode,
				'nama_ktgr'	=> $nama,
				'status'	=> $status
			);
			
			$query = $this->m_kategori_buku->getInsert($insert);
			
			if($query){
				$data	= array('result'=>'1','message'=>'Data berhasil disimpan');
			}else{
				$data	= array('result'=>'0','message'=>'Data gagal disimpan');
			}
		}
		
		echo json_encode($data);
	}
	
	function get_kode_ktgr(){
		
		$query	= $this->m_kategori_buku->getKodeKategori();
		
		if($query) {
			$query	= explode("-",$query['kode_ktgr']);
			$hasil_1= ((int) $query[1]) + 1;
			$kd		= '';
			
			if(count($hasil_1) == 1){
				$kd	= '00'.$hasil_1;
			}else if(count($hasil_1) == 2){
				$kd	= '0'.$hasil_1;
			}else if(count($hasil_1) == 3){
				$kd	= $hasil_1;
			}else{
				$kd	= '#&^$*&*#@*(+_@#$^';
			}
			
			$data = array('result'=>'KR-'.$kd);
		}else{
			$data = array('result'=>'KR-001');
		}
		
		echo json_encode($data);
	}
	
	function cek_nama_ktgr(){
		$nama = trim($this->input->post('x',true));
		$query	= $this->m_kategori_buku->getNamaKtgrByNama($nama);
		if($query->num_rows() > 0){
			$data = array(
				'result' => 0 
			);
		}else{
			$data = array(
				'result' => 1
			);
		}
		echo json_encode($data);
	}
	
	function cek_kode_ktgr(){
		$kode = trim($this->input->post('x',true));
		$query	= $this->m_kategori_buku->getKodeKtgrByKode($kode);
		if($query->num_rows() > 0){
			$data = array(
				'result' => 0 
			);
		}else{
			$data = array(
				'result' => 1
			);
		}
		echo json_encode($data);
	}
	
	function edit(){
		$id		= trim($this->input->post('id',true));
		$kode		= trim($this->input->post('kode',true));
		$nama	= trim($this->input->post('nama',true));
		$status	= trim($this->input->post('status',true));
		$data	= array();
		
		if($id == '' || $nama == '' || $status == ''){
			$data	= array('result'=>'0','message'=>'Silahkan lengkapi data inputan terlebih dahulu');
		}else{
			$update	= array(
				'kode_ktgr'	=> $kode,
				'nama_ktgr'	=> $nama,
				'status'	=> $status
			);
			
			$query = $this->m_kategori_buku->getUpdate($update,decode($id));
			
			if($query){
				$this->m_buku->getUpdateStatusKategori(array('status'=>$status),decode($id));
				$data	= array('result'=>'1','message'=>'Data berhasil diedit');
			}else{
				$data	= array('result'=>'0','message'=>'Data gagal diedit');
			}
		}
		
		echo json_encode($data);
	}
	
	function hapus(){
		$id_ktgr 	= decode(trim($this->input->post('x',true)));
		$query		= $this->m_kategori_buku->getDelete($id_ktgr);
		$data		= array();
		
		if($query){
			$data = array(
				'result' => 1
			);
		}else{
			$data = array(
				'result' => 0
			);
		}
		echo json_encode($data);
	}
	
}
