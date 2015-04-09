<?php if(!defined('BASEPATH')) die('Die already!');
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 2/5/15
 * Time: 10:40 AM
 * Proj: prod-new
 */
class Teacher_driven extends Admin_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/admin_model');
		$this->load->model('vendor_model');
		$this->load->model('vendor_class_model');
		$this->load->model('payment_model');
		error_reporting(E_ALL);
	}
	
	public function index() {
		$data['active'] = 500;
	}
	
	public function vendor_confirm() {
		$data['active'] = 511;
		$data['breadcumb'] = $this->admin_model->get_breadcumb(array('Teacher Driven'=>'teacher_driven',
																	 'Vendor'=>'teacher_driven/vendor_list',
																	 'Register Confirmation'=> 'vendor_confirm'));
		$data['vendor'] = $this->vendor_model->get_new_register_vendor();
		$data['content'] = $this->load->view('admin/teacher_driven/vendor_list',$data,TRUE);
		$this->load->view('admin/admin_v',$data);
	}
	
	public function do_vendor_confirm($id) {
		$id = (int) $id;
		$referer = array_pop(explode('/',$_SERVER['HTTP_REFERER']));
		if( ! method_exists($this, $referer)) show_error('unauthorized call of function!', 401);
		if($this->vendor_model->approve_vendor($id)){
			$this->load->model('email_model');
			$vendor = $this->vendor_model->get_vendor_detail($id);
			$this->email_model->admin_approved_vendor($vendor->email);
		}
		redirect('admin/teacher_driven/'.$referer);
	}

	public function reject_vendor_confirm($id) {
		$id = (int) $id;
		$referer = array_pop(explode('/',$_SERVER['HTTP_REFERER']));
		if( ! method_exists($this, $referer)) show_error('unauthorized call of function!', 401);
		if($this->vendor_model->reject_vendor($id)){
			$this->load->model('email_model');
			$vendor = $this->vendor_model->get_vendor_detail($id);
			$this->email_model->admin_rejected_vendor($vendor->email);
		}
		redirect('admin/teacher_driven/'.$referer);
	}

	public function deactivate_vendor($id) {
		$id = (int) $id;
		$referer = array_pop(explode('/',$_SERVER['HTTP_REFERER']));
		if( ! method_exists($this, $referer)) show_error('unauthorized call of function!', 401);
		$this->vendor_model->deactivate_vendor($id);
		redirect('admin/teacher_driven/'.$referer);
	}

	public function vendor_search() {
		$keywords = $this->input->get('vendor_name', TRUE);
		$keyword = explode(' ', $keywords);

		$data['active'] = 500;
		$data['breadcumb'] = $this->admin_model->get_breadcumb(array('Teacher Driven'=>'teacher_driven',
																	 'Vendor'=>'teacher_driven/vendor_list',
																	 'Search'=> 'teacher_driven/vendor_search'));
		$data['vendor'] = $this->vendor_model->vendor_search($keyword);
		$data['content'] = $this->load->view('admin/teacher_driven/vendor_list',$data,TRUE);
		$this->load->view('admin/admin_v',$data);
	}

	public function vendor_list() {
		$data['active'] = 510;
		$data['breadcumb'] = $this->admin_model->get_breadcumb(array('Teacher Driven'=>'teacher_driven',
																	 'Vendor'=>'teacher_driven/vendor_list'));
		$data['vendor'] = $this->vendor_model->get_all_vendor();
		$data['content'] = $this->load->view('admin/teacher_driven/vendor_list',$data,TRUE);
		$this->load->view('admin/admin_v',$data);
	}
	
	public function get_vendor_detail($id) {
		$vendor = $this->vendor_model->get_vendor_detail($id);
		if($vendor) {
			header('HTTP/1.1 200 OK');
			header('Content-type: application/json');
			echo json_encode(array(
				'status'	=> 'OK',
				'data'		=> $vendor,
				'message'	=> 'Vendor found!'
			));
		} else {
			header('HTTP/1.1 404 Not Found');
			header('Content-type: application/json');
			echo json_encode(array(
				'status'	=> 'KO',
				'data'		=> array(),
				'message'	=> 'Vendor NOT found!'
			));
		}
	}
	
	public function class_confirm() {
		$data['active'] = 521;
		$data['breadcumb'] = $this->admin_model->get_breadcumb(array('Teacher Driven'=>'teacher_driven',
																	 'Class'=>'teacher_driven/class_list',
																	 'Register Confirmation'=> 'class_confirm'));
		$class = $this->vendor_class_model->get_class(array(
				'class_status >='	=> NULL,
				'active'		=> '0'
		))->result();
		
		foreach($class as &$cls) {
			$cls->vendor_name = $this->vendor_model->get_profile(array('id'=>$cls->vendor_id))->row()->name;
			$cls->category_name = $this->vendor_class_model->get_category(array('id'=>$cls->category_id))->row()
					->category_name;
			$cls->level_name = $this->vendor_class_model->get_level_name(array('id'=>$cls->level_id))->row();
			if(!empty($cls->level_name)) $cls->level_name = $cls->level_name->nama;
			else $cls->level_name = 'None!';
			$cls->session_count = $this->vendor_class_model->get_class_schedule(array('class_id'=>$cls->id))
					->num_rows();
//			var_dump($cls);exit;
		}
		$data['class'] = $class;
		
//		vaR_dump($data['class']->result());exit;
		$data['content'] = $this->load->view('admin/teacher_driven/class_list',$data,TRUE);
		$this->load->view('admin/admin_v',$data);
	}
	
	public function do_class_confirm($id) {
		$referer = array_pop(explode('/',$_SERVER['HTTP_REFERER']));
		if( ! method_exists($this, $referer)) show_error('unauthorized call of function!', 401);
		$status = $this->vendor_class_model->set_status_class($id, 1);
		
		$this->session->set_flashdata($status?
				array('f_class'=>'Class confirmed!')
				:array('f_class_error'=>'Class NOT confirmed!'));
		redirect('admin/teacher_driven/'.$referer);
	}
	
	public function class_featured() {
		$data['active'] = 524;
		$data['breadcumb'] = $this->admin_model->get_breadcumb(array('Teacher Driven'=>'teacher_driven',
																	 'Class'=>'teacher_driven/class_list',
																	 'Featured Class'=> 'class_featured'));
		// Featured Class must be active published!
		$class = $this->vendor_class_model->get_class(array(),0,0)->result();
		
		$featured = $this->vendor_class_model->get_featured_class()->result();
		$feature_class = array();
		foreach($featured as $f) {
			$feature_class[] = $this->vendor_class_model->get_class(array('id'=>$f->class_id),0,0)->row();
		}
		
		$data['class'] = $class;
		$data['featured'] = $feature_class;
		
//		vaR_dump($data['class']->result());exit;
		$data['content'] = $this->load->view('admin/teacher_driven/featured_class_list',$data,TRUE);
		$this->load->view('admin/admin_v',$data);
	}
	
	public function set_class_featured($id) {
		$this->vendor_class_model->set_featured_id($id, 0);
		redirect('admin/teacher_driven/class_featured');
	}
	
	public function unset_class_featured($id) {
		$this->vendor_class_model->deactivate_featured($id);
		redirect('admin/teacher_driven/class_featured');
	}
	
	public function featured_reorder() {
		$sort = $_GET['sort'];
		foreach($sort as $s => $id) {
			$this->vendor_class_model->set_featured_id($id, $s+1);
		}
		redirect('admin/teacher_driven/class_featured');
	}
	
	public function deactivate_class($id) {
		$referer = array_pop(explode('/',$_SERVER['HTTP_REFERER']));
		if( ! method_exists($this, $referer)) show_error('unauthorized call of function!', 401);
		$this->vendor_class_model->set_published_class($id, 0);
		$status = $this->vendor_class_model->set_status_class($id, -1);
		if($status) {
			$class = $this->vendor_class_model->get_class(array('id'=>$id, 
																'class_status >=' => NULL, 
																'active'=>NULL))->row();
			$vendor = $this->vendor_model->get_vendor_detail($class->vendor_id);
			$this->email_model->vendor_create_class_rejected($vendor, $class);
		}
		$this->session->set_flashdata($status?
				array('f_class'=>'Class deactivated!')
				:array('f_class_error'=>'Class NOT deactivated!'));
		redirect('admin/teacher_driven/'.$referer);
	}
	
	public function reject_class_confirm($id) {
		$referer = array_pop(explode('/',$_SERVER['HTTP_REFERER']));
		if( ! method_exists($this, $referer)) show_error('unauthorized call of function!', 401);
		$this->vendor_class_model->set_published_class($id, 0);
		$status = $this->vendor_class_model->set_status_class($id, -1);
		if($status) {
			$class = $this->vendor_class_model->get_class(array('id'=>$id, 
																'class_status >=' => NULL, 
																'active'=>NULL))->row();
			$vendor = $this->vendor_model->get_vendor_detail($class->vendor_id);
			$this->email_model->vendor_create_class_rejected($vendor, $class);
		}
		$this->session->set_flashdata($status?
				array('f_class'=>'Class rejected!')
				:array('f_class_error'=>'Class NOT rejected!'));
		redirect('admin/teacher_driven/'.$referer);
	}
	
	public function approve_unpublish_class($id) {
		$referer = array_pop(explode('/',$_SERVER['HTTP_REFERER']));
		if( ! method_exists($this, $referer)) show_error('unauthorized call of function!', 401);
		$status1 = $this->vendor_class_model->set_published_class($id, 0);
		if($status1) {
			$status2 = $this->vendor_class_model->set_status_class($id, 1);
			if($status2) $status = array('f_class'	=> 'Class is unpublished!');
			else $status = array('f_class_error'	=> 'Class unpublished but failed to change status!');
		} else $status = array('f_class_error'	=> 'Class STILL Published!');
		$this->session->set_flashdata($status);
		redirect('admin/teacher_driven/'.$referer);
	}
	
	public function reject_unpublish_class($id) {
		$referer = array_pop(explode('/',$_SERVER['HTTP_REFERER']));
		if( ! method_exists($this, $referer)) show_error('unauthorized call of function!', 401);
		$status = $this->vendor_class_model->set_status_class($id, 1);
		if($status) $status = array('f_class'	=> 'Class Unpublished Rejected!');
		else $status = array('f_class_error'	=> 'Class Unpublished FAILED to be rejected!');
		$this->session->set_flashdata($status);
		redirect('admin/teacher_driven/'.$referer);
	}
	
	public function approve_publish_class($id) {
		$referer = array_pop(explode('/',$_SERVER['HTTP_REFERER']));
		if( ! method_exists($this, $referer)) show_error('unauthorized call of function!', 401);
		$status1 = $this->vendor_class_model->set_published_class($id, 1);
		
		if($status1) {
			$status2 = $this->vendor_class_model->set_status_class($id, 1);
			if($status2) {
				$this->load->model('email_model');
				$this->email_model->vendor_class_published($id);
				$status = array('f_class'	=> 'Class is published!');
				$class = $this->vendor_class_model->get_class(array('id'=>$id, 
																	'class_status >=' => NULL, 
																	'active'=>NULL))->row();
				$vendor = $this->vendor_model->get_vendor_detail($class->id);
//				$this->email_model->vendor_class_published($vendor, $class);
			}
			else $status = array('f_class_error'	=> 'Class unpublished but status remain.');
		} else $status = array('f_class_error'	=> 'Class STILL Unpublished!');
		$this->session->set_flashdata($status);
		redirect('admin/teacher_driven/'.$referer);
	}
	
	public function reject_publish_class($id) {
		$referer = array_pop(explode('/',$_SERVER['HTTP_REFERER']));
		if( ! method_exists($this, $referer)) show_error('unauthorized call of function!', 401);
		$status = $this->vendor_class_model->set_status_class($id, 1);
		if($status) $status = array('f_class'	=> 'Class Published Rejected!');
		else $status = array('f_class_error'	=> 'Class Published FAILED to be rejected!');
		$this->session->set_flashdata($status);
		redirect('admin/teacher_driven/'.$referer);
	}
	
	public function force_publish_class($id) {
		$referer = array_pop(explode('/',$_SERVER['HTTP_REFERER']));
		if( ! method_exists($this, $referer)) show_error('unauthorized call of function!', 401);
		$status = $this->vendor_class_model->set_published_class($id, 1);
		if($status) $status = array('f_class'	=> 'Class Published!');
		else $status = array('f_class_error'	=> 'Class FAILED to be published!');
		$this->session->set_flashdata($status);
		redirect('admin/teacher_driven/'.$referer);
	}
	
	public function force_unpublish_class($id) {
		$referer = array_pop(explode('/',$_SERVER['HTTP_REFERER']));
		if( ! method_exists($this, $referer)) show_error('unauthorized call of function!', 401);
		$status = $this->vendor_class_model->set_published_class($id, 0);
		if($status) $status = array('f_class'	=> 'Class Unpublished!');
		else $status = array('f_class_error'	=> 'Class FAILED to be unpublished!');
		$this->session->set_flashdata($status);
		redirect('admin/teacher_driven/'.$referer);
	}
	
	public function class_list() {
		$data['active'] = 521;
		$data['breadcumb'] = $this->admin_model->get_breadcumb(array('Teacher Driven'=>'teacher_driven',
																	 'Class'=>'teacher_driven/class_list'
		));
		$class = $this->vendor_class_model->get_class(
				array(
					'class_status >='	=> NULL,
					'active'		=> NULL
				),0,0)->result();
		foreach($class as &$cls) {
			$cls->vendor_name = $this->vendor_model->get_profile(array('id'=>$cls->vendor_id))->row()->name;
			$cls->category_name = $this->vendor_class_model->get_category(array('id'=>$cls->category_id))->row()
					->category_name;
			$lvl = $this->vendor_class_model->get_level_name(array('id'=>$cls->level_id))->row();
			if(!empty($lvl))$cls->level_name = $lvl->nama;
			else $cls->level_name = 'Level belum terpilih!';
			$cls->session_count = $this->vendor_class_model->get_class_schedule(array('class_id'=>$cls->id))
					->num_rows();
//			var_dump($cls);exit;
		}
		$data['class'] = $class;
		
//		vaR_dump($data['class']->result());exit;
		$data['content'] = $this->load->view('admin/teacher_driven/class_list',$data,TRUE);
		$this->load->view('admin/admin_v',$data);
	}
	
	public function get_class_detail($id) {
		$class = $this->vendor_class_model->get_class(array(
				'class_status >='	=> NULL,
				'active'			=> NULL,
				'id'				=> $id
		))->row();
		if($class) {
			header('HTTP/1.1 200 OK');
			header('Content-type: application/json');
			echo json_encode(array(
				'status'	=> 'OK',
				'data'		=> $class,
				'message'	=> 'Class found!'
			));
		} else {
			header('HTTP/1.1 404 Not Found');
			header('Content-type: application/json');
			echo json_encode(array(
				'status'	=> 'KO',
				'data'		=> array(),
				'message'	=> 'Class NOT found!'
			));
		}
	}
	
	public function class_mail() {
		
	}
	
	public function get_class_mail_detail() {
		
	}
	
	public function class_discount() {
		
	}
	
	public function get_class_discount_detail(){
		
	}
	
	public function class_attendance() {
		$data['active'] = 531;
		$data['breadcumb'] = $this->admin_model->get_breadcumb(array('Teacher Driven'=>'teacher_driven',
																	 'Class'=>'teacher_driven/class_list',
																	 'Attendance'=>'teacher_driven/class_attendance'
		));
		$class = $this->vendor_class_model->get_class(array(
				'class_status >='	=> NULL,
				'active'		=> NULL
		),0,0)->result();
		
		foreach($class as &$cls) {
			$cls->vendor_name = $this->vendor_model->get_profile(array('id'=>$cls->vendor_id))->row()->name;
			$cls->category_name = $this->vendor_class_model->get_category(array('id'=>$cls->category_id))->row()
					->category_name;
			$level = $this->vendor_class_model->get_level_name(array('id'=>$cls->level_id));
			if(empty($level) || $level->num_rows() == 0) {
				$cls->level_name = '';
			} else {
				$cls->level_name = $level->row()->nama;
			}
			
			$cls->session_count = $this->vendor_class_model->get_class_schedule(array('class_id'=>$cls->id))
					->num_rows();
			$cls->attendance = $this->vendor_class_model->get_class_participant_full($cls->id, 0);
			$cls->attendance_register = $this->vendor_class_model->get_class_participant_full($cls->id, '<= 3');
			$cls->attendance_paid = $this->vendor_class_model->get_class_participant_full($cls->id, 4);
//			var_dump($cls);exit;
		}
		$data['class'] = $class;
		
//		vaR_dump($data['class']->result());exit;
		$data['content'] = $this->load->view('admin/teacher_driven/class_attendance_list',$data,TRUE);
		$this->load->view('admin/admin_v',$data);
	}
	
	public function get_class_attendance_detail() {
		
	}
	
	public function invoice_search() {
		$data['active'] = 541;
		$data['breadcumb'] = $this->admin_model->get_breadcumb(array('Teacher Driven'=>'teacher_driven',
																	 'Payment'=>'teacher_driven/payment_invoice',
																	 'Invoice'=>''
		));
		$code = $this->input->post('invoice_code', TRUE);
		$invoice = $this->vendor_class_model->search_invoice($code);
		
		$data['invoice'] = $invoice;
		$data['student'] = $this->vendor_class_model->get_participant_all();
		$data['pemesan'] = $this->vendor_class_model->get_sponsor_all();
		
//		vaR_dump($data['class']->result());exit;
		$data['content'] = $this->load->view('admin/teacher_driven/payment_invoice',$data,TRUE);
		$this->load->view('admin/admin_v',$data);
	}
	
	public function payment_invoice() {
		$data['active'] = 541;
		$orderby = $this->input->get('orderby', TRUE);
		$sort = $this->input->get('sort');
		$data['breadcumb'] = $this->admin_model->get_breadcumb(array('Teacher Driven'=>'teacher_driven',
																	 'Payment'=>'teacher_driven/payment_invoice',
																	 'Invoice'=>''
		));
		if(empty($orderby) || !in_array($orderby, array('status_2','code','status'))) {
			$invoice = $this->vendor_class_model->get_transaction_all();
		} else {
			$data['orderby'] = $orderby;
			if(!empty($sort) && in_array(strtoupper($sort), array('ASC','DESC'))) $data['sort'] = strtoupper($sort);
			else $sort = 'DESC';
			$invoice = $this->vendor_class_model->get_transaction_all($orderby, $sort);
		}

		$data['invoice'] = $invoice;
		$data['student'] = $this->vendor_class_model->get_participant_all();
		$data['pemesan'] = $this->vendor_class_model->get_sponsor_all();
		
//		vaR_dump($data['class']->result());exit;
		$data['content'] = $this->load->view('admin/teacher_driven/payment_invoice',$data,TRUE);
		$this->load->view('admin/admin_v',$data);
	}
	
	public function get_payment_invoice_detail() {
		
	}
	
	public function payment_confirm() {
		$data['active'] = 541;
		$data['breadcumb'] = $this->admin_model->get_breadcumb(array('Teacher Driven'=>'teacher_driven',
																	 'Payment'=>'teacher_driven/payment_invoice',
																	 'Invoice'=>''
		));
		
		$invoice = $this->vendor_class_model->get_confirm_payment_transfer();
		$data['invoice'] = $invoice;
		
//		vaR_dump($data['class']->result());exit;
		$data['content'] = $this->load->view('admin/teacher_driven/payment_confirmation',$data,TRUE);
		$this->load->view('admin/admin_v',$data);
	}
	
	public function ticket_list() {
		$data['active'] = 551;
		$data['breadcumb'] = $this->admin_model->get_breadcumb(array('Teacher Driven'=>'teacher_driven',
																	 'Ticket'=>'teacher_driven/ticket_list'
		));
		$orderby = $this->input->get('orderby',TRUE);
		$sort = $this->input->get('sort',TRUE);
		$code = $this->input->get('ticket_code', TRUE);
		$ticket = $this->vendor_class_model->get_all_ticket($orderby, $sort, $code);
		$data['ticket'] = $ticket;
		$data['code'] = $code;
		$data['orderby'] = $orderby;
		$data['sort'] = $sort;
		
//		vaR_dump($data['class']->result());exit;
		$data['content'] = $this->load->view('admin/teacher_driven/ticket_list',$data,TRUE);
		$this->load->view('admin/admin_v',$data);
	}
	
	public function ticket_search() {
		$data['active'] = 551;
		$data['breadcumb'] = $this->admin_model->get_breadcumb(array('Teacher Driven'=>'teacher_driven',
																	 'Ticket'=>'teacher_driven/ticket_list'
		));
		$orderby = $this->input->get('orderby',TRUE);
		$sort = $this->input->get('sort',TRUE);
		$code = $this->input->get('ticket_code', TRUE);
		$ticket = $this->vendor_class_model->search_ticket($code);
		$data['ticket'] = $ticket;
		$data['orderby'] = $orderby;
		$data['sort'] = $sort;
		
//		vaR_dump($data['class']->result());exit;
		$data['content'] = $this->load->view('admin/teacher_driven/ticket_list',$data,TRUE);
		$this->load->view('admin/admin_v',$data);
	}
	
	public function resend_ticket($code) {
		$referer = array_pop(explode('/',empty($_SERVER['HTTP_REFERER'])?'empty':$_SERVER['HTTP_REFERER']));
		if( ! method_exists($this, array_shift(explode('?',$referer)))) 
			show_error('unauthorized call of function!', 401);
		$this->email_model->student_payment_step4($code, TRUE);
		$status = array('f_class'	=> 'Email Sent!');
		$this->session->set_flashdata($status);
		redirect('admin/teacher_driven/'.$referer);
	}
	
	public function do_payment_confirm($code) {
		$this->load->model('email_model');
		$this->load->model('vendor_class_model');

		if(!$this->vendor_class_model->set_confirm_payment_transfer($code)) {
			$this->session->set_flashdata('f_class_error', 'Failed To Confirm Payment!');
			redirect('admin/teacher_driven/payment_confirm');
			return FALSE;
		}
		$this->payment_model->create_ticket($code);
		$trx = (array)$this->vendor_class_model->get_transaction($code);

		$pemohon = (array)$this->vendor_class_model->get_sponsor($trx['pemesan_id']);
		$murid = (array)$this->vendor_class_model->get_participant($trx['student_id']);

		$tickets = $this->payment_model->get_ticket_by_invoice($code);
		foreach($tickets as $ticket) {
			$tix = $this->payment_model->get_class_by_ticket($ticket->ticket_code);
			$class = $this->vendor_class_model->get_class(array('id'=>$tix))->row();
			$this->email_model->student_payment_step4($ticket->ticket_code);
			if($this->vendor_class_model->get_class_empty_seat($class->id) == 0) {
				$vendor = $this->vendor_model->get_vendor_detail($class);
				$this->email_model->vendor_class_soldout($vendor, $class);
			}
		}
		$this->session->set_flashdata('f_class', 'Payment Confirmed!');
/*
		if($this->email_model->send_admin_confirmed_payment_message($code)){
			//$this->vendor_class_model->get_class_empty_seat()
			foreach($this->vendor_class_model->get_class_from_invoice($code) as $class) {
			}
		} else {
			$this->session->set_flashdata('f_class_error', 'Failed To Confirm Payment!');
		}
// */
		redirect('admin/teacher_driven/payment_confirm');
	}
	
	public function reject_payment_confirm($code) {
		$this->load->helper('file');
		$this->vendor_class_model->reject_payment_confirmation($code);
		// TODO: Send email that you've failed them!
		redirect('admin/teacher_driven/payment_confirm');
	}

	public function do_class_sold_out($class_id) {
		if($this->vendor_class_model->class_sold_out($class_id))
			$this->session->set_flashdata('f_class', 'Update Class SUCCESS!');
		else
			$this->session->set_flashdata('f_class_error', 'Update Class FAILED!');
		redirect('admin/teacher_driven/class_list');
	}
	
	public function expired_invoices($file=NULL) {
		$this->load->helper('file');
		$config =& get_config();
		$_log_path = FCPATH.(($config['log_path'] != '') ? $config['log_path'] : APPPATH.'logs');

		$log_path = str_replace('/administrator','',$_log_path).'/invoice_expire/';

		if(empty($file)) {
			$files = get_filenames($log_path);
			foreach($files as $file) {
				echo "<a href='".base_url()."admin/teacher_driven/expired_invoices/{$file}'>{$file}</a><br />";
			}
		} else {
			$file_path = $log_path.$file;
			if (($handle = fopen($file_path, "r")) !== FALSE) {
				$first = TRUE;
				$key = array();
				$data = array();
				$num = 0;
				while (($datas = fgetcsv($handle, 0, ",")) !== FALSE) {
					if($first) {
						$key = $datas;
						$num = count($key);
					} else {
						$dt = array();
						for($i = 0; $i < $num; $i++) {
							$dt[$key[$i]] = $datas[$i];
						}
						$data[] = $dt;
					}
					$first = FALSE;
				}
				fclose($handle);
			}
			print_r($data);
		}
	}
}

// END OF teacher_driven.php File