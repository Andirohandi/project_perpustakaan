<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model(array('m_user'));
		$this->load->helper(array('general_helper'));
		$this->load->library(array('form_validation'));
	}

	public function index()
	{
		if(!$this->session->userdata('logged_in_pustakawan')){
			$this->load->view('vwLogin');
		}else{
			if($this->session->userdata('level') == 2 || $this->session->userdata('level') == 1){
				redirect('dashboard','refresh');
				
			}else{
				$this->load->view('vwLogin');
			}
		}
	}
	
	function auth(){
		
		if(!isset($_POST['login'])){
			echo "<h3 style='color:red;text-align:center' >-- 503 Access Forbidden --</h3>";
		}else{
			$username	= addslashes($this->input->post('username',true));
			$password	= addslashes($this->input->post('password',true));
			
			$this->form_validation->set_rules('username','Email','trim|required');
			$this->form_validation->set_rules('password','Password','trim|required|callback_cek_auth_user');
			
			if ($this->form_validation->run() == FALSE) {
				redirect("admin",'refresh');
			}else{
				redirect('dashboard','refresh');
			}
		}
	}
	
	function cek_auth_user(){
		$username	= $this->input->post('username',true);
		$password	= $this->input->post('password',true);
		
		$dt = array(
			'username' 	=> $username,
			'password' => md5('dgbHjdKJXYdejkDwE'.md5($password).'njkUlkJHddfsjO021')
		);
		
		$cek 	= $this->m_user->getAuthentification($dt);
		
		if($cek){
			
			$data	= array(
				'id'			=> $cek['id_admin'],
				'nama_admin'	=> $cek['nama_admin'],
				'logged_in_pustakawan'	=> TRUE,
			);
			
			$this->session->set_userdata($data);
			return true;
			
		}else{
			
			$data = array(
				"result" => 2,
				"error" => "Maaf username dan password tidak ditemukan"
			);
			
			$this->session->set_flashdata($data);
			return false;
		}
	}
	
	function logout(){
		session_destroy();
		redirect('admin','refresh');
	}
}
