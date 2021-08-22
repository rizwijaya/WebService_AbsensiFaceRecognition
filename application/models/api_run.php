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

    function inputAbsen($id_pertemuan, $id_frs, $sts_kehadiran, $date) {
        $this->db->set("id_pertemuan", $id_pertemuan);
        $this->db->set("id_frs", $id_frs);
        $this->db->set("sts_kehadiran", $sts_kehadiran);
        $this->db->set("tgl_absen", $date);

        $this->db->insert("kehadiran");
    }

    function updateAbsen($table, $data, $where) {
        $this->db->update($table, $data, $where);
    }
}
