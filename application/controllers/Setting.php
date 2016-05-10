<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		if(!$this->session->userdata('logged_in_pustakawan')){
			redirect('verify','refresh');
			
			if($this->session->userdata('level') != 2 || $this->session->userdata('level') != 1){
				redirect('verify','refresh');
			}
		}
		$this->load->helper('general_helper');
	}

	public function index(){

		$this->load->model("m_buku");
		$this->load->model("m_user");
		$this->load->model("m_peminjaman");
		$this->load->model("m_pengembalian");

		$data['buku']	= $this->m_buku->getCount();
		$data['pnj']	= $this->m_peminjaman->getCount();
		$data['pmb']	= $this->m_pengembalian->getCount();
		$data['anggota']= $this->m_user->getCount();
		$data['title']	= 'Dashboard';
		$data['pg']		= 'setting';
		$this->load->view('back/layout/vwNavbar',$data);
		$this->load->view('back/layout/vwSidebar');
		$this->load->view('back/p/vwSetting');
		$this->load->view('back/layout/vwFooter');
	}

	function simpan(){
		if(!isset($_POST['simpan'])){
			$this->load->view("error_404");
		}else{
			$nama 	= $this->input->post("nama",true);
			$lama	= $this->input->post("lama",true);
			$denda	= $this->input->post("denda",true);

			if($nama != '' && $lama != '' && $denda != ''){
				$insert = array(
					"nama_perpustakaan"	=> $nama,
					"lama_peminjaman"	=> $lama,
					"denda"				=> $denda
				);

				$query = $this->m_setting->getUpdate($insert);

				if($query){

					$this->session->set_flashdata(array("rs" => 1));
					redirect("setting","refresh");

				}else{

					$this->session->set_flashdata(array("rs" => 2));
					redirect("setting","refresh");

				}

			}else{

				$this->session->set_flashdata(array("rs" => 2));
				redirect("setting","refresh");

			}
		}
	}
}
