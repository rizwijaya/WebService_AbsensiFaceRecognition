<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends BD_Controller {
    function __construct() {
        // Construct the parent class
        parent::__construct();
        $this->auth(); //Untuk authentication API nya
    }

    public function cekdevice_get() {
        $device = $this->get('device');
        $this->load->model('api_run');
        $presensi = $this->api_run->cekabsen($device); //Dapatkan data presensi.

        if ($device === NULL) { // Periksa apakah penyimpanan data pengguna berisi pengguna (jika hasil basis data mengembalikan NULL)
            if ($presensi) { // Set the response and exit
                $this->response($presensi, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else { // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'Device tidak terdaftar'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Temukan dan kembalikan satu rekaman untuk pengguna tertentu.

        // Validate the id.
        if ($device <= 0) { // id tidak valid, atur respons dan keluar.
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // Dapatkan pengguna dari array, menggunakan id sebagai kunci untuk pengambilan.
        // Biasanya model akan digunakan untuk ini.
        $presensi2 = NULL;

        if (!empty($presensi)) {
            foreach ($presensi as $key => $value) {
                if (isset($value['id_device']) && $value['id_device'] === $device) {
                    $presensi2 = $value;
                }
            }
        }

        if (!empty($presensi2)) {
            $this->set_response($presensi2, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Tidak ada absensi'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function updatestatus_post() {
		$where = array(
			'id_running' => $this->post('id')
		);
        $data = array(
			'sts_running' => 2
		);
        $msg = array(
			'status' => 200,
            'message' => 'perangkat dinonaktifkan'
		);

        $this->load->model('api_run');
        $this->api_run->updatestatus('running', $data, $where); //Dapatkan data presensi.

        $this->set_response($msg, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function getpertemuan_get() {
        $device = $this->get('device');
        $this->load->model('api_run');
        $pertemuan = $this->api_run->getpertemuan($device); //Dapatkan data pertemuan.

        if ($device === NULL) { // Periksa apakah penyimpanan data pengguna berisi pengguna (jika hasil basis data mengembalikan NULL)
            if ($pertemuan) { // Set the response and exit
                $this->response($pertemuan, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else { // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'Device tidak terdaftar'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Temukan dan kembalikan satu rekaman untuk pengguna tertentu.

        // Validate the id.
        if ($device <= 0) { // id tidak valid, atur respons dan keluar.
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // Dapatkan pengguna dari array, menggunakan id sebagai kunci untuk pengambilan.
        // Biasanya model akan digunakan untuk ini.
        $pertemuan2 = NULL;

        if (!empty($pertemuan)) {
            foreach ($pertemuan as $key => $value) {
                if (isset($value['id_device']) && $value['id_device'] === $device) {
                    $pertemuan2 = $value;
                }
            }
        }

        if (!empty($pertemuan2)) {
            $this->set_response($pertemuan2, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Tidak ada absensi'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function hadir_post() {
		$nama = $this->post('nama');
        $pertemuan = $this->post('pertemuan');
        $this->load->model('api_run');
        $cekfrs = $this->api_run->cekFrs($nama); //Cek Apakah Mahasiswa menggambil mata kuliah
        
        if(!empty($cekfrs[0]['id_frs'])) { //Jika mahasiswa menggambil mata kuliah
            $hadir = $this->api_run->getKehadiran($pertemuan, $cekfrs[0]['id_frs']); //Dapatkan data kehadiran
            if(empty($hadir[0]['sts_kehadiran'])) { //Jika tidak ada data kehadiran
                date_default_timezone_set('Asia/Jakarta'); // Set the new timezone
                $date = date('y-m-d h:i:s');
                $this->api_run->inputAbsen($pertemuan, $cekfrs[0]['id_frs'], 2, $date); //Lakukan input data kehadiran
                $msg = array(
                    'status' => 200,
                    'message' => 'Absensi berhasil'
                );
            } else if($hadir[0]['sts_kehadiran'] == 2) { //Jika sudah hadir
                $msg = array(
                    'status' => 200,
                    'message' => 'Absensi berhasil'
                );
            } else if($hadir[0]['sts_kehadiran'] == 3 || $hadir[0]['sts_kehadiran'] == 4) { //Jika izin dan alfa
                $msg = array(
                    'status' => 200,
                    'message' => 'Absensi berhasil'
                );    
            } else if($hadir[0]['sts_kehadiran'] == 1) {
                date_default_timezone_set('Asia/Jakarta'); // Set the new timezone
                $date = date('y-m-d h:i:s');
                $data = array(
                    'sts_kehadiran' => 2
                );
                $where = array(
                    'id_pertemuan' => $hadir[0]['id_pertemuan']
                );
                $this->api_run->updateAbsen("kehadiran", $data, $where); //Lakukan input data kehadiran
                $msg = array(
                    'status' => 200,
                    'message' => 'Absensi berhasil'
                );
            } else { //Jika pertemuan belum terlaksa / sts_kehadiran = 1
                $msg = array(
                    'status' => 200,
                    'message' => 'Pertemuan belum dimulai.'
                );  
            }
        } else { //Jika mahasiswa tidak mengambil mata kuliah
            $msg = array(
                'status' => 200,
                'message' => 'Mahasiswa Tidak Mengambil Mata Kuliah ini'
            );
        }
        $this->set_response($msg, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }
}
