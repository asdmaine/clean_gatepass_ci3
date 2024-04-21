<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Scan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('m_admin');
		if (!$this->m_admin->is_login()) {
			redirect('AuthAdmin/Login');
		}else{
			require_once 'set_menu.php';
		}
	}
	public function index()
	{
		$this->sidebar->view('public/scan/Scan',array_merge($this->logindata));
	}
	public function output(){
		$post = $this->input->post();
		echo $post['qr'];
	}
	
	
	
}
