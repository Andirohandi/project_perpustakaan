<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logged_in_pustakawan')){
			redirect('verify','refresh');
		}
		$this->load->model(array('m_buku','m_buku_masuk','m_kategori_buku'));
		$this->load->helper('general_helper');
		$this->load->library('form_validation');
		

	}

	public function index(){
		
		$data['title']	= "Data Buku ";
		$data['pg']		= 'p_buku';
		
		$this->load->view('back/layout/vwNavbar',$data);
		$this->load->view('back/layout/vwSidebar');
		$this->load->view('back/p/buku/vwIndex');
		$this->load->view('back/layout/vwFooter');
	}
	
	function read($pg=1){
		
		$key	= trim($this->input->post('cari',true));
		$limit	= trim($this->input->post('limit',true));
		$offset = ($limit*$pg)-$limit;
		$id_kat	= trim($this->input->post('kategori',true));
		$like	= '';
		$where	= '';
		
		if($key) $like = "(kode_buku LIKE '%$key%' OR judul_buku LIKE '%$key%' )";
		if($id_kat) $where = "id_ktgr = $id_kat";
		
		$page 	= array();
        $page['limit'] 		= $limit;
        $page['count_row'] 	= $this->m_buku->getCount($like,$where);
        $page['current'] 	= $pg;
        $page['list'] 		= gen_paging($page);

        $data['paging'] = $page;
		$data['key']	= $key;
		$data['ktgr']	= $id_kat;
		$data['last']	= ceil($this->m_buku->getCount($like) / $limit);
		$data['list']	= $this->m_buku->getAll($like, $where, $limit, $offset);
		
		$this->load->view('back/p/buku/vwList',$data);
	}
	
	function read_dashboard($pg=1){
		$this->load->model("m_arus_buku");
		$key	= trim($this->input->post('cari',true));
		$limit	= trim($this->input->post('limit',true));
		$offset = ($limit*$pg)-$limit;
		$id_kat	= trim($this->input->post('kategori',true));
		$like	= '';
		$where	= '';
		
		if($key) $like = "(kode_buku LIKE '%$key%' OR judul_buku LIKE '%$key%' )";
		if($id_kat) $where = "id_ktgr = $id_kat";
		
		$page 	= array();
        $page['limit'] 		= $limit;
        $page['count_row'] 	= $this->m_buku->getCount($like,$where);
        $page['current'] 	= $pg;
        $page['list'] 		= gen_paging($page);

        $data['paging'] = $page;
		$data['key']	= $key;
		$data['ktgr']	= $id_kat;
		$data['last']	= ceil($this->m_buku->getCount($like) / $limit);
		$data['list']	= $this->m_buku->getAll($like, $where, $limit, $offset);
		
		$this->load->view('back/p/buku/vwListDashboard',$data);
	}
	
	function add($page=''){
		if($page != ''){
			$data['title']	= "404 Page Not Found";
			$this->load->view('back/layout/vwNavbar',$data);
			$this->load->view('back/error/e_404');
			$this->load->view('back/layout/vwFooter');
		}else{
			$data['title']	= "Tambah Buku ";
			$data['pg']		= 'p_buku';
			
			$this->load->view('back/layout/vwNavbar',$data);
			$this->load->view('back/layout/vwSidebar');
			$this->load->view('back/p/buku/vwAdd');
			$this->load->view('back/layout/vwFooter');
		}
	}
	
	function ubah(){
		
		if(!isset($_POST['simpan'])){
			echo "<h3 style='color:red;text-align:center'>-- 503 Akses Forbidden --</h3>";
		}else{
			
			$this->form_validation->set_rules('id', 'Id', 'trim|required');
			$this->form_validation->set_rules('kode', 'Kode', 'trim|required');
			$this->form_validation->set_rules('judul', 'Judul', 'trim|required');
			$this->form_validation->set_rules('tempat', 'Tempat', 'trim|required');
			$this->form_validation->set_rules('isbn', 'ISBN', 'trim|required');
			$this->form_validation->set_rules('kota', 'Kota terbit', 'trim|required');
			$this->form_validation->set_rules('tahun', 'Tahun terbit', 'trim|required');
			
			$id_buku	= decode(trim($this->input->post('id',true)));
			
			if($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('result','2');
				$this->edit(encode($id_buku));
			}else{
				
				$this->load->helper('file');
				
				
				$thumb		= trim($this->input->post('thumb',true));
				$img		= trim($this->input->post('img',true));
				$judul		= trim($this->input->post('judul',true));
				$penulis	= trim($this->input->post('penulis',true));
				$penerbit	= trim($this->input->post('penerbit',true));
				$kategori	= decode(trim($this->input->post('kategori',true)));
				$tempat		= trim($this->input->post('tempat',true));
				$isbn		= trim($this->input->post('isbn',true));
				$kota		= trim($this->input->post('kota',true));
				$tahun		= trim($this->input->post('tahun',true));
				$deskripsi	= trim($this->input->post('deskripsi',true));
				$pustakawan	= $this->session->userdata('id');
				$url		= trim(preg_replace('^[\/:\*\?!.,\^\{\}\[\]\(\)#;%+=$@"<>\|]^',' ',$judul));
				$url		= strtolower(str_replace(" ","-",$url));
				$url		= str_replace("----","-",$url);
				$url		= str_replace("---","-",$url);
				$url		= str_replace("--","-",$url);
				$image		= '';
				$thumbnail	= '';
				$update = array();
				
				$config['upload_path'] = './uploads/images/';
				$config['allowed_types'] =  'gif|jpg|png|jpeg';
				$config['max_size'] = '5120';
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				if($this->upload->do_upload('upload-image')){
					$file = $this->upload->data();
					
					$image = 'uploads/images/'.$file['file_name'];
					
					$config['image_library'] = 'gd2';
					$config['source_image'] = $file['full_path'];
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 256;
					$config['height'] = 256;
					$config['new_image'] = './uploads/thumbnails/';

					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					
					$thumbnail = 'uploads/thumbnails/'.$file['raw_name'].'_thumb'.$file['file_ext'];
					
					$this->image_lib->clear();
				} else {
					//error uploads
				}
				
				if($image == '' || $thumbnail == ''){
					$update = array(
						'judul_buku'	=> $judul,
						'penulis'		=> $penulis,
						'penerbit'		=> $penerbit,
						'tempat_buku'	=> $tempat,
						'isbn'			=> $isbn,
						'kota_terbit'	=> $kota,
						'tahun_terbit'	=> $tahun,
						'id_pustakawan'	=> $pustakawan,
						'deskripsi_buku'=> $deskripsi,
						'url_buku'		=> $url,
					);
				}else{
					$update = array(
						'judul_buku'	=> $judul,
						'penulis'		=> $penulis,
						'penerbit'		=> $penerbit,
						'tempat_buku'	=> $tempat,
						'isbn'			=> $isbn,
						'kota_terbit'	=> $kota,
						'tahun_terbit'	=> $tahun,
						'image'			=> $image,
						'thumbnail'		=> $thumbnail,
						'id_pustakawan'	=> $pustakawan,
						'deskripsi_buku'=> $deskripsi,
						'url_buku'		=> $url,
					);
					
					unlink(FCPATH.$thumb);
					unlink(FCPATH.$img);
					
				}
				
				
				
				$this->db->trans_begin();
				
				$query = $this->m_buku->getUpdate($update,$id_buku);
				
				if($this->db->trans_status() === false) {
					$this->db->trans_rollback();
					$dt_flash = array(
						'judul'			=> $judul,
						'penulis'		=> $penulis,
						'penerbit'		=> $penerbit,
						'kategori'		=> $kategori,
						'tempat'		=> $tempat,
						'deskripsi'		=> $deskripsi,
						'isbn'			=> $isbn,
						'kota'			=> $kota,
						'tahun'			=> $tahun,
						'result'		=> 3
					);

					$this->session->set_flashdata('result','3');
					$this->add();
				}else{
					$this->db->trans_commit();
					$this->session->set_flashdata('result','1');
					redirect('p/buku/edit/'.encode($id_buku),'refresh');
				}
				/*$this->session->set_flashdata('result','1');
				$this->add();*/
			}
		}
	}
	
	function get_kode_buku($id_ktgr=''){
		
		$id_ktgr 	= trim(decode($id_ktgr));
		$kode_buku	= '';
		$nol		= '';
		
		$ktgr		= $this->m_kategori_buku->getKodeKtgrById($id_ktgr);
		
		$kode_ktgr	= $ktgr['kode_ktgr'];
		
		$buku		= $this->m_buku->getBukuByKategoriForKode(array('id_ktgr' => $id_ktgr));
		
		if($buku){
			
			$kode_buku_ = explode("-",$buku['kode_buku']);
			$kd_buku	= $kode_buku_[0];
			$count_buku	= (int) $kode_buku_[1] + 1;
			
			if($count_buku >= 1 && $count_buku <=9 ){
				$nol	= "0000";
			}else if($count_buku >= 10 && $count_buku  <=99 ){
				$nol	= "000";
			}else if($count_buku >= 100 && $count_buku  <=999 ){
				$nol	= "00";
			}else if($count_buku >= 1000 && $count_buku <=9999 ){
				$nol	= "0";
			}else if($count_buku >= 10000 && $count_buku <=99999 ){
				$nol	= "";
			}else{
				$nol	= "Error";
			}
			
			$kode_buku = $kd_buku."-".$nol.$count_buku;
		}else{
			$kode_buku = strtoupper($kode_ktgr)."-00001";
		}
		
		$hasil	= array(
			'kode' => $kode_buku
		);
		
		echo json_encode($hasil);
	}
	
	function detail($id='',$url='',$cek=''){
		if($id=='' || $url==''){
			echo "<h3 style='color:red;text-align:center'>-- 404 Page Not Found --</h3>";
		}else if($cek!=''){
			echo "<h3 style='color:red;text-align:center'>-- 404 Page Not Found --</h3>";
		}else{
			$id_buku	= decode($id);
			$where		= array ('id_buku'=>$id_buku, 'url_buku'=>$url);
			$query		= $this->m_buku->getBukuById($where);
			
			if(!$query){
				echo "<h3 style='color:red;text-align:center'>-- 404 Page Not Found --</h3>";
			}else{
				$data['title']	= "Detail Buku ".$query['judul_buku'];
				$data['pg']		= 'p_buku';
				$data['list']	= $query;
				
				$this->load->view('back/layout/vwNavbar',$data);
				$this->load->view('back/layout/vwSidebar');
				$this->load->view('back/p/buku/vwDetail');
				$this->load->view('back/layout/vwFooter');
			}
		}
	}
	
	function edit($id='',$cek=''){
		
		if($id=='' || $cek!='' ){
			echo "<h3 style='color:red;text-align:center'>-- 404 Page Not Found --</h3>";
		}else{
			
			$id_buku	= decode($id);
			$where		= array ('id_buku'=>$id_buku);
			$query		= $this->m_buku->getBukuById($where);
			
			if(!$query){
				echo "<h3 style='color:red;text-align:center'>-- 404 Page Not Found --</h3>";
			}else{
			
				$data['title']	= "Edit Buku ";
				$data['pg']		= 'p_buku';
				$data['list']	= $query;
				
				$this->load->view('back/layout/vwNavbar',$data);
				$this->load->view('back/layout/vwSidebar');
				$this->load->view('back/p/buku/vwEdit');
				$this->load->view('back/layout/vwFooter');
			}
		}
	}
	
	function simpan(){
		
		if(!isset($_POST['simpan'])){
			echo "<h3 style='color:red;text-align:center'>-- 503 Akses Forbidden --</h3>";
		}else{
			
			$this->form_validation->set_rules('kode', 'Kode', 'trim|required');
			$this->form_validation->set_rules('judul', 'Judul', 'trim|required');
			$this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');
			$this->form_validation->set_rules('tempat', 'Tempat', 'trim|required');
			$this->form_validation->set_rules('isbn', 'ISBN', 'trim|required');
			$this->form_validation->set_rules('kota', 'Kota terbit', 'trim|required');
			$this->form_validation->set_rules('tahun', 'Tahun terbit', 'trim|required');
			
			if($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('result','2');
				$this->add();
			}else{
				
				$this->load->helper('file');
				
				$kode		= trim($this->input->post('kode',true));
				$judul		= trim($this->input->post('judul',true));
				$penulis	= trim($this->input->post('penulis',true));
				$penerbit	= trim($this->input->post('penerbit',true));
				$kategori	= decode(trim($this->input->post('kategori',true)));
				$tempat		= trim($this->input->post('tempat',true));
				$isbn		= trim($this->input->post('isbn',true));
				$kota		= trim($this->input->post('kota',true));
				$tahun		= trim($this->input->post('tahun',true));
				$deskripsi	= trim($this->input->post('deskripsi',true));
				$pustakawan	= $this->session->userdata('id');
				$url		= trim(preg_replace('^[\/:\*\?!.,\^\{\}\[\]\(\)#;%+=$@"<>\|]^',' ',$judul));
				$url		= strtolower(str_replace(" ","-",$url));
				$url		= str_replace("----","-",$url);
				$url		= str_replace("---","-",$url);
				$url		= str_replace("--","-",$url);
				$image		= '';
				$thumbnail	= '';
				
				$config['upload_path'] = './uploads/images/';
				$config['allowed_types'] =  'gif|jpg|png|jpeg';
				$config['max_size'] = '5120';
				
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				if($this->upload->do_upload('upload-image')){
					$file = $this->upload->data();
					
					$image = 'uploads/images/'.$file['file_name'];
					
					$config['image_library'] = 'gd2';
					$config['source_image'] = $file['full_path'];
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 128;
					$config['height'] = 128;
					$config['new_image'] = './uploads/thumbnails/';

					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					
					$thumbnail = 'uploads/thumbnails/'.$file['raw_name'].'_thumb'.$file['file_ext'];
					
					$this->image_lib->clear();
				} else {
					//error uploads
				}
				
				$insert = array(
					'kode_buku'		=> $kode,
					'judul_buku'	=> $judul,
					'penulis'		=> $penulis,
					'penerbit'		=> $penerbit,
					'id_ktgr'		=> $kategori,
					'tempat_buku'	=> $tempat,
					'isbn'			=> $isbn,
					'tahun_terbit'	=> $tahun,
					'kota_terbit'	=> $kota,
					'image'			=> $image,
					'thumbnail'		=> $thumbnail,
					'id_pustakawan'	=> $pustakawan,
					'deskripsi_buku'=> $deskripsi,
					'url_buku'		=> $url,
					'status'		=> 1
				);
				
				$this->db->trans_begin();
				
				$query = $this->m_buku->getInsert($insert);
				
				if($query){
					$id_buku = $this->m_buku->getLastId();
					$dt = array('id_arus_stok' => '', 'id_buku'=>$id_buku['id_buku']);
					$this->db->insert('table_arus_stok',$dt);
				}
				
				if($this->db->trans_status() === false) {
					$this->db->trans_rollback();
					$dt_flash = array(
						'judul'			=> $judul,
						'penulis'		=> $penulis,
						'penerbit'		=> $penerbit,
						'kategori'		=> $kategori,
						'tempat'		=> $tempat,
						'deskripsi'		=> $deskripsi,
						'tahun'			=> $tahun,
						'isbn'			=> $isbn,
						'kota'			=> $kota,
						'result'		=> 3
					);

					$this->session->set_flashdata('result','3');
					$this->add();
				}else{
					$this->db->trans_commit();
					$this->session->set_flashdata('result','1');
					redirect('p/buku/add','refresh');
				}
				/*$this->session->set_flashdata('result','1');
				$this->add();*/
			}
		}
	}
	
	//cari buku
	function read_cari($pg=1){
		
		$key	= trim($this->input->post('cari',true));
		$limit	= 5;
		$offset = ($limit*$pg)-$limit;
		$like	= '';
		
		if($key) $like = "(kode_buku LIKE '%$key%' OR judul_buku LIKE '%$key%' )";
		$where = "status = 1";
		
		$page 	= array();
        $page['limit'] 		= $limit;
        $page['count_row'] 	= $this->m_buku->getCount($like,$where);
        $page['current'] 	= $pg;
        $page['list'] 		= gen_paging_dua($page);

        $data['paging'] = $page;
		$data['key']	= $key;
		$data['list']	= $this->m_buku->getAll($like, $where, $limit, $offset);
		
		$this->load->view('back/p/buku/vwListCari',$data);
	}
	
	function hapus(){
		$id_ktgr 	= decode(trim($this->input->post('x',true)));
		$query		= $this->m_buku->getDelete($id_ktgr);
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
