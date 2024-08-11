<?php defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	function __construct()
    {
        parent::__construct();
        $this->load->model('Home_m');
    }
	public function index()
	{
		check_not_login();
        $data['login'] = $this->Home_m->getLogin();
        $data['nasabah'] = $this->Home_m->getNasabah();
		$this->template->load('template', 'V_Home', $data);
	}

}
