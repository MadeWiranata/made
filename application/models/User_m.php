<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_m extends CI_Model
{
    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('vwlogin');
        $this->db->where('username', $post['username']);
        $this->db->where('password', md5($post['password']));
        $query = $this->db->get();
        return $query;
    }
    public function pantau($post)
    {
        $computer = gethostname();
        $status = 0;
        $update = 1;
        date_default_timezone_set('Asia/Jakarta');
        $updated_date = date("Y-m-d H:i:s");
        $username = $this->fungsi->user_login()->username;
        $cek = [
            'username' => $username, 'status' => $status,
            'tanggal_out'=>$updated_date, 'computer' => $computer
        ];
        $this->db->where('status', $update);
        $this->db->update('tbl_cek', $cek);

        $data = [
            'username' => $post['username'],
            'computer' => $computer
        ];
        $this->db->insert('tbl_cek', $data);

    }
    public function Out()
    {
        $computer = gethostname();
        $status = 0;
        $update = 1;
        date_default_timezone_set('Asia/Jakarta');
        $updated_date = date("Y-m-d H:i:s");
        $username = $this->fungsi->user_login()->username;
        $data = [
            'username' => $username, 'status' => $status,
            'tanggal_out'=>$updated_date, 'computer' => $computer
        ];
        $this->db->where('status', $update);
       $this->db->update('tbl_cek', $data);
       
    }
    public function get($id = null)
    {
        $this->db->from('vwlogin');
        if ($id != null) {
            $this->db->where('username', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    function getDataByID($username)
    {
        $this->db->where('username', $username);
        return $this->db->get('vwlogin')->result();
    }

    function deleteData($username, $data)
    {
        $this->db->where('username', $username);
        $this->db->update('tbl_login', $data);
    }

    function insertData($data)
    {
        $this->db->insert('tbl_login', $data);
    }

    function updateData($username, $data)
    {
        $this->db->where('username', $username);
        $this->db->update('tbl_login', $data);
    }
    function getJabatan()
    {
        $query = $this->db->query('SELECT id_jabatan,jabatan FROM tbl_jabatan');
        return $query->result();
    }
    var $order_column = array("","username","nama","","","");
    function make_query()
    {
        $hapus = 1;
        $this->db->select("*");
        $this->db->from("vwlogin");
        
        if (isset($_POST["search"]["value"])) {
            $this->db->like("username", $_POST["search"]["value"]);
            $this->db->or_like("nama", $_POST["search"]["value"]);
        }
        if (isset($_POST["order"])) {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('username', 'DESC');
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
        $this->db->from("vwlogin");
        return $this->db->count_all_results();
    }
}
