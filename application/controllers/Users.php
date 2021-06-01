<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function index()
    {
        $this->load->view('template/login/header');
        $this->load->view('login');
        $this->load->view('template/login/footer');
    }

    public function checkingLogin()
    {
        $this->load->helper(array('url', 'security'));
        $this->load->model('account');
        $this->load->library(array('form_validation'));

        $this->form_validation->set_rules(
            'nomorinduk',
            'Nomorinduk',
            'trim|xss_clean|required'
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'trim|xss_clean|required'
        );

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/login/header');
            $this->load->view('login');
            $this->load->view('template/login/footer');
        } else {
            $nomorinduk      =    $this->input->post('nomorinduk');
            $password        =    $this->input->post('password');
            $users = $this->account->checklogin($nomorinduk, $password);
            if ($users == FALSE) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Nomor Induk/Password anda salah! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</button></div>');
                $this->load->view('template/login/header');
                $this->load->view('login');
                $this->load->view('template/login/footer');
            } else {
                //inisialisasi session
                $this->session->set_userdata('id_user', $users[0]['id_user']);
                $this->session->set_userdata('nama', $users[0]['nama']);
                $this->session->set_userdata('no_induk', $users[0]['username']);
                $this->session->set_userdata('id_grup', $users[0]['id_grup']);
                //ke halaman welcome page yang bersesuaian
                switch ($users[0]['id_grup']) {
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
            }
        }
    }

    // public function _filter_register() //Lakukan Trims terhadap input pengguna
    // {
    //     $this->load->library(array('form_validation'));
    //     $this->form_validation->set_rules(
    //         'nama',
    //         'Nama',
    //         'trim|min_length[2]|max_length[128]|xss_clean|required'
    //     );
    //     $this->form_validation->set_rules(
    //         'email',
    //         'Email',
    //         'trim|valid_email|is_unique[users.email]|min_length[2]|max_length[128]|xss_clean|required',
    //         ['is_unique' => 'This email has already registered!']
    //     );
    //     $this->form_validation->set_rules(
    //         'username',
    //         'Username',
    //         'trim|min_length[2]|max_length[128]|xss_clean|required'
    //     );
    //     $this->form_validation->set_rules(
    //         'no_telp',
    //         'No_telp',
    //         'trim|min_length[2]|max_length[128]|xss_clean|required'
    //     );
    //     $this->form_validation->set_rules(
    //         'password',
    //         'Password',
    //         'trim|min_length[5]|max_length[128]|xss_clean|required'
    //     );

    //     $this->form_validation->set_rules(
    //         'confirm_password',
    //         'Confirm Password',
    //         'required|matches[password]'
    //     );
    // }

    // public function registering()
    // {
    //     $this->load->helper(array('url', 'security'));
    //     $this->load->library(array('form_validation'));
    //     $this->_filter_register(); //Lakukan Trims terhadap input pengguna

    //     //Jika validasi gagal
    //     if ($this->form_validation->run() == FALSE) {
    //         $this->load->view('register');
    //     } else {
    //         //validasi input
    //         $nama            =    $this->input->post('nama');
    //         $email            =    $this->input->post('email');
    //         $username        =    $this->input->post('username');
    //         $no_telp        =    $this->input->post('no_telp');
    //         $password        =    $this->input->post('password');
    //         $id_grup        =    2;
    //         $gambar                 =       $_FILES['gambar']['name'];

    //         if ($gambar = '') {
    //         } else {
    //             $config['upload_path']          = './assets/user_identitas';
    //             $config['allowed_types']        = 'jpg|png|jpeg';
    //             $config['max_size']             = 2048;

    //             $this->load->library('upload', $config);
    //             if (!$this->upload->do_upload('gambar')) {
    //                 // return $this->upload->data('file_name');
    //                 $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</button></div>');
    //                 // // $error = array('error' => $this->upload->display_errors());
    //                 $this->load->view('register');
    //             } else {
    //                 $gambar = $this->upload->data('file_name');
    //             }
    //         }

    //         $data = array(
    //             'nama'            =>    $nama,
    //             'email'            =>    $email,
    //             'username'    =>    $username,
    //             'no_telp'    =>    $no_telp,
    //             'password'    =>    password_hash($password, PASSWORD_DEFAULT),
    //             'id_grup'    =>    $id_grup,
    //             'foto_ktp'      =>      $gambar
    //         );

    //         $this->load->model('account');
    //         $this->account->insertNewUser($data);
    //         $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Akun anda berhasil dibuat, Silahkan Login!. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</button></div>');
    //         redirect('home/login');
    //     }
    // }
}
