<?php defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('user_m');
    }

    public function index()
    {
        check_not_login();
        $data['jabatan'] = $this->user_m->getJabatan();
        $this->template->load('template', 'user_v',$data);
    }
    function ambilDataByid()
    {
        $id = $this->input->post('id');
        $data = $this->user_m->getDataByID($id);
        echo json_encode($data);
    }

    function hapusData()
    {
        $hapus = 0;
        $updated_by = $this->fungsi->user_login()->username;
        date_default_timezone_set('Asia/Jakarta');
        $updated_date = date("Y-m-d H:i:s");
        $computer = gethostname();
        $id = $this->input->post('username');
        $data = [
            'status' => $hapus, 'updated_by' => $updated_by,
            'updated_date' => $updated_date, 'computer' => $computer
        ];
        $data = $this->user_m->deleteData($id, $data);
        echo json_encode($data);
    }

    function tambahData()
    {
        $nama     = $this->input->post('nama');
        $username  = $this->input->post('username');
        $password = $this->input->post('password');
        $id_jabatan  = $this->input->post('jabatan');
        $created_by = $this->fungsi->user_login()->username;
        $computer = gethostname();
        $data = [
            'nama' => $nama, 'username' => $username, 'password' => md5($password),
            'id_jabatan' => $id_jabatan,'created_by' => $created_by, 'computer' => $computer
        ];
        $data = $this->user_m->insertData($data);
        echo json_encode($data);
    }

    function perbaruiData()
    {
        $username     = $this->input->post('username');
        $nama     = $this->input->post('nama');
        $password = $this->input->post('password');
        $id_jabatan  = $this->input->post('jabatan');
        $updated_by = $this->fungsi->user_login()->username;
        date_default_timezone_set('Asia/Jakarta');
        $updated_date = date("Y-m-d H:i:s");
        $computer = gethostname();
        if($password==""){
             $data = [
            'nama' => $nama, 'id_jabatan' => $id_jabatan,
           'updated_by' => $updated_by, 'updated_date' => $updated_date, 'computer' => $computer
        ];

        }else{
            $data = [
                'nama' => $nama, 'password' => md5($password),'id_jabatan' => $id_jabatan,
                'updated_by' => $updated_by, 'updated_date' => $updated_date, 'computer' => $computer
            ];
    
        }
       
        $data = $this->user_m->updateData($username, $data);
        echo json_encode($data);
    }
    function table()
    {
        $this->load->model("User_m");
        $fetch_data = $this->User_m->getTable();
        $data = array();
        $no = 1;
        foreach ($fetch_data as $row) {
            $sub_array = array();
            $sub_array[] = $no++;
            $sub_array[] = $row->username;
            $sub_array[] = $row->nama;
            $sub_array[] = $row->password;
            $sub_array[] = $row->jabatan;
            $sub_array[] = '<button type="button" name="update" data-id="' . $row->username . '" class="btn btn-primary btn_edit fa fa-pencil-square-o"> Update</button>  <button type="button" name="delete" data-id="' . $row->username . '" class="btn btn-danger btn_hapus fa fa-trash"> Delete</button>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"                =>     intval($_POST["draw"]),
            "recordsTotal"        =>     $this->User_m->get_all_data(),
            "recordsFiltered"     =>     $this->User_m->get_filtered_data(),
            "data"                =>     $data
        );
        echo json_encode($output);
    }
}
