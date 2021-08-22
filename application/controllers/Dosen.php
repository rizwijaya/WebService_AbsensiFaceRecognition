<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		if (!$this->session->userdata('no_induk')) {
			redirect('home');
		}

		$session_data = $this->session->userdata('id_grup');
		if ($session_data != 2) {
			redirect('home/redirecting');
		}
	}

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

    public function daftarsiswa($id_matkul) {
        $this->load->model('dosen_model');
        $data['siswa'] = $this->dosen_model->siswa($id_matkul);
        
        $this->load->view('template/dashboard/header');
        $this->load->view('template/dashboard/sidebar');
        $this->load->view('dosen/daftarsiswa', $data);
        $this->load->view('template/dashboard/footer');   
    }

    public function ceksiswa($id_matkul, $pekan)
    {
        $this->load->model('dosen_model');
        //Get id_pertemuan dengan data id_matkul dan pekan
        $id = $this->dosen_model->idpertemuan($id_matkul, $pekan);
        //Dapatkan data kehadiran
        $data['kehadiran'] = $this->dosen_model->kehadiran($id[0]['id_pertemuan']);
        
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

    function startabsen() {
        $this->load->model('dosen_model');
        $device = $this->dosen_model->getdevice($this->input->post('id_pertemuan')); //Dapatkan data perangkat

        $cek = $this->dosen_model->cekdevice($device[0]['id_device']);
        if(empty($cek[0]['sts_running']) || $cek[0]['sts_running'] == 2) { //cek apakah device sedang berjalan
            $mulai = $this->input->post('mulai_run');
            $m = explode("T",$mulai);
            $selesai = $this->input->post('end_run');
            $s = explode("T",$selesai);

            $data = array(
                'id_pertemuan'	=> $this->input->post('id_pertemuan'),
                'id_device'     => $device[0]['id_device'], //pilih device yang digunakan
                'mulai_run'		=> $m[0] . ' ' . $m[1] . ':02',
                'end_run'		=> $s[0] . ' ' . $s[1] . ':02',
                'sts_running'   => 1, //Perangkat dijalankan
                'sts_command'   => 1 //Mode Absensi
            );

            $this->dosen_model->startingabsen($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Absensi sedang berjalan! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</button></div>');
            redirect('dosen/pertemuan/'. $this->input->post('id_matkul'));
        } else { //Jika device sedang berjalan
            $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Device/ruangan sedang digunakan ! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</button></div>');
            redirect('dosen/pertemuan/'. $this->input->post('id_matkul'));
        }
    }

    public function stop($matkul) {
        $this->load->model('dosen_model');
        $device = $this->dosen_model->stop(1, 1); //Mencari data device yang running
        $data = array(
			'sts_running' 	=> 2
		);

		$where = array(
			'id_running' => $device[0]['id_running']
		);

        $this->dosen_model->stopping('running', $data, $where);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Absensi berhasil diakhiri, perangkat dinonaktifkan! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</button></div>');
        redirect('dosen/pertemuan/'. $matkul);
    }
}