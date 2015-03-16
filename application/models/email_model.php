<?php if(!defined('BASEPATH')) die('Die!');

/**
	@property $vendor_class_model Vendor_class_model 
 */

class Email_model extends MY_Model
{
	var $email;
	var $CI;
	var $from = 'no-reply@ruangguru.com';
	var $to = array();
	var $cc = array();
	var $bcc = array();
	private $_subject = '[ruangguru.com] ';
	var $subject = '';
	var $text_content = '';
	var $html_content = '';
	var $attachment = array();
	var $forceHTML = FALSE;

	public function __construct() {
		$this->CI = &get_instance();
		error_reporting(E_ALL);
		$this->CI->load->library('email');
		$this->email = $this->CI->email;
	}
	
	protected function initialize($_config) {
		$config['useragent'] = 'Ruangguru Web Service';
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'mail.ruangguru.com';
		$config['smtp_port'] = 25;
		$config['smtp_user'] = $this->from;
		$config['smtp_pass'] = $this->config->item('smtp_password');
		$config['priority'] = 1;
		$config['mailtype'] = 'text';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE; 
		if(!empty($_config)) {
			$config = array_merge($config, $_config);
		}
		$this->email->initialize($config);
	}
	
	public function to($to){
		if(!is_array($to)) $to = array($to);
		$this->to = array_merge($this->to, $to);
		// make it unique
		$this->to = arr_uniq($this->to);
	}
	
	public function cc($cc){
		if(!is_array($cc)) $cc = array($cc);
		$this->cc = array_merge($this->cc, $cc);
		// make it unique
		$this->cc = arr_uniq($this->cc);
	}
	
	public function bcc($bcc){
		if(!is_array($bcc)) $bcc = array($bcc);
		$this->bcc = array_merge($this->bcc, $bcc);
		// make it unique
		$this->bcc = arr_uniq($this->bcc);
	}
	
	public function subject($subject) {
		$this->subject = $this->_subject.$subject;
	}

	/**
	 * Pathfile are path to file, related to FCPATH (Path to CI Front Controller => index.php)
	 * @param $pathfile
	 */
	public function attach($pathfile) {
		array_push($this->attachment, $pathfile);
	}

	/**
	 * File are related to path: /views/email/$file
	 * @param $file
	 */

	public function html_content($file, $param=array()) {
		$this->html_content = $this->CI->load->view('email/'.$file, $param, TRUE);
	}
	
	public function text_content($content) {
		$this->text_content = $content;
	}
	
	public function send() {
		$this->email->clear();
		if(empty($this->html_content) && ! empty($this->text_content)) {
			$this->initialize(array('mailtype'=>$this->forceHTML?'html':'text'));
			$this->email->message($this->text_content);
		} elseif(!empty($this->html_content) && empty($this->text_content)) {
			$this->initialize(array('mailtype'=>'html'));
			$this->email->message($this->html_content);
		} elseif( !empty($this->html_content) && ! empty($this->text_content) ) {
			$this->initialize(array('mailtype'=>'html'));
			$this->email->message($this->html_content);
			$this->email->set_alt_message($this->text_content);
		} else {
			return FALSE;
		}
		
		//* STAGING
//		$this->bcc('arie@ruangguru.com');
//		$this->bcc('iman@ruangguru.com');
//		$this->bcc('daniel@ruangguru.com');
		// */

		$this->email->from($this->from);
		$this->email->to($this->to);
		if(!empty($this->reply_to)) $this->email->reply_to($this->reply_to);
		if(!empty($this->cc)) $this->email->cc($this->cc);
		if(!empty($this->bcc)) $this->email->bcc($this->bcc);
		$this->email->subject($this->subject);
		foreach($this->attachment as $attach) {
			$this->email->attach($attach);
		}
/*
		echo "<pre>";
		var_dump($this->to);
		var_dump($this->text_content);
		var_dump($this->html_content);
		var_dump($this->attachment);
		var_dump('WER');
		var_dump($this->email->_body);
		var_dump($this->email->_finalbody);
// */
//		$this->email->send();
/*
		var_dump('qqq');
		echo $this->email->print_debugger();
		var_dump('zzz');
		exit;//
// */
		try {
			if($this->email->send()){
				$this->reset();
				return TRUE;
			}
		} catch(Exception $e) {
		}
		$this->reset();
		return FALSE;
	}
	
	public function reset() {
		$this->text_content = $this->html_content = $this->subject = '';
		$this->attachment = $this->to = $this->cc = $this->bcc = array();
		$this->forceHTML = FALSE;
		
	}
	
	public function register_vendor($email) {
		$this->to($email);
		
		$this->subject('Pendaftaran Vendor');
		$this->text_content("Anda telah mendaftar sebagai vendor!\n~~Selamat yaa~~\n\ntim@ruangguru");
		$this->send();
	}
	public function admin_approved_vendor($email) {
		$this->to($email);
		
		$this->subject('Pendaftaran Vendor telah disetujui Admin');
		$this->text_content("Admin kami telah menyetujui anda sebagai vendor!\n~~Selamat yaa~~\n\ntim@ruangguru");
		$this->send();
	}
	public function admin_rejected_vendor($email) {
		$this->to($email);
		
		$this->subject('Pendaftaran Vendor telah ditolak Admin');
		$this->text_content("Admin kami telah menolak pendaftaran anda sebagai vendor!\n
		Kalau anda merasa kesulitan, silahkan hubungi tim ruangguru di 021 9200 3040\n
		~~Maaf yaa~~\n\ntim@ruangguru");
		$this->send();
	}
	public function vendor_publish_class($email, $class_id) {
		$this->CI->load->model('vendor_class_model');
		
		$class = $this->CI->vendor_class_model->get_class(array(
			'id'				=> $class_id,
			'class_status >='	=> 0,
			'active'			=> 1
		))->row();
		
		$this->to($email);
		$this->bcc('arie@ruangguru.com');
		$this->bcc('iman@ruangguru.com');
		
		$this->subject('Publish kelas');
		$this->text_content("Anda telah mem-publish kelas dengan detail:!\n".print_r($class, TRUE)."\n\n~~Selamat yaa~~\n\ntim@ruangguru");
		$this->send();
	}
	
	public function vendor_send_message_to($vendor, $class_id, $subject, $message, $type = 'peserta', $attachment=NULL) {
		$this->CI->load->model('vendor_class_model');

		$class = $this->CI->vendor_class_model->get_class(array(
			'id'				=> $class_id,
			'class_status >='	=> 0,
			'active'			=> 1
		))->row();
		

		switch ($type) {
			case			'peserta'	:
				$tos = $this->CI->vendor_class_model->get_class_attendance_full($class->id)->result();
				break;
			case			'pendaftar'	:
				$tos = $this->CI->vendor_class_model->get_class_sponsor_full($class->id)->result();
				break;
			case			'semua'		:
			default						:
				$tos = $this->CI->vendor_class_model->get_class_participant_full($class->id)->result();
				break;
		}
		$sponsor_key = array();
		$participant_key = array();
		$sponsor = array();
		$participant = array();
		foreach($tos as $to) {
			if(!empty($to->email_pemesan)) {
				if( ! in_array($to->email_pemesan, $sponsor_key)) {
					$sponsor_key[] = $to->email_pemesan;
					$sponsor[$to->email_pemesan] = $to->nama_pemesan;
				}
			}
			if(!empty($to->email_peserta)) {
				if( ! in_array($to->email_peserta, $participant_key)) {
					$participant_key[] = $to->email_peserta;
					$participant[$to->email_peserta] = $to->nama_peserta;
				}
			}
		}
		
		$result = array();
//		var_dump($type);
//		exit;
		foreach($sponsor as $email => $name) {
			$this->forceHTML = TRUE;
			$this->to($email);
			$this->bcc('arie@ruangguru.com');
//			$this->bcc('iman@ruangguru.com');
			
			$this->subject('Pesan untuk PEMESAN dari vendor: ' . $subject);
			$txt_message = "Hi {$name}, anda menerima pesan ini sebagai PEMESAN untuk kelas: {$class->class_nama}\n
dari {$vendor->name} sebagai pihak pembuat acara,\n dengan pesan sebagai berikut: \n\n{MESSAGE} \n\n
Mohon laporkan kepada tim ruangguru apabila pihak penyelenggara menanyakan email atau no telp anda. Terima kasih. \n\ntim@ruangguru";
			$txt_message = nl2br($txt_message);
			$txt_message = str_replace('{MESSAGE}', '<div style="border: 1px solid black;padding: 5px;">'.$message.'</div>', $txt_message);
			$this->text_content($txt_message);
			$result['sponsor'][$email] = $this->send()?'OK':'KO';
		}
		foreach($participant as $email => $name) {
			$this->forceHTML = TRUE;
			$this->to($email);
			$this->bcc('arie@ruangguru.com');
//			$this->bcc('iman@ruangguru.com');
			
			$this->subject('Pesan untuk PESERTA dari vendor: ' . $subject);
			$txt_message = "Hi {$name}, anda menerima pesan ini sebagai PESERTA untuk kelas: {$class->class_nama}\n
dari {$vendor->name} sebagai pihak pembuat acara,\n dengan pesan sebagai berikut: \n\n{MESSAGE} \n\n
Mohon laporkan kepada tim ruangguru apabila pihak penyelenggara menanyakan email atau no telp anda. Terima kasih. \n\ntim@ruangguru";
			$txt_message = nl2br($txt_message);
			$txt_message = str_replace('{MESSAGE}', '<div style="border: 1px solid black;padding: 5px;">'.$message.'</div>', $txt_message);
			$this->text_content($txt_message);
			$result['participant'][$email] = $this->send()?'OK':'KO';
		}
		$data = array(
			'class_id'			=> $class_id,
			'type'				=> $type,
			'subject'			=> $subject,
			'message'			=> $message,
			'attachment'		=> $attachment
		);
		$this->db->insert('vendor_class_message', $data);
//		var_dump($result);exit;
		return $result;
	}
	
	public function send_invoice($code) {
		$this->CI->load->model('vendor_class_model');
		$trx = (array)$this->CI->vendor_class_model->get_transaction($code);

		$pemohon = (array)$this->CI->vendor_class_model->get_sponsor($trx['pemesan_id']);
		$murid = (array)$this->CI->vendor_class_model->get_participant($trx['student_id']);
		$trx['pemohon'] = $pemohon;
		$trx['murid'] = $murid;

		$path1 = substr($code, 0,1);
		$path2 = substr($code, 1,1);
		$docs_path = "documents/invoice/{$path1}/{$path2}/";

		$email_message = "
Halo {$trx['pemohon']['name']},

Ini adalah invoice (tagihan) untuk pemesanan yang telah anda lakukan di ruangguru.com, dengan keterangan sebagai berikut:
Pemesan:
- Nama  : {$trx['pemohon']['name']}
- Email : {$trx['pemohon']['email']}
- Telp  : {$trx['pemohon']['phone']}
- Alamat: {$trx['pemohon']['address']}

Peserta:
- Nama  : {$trx['murid']['name']}
- Email : {$trx['murid']['email']}
- Telp  : {$trx['murid']['phone']}

Sub Total Transaksi: Rp. {$trx['subtotal']}
Diskon: Rp. {$trx['discount']}
Total: Rp. {$trx['total']}
					
KODE TRANSAKSI: {$trx['code']}

Gunakan kode transaksi anda untuk melakukan konfirmasi dengan menghubungi operator kami di: 021 9200 3040
Atau anda dapat juga melakukan konfirmasi di:
".base_url()."payment/transfer/confirm/{$trx['code']}

Selain terlampir dengan email ini, file invoice juga dapat anda download di:
".base_url()."{$docs_path}{$trx['code']}.pdf

Terima kasih,

Tim Ruangguru.com
";
		
		$trx_invoice = $this->vendor_class_model->create_invoice($code);
		$data = array(
			'code'		=> $code,
			'data'		=> $trx_invoice,
		);
		
		$content = $this->CI->load->view('email/invoice_to_pdf', $data, TRUE);

		if(!is_dir(FCPATH.$docs_path))
			mkdir(FCPATH.$docs_path, 0775, TRUE);
		$this->CI->load->library('html2pdf');
		$this->CI->html2pdf->pdf->SetTitle('INVOICE - '.$code);
		$this->CI->html2pdf->pdf->SetAuthor('Ruangguru.com');
		$this->CI->html2pdf->WriteHTML($content);
		
		$this->CI->html2pdf->Output(FCPATH.$docs_path.$code.'.pdf', 'F');

		$this->text_content($email_message);
		$this->to($trx['pemohon']['email']);
		$this->bcc('arie@ruangguru.com');
		$this->subject('Tagihan ruangguru.com');
		
		$this->attach(FCPATH.$docs_path.$code.'.pdf');
		
		if(!$this->send()) return FALSE; 
		return TRUE;
	}
	
	public function send_payment_confirmed_message($code){
		$this->CI->load->model('vendor_class_model');
		$trx = (array)$this->CI->vendor_class_model->get_transaction($code);
		$data = array(
			'code'		=> $code,
			'data'		=> $trx,
		);//get_participant
		$pemohon = (array)$this->CI->vendor_class_model->get_sponsor($trx['pemesan_id']);
		$murid = (array)$this->CI->vendor_class_model->get_participant($trx['student_id']);
		$trx['pemohon'] = $pemohon;
		$trx['murid'] = $murid;
		$email_message = "
Halo {$trx['pemohon']['name']},
		
Terima kasih telah melakukan konfirmasi pembayaran anda untuk transaksi dengan kode invoice:
{$trx['code']}
Petugas operasional kami akan segera memproses transaksi anda. Terima kasih!

Terima kasih,

Tim Ruangguru.com";
		
		$this->text_content($email_message);
		$this->to($trx['pemohon']['email']);
		$this->bcc('arie@ruangguru.com');
		$this->subject('Tagihan ruangguru.com');
		if(!$this->send()) return FALSE;
		return TRUE;
	}
	
	public function send_admin_confirmed_payment_message($code) {
		$this->CI->load->model('vendor_class_model');
		$trx = (array)$this->CI->vendor_class_model->get_transaction($code);
		$data = array(
			'code'		=> $code,
			'data'		=> $trx,
		);//get_participant
		$pemohon = (array)$this->CI->vendor_class_model->get_sponsor($trx['pemesan_id']);
		$murid = (array)$this->CI->vendor_class_model->get_participant($trx['student_id']);
		$trx['pemohon'] = $pemohon;
		$trx['murid'] = $murid;

		$this->CI->load->model('payment_model');
		if(!$this->CI->vendor_class_model->set_confirm_payment_transfer($code)) {
			return FALSE;
		}
		$file_links = $this->CI->payment_model->create_ticket($code);

		$email_message = "
Halo {$trx['pemohon']['name']},
		
Petugas kami telah mengkonfirmasi pembayaran anda dengan kode invoice: {$trx['code']}
Terima kasih telah berpartisipasi dalam kelas ini.

Bersama dengan email ini, kami juga melampirkan tiket untuk tiap kelas yang anda ikuti.
Anda juga dapat mendownload tiket tersebut dari:
";
foreach($file_links as $file) {
	$email_message .= base_url().rawurlencode($file)."
";
}
		$email_message .= "



Terima kasih,

Tim Ruangguru.com";
		
		foreach($file_links as $file) {
			$this->attach(FCPATH.$file);
		}
		$this->text_content($email_message);
		$this->to($trx['pemohon']['email']);
		$this->bcc('arie@ruangguru.com');
		$this->subject('Tiket kelas');
		if(!$this->send()) return FALSE;
		return TRUE;
	}
	
	public function send_ticket($email, $code) {
		$this->CI->load->model('payment_model');
		$tickets = $this->CI->payment_model->create_ticket($code);
		$this->to = $email;
		$this->subject('Tiket Kelas');
		$links = array();
		foreach($tickets as $ticket) {
			$this->attach(FCPATH.$ticket);
			$links[] = base_url().$ticket;
		}
		$txt = "
Halo,

Ini adalah tiket kelas anda!
Atau anda dapat mendownloadnya juga di:

";
		$txt .= implode("\n", $links);
		$txt .= "

Terima kasih

.arie.
";
		$this->text_content($txt);
		$this->send();
	}
	
	public function vendor_register_success($vendor) {
		$data = array(
			'penyelenggara'			=> $vendor->name,
			'email'					=> $vendor->email
		);
		$this->html_content('vendor/1_register_success', $data);
		$this->subject('Register Vendor Berhasil');
		$this->from = 'kelas@ruangguru.com';
		$this->to($vendor->email);
		$this->send();
	}

	public function vendor_create_class_success($vendor, $class) {
		$data = array(
			'penanggung_jawab'			=> $vendor->contact_person_name,
			'penyelenggara'				=> $vendor->name,
			'class_name'				=> $class->class_nama,
			'class_id'					=> $class->id,
		);
		$this->html_content('vendor/2_create_class_success', $data);
		$this->subject('Kelas telah dibuat');
		$this->from = 'kelas@ruangguru.com';
		$this->to($vendor->email);
		$this->cc($vendor->contact_person_email);
		$this->send();
	}

	public function vendor_create_class_rejected($vendor, $class) {
		$data = array(
			'penanggung_jawab'			=> $vendor->contact_person_name,
			'penyelenggara'				=> $vendor->name,
			'class_name'				=> $class->class_nama,
			'class_id'					=> $class->id,
		);
		$this->from = 'kelas@ruangguru.com';
		$this->html_content('vendor/3_create_class_rejected', $data);
		$this->subject('Kelas anda ditolak oleh admin');
		$this->to($vendor->email);
		$this->cc($vendor->contact_person_email);
		$this->send();
	}
	
	public function vendor_class_published($vendor, $class) {
		$data = array(
			'penanggung_jawab'			=> $vendor->contact_person_name,
			'penyelenggara'				=> $vendor->name,
			'class_name'				=> $class->class_nama,
			'class_id'					=> $class->id,
		);
		$this->from = 'kelas@ruangguru.com';
		$this->html_content('vendor/4_class_published', $data);
		$this->subject('Kelas anda telah diterbitkan');
	$this->to($vendor->email);
		$this->cc($vendor->contact_person_email);
		$this->send();
	}

	public function vendor_class_3day_reminder($vendor, $class) {
		$data = array(
			'penanggung_jawab'			=> $vendor->contact_person_name,
			'penyelenggara'				=> $vendor->name,
			'class_name'				=> $class->class_nama,
			'class_id'					=> $class->id,
		);
		$this->from = 'kelas@ruangguru.com';
		$this->html_content('vendor/5_class_3day_reminder', $data);
		$this->subject('Pengingat: Kelas akan mulai');
		$this->to($vendor->email);
		$this->cc($vendor->contact_person_email);
		$this->send();
	}

	public function vendor_class_soldout($vendor, $class) {
		$data = array(
			'penanggung_jawab'			=> $vendor->contact_person_name,
			'penyelenggara'				=> $vendor->name,
			'class_name'				=> $class->class_nama,
			'class_id'					=> $class->id,
		);
		$this->from = 'kelas@ruangguru.com';
		$this->html_content('vendor/6_class_soldout', $data);
		$this->subject('Tiket telah habis terjual!');
		$this->to($vendor->email);
		$this->cc($vendor->contact_person_email);
		$this->send();
	}

	public function vendor_class_feedback($vendor, $class) {
		$data = array(
			'penanggung_jawab'			=> $vendor->contact_person_name,
			'penyelenggara'				=> $vendor->name,
			'class_name'				=> $class->class_nama,
			'class_id'					=> $class->id,
		);
		$this->from = 'kelas@ruangguru.com';
		$this->html_content('vendor/7_class_feedback', $data);
		$this->subject('Feedback untuk kelas');
		$this->to($vendor->email);
		$this->cc($vendor->contact_person_email);
		$this->send();
	}

	public function vendor_class_admin_update_notification($vendor, $class, $admin) {
		$data = array(
			'penanggung_jawab'			=> $vendor->contact_person_name,
			'penyelenggara'				=> $vendor->name,
			'class_name'				=> $class->class_nama,
			'class_id'					=> $class->id,
			'reason'					=> $admin->reason,
			'detail'					=> $admin->detail
		);
		$this->from = 'kelas@ruangguru.com';
		$this->html_content('vendor/8_class_admin_update_notification',$data);
		$this->subject('Pemberitahuan: Admin mengubah data kelas anda');
		$this->to($vendor->email);
		$this->cc($vendor->contact_person_email);
		$this->send();
	}
	
	public function student_payment_step3($code) {
		$this->CI->load->model('vendor_class_model');
		$invoice_raw = $this->CI->vendor_class_model->get_new_invoice_data($code);
		
		$invoice_class = array();
		$email_data = array(
			'murid_name'	=> $invoice_raw['pemohon']->name,
			'class'			=> array(),
			'total_pay'		=> $invoice_raw['transaction']->total
		);
		foreach($invoice_raw['class'] as $class) {
			$email_data['class'][] = array(
				'class_nama'		=> $class['profile']->class_nama,
				'vendor_name'		=> $class['vendor']->name
			);
			foreach($class['jadwal'] as $jadwal) {
				$i_class = array(
					'topik'	=> $jadwal->class_jadwal_topik,
					'jadwal'=> date('d M Y', strtotime($jadwal->class_tanggal))
							.' '.double_digit($jadwal->class_jam_mulai.':'.double_digit($jadwal->class_menit_mulai))
							.'-'.double_digit($jadwal->class_jam_selesai.':'.double_digit($jadwal->class_menit_selesai)),
					'harga' => $class['profile']->price_per_session
				);
				$invoice_class[] = $i_class;
			}
		}
		
		$invoice_data = array(
			'code'		=> $code,
			'pemohon'	=> (array)$invoice_raw['pemohon'],
			'murid'		=> (array)$invoice_raw['peserta'],
			'class'		=> $invoice_class,
			'subtotal'	=> $invoice_raw['transaction']->subtotal,
			'discount'	=> $invoice_raw['transaction']->discount,
			'total'		=> $invoice_raw['transaction']->total,
		);
		

		$path1 = substr($code, 0,1);
		$path2 = substr($code, 1,1);
		$docs_path = "documents/invoice/{$path1}/{$path2}/";

		$content = $this->CI->load->view('email/documents/invoice', $invoice_data, TRUE);

		if(!is_dir(FCPATH.$docs_path))
			mkdir(FCPATH.$docs_path, 0775, TRUE);
		$this->CI->load->library('html2pdf');
		$this->CI->html2pdf->pdf->SetTitle('INVOICE - '.$code);
		$this->CI->html2pdf->pdf->SetAuthor('Ruangguru.com');
		$this->CI->html2pdf->WriteHTML($content);
		
		$this->CI->html2pdf->Output(FCPATH.$docs_path.$code.'.pdf', 'F');
		
		$this->from = 'kelas@ruangguru.com';
		$this->html_content('murid/2_payment_step3',$email_data);
		$this->subject('Tagihan ');
		$this->to($invoice_raw['pemohon']->email);
		
		$this->attach(FCPATH.$docs_path.$code.'.pdf');
		
		$this->send();
	}

	public function student_payment_step4($murid, $class, $vendor, $ticket) {
		$data = array(
			'murid_name'		=> '',
			'class_name'		=> '',
			'vendor_name'		=> '',
			'ticket_code'		=> '',
			
		);
		$this->from = 'kelas@ruangguru.com';
		$this->html_content('murid/3_payment_step4',$data);
		$this->subject('');
	}

	public function student_24hour_reminder($murid, $class, $vendor, $ticket) {
		$data = array(
			'murid_name'		=> '',
			'class_name'		=> '',
			'vendor_name'		=> '',
			'ticket_code'		=> '',
			
		);
		$this->from = 'kelas@ruangguru.com';
		$this->html_content('murid/4_24hour_reminder',$data);
		$this->subject('');
	}

	public function student_class_feedback($murid, $class, $vendor) {
		$data = array(
			'murid_name'		=> '',
			'class_name'		=> '',
			'vendor_name'		=> '',
		);
		$this->from = 'kelas@ruangguru.com';
		$this->html_content('murid/5_class_feedback',$data);
		$this->subject('');
	}
}