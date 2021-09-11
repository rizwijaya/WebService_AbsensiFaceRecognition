<?php
class Api_run extends CI_Model
{
    function cekabsen($device)
    {
        $q = "SELECT * FROM running WHERE sts_running = 1 AND id_device = " . $device . " ORDER BY id_running DESC LIMIT 1";
        $res = $this->db->query($q);
        return $res->result_array();   
    }

    function updatestatus($table, $data, $where) {
        $this->db->update($table, $data, $where);
    }

    function cekFrs($nama) {
        $q = "SELECT t1.nama, t3.id_frs FROM users t1 INNER JOIN siswa t2 ON t1.id_user=t2.id_user INNER JOIN frs t3 ON t2.id_siswa=t3.id_siswa WHERE t1.nama = \"" . $nama . "\"";
        $res = $this->db->query($q);
        return $res->result_array();   
    }

    function getKehadiran($id_frs, $pertemuan) {
        $q = "SELECT * FROM kehadiran WHERE id_frs = " . $id_frs . " AND id_pertemuan = " . $pertemuan;
        $res = $this->db->query($q);
        return $res->result_array();   
    }

    function getpertemuan($device) {
        $q = "SELECT id_pertemuan, id_device FROM running WHERE sts_running = 1 AND id_device = " . $device . " ORDER BY id_running DESC LIMIT 1";
        $res = $this->db->query($q);
        return $res->result_array();         
    }

    function getmatkul($pertemuan) {
        $q = "SELECT t1.id_pertemuan, t1.id_matkul, t2.nama_matkul, t2.start_kuliah, t2.end_kuliah, t2.hari_kuliah FROM pertemuan t1 INNER JOIN matkul t2 ON t1.id_matkul=t2.id_matkul WHERE t1.id_pertemuan = " . $pertemuan;
        $res = $this->db->query($q);
        return $res->result_array();         
    }

    function pintukehadiran() {
        $q = "SELECT id_pertemuan, bukapintu FROM kehadiran ORDER BY id_kehadiran DESC LIMIT 1";
        $res = $this->db->query($q);
        return $res->result_array();         
    }

    function resetpintu() {
        $q = "UPDATE kehadiran SET bukapintu = 0";
        $res = $this->db->query($q);
        return 1; 
    }
    
    function inputAbsen($id_pertemuan, $id_frs, $sts_kehadiran, $date, $bukapintu) {
        $this->db->set("id_pertemuan", $id_pertemuan);
        $this->db->set("id_frs", $id_frs);
        $this->db->set("sts_kehadiran", $sts_kehadiran);
        $this->db->set("bukapintu", $bukapintu);
        $this->db->set("tgl_absen", $date);

        $this->db->insert("kehadiran");
    }

    function updateAbsen($table, $data, $where) {
        $this->db->update($table, $data, $where);
    }

    function getJumlahPintu() {
        $q = "SELECT count(bukapintu) as jumlah FROM kehadiran WHERE bukapintu = 1";
        $res = $this->db->query($q);
        return $res->result_array();
    }

    function getPintu($pertemuan, $frs) {
        $q = "SELECT bukapintu FROM kehadiran WHERE id_frs = " . $frs . " AND id_pertemuan = " . $pertemuan;
        $res = $this->db->query($q);
        return $res->result_array();
    }
}
