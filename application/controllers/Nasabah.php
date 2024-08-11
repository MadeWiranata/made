<?php defined('BASEPATH') or exit('No direct script access allowed');

class Nasabah extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('nasabah_m');
    }
    public function index()
    {
        check_not_login();
        $data['jenis'] = $this->nasabah_m->getJenis();
        $this->template->load('template', 'nasabah_v', $data);
    }
    function ambilDataByid()
    {
        $id = $this->input->post('id_nasabah');
        $data = $this->nasabah_m->getDataByID($id);
        echo json_encode($data);
    }
    function getDat()
    {
        $id = $this->input->get('id_nasabah');
        $data['nasabah'] = $this->nasabah_m->getDat($id);
        $this->template->load('template', 'print_v', $data);
    }

    function hapusData()
    {
        $hapus = 0;
        $updated_by = $this->fungsi->user_login()->username;
        date_default_timezone_set('Asia/Jakarta');
        $updated_date = date("Y-m-d H:i:s");
        $computer = gethostname();
        $id = $this->input->post('id_nasabah');
        $data = [
            'hapus' => $hapus, 'updated_by' => $updated_by,
            'updated_date' => $updated_date, 'computer' => $computer
        ];
        $data = $this->nasabah_m->deleteData($id, $data);
        echo json_encode($data);
    }

    function tambahData()
    {
        $nama     = $this->input->post('nama');
        $date_from  = $this->input->post('date_from');
        $date_to     = $this->input->post('date_to');
        $pertanggungan     = $this->input->post('pertanggungan');
        $harga     = $this->input->post('harga');
        $harga_format = str_replace(',','', $harga);
        $jenis     = $this->input->post('jenis');
        $banjir    = $this->input->post('banjir');
        $gempa    = $this->input->post('gempa');
        $created_by = $this->fungsi->user_login()->username;
        $computer = gethostname();
        $data = [
            'nama' => $nama, 'date_from' => $date_from, 'date_to' => $date_to,
            'pertanggungan' => $pertanggungan, 'harga' => $harga_format, 'banjir' => $banjir,
            'id_jenis' => $jenis, 'gempa' => $gempa,
            'created_by' => $created_by, 'computer' => $computer
        ];
        $data = $this->nasabah_m->insertData($data);
        echo json_encode($data);
    }

    function perbaruiData()
    {
        $id_nasabah     = $this->input->post('id_nasabah');
        $nama     = $this->input->post('nama');
        $date_from  = $this->input->post('date_from');
        $date_to     = $this->input->post('date_to');
        $pertanggungan     = $this->input->post('pertanggungan');
        $harga     = $this->input->post('harga');
        $harga_format = str_replace(',','', $harga);
        $jenis     = $this->input->post('jenis');
        $banjir    = $this->input->post('banjir');
        $gempa    = $this->input->post('gempa');
        $updated_by = $this->fungsi->user_login()->username;
        date_default_timezone_set('Asia/Jakarta');
        $updated_date = date("Y-m-d H:i:s");
        $computer = gethostname();
        $data = [
            'nama' => $nama, 'date_from' => $date_from, 'date_to' => $date_to,
            'pertanggungan' => $pertanggungan, 'harga' => $harga_format, 'banjir' => $banjir,
            'id_jenis' => $jenis, 'gempa' => $gempa,
            'updated_by' => $updated_by, 'updated_date' => $updated_date,'computer' => $computer
        ];
       
        $data = $this->nasabah_m->updateData($id_nasabah, $data);
        echo json_encode($data);
    }
    function table()
    {
        $this->load->model("nasabah_m");
        $fetch_data = $this->nasabah_m->getTable();
        $data = array();
        $no = 1;
        foreach ($fetch_data as $row) {
            $sub_array = array();
            $sub_array[] = $no++;
            $sub_array[] = $row->nama;
            $sub_array[] = $row->date_from;
            $sub_array[] = $row->date_to;
            $sub_array[] = $row->pertanggungan;
            $sub_array[] = $row->harganew;
            $sub_array[] = $row->jenis;
            $sub_array[] = $row->banjir;
            $sub_array[] = $row->gempa;
            $sub_array[] = $row->created_by;
            $sub_array[] = $row->created_date;
            $sub_array[] = $row->updated_by;
            $sub_array[] = $row->updated_date;
            $sub_array[] = $row->computer;
            $sub_array[] = '<button type="button" name="update" data-id="' . $row->id_nasabah . '" class="btn btn-primary btn_edit fa fa-pencil-square-o"> Update</button>  <button type="button" name="delete" data-id="' . $row->id_nasabah . '" class="btn btn-danger btn_hapus fa fa-trash"> Delete</button> <button type="button" name="print" data-id="' . $row->id_nasabah . '" class="btn btn-primary btn_print fa fa-pencil-square-o"> Print</button> ';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"                =>     intval($_POST["draw"]),
            "recordsTotal"        =>     $this->nasabah_m->get_all_data(),
            "recordsFiltered"     =>     $this->nasabah_m->get_filtered_data(),
            "data"                =>     $data
        );
        echo json_encode($output);
    }
}
