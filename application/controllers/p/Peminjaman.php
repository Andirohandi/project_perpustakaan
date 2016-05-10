<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logged_in_pustakawan')){
			redirect('verify','refresh');
		}
		$this->load->model(array('m_buku','m_arus_buku','m_peminjaman','m_arus_detail','m_user','m_pengembalian'));
		$this->load->helper('general_helper');
		$this->load->library('form_validation');
	}
	
	function index(){
		$data['title']	= "Peminjaman ";
		$data['pg']		= 'p_peminjaman';
		
		$this->load->view('back/layout/vwNavbar',$data);
		$this->load->view('back/layout/vwSidebar');
		$this->load->view('back/p/peminjaman/vwIndex');
		$this->load->view('back/layout/vwFooter');
	}
	
	function read($pg=1){
		date_default_timezone_set('Asia/Jakarta');
		$key	= trim($this->input->post('cari',true));
		$limit	= trim($this->input->post('limit',true));
		$tanggal= trim($this->input->post('tanggal',true));
		$offset = ($limit*$pg)-$limit;
		$like	= '';
		$where	= '';
		
		$tgl	= explode(" - ",$tanggal);
		$t_awal = date('Y-m-d H:i:s',strtotime($tgl[0]));
		$t_akhir = date('Y-m-d 23:55:00',strtotime($tgl[1]));
		
		if($tanggal) $where	= ("tgl_peminjaman BETWEEN '$t_awal' AND '$t_akhir'");
		
		if($key) $like = "(a.nomor_peminjaman LIKE '%$key%' OR b.nama_anggota LIKE '%$key%')";
		
		$page 	= array();
        $page['limit'] 		= $limit;
        $page['count_row'] 	= $this->m_peminjaman->getCount($like,  $where);
        $page['current'] 	= $pg;
        $page['list'] 		= gen_paging($page);

        $data['paging'] = $page;
		$data['key']	= $key;
		$data['list']	= $this->m_peminjaman->getAll($like, $where, $limit, $offset);
		
		$this->load->view('back/p/peminjaman/vwList',$data);
	}
	
	function read_cari($pg=1){
		$this->load->model("m_setting");
		$key	= htmlspecialchars(trim($this->input->post('cari',true)));
		$level	= trim($this->input->post('level',true));
		$limit	= 5;
		$offset = ($limit*$pg)-$limit;
		$like	= '';
		$id_peminjam = '';
		$nama		 = '';
		$where	= "(a.id_pengembalian = 0)";
		
		if($key) $like = "(b.nama_anggota LIKE '%$key%' OR b.nip_nim_anggota LIKE '%$key%' OR a.nomor_peminjaman LIKE '%$key%' )";
		if($level) $where = "(b.id_kategori_anggota = $level AND a.id_pengembalian = 0 )";
		
		$page 	= array();
        $page['limit'] 		= $limit;
        $page['count_row'] 	= $this->m_peminjaman->getCount($like,$where,$level);
        $page['current'] 	= $pg;
        $page['list'] 		= gen_paging_dua($page);

        $data['paging'] = $page;
		$data['key']	= $key;
		$data['list']	= $this->m_peminjaman->getAll($like, $where, $limit, $offset, $level);
		$data['level']	= $level;
		$data['field']	= $id_peminjam;
		
		$this->load->view('back/p/peminjaman/vwListCari',$data);
	}
	
	function add(){
		
		$data['title']	= "Tambah Peminjaman ";
		$data['pg']		= 'p_peminjaman';
		
		$this->load->view('back/layout/vwNavbar',$data);
		$this->load->view('back/layout/vwSidebar');
		$this->load->view('back/p/peminjaman/vwAdd');
		$this->load->view('back/layout/vwFooter');
	}
	
	function get_detail_buku($id_peminjaman=''){
		if($id_peminjaman==''){
			echo "<h3 style='color:red;text-align:center'>-- 404 Page Not Found --</h3>";
		}else{
			$data['detail_buku']	= $this->m_peminjaman->getPeminjamanDetailByParam(array('id_peminjaman' => decode($id_peminjaman)));
			$this->load->view('back/p/pengembalian/vwDetailBuku',$data);
		}
	}
	
	function add_detail($id_peminjaman=''){
		
		if($id_peminjaman==''){
			echo "<h3 style='color:red;text-align:center'>-- 404 Page Not Found --</h3>";
		}else{
			
			$query	= $this->m_peminjaman->getPeminjamanByParam(array('id_peminjaman' => decode($id_peminjaman)));
			$pmnjm	= $this->m_user->getAll(array("id_anggota" => $query['id_peminjam']))->row_array();

			if($query){
				$data['id_level']		= $pmnjm['id_kategori_anggota'];
				$data['nip_nim']		= $pmnjm['nip_nim_anggota'];
				$data['id_peminjam']	= $query['id_peminjam'];
				$data['id_peminjaman']	= encode($query['id_peminjaman']);
				$data['no_peminjaman']	= $query['nomor_peminjaman'];
				$data['tgl_peminjaman']	= $query['tgl_peminjaman'];
				$data['tgl_kembali']	= $query['tgl_kembali'];
				$data['nama_peminjam']	= $pmnjm['nama_anggota'];
				$data['status']			= $pmnjm['nama_kategori_anggota'];
				$data['status_pmnjmn']	= $query['status'];
				
				$data['title']	= "Input Detail Peminjaman ";
				$data['pg']		= 'p_peminjaman';
				
				$this->load->view('back/layout/vwNavbar',$data);
				$this->load->view('back/layout/vwSidebar');
				$this->load->view('back/p/peminjaman/vwAddDetail');
				$this->load->view('back/layout/vwFooter');
			}else{
				echo "<h3 style='color:red;text-align:center'>-- 404 Page Not Found --</h3>";
			}
		}
	}
	
	function read_transit($id_peminjaman=''){
		
		$status		= trim($this->input->post('status',true));
		$id_peminjaman	= decode($id_peminjaman);
		$data['status_pmnjmn'] = $this->m_peminjaman->getPeminjamanByParam(array('id_peminjaman' => $id_peminjaman));
		$query	= '';
		if($status == 0)
			$query			= $this->m_peminjaman->getPeminjamanTransitByParam(array('id_peminjaman' => $id_peminjaman));
			else $query		= $this->m_peminjaman->getPeminjamanDetailByParam(array('id_peminjaman' => $id_peminjaman));
		
		$data['list']	= $query;
		$this->load->view('back/p/peminjaman/vwListTransaksi',$data);
	}
	
	function simpan(){

		$id_level		= htmlspecialchars(trim($this->input->post("level-simpan",true)));
		$nip_nim		= htmlspecialchars(trim($this->input->post("nip_nim",true)));
		$id_peminjam	= htmlspecialchars(trim($this->input->post("id_peminjam",true)));
		$nama_peminjam	= htmlspecialchars(trim($this->input->post("nama_peminjam",true)));
		$status			= htmlspecialchars(trim($this->input->post("status",true)));
		$no_peminjaman	= getNomorPeminjaman();
		$tgl_kembali	= date('Y-m-d H:i:s',strtotime(getTglKembali()));
		
		$this->form_validation->set_rules('level-simpan','Level','trim|required');
		$this->form_validation->set_rules('nip_nim','ID Peminjam','trim|required');
		$this->form_validation->set_rules('nama_peminjam','Nama Peminjam','trim|required');
		$this->form_validation->set_rules('status','Status Peminjam','trim|required');
		
		if($this->form_validation->run() == false){
			
			$flash	= array(
				'result'	=> 2
			);
			$this->session->set_flashdata($flash);
			redirect("p/peminjaman/add","refresh");
		}else{
			$insert = array(
				'nomor_peminjaman'	=> $no_peminjaman,
				'tgl_kembali'	=> $tgl_kembali,
				'id_peminjam'	=> decode($id_peminjam)
			);
			
			$query	= $this->m_peminjaman->getInsert($insert);
			
			if($query){
				
				$lastpeminjaman = $this->m_peminjaman->getlastPeminjaman();
				redirect('p/peminjaman/add_detail/'.encode($lastpeminjaman['id_peminjaman']),'refresh');
				
			}else{
				$flash	= array(
					'result'	=> 2
				);
				$this->session->set_flashdata($flash);
				redirect("p/peminjaman/add","refresh");
			}
		}
		
	}
	
	function simpan_detail($id_peminjaman=''){
		if($id_peminjaman == ''){
			echo "<h3 style='color:red;text-align:center'>-- 503 Forbiden Access --</h3>";
		}else{
			
			$query	= $this->m_peminjaman->getPeminjamanByParam(array('id_peminjaman' => decode($id_peminjaman)));
			if($query){
				
				$this->db->trans_begin();
				
				//update status peminjaman jadi 1 biar pindah ke detail_peminjaman
				$upd_pmnjmn = array("status" => 1);
				$this->m_peminjaman->getUpdate($upd_pmnjmn, decode($id_peminjaman));
				
				//pindahkan detail_transit ke detail peminjaman
				
				$det_trans	= $this->m_peminjaman->getPeminjamanTransitByParam(array('a.id_peminjaman' => decode($id_peminjaman)));
				
				foreach($det_trans->result() as $row){
					$ins_det_pmnjmn	= array(
						'id_peminjaman'	=> decode($id_peminjaman),
						'id_buku'	=> $row->id_buku,
						'jumlah'	=> $row->jumlah
					);
					
					$this->m_peminjaman->getInsertDetail($ins_det_pmnjmn);
					
					//data stok sebelum diupdate
					$dt_st	= $this->m_arus_buku->getStokByIdBuku($row->id_buku);
					$buku_masuk		= $dt_st['buku_masuk'];
					$buku_keluar	= $dt_st['buku_keluar'];
					$booking_buku	= 0;
					$peminjaman_buku	= $dt_st['peminjaman_buku'];
					$pengembalian_buku	= $dt_st['pengembalian_buku'];
					$buku_real		= $dt_st['buku_real'];
					$buku_free		= $dt_st['buku_free'];
					
					//olah data stok
					$pmnjmn		= $peminjaman_buku + $row->jumlah;
					$real		= $buku_masuk - $buku_keluar;
					$free		= $real - $pmnjmn + $pengembalian_buku - $booking_buku ;
					
					$update = array(
						'peminjaman_buku'	=> $pmnjmn,
						'buku_free'	=> $free
					);
					
					$this->m_arus_buku->getUpdate($update,$row->id_buku);
					
				}
				
				$this->m_peminjaman->getDeleteDetailTransitByIdPmnjmn(decode($id_peminjaman));
				
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
				redirect('p/peminjaman/add_detail/'.$id_peminjaman, 'refresh');
				
			}else{
				echo "<h3 style='color:red;text-align:center'>-- 503 Forbiden Access --</h3>";
			}
		}
	}
	
	function simpan_detail_transit(){
		
		$this->form_validation->set_rules('id_peminjaman','ID Peminjaman','trim|required');
		$this->form_validation->set_rules('id_buku','ID Buku','trim|required');
		$this->form_validation->set_rules('jumlah','Jumlah','trim|required');
		
		$data	= '';
		
		if($this->form_validation->run() == false){
			
			$data	= array(
				'result'	=> 2,
				'msg'		=> 'Silahkan lengkapi inputan anda'
			);
			
		}else{
			$id_peminjaman	= htmlspecialchars(trim(decode($this->input->post("id_peminjaman",true))));
			$id_buku		= trim(decode($this->input->post("id_buku",true)));
			$jumlah			= trim($this->input->post("jumlah",true));
			
			$cek_jumlah	= $this->m_peminjaman->getSumBookOnTransitDetail(array('id_peminjaman' => $id_peminjaman));
			
			if(($cek_jumlah['jumlah'] + $jumlah) >= 3 ){
				$data	= array(
					'result'	=> 3,
					'msg'		=> 'Maximum peminjaman dalam satu kali peminjaman hanya 2 buku saja<br/>Terimakasih'
				);
			}else{
				$insert = array(
					'id_peminjaman'	=> $id_peminjaman,
					'id_buku'		=> $id_buku,
					'jumlah'		=> $jumlah
				);
				
				$query = $this->m_peminjaman->getInsertDetailTransit($insert);
				
				if($query){
					$data	= array(
						'result'	=> 1,
						'msg'		=> 'Data berhasil disimpan'
					);
				}else{
					$data	= array(
						'result'	=> 2,
						'msg'		=> 'Data gagal disimpan'
					);
				}
			}

		}
		echo json_encode($data);
	}
	
	function hapus(){
		$id_pmnjmn	= decode(trim($this->input->post('x',true)));
		$data		= array();
		
		$this->db->trans_begin();
		$this->m_peminjaman->getDelete($id_pmnjmn);
		$this->m_peminjaman->getDeleteDetailTransitByIdPmnjmn($id_pmnjmn);
		
		if($this->db->trans_status() == false){
			$this->db->trans_rollback();
			$data = array(
				'result' => 0
			);
		}else{
			$this->db->trans_commit();
			$data = array(
				'result' => 1
			);
		}
		echo json_encode($data);
	}
	
	function hapus_transit(){
		$id_transit	= decode(trim($this->input->post('x',true)));
		$query		= $this->m_peminjaman->getDeleteDetailTransit($id_transit);
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