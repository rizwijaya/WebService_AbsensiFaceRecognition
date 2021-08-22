<?php
class admin_model extends CI_Model
{
    function getdevice() {
        $q = "SELECT * FROM device";
        $res = $this->db->query($q);
        return $res->result_array();  
    }
}