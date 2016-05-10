<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arus_buku extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logged_in_pustakawan')){
			redirect('verify','refresh');
		}
		$this->load->model(array('m_buku','m_kategori_buku','m_arus_buku','m_buku_masuk','m_buku_keluar','m_helper'));
		$this->load->helper('general_helper');
		$this->load->helper('bar128_helper');
		$this->load->library('form_validation');
	}
	
	function index(){
		
		$data['title']	= "Arus Stok Buku | Silerpus";
		$data['pg']		= 'arus_buku';
		
		$this->load->view('back/layout/vwNavbar',$data);
		$this->load->view('back/layout/vwSidebar');
		$this->load->view('back/p/arus_stok/vwIndex');
		$this->load->view('back/layout/vwFooter');
	}
	
	function read_arus($pg=1){
		
		$key	= trim($this->input->post('cari',true));
		$limit	= trim($this->input->post('limit',true));
		$offset = ($limit*$pg)-$limit;
		$like	= '';
		
		if($key) $like = "(b.kode_buku LIKE '%$key%' OR b.judul_buku LIKE '%$key%' )";
		
		$page 	= array();
        $page['limit'] 		= $limit;
        $page['count_row'] 	= $this->m_arus_buku->getCount($like);
        $page['current'] 	= $pg;
        $page['list'] 		= gen_paging($page);

        $data['paging'] = $page;
		$data['key']	= $key;
		$data['list']	= $this->m_arus_buku->getAll($like, $limit, $offset);
		
		$this->load->view('back/p/arus_stok/vwList',$data);
	}
	
	function cek_stok($id_buku){
		$id_buku 	= decode(trim($id_buku));
		$dt_st		= $this->m_arus_buku->getStokByIdBuku($id_buku);
		echo json_encode(array('stok' => $dt_st['buku_free']));
	}
	
	//buku masuk
	function buku_masuk(){
		$data['title']	= "Buku Masuk | Silerpus";
		$data['pg']		= 'buku_masuk';
		
		$this->load->view('back/layout/vwNavbar',$data);
		$this->load->view('back/layout/vwSidebar');
		$this->load->view('back/p/buku_masuk/vwIndex');
		$this->load->view('back/layout/vwFooter');
	}
	
	function read_buku_masuk($pg=1){
		
		$key	= trim($this->input->post('cari',true));
		$limit	= trim($this->input->post('limit',true));
		$tanggal= trim($this->input->post('tanggal',true));
		$offset = ($limit*$pg)-$limit;
		$like	= '';
		$tgl	= explode(" - ",$tanggal);
		$t_awal = date('Y-m-d H:i:s',strtotime($tgl[0]));
		$t_akhir = date('Y-m-d H:i:s',strtotime($tgl[1]));
		
		$where	= ("a.tgl_input BETWEEN '$t_awal' AND '$t_akhir'");
		
		if($key) $like = "(b.kode_buku LIKE '%$key%' OR b.judul_buku LIKE '%$key%' )";
		
		$page 	= array();
        $page['limit'] 		= $limit;
        $page['count_row'] 	= $this->m_buku_masuk->getCount($like,$where);
        $page['current'] 	= $pg;
        $page['list'] 		= gen_paging($page);

        $data['paging'] = $page;
		$data['key']	= $key;
		$data['list']	= $this->m_buku_masuk->getAll($like, $where, $limit, $offset);
		
		$this->load->view('back/p/buku_masuk/vwList',$data);
	}
	
	function simpan_buku_masuk(){
		$id_buku	= decode(trim($this->input->post('id_buku',true)));
		$jumlah		= trim($this->input->post('jumlah',true));
		$keterangan	= trim($this->input->post('keterangan',true));
		$data	= array();

		if($id_buku == '' || $jumlah == ''){
			$data	= array('result'=>'0','message'=>'Silahkan lengkapi data inputan terlebih dahulu');
		}else{
			$insert	= array(
				'id_buku_masuk'	=> '',
				'id_buku'		=> $id_buku,
				'jumlah'		=> $jumlah,
				'keterangan'	=> $keterangan,
				'id_pustakawan'	=> $this->session->userdata('id')
			);
			
			//data stok sebelum diupdate
			$dt_st	= $this->m_arus_buku->getStokByIdBuku($id_buku);
			$buku_masuk		= $dt_st['buku_masuk'];
			$buku_keluar	= $dt_st['buku_keluar'];
			$booking_buku	= 0;
			$peminjaman_buku	= $dt_st['peminjaman_buku'];
			$pengembalian_buku	= $dt_st['pengembalian_buku'];
			$buku_real		= $dt_st['buku_real'];
			$buku_free		= $dt_st['buku_free'];
			
			//olah data stok
			$masuk		= $buku_masuk + $jumlah;
			$real		= $masuk - $buku_keluar;
			$free		= $real - $peminjaman_buku + $pengembalian_buku - $booking_buku ;
			
			$update = array(
				'buku_masuk'=> $masuk,
				'buku_real'	=> $real,
				'buku_free'	=> $free
			);
			
			$this->db->trans_begin();
			
			$this->m_buku_masuk->getInsert($insert);
			$this->m_arus_buku->getUpdate($update,$id_buku);
			
			$dtbkmasuk	= $this->m_buku_masuk->getLastId();
			
			$label	= '';
			$thn	= date('Y');
			$urutan	= '';
			
			for($i = 1; $i<=$jumlah; $i++){
				$get_label 	= $this->m_helper->getDataLabelBuku();
				
				if($get_label){
					
					$kd		= explode("-",$get_label['id_label_buku']);
					$kd_1	= $kd[0];
					$kd_2	= (int) $kd[1] + 1;
					
					if($kd_2 >= 1 && $kd_2 <= 9){
						$urutan	= '00000';
					}else if($kd_2 >= 10 && $kd_2 <= 99){
						$urutan	= '0000';
					}else if($kd_2 >= 100 && $kd_2 <= 999){
						$urutan	= '000';
					}else if($kd_2 >= 1000 && $kd_2 <= 9999){
						$urutan	= '00';
					}else if($kd_2 >= 10000 && $kd_2 <= 99999){
						$urutan	= '0';
					}else if($kd_2 >= 100000 && $kd_2 <= 999999){
						$urutan	= '';
					}else{
						$urutan	= '0000000';
					}
					
					$label	= $kd_1."-".$urutan.$kd_2;
				}else{
					$label	= "2016-000001";
				}
				
				$datalabel	= array(
					'id_label_buku'	=> $label,
					'id_buku'	=> $id_buku,
					'id_buku_masuk'	=> $dtbkmasuk['id_buku_masuk'],
				);
				
				$this->m_helper->getInsertLabelBuku($datalabel);
			}
			
			if($this->db->trans_status() === false) {
				$this->db->trans_rollback();
				$data	= array('result'=>'0','message'=>'Data gagal disimpan');
			}else{
				$this->db->trans_commit();
				$data	= array('result'=>'1','message'=>'Data berhasil disimpan');
			}
		}
		echo json_encode($data);
	}
	
	function hapus_buku_masuk(){
		$id 		= decode(trim($this->input->post('x',true)));
		$id_buku	= decode(trim($this->input->post('id_buku',true)));
		$jumlah 	= trim($this->input->post('jumlah',true));
		$data		= array();
		
		//data stok sebelum diupdate
		$dt_st	= $this->m_arus_buku->getStokByIdBuku($id_buku);
		$buku_masuk		= $dt_st['buku_masuk'];
		$buku_keluar	= $dt_st['buku_keluar'];
		$booking_buku	= 0;
		$peminjaman_buku	= $dt_st['peminjaman_buku'];
		$pengembalian_buku	= $dt_st['pengembalian_buku'];
		$buku_real		= $dt_st['buku_real'];
		$buku_free		= $dt_st['buku_free'];
		
		//olah data stok
		$masuk		= $buku_masuk - $jumlah;
		$real		= $masuk - $buku_keluar;
		$free		= $real - $peminjaman_buku + $pengembalian_buku - $booking_buku ;
		
		$update = array(
			'buku_masuk'=> $masuk,
			'buku_real'	=> $real,
			'buku_free'	=> $free
		);

		$this->db->trans_begin();
		
		$this->m_buku_masuk->getDelete($id);
		$this->m_arus_buku->getUpdate($update,$id_buku);

		if($this->db->trans_status() === false){
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
	
	//buku keluar
	function buku_keluar(){
		$data['title']	= "Buku Keluar | Silerpus";
		$data['pg']		= 'buku_keluar';
		
		$this->load->view('back/layout/vwNavbar',$data);
		$this->load->view('back/layout/vwSidebar');
		$this->load->view('back/p/buku_keluar/vwIndex');
		$this->load->view('back/layout/vwFooter');
	}
	
	function read_buku_keluar($pg=1){
		
		$key	= trim($this->input->post('cari',true));
		$limit	= trim($this->input->post('limit',true));
		$tanggal= trim($this->input->post('tanggal',true));
		$offset = ($limit*$pg)-$limit;
		$like	= '';
		$tgl	= explode(" - ",$tanggal);
		$t_awal = date('Y-m-d H:i:s',strtotime($tgl[0]));
		$t_akhir = date('Y-m-d H:i:s',strtotime($tgl[1]));
		
		$where	= ("a.tgl_input BETWEEN '$t_awal' AND '$t_akhir'");
		
		if($key) $like = "(b.kode_buku LIKE '%$key%' OR b.judul_buku LIKE '%$key%' )";
		
		$page 	= array();
        $page['limit'] 		= $limit;
        $page['count_row'] 	= $this->m_buku_keluar->getCount($like,$where);
        $page['current'] 	= $pg;
        $page['list'] 		= gen_paging($page);

        $data['paging'] = $page;
		$data['key']	= $key;
		$data['list']	= $this->m_buku_keluar->getAll($like, $where, $limit, $offset);
		
		$this->load->view('back/p/buku_keluar/vwList',$data);
	}
	
	function simpan_buku_keluar(){
		$id_buku	= decode(trim($this->input->post('id_buku',true)));
		$jumlah		= trim($this->input->post('jumlah',true));
		$status		= trim($this->input->post('status',true));
		$sanksi		= trim($this->input->post('sanksi',true));
		$keadaan	= trim($this->input->post('keadaan',true));
		$data	= array();
		$status_buku= "";
		
		if($status == 1){
			$status_buku = "Hilang";
		}else if($status == 2){
			$status_buku = "Rusak";
		}else if($status == 3){
			$sanksi	= 0;
			$status_buku = $keadaan;
		}
		
		if($id_buku == '' || $jumlah == '' || $status == '' ){
			$data	= array('result'=>'0','message'=>'Silahkan lengkapi data inputan terlebih dahulu');
		}else{
			$insert	= array(
				'id_buku_keluar'	=> '',
				'id_buku'		=> $id_buku,
				'jumlah'		=> $jumlah,
				'status_buku'	=> $status_buku,
				'denda'			=> $sanksi,
				'id_pustakawan'	=> $this->session->userdata('id')
			);
			
			//data stok sebelum diupdate
			$dt_st	= $this->m_arus_buku->getStokByIdBuku($id_buku);
			$buku_masuk		= $dt_st['buku_masuk'];
			$buku_keluar	= $dt_st['buku_keluar'];
			$booking_buku	= 0;
			$peminjaman_buku	= $dt_st['peminjaman_buku'];
			$pengembalian_buku	= $dt_st['pengembalian_buku'];
			$buku_real		= $dt_st['buku_real'];
			$buku_free		= $dt_st['buku_free'];
			
			//olah data stok
			$keluar		= $buku_keluar + $jumlah;
			$real		= $buku_masuk - $keluar;
			$free		= $real - $peminjaman_buku + $pengembalian_buku - $booking_buku ;
			
			$update = array(
				'buku_keluar'=> $keluar,
				'buku_real'	=> $real,
				'buku_free'	=> $free
			);
			
			$this->db->trans_begin();
			
			$this->m_buku_keluar->getInsert($insert);
			$this->m_arus_buku->getUpdate($update,$id_buku);
			
			if($this->db->trans_status() === false) {
				$this->db->trans_rollback();
				$data	= array('result'=>'0','message'=>'Data gagal disimpan');
			}else{
				$this->db->trans_commit();
				$data	= array('result'=>'1','message'=>'Data berhasil disimpan');
			}
		}
		echo json_encode($data);
	}
	
	function detail_arus($id_buku=''){
		if($id_buku == ''){
			echo "<h3 style='color:red;text-align:center'>-- 404 Page Not Found --</h3>";
		}else{
			$id_buku= decode($id_buku);
			
			$buku	= $this->m_buku->getBukuById(array("id_buku" => $id_buku));
			
			if($buku){
				
				$data['buku'] = $buku;
				$data['title']	= "Arus Stok Buku | Silerpus";
				$data['pg']		= 'arus_buku';
				
				$this->load->view('back/layout/vwNavbar',$data);
				$this->load->view('back/layout/vwSidebar');
				$this->load->view('back/p/arus_stok/detail/vwIndex');
				$this->load->view('back/layout/vwFooter');
			}else{
				echo "<h3 style='color:red;text-align:center'>-- 404 Page Not Found --</h3>";
			}
		}
	}
	
	function read_detail_arus($pg=1){
		
		$jenis	 = trim($this->input->post('jenis',true));
		$limit	 = trim($this->input->post('limit',true));
		$id_buku = trim(decode($this->input->post('id_buku',true)));
		$offset  = ($limit*$pg)-$limit;
		$where	 = '';
		
		if($jenis) $where = "(jns_transaksi = '$jenis' AND id_buku = $id_buku)";
			else $where = "(id_buku = $id_buku)";
		
		$page 	= array();
        $page['limit'] 		= $limit;
        $page['count_row'] 	= $this->m_arus_buku->getCountDetailArus($where);
        $page['current'] 	= $pg;
        $page['list'] 		= gen_paging($page);

        $data['paging'] = $page;
		$data['list']	= $this->m_arus_buku->getAllDetailArus($where, $limit, $offset);
		
		$this->load->view('back/p/arus_stok/detail/vwList',$data);
	}
	
	function hapus_buku_keluar(){
		$id 		= decode(trim($this->input->post('x',true)));
		$id_buku	= decode(trim($this->input->post('id_buku',true)));
		$jumlah 	= trim($this->input->post('jumlah',true));
		$data		= array();
		
		//data stok sebelum diupdate
		$dt_st	= $this->m_arus_buku->getStokByIdBuku($id_buku);
		$buku_masuk		= $dt_st['buku_masuk'];
		$buku_keluar	= $dt_st['buku_keluar'];
		$booking_buku	= 0;
		$peminjaman_buku	= $dt_st['peminjaman_buku'];
		$pengembalian_buku	= $dt_st['pengembalian_buku'];
		$buku_real		= $dt_st['buku_real'];
		$buku_free		= $dt_st['buku_free'];
		
		//olah data stok
		$keluar		= $buku_keluar - $jumlah;
		$real		= $buku_masuk - $keluar;
		$free		= $real - $peminjaman_buku + $pengembalian_buku - $booking_buku ;
		
		$update = array(
			'buku_keluar'=> $keluar,
			'buku_real'	=> $real,
			'buku_free'	=> $free
		);

		$this->db->trans_begin();
		
		$this->m_buku_keluar->getDelete($id);
		$this->m_arus_buku->getUpdate($update,$id_buku);

		if($this->db->trans_status() === false){
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
	
	function cetak_label($id='',$id_buku){
		if($id==''){
			echo "<h3 style='color:red;text-align:center'>-- 404 Page Not Found --</h3>";
		}else{
			$id_buku_masuk = decode($id);
			
			$where	= array(
				'id_buku_masuk'	=> $id_buku_masuk
			);
			
			
			$data_buku	= $this->m_helper->getLabelByParam($where);
			$data['data_label'] = $data_buku;
			$data['data_buku']	= $this->m_buku->getBukuById(array("id_buku" => decode($id_buku)));
			
			$this->load->view('back/p/buku_masuk/vwCetakLabel',$data);
			
		}
	}
}
