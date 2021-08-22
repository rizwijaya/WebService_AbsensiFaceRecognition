<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		if (!$this->session->userdata('no_induk')) {
			redirect('home');
		}

		$session_data = $this->session->userdata('id_grup');
		if ($session_data != 3) {
			redirect('home/redirecting');
		}
	}

	public function index() {
		$this->load->view('template/dashboard/header');
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('siswa/index');
        $this->load->view('template/dashboard/footer');
	}

	public function matakuliah() {
		$id_user = $this->session->userdata('id_user');
        $this->load->model('siswa_model');
        $data['matkul'] = $this->siswa_model->matakuliah($id_user);

        $this->load->view('template/dashboard/header');
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('siswa/matakuliah', $data);
        $this->load->view('template/dashboard/footer');  
	}

	public function absensi() {
		$id_user = $this->session->userdata('id_user');
        $this->load->model('siswa_model');
        $data['matkul'] = $this->siswa_model->absensi($id_user);

        $this->load->view('template/dashboard/header');
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('siswa/absensi', $data);
        $this->load->view('template/dashboard/footer'); 		
	}
}
