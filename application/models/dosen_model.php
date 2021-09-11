<?php
class Dosen_model extends CI_Model
{
    function matkul($id_user){
        $q = "SELECT t3.id_matkul, t3.nama_matkul, t3.start_kuliah, t3.end_kuliah, t3.hari_kuliah FROM users t1 
        INNER JOIN dosen t2 ON t1.id_user=t2.id_user INNER JOIN matkul t3 ON t2.id_dosen=t3.id_dosen 
        WHERE t1.id_user=" . $id_user;
        $res = $this->db->query($q);
        return $res->result_array();
    }
    
    function siswa($id_matkul){
        $q = "SELECT t4.nama, t4.no_induk, t4.email FROM matkul t1 
        INNER JOIN frs t2 ON t1.id_matkul=t2.id_matkul INNER JOIN siswa t3 ON t2.id_siswa=t3.id_siswa 
        INNER JOIN users t4 ON t3.id_user = t4.id_user WHERE t1.id_matkul = " . $id_matkul;
        $res = $this->db->query($q);
        return $res->result_array();        
    }

    function pertemuan($id_matkul, $id_user) {
        $q = "SELECT t1.nama, t3.id_matkul, t3.nama_matkul, t3.start_kuliah, t3.end_kuliah, t3.hari_kuliah, t4.id_pertemuan, t4.pekan, t4.sts_pertemuan FROM users t1 INNER JOIN dosen t2 ON t1.id_user=t2.id_user INNER JOIN matkul t3 ON t2.id_dosen=t3.id_dosen INNER JOIN pertemuan t4 ON t4.id_matkul=t3.id_matkul WHERE t3.id_matkul = " . $id_matkul . " AND t1.id_user = " . $id_user;
        $res = $this->db->query($q);
        return $res->result_array();              
    }

    function idpertemuan($id_matkul, $pekan) {
        $q = "SELECT id_pertemuan, id_matkul FROM pertemuan WHERE id_matkul =" . $id_matkul . " AND pekan = " . $pekan;
        $res = $this->db->query($q);
        return $res->result_array();          
    }

    function kehadiran($id_pertemuan) {
        $q = "SELECT t1.sts_kehadiran, t1.tgl_absen, t4.nama, t4.email, t4.no_induk FROM kehadiran t1 INNER JOIN frs t2 ON t1.id_frs = t2.id_frs INNER JOIN siswa t3 ON t2.id_siswa = t3.id_siswa INNER JOIN users t4 ON t3.id_user = t4.id_user WHERE t1.id_pertemuan = " . $id_pertemuan;
        $res = $this->db->query($q);
        return $res->result_array();
    }

    function running($id_pertemuan) {
        $q = "SELECT t1.id_running, t1.id_device, t1.sts_running, t2.ruangan FROM running t1 INNER JOIN device t2 ON t1.id_device=t2.id_device WHERE t1.id_pertemuan= " . $id_pertemuan . " ORDER BY id_running DESC LIMIT 1";
        $res = $this->db->query($q);
        return $res->result_array();   
    }
    
    function startingabsen($data) {
        $this->db->set("id_device", $data['id_device']);
        $this->db->set("id_pertemuan", $data['id_pertemuan']);
        $this->db->set("mulai_run", $data['mulai_run']);
        $this->db->set("end_run", $data['end_run']);
        $this->db->set("sts_running", $data['sts_running']);
        $this->db->set("sts_command", $data['sts_command']);

        $this->db->insert("running");
    }

    function getdevice($id_pertemuan) {
        $q = "SELECT id_device FROM pertemuan WHERE id_pertemuan= " . $id_pertemuan;
        $res = $this->db->query($q);
        return $res->result_array();   
    }

    function cekdevice($device) {
        $q = "SELECT id_device, sts_running FROM running WHERE id_device= " .$device. " AND sts_running= 1";
        $res = $this->db->query($q);
        return $res->result_array();   
    }

    function stop($command, $run) {
        $q = "SELECT id_running, sts_running, sts_command FROM running WHERE sts_command= ". $command ." AND sts_running= " . $run . " ORDER BY id_running DESC LIMIT 1";
        $res = $this->db->query($q);
        return $res->result_array();   
    }

    function stopping($table, $data, $where) {
        $this->db->update($table, $data, $where);
    }
}   