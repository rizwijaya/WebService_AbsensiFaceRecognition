<?php
class Account extends CI_Model
{
    function checklogin($nomorinduk, $password)
    {
        $result = $this->db->where('no_induk', $nomorinduk)
            ->limit(1)
            ->get('users');
        if ($result->num_rows() > 0) {
            $hash = $result->row('password');
            if (password_verify($password, $hash)) {
                return $result->result_array();
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    // function insertNewUser($data)
    // {
    //     $this->db->set("nama", $data['nama']);
    //     $this->db->set("email", $data['email']);
    //     $this->db->set("username", $data['username']);
    //     $this->db->set("password", $data['password']);
    //     $this->db->set("id_grup", $data['id_grup']);

    //     $this->db->insert("users");

    //     $id_user =  $this->db->insert_id();
    //     $peran = $data['id_grup'];

    //     if ($peran == 2) { //Pelapor
    //         $this->db->set("id_user", $id_user);
    //         $this->db->set("no_telp", $data['no_telp']);
    //         $this->db->set("foto_ktp", $data['foto_ktp']);
    //         $this->db->insert("pelapor");
    //     }
    // }
}
