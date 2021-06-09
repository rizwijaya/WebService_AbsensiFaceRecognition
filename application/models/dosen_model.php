<?php
class dosen_model extends CI_Model
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

}   