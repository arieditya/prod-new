<?php if (!defined('BASEPATH')) die('No direct script access allowed');

/**
 * @property	Vendor_class_model $vendor_class_model
 * 
 * */
class Payment extends MY_Controller {
    private $id;
	
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
	   $this->load->helper('veritrans');
	   $this->load->model('payment_model');
		$this->load->model('vendor_class_model'); 
	}
	
	public function _remap($method = NULL, $parameter = NULL){
//		var_dump($a);
//		var_dump($b);
		$uri2 = $this->uri->rsegment(2);
		if($uri2 == 'transfer') {
			$uri3 = $this->uri->rsegment(3);
			if(empty($uri3)) $uri3 = 'index';
			$method = 't_'.$uri3;
			if(!method_exists($this, $method)) show_404();
			if(count($parameter) > 0) array_shift($parameter);
			$this->t_construct();
		} else {
			if(substr($uri2,0,2) == 't_') show_404();
		}
		call_user_func_array(array($this, $method), $parameter);
	}
	
	public function t_addtocart() {
		$this->input->get_post('class_id', TRUE);
		$this->input->get_post('jadwal_id', TRUE);
		
	}
	public function t_index() {
		
	}
	
	public function t_cek_diskon() {
		header('Content-Type: application/json');
		$cart = json_decode($this->input->cookie('cart', TRUE));
		$class_ids = array();
		foreach($cart as $c) {
			$class_ids[] = $c->id;
		}
		$this->load->model('discount_model');
		$kode = $this->input->get('kode_diskon', TRUE);

		$availability = $this->discount_model->check_code_available($class_ids, $kode);
		if(empty($availability)){
			set_status_header(400,'Kode tidak ada!');
			echo json_encode(array('status'=>'KO', 'data'=>array('message'=>'Kode Diskon tidak ditemukan!')));
			return;
		} else {
			$kode_diskon = $this->session->userdata('kode_diskon');
			if(empty($kode_diskon)) $kode_diskon = '[]';
			$kode_diskon = json_decode($kode_diskon);
			if(!in_array($kode, $kode_diskon)) {
				array_push($kode_diskon, $kode);
				$this->session->set_userdata('kode_diskon', json_encode($kode_diskon));
				echo json_encode(array('status'=>'OK', 'data'=>array('code'=>$kode, 'message'=>'Kode Diskon berhasil ditambahkan!')));
				return;
			} else {
				echo json_encode(array('status'=>'NOK', 'data'=>array('code'=>$kode, 'message'=>'Kode Diskon sudah pernah ditambahkan!')));
				return;
			}
		}
	}
	
	public function t_remove_from_cart() {
		$remove_id = (int)$this->input->get('r_id', TRUE);
		if(empty($remove_id)) {
			show_error('No ID found!', 400);
			return;
		}
		
		if(!$this->input->cookie('cart', TRUE)) show_404();
		$cart = json_decode($this->input->cookie('cart', TRUE));
		$new_cart = array();
		foreach($cart as $c){
			var_dump($c->id);
			var_dump($remove_id);
			if($c->id == $remove_id) {
				continue;
			}
			$new_cart[] = $c;
		}
		var_dump($new_cart);exit;
		$this->load->helper('cookie');
		set_cookie('cart', json_encode($new_cart), '', '', '/');
		header('Content-type: application/json');
		echo json_encode(array(
			'status'		=> 'OK',
			'data'			=> array(),
			'message'		=> 'Class removed!'
		));
		return;
	}
	
	public function t_clear_cart() {
		
	}

	public function t_step1() {
		if(!$this->input->cookie('cart', TRUE)) {
			$this->session->set_flashdata('status.warning','Tidak ada kelas yang didaftarkan. Silahkan daftar kelas.');
			redirect('kelas');
			return;
		}
//		var_dump();exit;
		$cart = json_decode($this->input->cookie('cart', TRUE));
		if(empty($cart)) {
			$this->session->set_flashdata('status.warning','Tidak ada kelas yang didaftarkan. Silahkan daftar kelas.');
			redirect('kelas');
			return;
		}

		$class_ids = array();
		foreach($cart as $c) {
			$class_ids[] = $c->id;
		}

		$whostudent = $this->input->post('whostudent',TRUE);
		if(empty($whostudent)) $whostudent = 'me';
		$discount = 0;
		$percent_class = array();
		$nominal_class = array();
		$kode = array();
		$kode_diskon = $this->session->userdata('kode_diskon');
		if(!empty($kode_diskon)) {
			$this->load->model('discount_model');
			$kode_diskon = json_decode($kode_diskon);
			
			$new_diskon = array();
			foreach($kode_diskon as $disk) {
				if(!empty($disk)) {
					$diskon = $this->discount_model->detail_code($class_ids, $disk);
					if(!empty($diskon)){
						$new_diskon[] = $disk;
						if(empty($percent_class[$diskon->class_id]))
							$percent_class[$diskon->class_id] = array();
						$value = $this->discount_model->detail_value($diskon->id);
						if($value->type == 'idr') {
							$disc = $value->value;
							$discount += $disc;
							$kode[$disk] = $disc;
							$nominal_class[$diskon->class_id][] = array(
								'code'	=> $disk,
								'value' => $value->value,
							);
						} else {
	//						$discount_percent += $value->value;
							$percent_class[$diskon->class_id][] = array(
								'code'	=> $disk,
								'value'	=> $value->value
							);
						}
					}
				}
			}
			$this->session->set_userdata('kode_diskon', json_encode($new_diskon));
		} else {
			
		}
		$class = array();
		
		foreach($cart as $c) {
			$sched = array();
			$schedule = $this->vendor_class_model->get_class_schedule(array('class_id'=>$c->id))->result();
			foreach($schedule as &$s) {
				$participant = $this->vendor_class_model->get_class_schedule_availability($s->jadwal_id);
				$s->available_seat = $participant;
			}
			$data_class = array(
				'class'		=> $this->vendor_class_model->get_class(array('id'=>$c->id,'active'=>NULL, 'class_status'=>NULL))->row(),
				'schedule'	=> $schedule,
				'followed'	=> $c->jadwal
			);
			$class[] = $data_class;
			
		}
		$type = $this->session->userdata('user_type');
		$murid = null;
		if(!empty($type) && $type == 'murid' ) {
			$this->load->model('murid_model');
			$murid = $this->murid_model->get_murid_by_email($this->session->userdata('user_email'));
		}
		
		$data = array(
				'in_cart'					=>$class, 
				'student'					=>$murid, 
				'potongan_diskon'			=> $kode, 
				'potongan_diskon_persen'	=>$percent_class, 
				'potongan_diskon_nominal'	=>$nominal_class,
				'whostudent'=>$whostudent
		);
		$data = array_merge($this->data, $data);
		$this->new_design?
				$this->load->view('payment/transfer/step1_2', $data):
				$this->load->view('payment/transfer/step1',$data);
//		$this->load->view('payment/transfer/step1', $data);
	}
	
	public function user($act) {
		switch($act) {
			case		'login' :
				$email	= $this->input->post('email', TRUE);
				$pass	= $this->input->post('password', TRUE);
				if(empty($email) || empty($pass)) {
					show_error('Failed to login!', 401,'Authorization Failed');
					exit;
				}
				$this->load->model('murid_model');
				$murid_id = $this->murid_model->check_login(array('email'=>$email, 'password'=>$pass));
				if(empty($murid_id)){
					show_error('Email/Password not valid!', 401,'Authorization Failed');
					exit;
				}
				$murid = $this->murid_model->get_murid_by_email($email);
				$data = array(
					'type'		=> 'student',
					'name'		=> $murid->murid_nama,
					'email'		=> $email,
					'id'		=> $murid_id
				);
				$this->exec_login($data);
				$this->session->set_userdata('murid', json_encode($murid));
				redirect($this->input->server('HTTP_REFERER', TRUE));
		}
	}
	
	public function t_step2() {
		$dt1 = json_decode($this->session->userdata('transaction'), TRUE);
		if(!empty($dt1) && $this->input->post('frm_c') != 'fex') {
//			var_dump($dt1);exit;
//			$trx = $this->vendor_class_model->get_transaction($dt1['code']);
			$dt2 = json_decode($this->session->userdata('transaction'));
			$dt1['jadwal'] = $dt2->jadwal;
			$this->load->view('payment/transfer/step2_2', $dt1);
			return;
		}
		
		if(!empty($dt1)) $this->vendor_class_model->remove_transaction($dt1['code']);
		
 		$this->load->model('discount_model');
		
		$pemesan = array(
			'name'			=> $this->input->post('pemesan_name', TRUE),
			'email'			=> $this->input->post('pemesan_email', TRUE),
			'phone'			=> $this->input->post('pemesan_phone', TRUE),
		);

		if(empty($pemesan['name']) || empty($pemesan['email']) || empty($pemesan['phone'])) {
			$this->session->set_flashdata('status.error','Data Pemesan WAJIB diisi!');
			redirect('payment/transfer/step1');
			return;
		}
		$whostudent = $this->input->post('whostudent',TRUE);
		if($whostudent == 'me') {
			$peserta = $pemesan;
		} else {
			$peserta = array(
				'name'			=> $this->input->post('peserta_name', TRUE),
				'email'			=> $this->input->post('peserta_email', TRUE),
				'phone'			=> $this->input->post('peserta_phone', TRUE)
			);
		}
		
		if(!$this->input->cookie('cart', TRUE)) show_404();
//		var_dump();exit;
		$cart = json_decode($this->input->cookie('cart', TRUE));
		if(empty($cart)) {
			delete_cookie('cart','.');
			show_404();
		}

		$pemesan_id = $this->vendor_class_model->add_class_pemesan($pemesan);
		$peserta_id = $this->vendor_class_model->add_class_peserta($peserta);
		

		$class_ids = array();
		foreach($cart as $c) {
			$class_ids[] = $c->id;
		}

/*
		$kode = trim($this->input->cookie('kode_diskon', TRUE), '"');
		$discount = 0;
		if(!empty($kode))
			if($kode == 'lima puluh')
				$discount = 50000;
			elseif($kode == 'dua ratus lima puluh')
				$discount = 250000;
// */

		$discount = 0;
		$kode = array();
		$kode_diskon = $this->session->userdata('kode_diskon');
		$percent_class = array();
		$nominal_class = array();

		if(!empty($kode_diskon)) {
			$this->load->model('discount_model');
			$kode_diskon = json_decode($kode_diskon);
			
			foreach($kode_diskon as $disk) {
				if(!empty($disk)) {
					$diskon = $this->discount_model->detail_code($class_ids, $disk);
					if(empty($percent_class[$diskon->class_id]))
						$percent_class[$diskon->class_id] = array();
					$value = $this->discount_model->detail_value($diskon->id);
					if($value->type == 'idr') {
						$disc = $value->value;
						$discount += $disc;
						$kode[$disk] = $disc;
						$nominal_class[$diskon->class_id][] = array(
							'code'	=> $disk,
							'value' => $value->value,
						);
					} else {
//						$discount_percent += $value->value;
						$percent_class[$diskon->class_id][] = array(
							'code'	=> $disk,
							'value'	=> $value->value
						);
					}
				}
			}
		} else {
			
		}

/*
		if(!empty($kode_diskon)) {
			$kode_diskon = json_decode($kode_diskon);
			foreach($kode_diskon as $disk) {
				if(!empty($disk)) {
					if($disk == 'lima puluh') {
						$disc = 50000;
					} elseif($disk == 'dua ratus lima puluh') {
						$disc = 250000;
					} else {
						continue;
					}
					$kode[$disk] = $disc;
					$discount += $disc;
				}
			}
		} else {
			
		}
// */
		$subtotal = 0;
		$total = 0;
		$total_no_discount = 0;
		
		
		$sched = array();
		$code = NULL;
		
		$veritrans = array();

		foreach($cart as $c) {
			$class = $this->vendor_class_model->get_class(array('id'=>$c->id))->row();
			$test = $this->vendor_class_model->check_participant_class($c->id, $peserta_id);
			if(!empty($test)) {
					$this->session->set_flashdata('status.large', 'TRUE');
					$this->session->set_flashdata('status.error','Email murid sudah pernah didaftarkan untuk kelas: '
					.'<strong>'.$class->class_nama.'</strong>.<br />Gunakan alamat email lain untuk mendaftar atau'
					.' hapus kelas ini dari list.');
					redirect('payment/transfer/step1');
					return;
					exit;
			}
		}

		foreach($cart as $c) {
			$class_total = 0;
			$class_discount = 0;
			$schedules = $this->vendor_class_model->get_class_schedule(array('class_id'=>$c->id))->num_rows();
			$class = $this->vendor_class_model->get_class(array('id'=>$c->id))->row();
			if(empty($class)) continue;
			$full_session_discount = (int)$class->discount;
			$i = 0;
			$vt_qty = 0;
			foreach($c->jadwal as $j_id) {
				if(!$this->vendor_class_model->get_class_schedule_availability($j_id)) continue;
				$i++;
				$code = $this->vendor_class_model->add_class_participant($c->id, $j_id, $peserta_id, $pemesan_id, $code);
				if($code == 'BAD') {
					$this->session->set_flashdata('status.warning','Email murid dan kelas sudah pernah didaftarkan!'
					.' Gunakan alamat email lain untuk mendaftar kelas ini.');
					redirect('payment/transfer/step1');
					return;
					exit;
				}
				$schedule = $this->vendor_class_model->get_class_schedule(array('jadwal_id'=>$j_id))->row();
				$schedule->price_per_session = $class->price_per_session;
				$sched[] = $schedule;
				$class_total += $class->price_per_session;
				$total_no_discount += $class->price_per_session;
				$vt_qty++;
			}
			if((int)$class->price_per_session > 0 && $vt_qty > 0) {
				$veritrans_data = array(
					'id'		=> 'CID_'.$c->id,
					'price'		=> (int)$class->price_per_session,
					'name'		=> 'CLASS: '.$class->class_nama,
					'quantity' => $vt_qty
				);
				array_push($veritrans,$veritrans_data) ;
			}
//			var_dump($sched);
			if($i == $schedules && $full_session_discount > 0) {
				$this->discount_model->use_general_discount('FULL_SESSION', $code, $pemesan_id, $full_session_discount, 'CLASS: '.$c->id);
				$class_total -= $full_session_discount;
			}
			
			if( ! empty ($percent_class[$c->id])) {
				foreach($percent_class[$c->id] as $disc_percent) {
					if($this->discount_model->check_code_available($c->id, $disc_percent['code']) > 0){
						$percent_in_value = $class_total * ($disc_percent['value'] / 100);
						$this->discount_model->use_discount($c->id, $disc_percent['code'], $code, $pemesan_id, $percent_in_value);
						$class_discount += $percent_in_value;
					}
				}
			}
			
			if( ! empty ($nominal_class[$c->id])) {
				foreach($nominal_class[$c->id] as $disc_nominal) {
					if($this->discount_model->check_code_available($c->id, $disc_nominal['code']) > 0){
						$this->discount_model->use_discount($c->id, $disc_nominal['code'], $code, $pemesan_id, $disc_nominal['value']);
						$class_discount += $disc_nominal['value'];
					}
				}
			}
			
			$discount = $class_discount + $full_session_discount;
			
		}
		
		$total = $total_no_discount - $discount;
		if($total < 0) $total = 0;
		$data = array(
			'pemesan'=>$pemesan, 
			'peserta'=>$peserta, 
			'jadwal'=> $sched, 
			'subtotal'=>$total_no_discount, 
			'discount'=>$discount,
			'total'=>$total,
			'code'=>$code,
			'veritrans_items' => $veritrans
		);
//		var_dump($data);exit;
		$this->vendor_class_model->add_new_transaction(
			array(
				'code'		=> $code,
				'subtotal'	=> $total_no_discount,
				'discount'	=> $discount,
				'total'		=> $total,
				'pemesan_id'=> $pemesan_id,
				'student_id'=> $peserta_id,
				'status_1'	=> date('Y-m-d h:i:s')
			)
		);
		
		$data = array_merge($this->data, $data);
		$this->session->set_userdata('transaction', json_encode($data));
//		$this->new_design?
			$this->load->view('payment/transfer/step2_2', $data);
//			$this->load->view('payment/transfer/step2', $data);
	}
	
	public function t_step3free() {
		$code = $this->input->post('code', TRUE);
		$trx = json_decode($this->session->userdata('transaction'), TRUE);
		if($code != $trx['code']) {
			set_status_header(401);
			echo json_encode(array(
				'status'		=> 'KO',
				'data'			=> $trx
			));
			return;
		}
		$this->load->model('payment_model');
		$this->load->model('email_model');

		$this->vendor_class_model->set_participant_status($code, 4);
		$this->vendor_class_model->update_transaction($code, 
				array(
					'status_2'=>date('Y-m-d H:i:s'),
					'status_3'=>date('Y-m-d H:i:s'),
					'status_4'=>date('Y-m-d H:i:s')
				)
		);
		$this->payment_model->create_ticket($code);

		$trx = (array)$this->vendor_class_model->get_transaction($code);

		$pemohon = (array)$this->vendor_class_model->get_sponsor($trx['pemesan_id']);
		$murid = (array)$this->vendor_class_model->get_participant($trx['student_id']);

		$tickets = $this->payment_model->get_ticket_by_invoice($code);
		foreach($tickets as $ticket) {
			$tix = $this->payment_model->get_class_by_ticket($ticket->ticket_code);
			$class = $this->vendor_class_model->get_class(array('id'=>$tix))->row();
			$vendor = $this->vendor_model->get_profile(array('id'=>$class->vendor_id))->row();
			$this->email_model->student_payment_step4($ticket->ticket_code);
			if($this->vendor_class_model->get_class_empty_seat($class->id) == 0) {
				$vendor = $this->vendor_model->get_vendor_detail($class);
				$this->email_model->vendor_class_soldout($vendor, $class);
			}
		}

		$this->load->helper('cookie');
		set_cookie('cart', NULL, '', '', '/');
		//$this->email_model->send_ticket($trx['pemesan']['email'], $code);
		$this->session->unset_userdata('transaction');
		set_status_header(200);
		echo json_encode(array(
			'status'		=> 'OK',
			'data'			=> $trx,
			'tiket'			=> $tickets
		));
		return;
	}
	
	public function t_step3vt() {
		$code = $this->input->post('code', TRUE);
		$trx = json_decode($this->session->userdata('transaction'), TRUE);
		if($code != $trx['code']) {
			set_status_header(401);
			echo json_encode(array(
				'status'		=> 'KO',
				'message'		=> 'Transaction is not found!',
				'data'			=> $trx
			));
			return;
		}
		$method = $this->input->post('method', TRUE);
		switch($method) {
			case 'payment_mandiri'		:
				$bank = 'vt-mandiri';
				break;
			case 'payment_cimb'			:
				$bank = 'vt-cimb';
				break;
			case 'payment_cc'			:
				$bank = 'vt-cc';
				break;
			default:
				$bank = NULL;
				break;
		}
		$this->vendor_class_model->set_participant_status($code, 2);
		$this->vendor_class_model->update_transaction($code, array('status_2'=>date('Y-m-d H:i:s')));
		$this->load->model('email_model');

		$this->email_model->student_payment_step3($code, $bank);
		$this->session->set_userdata('payment_method', $bank);

		$this->session->unset_userdata('transaction');
		$this->load->helper('cookie');
		set_cookie('cart', NULL, '', '', '/');

		header('Content-type: application/json');
		echo json_encode(array(
			'status'		=> 'OK',
			'method'		=> $method
		));
	}
	
	public function t_step3() {
		$code = $this->input->post('code', TRUE);
		$trx = json_decode($this->session->userdata('transaction'), TRUE);
		if($code != $trx['code']) {
			set_status_header(401);
			echo json_encode(array(
				'status'		=> 'KO',
				'data'			=> $trx
			));
			exit;
		}
		$participant = $this->vendor_class_model->get_class_participant($code);
		$row = $participant->row();
		if($this->vendor_class_model->set_participant_status($code, 2)){
			$this->vendor_class_model->update_transaction($code, array('status_2'=>date('Y-m-d H:i:s')));
			$pemesan_id = $row->pemesan_id;
			$this->load->model('email_model');

//			$this->email_model->send_invoice($code);
			$this->session->unset_userdata('transaction');
			if($this->email_model->student_payment_step3($code)) {
				echo json_encode(array(
					'status'		=> 'OK',
					'data'			=> array(
						'code'			=> $code,
						'email'			=> $trx['pemesan']['email']
					)
				));
			} else {
				echo json_encode(array(
					'status'		=> 'OK',
					'data'			=> array(
						'code'			=> $code,
						'email'			=> $trx['pemesan']['email'],
						'warning'		=> 'Failed on delivery!'
					)
				));
			}

//			$this->mail_sender($trx['pemesan']['email'], 'Tagihan dari ruangguru.com', $email_message);
			// kirim email
			return;
		} else {
			set_status_header(400);
			echo json_encode(array(
				'status'		=> 'KO',
			));
		}
		
	}
	
	public function t_reset_transaction() {
		$this->session->unset_userdata('transaction');
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function t_generate_font() {
		$this->load->library('html2pdf');
		$x = $this->html2pdf->pdf->addTTFfont(FCPATH.'assets/fonts/fontawesome-webfont.ttf','TrueTypeUnicode');
		var_dump($x);
	}
	
	public function test() {
		$this->load->model('email_model');
		$c = $this->vendor_class_model->create_invoice('M5JBJ7');
		var_dump($c);
//		if($this->email_model->send_invoice('M5JBJ7')) echo "OK";
//		else echo "KO";
	}
	
	public function ticket() {
//		error_reporting(E_ALL);send_admin_confirmed_payment_message
		$this->load->model('email_model');//
		$c = $this->email_model->send_admin_confirmed_payment_message('M5JBJ7');
		var_dump($c);
	}
	
	public function t_invoice($code) {
		$download = (int)$this->input->get('download',TRUE);
		
		$trx = $this->vendor_class_model->create_invoice($code);
		$data = array(
			'code'		=> $code,
			'data'		=> $trx,
		);
//		var_dump($trx);
		$content = $this->load->view('email/invoice_to_pdf', $data, TRUE);

		$path1 = substr($code, 0,1);
		$path2 = substr($code, 1,1);
		$docs_path = "documents/invoice/{$path1}/{$path2}/";
		if(!is_dir(FCPATH.$docs_path))
			mkdir(FCPATH.$docs_path, 0775, TRUE);
		$this->load->library('html2pdf');
		$this->html2pdf->pdf->SetTitle('INVOICE - '.$code);
		$this->html2pdf->pdf->SetAuthor('Ruangguru.com');
		$this->html2pdf->addFont('fontawesomewebfont');
		$this->html2pdf->WriteHTML($content);

		if($download === 1) {
			$this->html2pdf->Output($code.'.pdf', 'I');
		} else {
			$this->html2pdf->Output(FCPATH.$docs_path.$code.'.pdf', 'F');
			$this->mail_sender('arieditya.prdh@live.com','INVOICE: '.$code,$content, array('arie@ruangguru.com', 'imanusman@gmail.com'), TRUE, NULL, APPPATH.'temp/'.$code.'.pdf');
		}
	}
	
	public function t_confirm($code=NULL) {
		ini_set('upload_max_filesize', '2M');
		$message = '';
		$status = NULL;
		if($this->input->post('code')) {
			$code = $this->input->post('code', TRUE);
			if($this->payment_model->check_invoice($code)) {
				$from = $this->input->post('transfer_from', TRUE);
				$tgl_transfer = $this->input->post('transfer_date', TRUE);
				if($from != '0'){
					$_from = explode('|',$from);
					$from_other = $_from[1];
					$from = (int)$from[0];
				} else {
					$from_other = $this->input->post('transfer_from_other', TRUE);
				}
				$to = (int)$this->input->post('transfer_to', TRUE);
			} else {
				$this->session->set_flashdata('status.warning',
						'Kode invoice tidak ditemukan atau sudah melewati masa berlakunya.');
			}
		}
		if(!empty($code) && !empty($from) && !empty($from_other) && !empty($to)){
			$code = strtoupper($code);
			if(!empty($_FILES['bukti_transfer'])) {
				if( TRUE
						&& empty($_FILES['bukti_transfer']['error']) // no error
						&& is_uploaded_file($_FILES['bukti_transfer']['tmp_name']) // is uploaded correctly
						&& filesize($_FILES['bukti_transfer']['tmp_name']) <= 2097152 // file size bellow 2MB
						&& @getimagesize($_FILES['bukti_transfer']['tmp_name'])
				){
				 	$frst_letter = substr($code, 0, 1);
					$scnd_letter = substr($code, 1, 1);
					$path = strtolower("images/payment/transfer/{$frst_letter}/{$scnd_letter}/{$code}/");
					$to_path = FCPATH.$path;
					$filename = explode('.',$_FILES['bukti_transfer']['name']);
					$ext = array_pop($filename);
					if(!is_dir($to_path)) mkdir($to_path, 0777, TRUE);
					$file = strtolower('bukti_transfer.'.$ext);
					move_uploaded_file($_FILES['bukti_transfer']['tmp_name'], "{$to_path}{$file}");
					$mime = mime_content_type($to_path.$file);
					$img_data = base64_encode(file_get_contents($to_path.$file));
					$img_source = 'data:'.$mime.';base64,'.$img_data;
					$img_path = base_url().$path.$file;
				} else {
					/*
					var_dump(array(
						$_FILES['bukti_transfer']['error'],
						is_uploaded_file($_FILES['bukti_transfer']['tmp_name']),
						filesize($_FILES['bukti_transfer']['tmp_name']),
						getimagesize($_FILES['bukti_transfer']['tmp_name'])
					));
					// */
				}
			}
			if($this->vendor_class_model->set_participant_status($code, 3)){
				$update_data = array(
						'status_3'=>$tgl_transfer.' '.date('H:i:s'),
						'status_3_bank_from'=>$from,
						'status_3_bank_from_other'=>$from_other,
						'status_3_bank_to'=>$to,
						'status_3_upload_file'=>!empty($file)?$file:''
				);
				$this->vendor_class_model->update_transaction($code, $update_data);
				$trx = $this->vendor_class_model->get_transaction($code);
				$pemesan = $this->vendor_class_model->get_class_pemesan($trx->pemesan_id);
				$peserta = $this->vendor_class_model->get_class_peserta($trx->student_id);
				$participant = $this->vendor_class_model->get_class_participant($code);

				$email_data = array(
					'code'		=> $code,
					'trx'		=> $trx,
					'bank_from'	=> $from,
					'bank_to'	=> $to,
					'file'		=> !empty($file)?$file:'',
					'bank_from_other'	=> $from_other,
					'pemesan'	=> $pemesan,
					'peserta'	=> $peserta,
					'img_src'	=> empty($img_source)?'':$img_source,
					'img_path'	=> empty($img_path)?'':$img_path,
					'detail'	=> array(),
				);
				$detil_transaksi = '';
				$class = array();
				foreach($participant->result() as $part) {
					$sched = $this->vendor_class_model->get_class_schedule(array('jadwal_id' => $part->jadwal_id))->row();
					if(empty($class[$part->class_id]))
						$class[$part->class_id] = $this->vendor_class_model->get_class(array(
								'id'=>$part->class_id,
								'class_status >=' => NULL, 
								'active'=>NULL))->row();
//					var_dump($class);exit;
					$kelas = $class[$part->class_id];
					$waktu = $sched->class_tanggal.', '.$sched->class_jam_mulai.':'.$sched->class_menit_mulai.' s/d '.$sched->class_jam_selesai.':'.$sched->class_menit_selesai;
					$email_data['detail'][] = array(
						'kelas'		=> $kelas,
						'sched'		=> $sched,
						'waktu'		=> $waktu
					);
					$detil_transaksi .= "
KELAS: 
[ID: {$kelas->id}] {$kelas->class_nama} (Rp. {$kelas->price_per_session})
JADWAL: 
[ID: {$sched->jadwal_id}] {$sched->class_jadwal_topik} 
({$waktu})
";
				}
				$status = TRUE;
				$email_message = "
TRX CODE: {$code}

PEMESAN: {$pemesan->name} ({$pemesan->email}) - {$pemesan->phone}
PESERTA: {$peserta->name} ({$peserta->email}) - {$peserta->phone}

SUB TOTAL TRANSAKSI: Rp. ($trx->subtotal)
DISKON             : Rp. ($trx->discount)
==========================================
TOTAL TRANSAKSI    : Rp. ($trx->total)

STATUS 1 (USER CHECKOUT): {$trx->status_1}
STATUS 2 (INVOICE SENT) : {$trx->status_2}
STATUS 3 (USER CONFIRM) : {$trx->status_3}

DETIL TRANSAKSI:
{$detil_transaksi}
";
				$message = 'Konfirmasi berhasil! Petugas ops kami akan segera memproses transaksi anda! Terima kasih.';
				$html_message = $this->load->view('email/payment_confirmation', $email_data, TRUE);
				$this->mail_sender(
						'kelas@ruangguru.com',
						'Konfirmasi Transaksi: '.$code,
						$html_message, 
						array(
							'arie@ruangguru.com',
							'daniel@ruangguru.com',
							'uun@ruangguru.com'
						), 
						TRUE,
						$email_message, 
						$to_path.$file
				);
				$code = NULL;
			} else {
				$status = FALSE;
				$message = 'Konfirmasi Gagal! Coba ulangi kembali kode konfirmasi anda, apabila masih gagal, hubungi petugas kami di: 021.9300.3040. Terima kasih.';
			}
		}
		$this->load->model('vendor_model');
		$data = array(
			'code'	=> $code,
			'message'=> $message,
			'status'=> $status
		);
		$data['bank_list'] = $this->vendor_model->get_bank_list();
		$data = array_merge($this->data, $data);
		$this->load->view('payment/transfer/confirm', $data);
	}
	
	protected function mail_sender($to, $subject, $message, $cc = NULL, $is_html=FALSE, $alt_message='', $attach=''){
		$this->load->library('email');
		$config['useragent'] = 'Ruangguru DevMail Service';
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'mail.ruangguru.com';
		$config['smtp_port'] = 25;
		$config['smtp_user'] = 'no-reply@ruangguru.com';
		$config['smtp_pass'] = $this->config->item('smtp_password');
		$config['priority'] = 1;
		$config['mailtype'] = $is_html?'html':'text';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = FALSE; 
		$this->email->initialize($config);
		$this->email->from('no-reply@ruangguru.com', 'Ruangguru.com');
		$this->email->to($to);
		if(!empty($cc)) {
			$this->email->cc($cc);
		}
		
		$this->email->subject($subject);
		$content = $message;
		$this->email->message($content);
		if(!empty($alt_message))
			$this->email->set_alt_message($alt_message);
	
		if(!empty($attach))
			$this->email->attach($attach);
		$this->email->send();
//		var_dump($this->email->print_debugger());exit;
	} 
	
	public function t_checkout($type, $uri) {
		switch($type){
			case		'kelas':
				$this->load->model('vendor_class_model');
				$class = $this->vendor_class_model->get_class(array('class_uri'=>$uri))->row();
				if(empty($class)) show_404();

				$sched = $this->vendor_class_model->get_class_available_session($class->id);
				$total_schedule = $this->vendor_class_model->get_class_schedule(array('class_id'=>$class->id))->num_rows();

				if($total_schedule>$sched->num_rows()) $class->discount = 0;
				
				$template = $this->load->view('template/payment_checkout_class', array(), TRUE);
				$template = str_replace('%%CLASS_DESC%%', $class->class_deskripsi, $template);
				$template = str_replace('%%CLASS_NAME%%', $class->class_nama, $template);
				$template = str_replace('%%CLASS_URI%%', $class->class_uri, $template);
				$template = str_replace('%%PRICE_SUBTOTAL%%', $class->class_harga, $template);
				$template = str_replace('%%QUANTITY%%', $sched->num_rows(), $template);
				$template = str_replace('%%DISCOUNT%%', $class->discount, $template);
				$template = str_replace('%%PRICE_TOTAL%%', $class->class_harga * $sched->num_rows(), $template);
				
				break;
		}
		$this->load->view('template/payment_checkout', array('template'=>$template));
	}
	
	
	protected function t_construct() {
		$this->data['user']['type'] = $this->session->userdata('user_type');
		$this->data['user']['name'] = $this->session->userdata('user_name');
		$this->data['user']['email'] = $this->session->userdata('user_email');
		$this->data['user']['id'] = $this->session->userdata('user_id');
		
	}
	
	public function t_auth() {
		
	}
	
	public function t_login() {
		
	}
	
	public function t_register() {
		$raw_password = hashgenerator(7, 'safe', 1);
		$password = md5($raw_password);
		$verification_code = hashgenerator(20, 'hex', 1);
		
	}
	
	public function t_anonymous() {
		$generated_id = hashgenerator(7, 'alphabet', 1);
		$id = $generated_id[0];
		
		
	}
	
	public function t_transaction() {
		if(empty($this->data['user']['id'])) {
			redirect(base_url('payment/transfer/auth'));
		}
	}
	
	
//	public function 
     public function checkout(){
        $this->load->view('header');
        $this->load->view('front/payment/checkout');
        $this->load->view('footer');
    }    

	public function notification(){
		header('Content-type: application/json');
		$this->session->unset_userdata('transaction');
		$this->load->helper('file');
		$this->load->model('email_model');
		$data = json_decode(file_get_contents('php://input'));
		if(empty($data) || empty($data->order_id)){
			set_status_header(400, 'Format not right!');
			echo json_encode(array(
				'status'		=> 'KO',
				'message'		=> 'Notification format not right!!'
			));
			return;
		}
		$code = $data->order_id;
		$path1 = substr($code, 0,1);
		$path2 = substr($code, 1,1);
		$docs_path = "documents/invoice/{$path1}/{$path2}/";
		if(!is_dir(FCPATH.$docs_path))
			mkdir(FCPATH.$docs_path, 0775, TRUE);

		if(write_file(FCPATH.$docs_path.'vt-'.$code.'.json',json_encode($data),'w')) {

		} else {

		}
		
		$invoice = $this->vendor_class_model->get_invoice_status($code);
		if(empty($invoice)) {
			set_status_header(404, 'Invoice code not found');
			echo json_encode(array(
				'status'		=> 'KO',
				'message'		=> 'Invoice code not found!'
			));
			return;
		}
		
		$this->vendor_class_model->set_participant_status($code, 4);
			$update_data = array(
					'status_4'=>date('Y-m-d H:i:s'),
					'status_3_upload_file'=>'vt-'.$code.'.json',
					'status_4_approval'=>1
			);
			$this->vendor_class_model->update_transaction($code, $update_data);

			$this->payment_model->create_ticket($code);
			$trx = (array)$this->vendor_class_model->get_transaction($code);
	
			$pemohon = (array)$this->vendor_class_model->get_sponsor($trx['pemesan_id']);
			$murid = (array)$this->vendor_class_model->get_participant($trx['student_id']);
	
			$tickets = $this->payment_model->get_ticket_by_invoice($code);
			foreach($tickets as $ticket) {

				$this->email_model->student_payment_step4($ticket->ticket_code);
				
				

				$tix = $this->payment_model->get_class_by_ticket($ticket->ticket_code);
				$class = $this->vendor_class_model->get_class(array('id'=>$tix))->row();
				$vendor = $this->vendor_model->get_profile(array('id'=>$class->vendor_id))->row();
				$this->email_model->student_payment_step4($ticket->ticket_code);
				if($this->vendor_class_model->get_class_empty_seat($class->id) == 0) {
					$vendor = $this->vendor_model->get_vendor_detail($class);
					$this->email_model->vendor_class_soldout($vendor, $class);
				}
			}
			echo json_encode(array(
				'status'		=> 'OK'
			));
		
	
//		$this->load->view('header');
//		$this->load->view('front/payment/notification');
//		$this->load->view('footer');
	}
	
	public function check_notification() {
		//$data = file_get_contents(FCPATH.'test.payment.log');
		//var_dump($data);
		
		$inputJSON = file_get_contents('php://input');
		$input= json_decode( $inputJSON, TRUE );
		
		var_dump($input);
	    }
    
	public function finish(){
		$code = $this->input->get('order_id', TRUE);
		$trx_code = $this->input->get('status_code',TRUE);
		$transaction_status = $this->input->get('transaction_status', TRUE);
		
		$this->data['code'] = $code;
		$this->data['trx_code'] = $code;
		$this->data['transaction_status'] = $transaction_status;
		$bank = $this->session->userdata('payment_method');

		if($this->vendor_class_model->set_participant_status($code, 3)){
			$update_data = array(
					'status_3'=>date('Y-m-d H:i:s'),
					'status_3_bank_from'=>0,
					'status_3_bank_from_other'=>$bank,
					'status_3_bank_to'=>0,
					'status_3_upload_file'=>!empty($file)?$file:''
			);
			$this->vendor_class_model->update_transaction($code, $update_data);
			
			$this->session->unset_userdata('transaction');
			$this->load->helper('cookie');
			set_cookie('cart', NULL, '', '', '/');

			$this->load->view('front/payment/finish2', $this->data);
		} else {
			show_error('Data has already saved!',500, 'Transaction code exists!');
		}

	}
    
     public function unfinish(){
        $this->load->view('header');
        $this->load->view('front/payment/unfinish');
        $this->load->view('footer');
    }
    
     public function error(){
        $this->load->view('header');
        $this->load->view('front/payment/error');
        $this->load->view('footer');
    }
}