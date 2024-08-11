<?php defined('BASEPATH') or exit('No direct script access allowed');

class Home_m extends CI_Model
{

    function getLogin()
    {
        $query = $this->db->query('SELECT count(username) as login FROM tbl_cek where status = 1');
        return $query->result();
    }
    function getNasabah()
    {
        $query = $this->db->query('SELECT count(id_nasabah) as login FROM vwnasabah where hapus = 1');
        return $query->result();
    }
}