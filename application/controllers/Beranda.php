<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

	public function index()
	{
		$this->load->view('template/dashboard/header');
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('dosen/index');
        $this->load->view('template/dashboard/footer');
	}
}
