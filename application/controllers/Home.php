<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		// $this->load->view('template/login/header');
        // $this->load->view('login');
        // $this->load->view('template/login/footer');
	}

    public function redirecting()
    {
        if (!$this->session->userdata('no_induk')) {
            redirect('home');
        }

        $session_data = $this->session->userdata('id_grup');

        switch ($session_data['id_grup']) {
			case 1:
				redirect('admin');
				break;
			case 2:
				redirect('dosen');
				break;
			case 3:
				redirect('siswa');
				break;
			default:
				redirect('home');
				break;
		}
        return;
    }

    public function login()
    {
		if ($this->session->userdata('no_induk')) {
            $this->redirecting();
        }

		$this->load->view('template/login/header');
        $this->load->view('login');
        $this->load->view('template/login/footer');
    }

    public function logout()
	{
		$this->session->sess_destroy();
		redirect('home/login');
	}
}
