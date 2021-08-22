<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		if (!$this->session->userdata('no_induk')) {
			redirect('home');
		}

		$session_data = $this->session->userdata('id_grup');
		if ($session_data != 1) {
			redirect('home/redirecting');
		}
	}

	public function index() {
		$this->load->view('template/dashboard/header');
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('dosen/index');
        $this->load->view('template/dashboard/footer');
	}

    public function daftardevice() {
        $this->load->model('admin_model');
        $data['device'] = $this->admin_model->getdevice();

        $this->load->view('template/dashboard/header');
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('admin/daftardevice', $data);
        $this->load->view('template/dashboard/footer');       
    }

	// public function tambahmahasiswa() {
    //     $this->load->model('admin_model');
    //     $data['device'] = $this->admin_model->getdevice();

    //     $this->load->view('template/dashboard/header');
    //     $this->load->view('template/dashboard/sidebar');
    //     $this->load->view('admin/daftardevice', $data);
    //     $this->load->view('template/dashboard/footer');       
    // }
}
