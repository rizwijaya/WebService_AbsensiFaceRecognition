<?php
class siswa_model extends CI_Model
{
    function matakuliah($id_user) {
        $q = "SELECT t1.nama, t4.nama_matkul, t4.start_kuliah, t4.end_kuliah, t4.hari_kuliah, t6.nama as dosen FROM users t1 INNER JOIN siswa t2 ON t1.id_user=t2.id_user INNER JOIN frs t3 ON t2.id_siswa=t3.id_siswa INNER JOIN matkul t4 ON t3.id_matkul=t4.id_matkul INNER JOIN dosen t5 ON t4.id_dosen=t5.id_dosen INNER JOIN users t6 ON t5.id_user=t6.id_user WHERE t1.id_user = " . $id_user;
        $res = $this->db->query($q);
        return $res->result_array();  
    }
}