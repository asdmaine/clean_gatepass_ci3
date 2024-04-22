<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mail extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('m_admin');
		// if (!$this->m_admin->is_login()) {
		// 	redirect('AuthAdmin/Login');
		// } else {
		// 	require_once 'set_menu.php';
		// }
	}
	public function index($as, $qrcode)
	{
		$this->data['as'] = $as;
		// $string = $this->logindata['user']['pst_pnr'];
		$this->data['Gatepass'] = $this->m_admin->GetGatepassForMail($as, $qrcode);
		// $this->load->view('public/test/test_mail_echo', array_merge($this->logindata, $this->data));
		$this->load->view('public/test/test_mail_echo', $this->data);
	}
	public function push($as, $qrcode, $redirect)
	{

		include APPPATH . 'third_party/phpmailer/src/Exception.php';
		include APPPATH . 'third_party/phpmailer/src/PHPMailer.php';
		include APPPATH . 'third_party/phpmailer/src/SMTP.php';
		include APPPATH . 'third_party/qrlib/src/qrlib.php';
		include APPPATH . 'third_party/fpdf/fpdf.php';
		include APPPATH . 'third_party/fpdf/src/autoload.php';


		$this->data['as'] = $as;
		$this->data['redirect'] = $redirect;
		$this->data['Gatepass'] = $this->m_admin->GetGatepassForMail($qrcode);
		ob_start();
		QRcode::png($this->data['Gatepass'][0]->qrcode, null, QR_ECLEVEL_H, 20);
		$imageData = ob_get_clean();
		$this->data['Gatepass'][0]->qrcode_64 = base64_encode($imageData);

		$this->load->view('public/mail/send_mail', $this->data);

	}




}