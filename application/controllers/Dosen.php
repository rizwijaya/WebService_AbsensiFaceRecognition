<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

	public function index()
	{
		$this->load->view('template/dashboard/header');
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('dosen/index');
        $this->load->view('template/dashboard/footer');
	}

    public function matkul()
    {   
        $id_user = $this->session->userdata('id_user');
        $this->load->model('dosen_model');
        $data['matkul'] = $this->dosen_model->matkul($id_user);
        $this->load->view('template/dashboard/header');
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('dosen/matkul', $data);
        $this->load->view('template/dashboard/footer');
    }

    public function cek_siswa($id_matkul)
    {
        $this->load->model('dosen_model');
        $data['siswa'] = $this->dosen_model->siswa($id_matkul);
        $this->load->view('template/dashboard/header');
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('dosen/siswa', $data);
        $this->load->view('template/dashboard/footer');        
    }

    public function absensi()
    {   
        $id_user = $this->session->userdata('id_user');
        $this->load->model('dosen_model');
        $data['matkul'] = $this->dosen_model->matkul($id_user);
        $this->load->view('template/dashboard/header');
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('dosen/absensi', $data);
        $this->load->view('template/dashboard/footer');
    }

    public function pertemuan($id_matkul)
    {
        $id_user = $this->session->userdata('id_user');
        $this->load->model('dosen_model');
        $data['pertemuan'] = $this->dosen_model->pertemuan($id_matkul, $id_user);
        $this->load->view('template/dashboard/header');
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('dosen/pertemuan', $data);
        $this->load->view('template/dashboard/footer');            
    }
}
