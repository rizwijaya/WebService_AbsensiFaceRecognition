<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	public function index()
	{
		$this->load->view('template/dashboard/header');
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('siswa/index');
        $this->load->view('template/dashboard/footer');
	}
}
