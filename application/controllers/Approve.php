<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Approve extends CI_Controller
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
		$string = $this->logindata['user']['pst_pnr'];	
		$this->data['Progress'] = $this->m_admin->GetProgressApproval($string);
		$this->sidebar->view('public/approve/Approve',array_merge($this->logindata,$this->data));
	}
	public function do_approve($int,$id,$as){
		if($int == 1){
			$this->m_admin->AcceptGatepass($id,$as);
			// echo 'accept gatepass id_verifikasi =  '.$id.' sebagai = '.$as;
		}else if($int == -1){
			$this->m_admin->RejectGatepass($id,$as);
			// echo 'reject gatepass id_verifikasi =  '.$id.' sebagai = '.$as;
		}else if($int == 0){
			$this->m_admin->PendingGatepass($id,$as);
		}
	}
	
	
}
