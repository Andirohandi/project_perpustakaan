<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logged_in_pustakawan')){
			redirect('verify','refresh');
		}
		$this->load->model(array('m_user'));
		$this->load->helper('general_helper');
		$this->load->library('form_validation');

	}

	public function index(){
		
		$this->load->view("error_404");
	}
	
	public function add($bla=""){
		
		if($bla){
			$this->load->view("error_404");
		}else{
			$data['title']	= "Tambah Anggota";
			$data['pg']		= 'p_agt_add';
			
			$this->load->view('back/layout/vwNavbar',$data);
			$this->load->view('back/layout/vwSidebar');
			$this->load->view('back/p/anggota/vwAdd');
			$this->load->view('back/layout/vwFooter');
		}
	}
	
	function simpan(){
		if(!isset($_POST['simpan'])){
			$this->load->view("error_404");
		}else{
			
			$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');
			$this->form_validation->set_rules('nip_nim', 'NIP / NIM', 'trim|required');
			$this->form_validation->set_rules('tempat', 'Tempat Lahir', 'trim|required');
			$this->form_validation->set_rules('tgl', 'Tanggal Lahir', 'trim|required');
			$this->form_validation->set_rules('bln', 'Bulan Lahir', 'trim|required');
			$this->form_validation->set_rules('tahun', 'Tahun Lahir', 'trim|required');
			$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
			$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
			$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'trim|required');
			
			$kategori	= trim($this->input->post('kategori',true));
			$nip_nim	= trim($this->input->post('nip_nim',true));
			$tempat		= trim($this->input->post('tempat',true));
			$jurusan	= trim($this->input->post('jurusan',true));
			$tgl		= trim($this->input->post('tgl',true));
			$bln		= trim($this->input->post('bln',true));
			$alamat		= trim($this->input->post('alamat',true));
			$tahun		= trim($this->input->post('tahun',true));
			$nama		= trim($this->input->post('nama',true));
			$jk			= trim($this->input->post('jk',true));
			
			if($this->form_validation->run() == FALSE) {
				$dt_flash = array(
					'kategori'	=> $kategori,
					'nip_nim'	=> $nip_nim,
					'tempat'	=> $tempat,
					'jurusan'	=> $jurusan,
					'tgl'		=> $tgl,
					'bln'		=> $bln,
					'alamat'	=> $alamat,
					'tahun'		=> $tahun,
					'nama'		=> $nama,
					'jk'		=> $jk,
					'result'	=> 2
				);
				$this->session->set_flashdata($dt_flash);
				redirect("p/anggota/add","refresh");
			}else{
				
				$insert = array(
					'nip_nim_anggota'	=> $nip_nim,
					'nama_anggota'		=> $nama,
					'alamat_anggota'	=> $alamat,
					'jk_anggota'		=> $jk,
					'id_jurusan'		=> $jurusan,
					'id_kategori_anggota'	=> $kategori,
					'tempat_lahir'		=> $tempat,
					'tanggal_lahir'		=> date("Y-m-d",strtotime($tgl."-".$bln."-".$tahun)),
					'status_anggota'		=> 1
				);
				
				$this->db->trans_begin();
				
				$query = $this->m_user->getInsert($insert);
				
				if($this->db->trans_status() === false) {
					$this->db->trans_rollback();
					$dt_flash = array(
						'kategori'	=> $kategori,
						'nip_nim'	=> $nip_nim,
						'tempat'	=> $tempat,
						'jurusan'	=> $jurusan,
						'tgl'		=> $tgl,
						'bln'		=> $bln,
						'alamat'	=> $alamat,
						'tahun'		=> $tahun,
						'nama'		=> $nama,
						'jk'		=> $jk,
						'result'	=> 3
					);

					$this->session->set_flashdata($dt_flash);
					redirect("p/anggota/add","refresh");
				}else{
					$this->db->trans_commit();
					$this->session->set_flashdata('result','1');
					redirect("p/anggota/add","refresh");
				}
			}
		}
	}
	
	public function edit($idanggota=""){
		
		if(!$idanggota){
			$this->load->view("error_404");
		}else{
			$data['title']	= "Edit Anggota";
			$data['pg']		= 'p_agt_add';
			$data['agt']	= $this->m_user->getAll(array("id_anggota" => decode($idanggota)))->row_array();
			$this->load->view('back/layout/vwNavbar',$data);
			$this->load->view('back/layout/vwSidebar');
			$this->load->view('back/p/anggota/vwEdit');
			$this->load->view('back/layout/vwFooter');
		}
	}
	
	function ubah(){
		if(!isset($_POST['simpan'])){
			$this->load->view("error_404");
		}else{
			
			$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');
			$this->form_validation->set_rules('nip_nim', 'NIP / NIM', 'trim|required');
			$this->form_validation->set_rules('tempat', 'Tempat Lahir', 'trim|required');
			$this->form_validation->set_rules('tgl', 'Tanggal Lahir', 'trim|required');
			$this->form_validation->set_rules('bln', 'Bulan Lahir', 'trim|required');
			$this->form_validation->set_rules('tahun', 'Tahun Lahir', 'trim|required');
			$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
			$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
			$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'trim|required');
			
			$idanggota	= trim(decode($this->input->post('idanggota',true)));
			$kategori	= trim($this->input->post('kategori',true));
			$nip_nim	= trim($this->input->post('nip_nim',true));
			$tempat		= trim($this->input->post('tempat',true));
			$jurusan	= trim($this->input->post('jurusan',true));
			$tgl		= trim($this->input->post('tgl',true));
			$bln		= trim($this->input->post('bln',true));
			$alamat		= trim($this->input->post('alamat',true));
			$tahun		= trim($this->input->post('tahun',true));
			$nama		= trim($this->input->post('nama',true));
			$jk			= trim($this->input->post('jk',true));
			
			if($this->form_validation->run() == FALSE) {
				$dt_flash = array(
					'kategori'	=> $kategori,
					'nip_nim'	=> $nip_nim,
					'tempat'	=> $tempat,
					'jurusan'	=> $jurusan,
					'tgl'		=> $tgl,
					'bln'		=> $bln,
					'alamat'	=> $alamat,
					'tahun'		=> $tahun,
					'nama'		=> $nama,
					'jk'		=> $jk,
					'result'	=> 2
				);
				$this->session->set_flashdata($dt_flash);
				redirect("p/anggota/edit/".encode($idanggota),"refresh");
			}else{
				
				$update = array(
					'nip_nim_anggota'	=> $nip_nim,
					'nama_anggota'		=> $nama,
					'alamat_anggota'	=> $alamat,
					'jk_anggota'		=> $jk,
					'id_jurusan'		=> $jurusan,
					'id_kategori_anggota'	=> $kategori,
					'tempat_lahir'		=> $tempat,
					'tanggal_lahir'		=> date("Y-m-d",strtotime($tgl."-".$bln."-".$tahun)),
					'status_anggota'		=> 1
				);
				
				$this->db->trans_begin();
				
				$query = $this->m_user->getUpdate($update,array("id_anggota" => $idanggota));
				
				if($this->db->trans_status() === false) {
					$this->db->trans_rollback();
					$dt_flash = array(
						'kategori'	=> $kategori,
						'nip_nim'	=> $nip_nim,
						'tempat'	=> $tempat,
						'jurusan'	=> $jurusan,
						'tgl'		=> $tgl,
						'bln'		=> $bln,
						'alamat'	=> $alamat,
						'tahun'		=> $tahun,
						'nama'		=> $nama,
						'jk'		=> $jk,
						'result'	=> 3
					);

					$this->session->set_flashdata($dt_flash);
					redirect("p/anggota/edit/".encode($idanggota),"refresh");
				}else{
					$this->db->trans_commit();
					$this->session->set_flashdata('result','1');
					redirect("p/anggota/edit/".encode($idanggota),"refresh");
				}
			}
		}
	}
	
	function read($pg=1){
		$key	= trim($this->input->post('cari',true));
		$limit	= trim($this->input->post('limit',true));
		$offset = ($limit*$pg)-$limit;
		$id_kat	= trim($this->input->post('kategori',true));
		$like	= '';
		$where	= '';
		
		if($key) $like = "(a.nama_anggota LIKE '%$key%' OR a.kode_anggota LIKE '%$key%' )";
		if($id_kat) $where = "a.id_kategori_anggota = $id_kat";
		
		$page 	= array();
        $page['limit'] 		= $limit;
        $page['count_row'] 	= $this->m_user->getCount($like,$where);
        $page['current'] 	= $pg;
        $page['list'] 		= gen_paging($page);

        $data['paging'] = $page;
		$data['key']	= $key;
		$data['ktgr']	= $id_kat;
		$data['last']	= ceil($this->m_user->getCount($like) / $limit);
		$data['list']	= $this->m_user->getAll($like, $where, $limit, $offset);
		
		$this->load->view('back/p/anggota/vwList',$data);
		
	}
	
	//cari anggota
	function read_cari($pg=1){
		
		$key	= htmlspecialchars(trim($this->input->post('cari',true)));
		$level	= trim($this->input->post('level',true));
		$limit	= 5;
		$offset = ($limit*$pg)-$limit;
		$like	= '';
		$where	= '';
		
		
		if($key) $like = "(a.kode_anggota LIKE '%$key%' OR a.nama_anggota LIKE '%$key%' )";
		if($level) $where = "(a.id_kategori_anggota = $level)";
		
		$page 	= array();
        $page['limit'] 		= $limit;
        $page['count_row'] 	= $this->m_user->getCount($like,$where);
        $page['current'] 	= $pg;
        $page['list'] 		= gen_paging_dua($page);

        $data['paging'] = $page;
		$data['key']	= $key;
		$data['level']	= $level;
		$data['list']	= $this->m_user->getAll($like, $where, $limit, $offset);
		
		$this->load->view('back/p/anggota/vwListCari',$data);
	}
	
	function ktgr($ktgr=""){
		
		if($ktgr == '' ){
			$this->load->view("error_404");
		}else{
			
			if($ktgr == 'akademik') {
				
				$data['id_kategori'] = 1;
				$data['pg']		= 'p_agt_akademik';
				$data['title']	= "Anggota - Akademik";
				
			}else if($ktgr == 'dosen') { 
			
				$data['id_kategori'] = 2; 
				$data['pg']		= 'p_agt_dosen';
				$data['title']	= "Anggota - Dosen";
				
			}else if($ktgr == 'mahasiswa') {
				
				$data['id_kategori'] = 3;
				$data['pg']		= 'p_agt_mhs';
				$data['title']	= "Anggota - Mahasiswa";
				
			}else $data['id_kategori'] = 4; //error_404
			
			if($data['id_kategori'] == 4) {
				$this->load->view("error_404");
			}else{
				
				$this->load->view('back/layout/vwNavbar',$data);
				$this->load->view('back/layout/vwSidebar');
				$this->load->view('back/p/anggota/vwIndex');
				$this->load->view('back/layout/vwFooter');
			}
		}
	}
	
	function ganti_password(){
		if(!isset($_POST['simpan'])){
			echo "<h3 style='color:red;text-align:center' >-- 503 Access Forbidden --</h3>";
		}else{
			$password	= addslashes($this->input->post('password_baru',true));
			$id			= $this->session->userdata('id');
			$url		= addslashes($this->input->post('url_pass',true));
			
			$this->form_validation->set_rules('password_baru','Password','trim|required');
			
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata(array("ganti_password"=>2));
				redirect($url,'refresh');
			}else{
				
				$this->m_user->getUpdatePass(array("password" => md5('dgbHjdKJXYdejkDwE'.md5($password).'njkUlkJHddfsjO021')),array("id_admin" => $id));
				$this->session->set_flashdata(array("ganti_password"=>1));
				redirect($url,'refresh');
			}
		}
	}
	
	//ed3e211df2603d4832e7ec0afba5e513
}
