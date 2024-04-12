<?php
defined('BASEPATH') or exit ('No direct script access allowed');
class Pdf extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('m_admin');
		if (!$this->m_admin->is_login()) {
			redirect('AuthAdmin/Login');
		} else {
			require_once 'set_menu.php';
		}
	}
	public function index()
	{
		redirect('dashboard');
	}
	public function print($int = '')
	{
		if ($int == 0) {
			redirect('dashboard');
		} else {
			$string = $this->logindata['user']['pst_pnr'];
			$this->data['Gatepass'] = $this->m_admin->GetGatepass($string, $int);
			if (!isset ($this->data['Gatepass'][0]->rl_time_out) || $this->data['Gatepass'][0]->rl_time_out === null) {
				$this->data['Gatepass'][0]->rl_time_out = 'belum keluar';
			}
			if (!isset ($this->data['Gatepass'][0]->rl_time_in) || $this->data['Gatepass'][0]->rl_time_in === null) {
				$this->data['Gatepass'][0]->rl_time_in = 'belum masuk';
			}
			$this->load->view('public/pdf/Pdf', array_merge($this->logindata, $this->data));
		}
	}


}
