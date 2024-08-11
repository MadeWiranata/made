<?php defined('BASEPATH') or exit('No direct script access allowed');

class Home_m extends CI_Model
{

    function getLogin()
    {
        $query = $this->db->query('SELECT count(username) as login FROM tbl_cek where status = 1');
        return $query->result();
    }
}