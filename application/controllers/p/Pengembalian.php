<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengembalian extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logged_in_pustakawan')){
			redirect('verify','refresh');
		}
		$this->load->model(array('m_buku','m_arus_buku','m_pengembalian','m_peminjaman','m_buku_keluar','m_arus_detail','m_user'));
		$this->load->helper('general_helper');
		$this->load->library('form_validation');
	}
	
	function index(){
		$data['title']	= "Pengembalian";
		$data['pg']		= 'p_pengembalian';
		
		$this->load->view('back/layout/vwNavbar',$data);
		$this->load->view('back/layout/vwSidebar');
		$this->load->view('back/p/pengembalian/vwIndex');
		$this->load->view('back/layout/vwFooter');
	}
	
	function read($pg=1){
		
		$key	= trim($this->input->post('cari',true));
		$limit	= trim($this->input->post('limit',true));
		$tanggal= trim($this->input->post('tanggal',true));
		$offset = ($limit*$pg)-$limit;
		$like	= '';
		$where	= '';
		
		$tgl	= explode(" - ",$tanggal);
		$t_awal = date('Y-m-d H:i:s',strtotime($tgl[0]));
		$t_akhir = date('Y-m-d 23:59:s',strtotime($tgl[1]));
		
		if($tanggal) $where	= ("a.tgl_pengembalian BETWEEN '$t_awal' AND '$t_akhir'");
		
		if($key) $like = "(a.nomor_pengembalian LIKE '%$key%' OR b.nomor_peminjaman LIKE '%$key%' )";
		
		$page 	= array();
        $page['limit'] 		= $limit;
        $page['count_row'] 	= $this->m_pengembalian->getCount($like,  $where);
        $page['current'] 	= $pg;
        $page['list'] 		= gen_paging($page);

        $data['paging'] = $page;
		$data['key']	= $key;
		$data['list']	= $this->m_pengembalian->getAll($like, $where, $limit, $offset);
		
		$this->load->view('back/p/pengembalian/vwList',$data);
	}
	
	function add(){
		$data['title']	= "Tambah Pengembalian ";
		$data['pg']		= 'p_pengembalian';
		
		$this->load->view('back/layout/vwNavbar',$data);
		$this->load->view('back/layout/vwSidebar');
		$this->load->view('back/p/pengembalian/vwAdd');
		$this->load->view('back/layout/vwFooter');
	}
	
	function detail($id_pengembalian=''){
		
		if($id_pengembalian==''){
			echo "<h3 style='color:red;text-align:center'>-- 404 Page Not Found --</h3>";
		}else{
			$id_pengembalian  = decode($id_pengembalian);
			$query	= $this->m_pengembalian->getAll(array('a.id_pengembalian' => $id_pengembalian));
			$query	= $query->row_array();
			$pmnjm	= $this->m_user->getAll(array("id_anggota" => $query['id_peminjam']))->row_array();
			$status = "";
			
			if($pmnjm['id_kategori_anggota'] == 1) $status = "AKADEMIK";
			else if($pmnjm['id_kategori_anggota'] == 2) $status = "DOSEN";
			else if($pmnjm['id_kategori_anggota'] == 3) $status = "MAHASISWA";
			else $status = "Error Found";
			
			if($query){
				$data['id_level']		= $pmnjm['id_kategori_anggota'];
				$data['nip_nim']		= $pmnjm['nip_nim_anggota'];
				$data['id_peminjam']	= $query['id_peminjam'];
				$data['id_peminjaman']	= encode($query['id_peminjaman']);
				$data['no_peminjaman']	= $query['nomor_peminjaman'];
				$data['tgl_peminjaman']	= $query['tgl_peminjaman'];
				$data['tgl_kembali']	= $query['tgl_kembali'];
				$data['nama_peminjam']	= $pmnjm['nama_anggota'];
				$data['status']			= $status;
				$data['status_pmnjmn']	= $query['status'];
				$data['pmb']			= $query;
				
				$data['title']	= "Detail Pengembalian ";
				$data['pg']		= 'p_pengembalian';
				
				$this->load->view('back/layout/vwNavbar',$data);
				$this->load->view('back/layout/vwSidebar');
				$this->load->view('back/p/pengembalian/vwDetailPengembalian');
				$this->load->view('back/layout/vwFooter');
			}else{
				echo "<h3 style='color:red;text-align:center'>-- 404 Page Not Found --</h3>";
			}
		}
	}
	
	function simpan(){
		if(!isset($_POST['simpan-input2'])){
			echo "<h3 style='color:red;text-align:center'>-- 503 Access Forbidden --</h3>";
		}else{
			//head input
			$no_pengembalian	= trim($this->input->post('no_pengembalian',true));
			$id_peminjaman		= trim(decode($this->input->post('id_peminjaman',true)));
			$terlambat			= trim($this->input->post('terlambat',true));
			$denda_terlambat	= trim($this->input->post('denda_terlambat',true));
			$id_pustakawan		= $this->session->userdata('id');
			
			//detail input
			$denda			= $this->input->post('denda',true);
			$status_buku	= $this->input->post('status_buku',true);
			$id_buku		= $this->input->post('id_buku',true);
			$jumlah			= $this->input->post('jumlah',true);
			$count_data 	= count($id_buku);
			
			//data insert head
			$input_pmb	= array(
				'nomor_pengembalian'=> $no_pengembalian,
				'id_peminjaman'		=> $id_peminjaman,
				'keterlambatan'		=> $terlambat,
				'denda'				=> $denda_terlambat,
				'id_pustakawan'		=> $id_pustakawan
			);
			
			$this->db->trans_begin();
			
			
			//insert db pmb head
			$this->m_pengembalian->getInsert($input_pmb);
			
			$pmb	= $this->m_pengembalian->getLastId();
			
			//update db peminjman
			$this->m_peminjaman->getUpdate(array("id_pengembalian" => $pmb['id_pengembalian']),$id_peminjaman);
			
			for($i=0; $i<$count_data; $i++){
				
				$input_pmb_det	= array(
					'id_pengembalian'	=> $pmb['id_pengembalian'],
					'id_buku'			=> $id_buku[$i],
					'jumlah'			=> $jumlah[$i],
					'status_buku'		=> $status_buku[$i],
					'denda'				=> $denda[$i]
				);
				
				//insert db pmb detail
				$this->m_pengembalian->getInsertPmbDetail($input_pmb_det);
				
				//data stok sebelum diupdate
				$dt_st	= $this->m_arus_buku->getStokByIdBuku($id_buku[$i]);
				$buku_masuk		= $dt_st['buku_masuk'];
				$buku_keluar	= $dt_st['buku_keluar'];
				$booking_buku	= 0;
				$peminjaman_buku	= $dt_st['peminjaman_buku'];
				$pengembalian_buku	= $dt_st['pengembalian_buku'];
				$buku_real		= $dt_st['buku_real'];
				$buku_free		= $dt_st['buku_free'];
				
				if($status_buku[$i] != ''){
					
					//input ke buku keluar
					$inp_bk_klr	= array(
						'id_buku'	=> $id_buku[$i],
						'jumlah'	=> $jumlah[$i],
						'id_pustakawan'		=> $id_pustakawan,
						'status_buku'		=> $status_buku[$i],
						'denda'				=> $denda[$i],
						'id_pengembalian'	=> $pmb['id_pengembalian'],
					);
					
					$this->m_buku_keluar->getInsert($inp_bk_klr);
					
					//olah data stok kelaur
					$keluar		= $buku_keluar + $jumlah[$i];
					$real		= $buku_masuk - $keluar;
					$pengembalian 	= $pengembalian_buku + $jumlah[$i];
					$free		= $real - $peminjaman_buku + $pengembalian - $booking_buku ;
					
					
					$update = array(
						'buku_keluar'=> $keluar,
						'buku_real'	=> $real,
						'buku_free'	=> $free,
						'pengembalian_buku' => $pengembalian
					);
					
					$this->m_arus_buku->getUpdate($update,$id_buku[$i]);
					
				}else{
					
					//input arus detail
					$inp_arus_detail	= array(
						'id_buku'	=> $id_buku[$i],
						'id_transaksi'	=> $pmb['id_pengembalian'],
						'jumlah'	=> $jumlah[$i],
						'jns_transaksi'		=> '2'
					);
					
					$this->m_arus_detail->getInsert($inp_arus_detail);
					
					//olah data stok kelaur
					$pengembalian2	= $pengembalian_buku + $jumlah[$i];
					$free			= $buku_real - $peminjaman_buku + $pengembalian2 - $booking_buku ;
					
					$update = array(
						'pengembalian_buku'=> $pengembalian2,
						'buku_free'	=> $free
					);
					
					$this->m_arus_buku->getUpdate($update,$id_buku[$i]);
					
				}
			}
			
			
			if($this->db->trans_status() === false) {
				$this->db->trans_rollback();
				
				$flash	= array(
					"result" => 2
				);
				
			}else{
				$this->db->trans_commit();
				
				$flash	= array(
					"result" => 1
				);
				
			}
			
			$this->session->set_flashdata($flash);
			redirect('p/pengembalian/add', 'refresh');
		}
	}
	
	
}