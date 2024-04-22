<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('m_admin');
		$this->load->model('m_signature');
		if (!$this->m_admin->is_login()) {
			redirect('AuthAdmin/Login');
		} else {
			require_once 'set_menu.php';
		}
	}

	public function index()
	{
		$string = $this->logindata['user']['pst_pnr'];
		$this->data['Progress'] = $this->m_admin->GetProgress($string);
		$this->data['signSet'] = $this->m_admin->cekSignature($string);
		$this->data['this_month'] = $this->m_admin->ThisMonth($string);
		$this->data['this_year'] = $this->m_admin->ThisYear($string);
		$this->data['last_month'] = $this->m_admin->LastMonth($string);
		if (isset($this->logindata['hr'])) {
			$this->data['all_this_month'] = $this->m_admin->AllThisMonth();
			$this->data['all_this_year'] = $this->m_admin->AllThisYear();
			$this->data['all_last_month'] = $this->m_admin->AllLastMonth();
		}
		$this->sidebar->view('public/dashboard/Dashboard', array_merge($this->logindata, $this->data));
	}
	public function upSignature()
	{
		$post = $this->input->post();
		if (empty($post)) {
			redirect('dashboard?alert=ditolak');
		} else {
			$this->m_signature->SetSignature();
		}
	}



}
