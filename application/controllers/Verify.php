<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verify extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		
	}

	public function index()
	{
		redirect("admin","refresh");
	}
}
