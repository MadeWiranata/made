<?php defined('BASEPATH') or exit('No direct script access allowed');

class Nasabah_m extends CI_Model
{
    function getDataByID($id_nasabah)
    {
        $this->db->where('id_nasabah', $id_nasabah);
        return $this->db->get('tbl_nasabah')->result();
    }

    function deleteData($id_nasabah, $data)
    {
        $this->db->where('id_nasabah', $id_nasabah);
        $this->db->update('tbl_nasabah', $data);
    }

    function insertData($data)
    {
        $this->db->insert('tbl_nasabah', $data);
    }

    function updateData($id_nasabah, $data)
    {
        $this->db->where('id_nasabah', $id_nasabah);
        $this->db->update('tbl_nasabah', $data);
    }
    var $order_column = array("","nama","date_from","date_to","","harga","jenis","banjir","gempa","created_by","updated_by","updated_by","updated_date","computer","");
    function make_query()
    {
        $this->db->select("*");
        $this->db->from("vwnasabah");
        if (isset($_POST["search"]["value"])) {
            $this->db->like("nama", $_POST["search"]["value"]);
        }
        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('id_nasabah', 'DESC');
        }
    }
    function getTable()
    {
        $this->make_query();
        if ($_POST["length"] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function get_filtered_data()
    {
        $this->make_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function get_all_data()
    {
        $this->db->select("*");
        $this->db->from("vwnasabah");
        return $this->db->count_all_results();
    }
    function getJenis()
    {
        $query = $this->db->query('SELECT id_jenis,jenis FROM tbl_jenis');
        return $query->result();
    }
    function getDat($id)
    {
        $query = $this->db->query('SELECT * FROM vwreport where id_nasabah = '.$id.' and hapus = 1');
        return $query->result();
    }
}
