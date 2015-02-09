<?php if(!defined('BASEPATH')) die('Die already!');
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 2/5/15
 * Time: 10:40 AM
 * Proj: prod-new
 */
class Teacher_driven extends MY_Controller{
	
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
		redirect('admin/teacher_driver/'.$referer);
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
		redirect('admin/teacher_driver/'.$referer);
	}

	public function deactivate_vendor($id) {
		$id = (int) $id;
		$referer = array_pop(explode('/',$_SERVER['HTTP_REFERER']));
		if( ! method_exists($this, $referer)) show_error('unauthorized call of function!', 401);
		$this->vendor_model->deactivate_vendor($id);
		redirect('admin/teacher_driver/'.$referer);
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
			$cls->level_name = $this->vendor_class_model->get_level(array('id'=>$cls->level_id))->row()
					->name;
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
	
	public function deactivate_class($id) {
		$referer = array_pop(explode('/',$_SERVER['HTTP_REFERER']));
		if( ! method_exists($this, $referer)) show_error('unauthorized call of function!', 401);
		$status = $this->vendor_class_model->set_status_class($id, 0);
		$this->session->set_flashdata($status?
				array('f_class'=>'Class deactivated!')
				:array('f_class_error'=>'Class NOT deactivated!'));
		redirect('admin/teacher_driven/'.$referer);
	}
	
	public function reject_class_confirm($id) {
		$referer = array_pop(explode('/',$_SERVER['HTTP_REFERER']));
		if( ! method_exists($this, $referer)) show_error('unauthorized call of function!', 401);
		$status = $this->vendor_class_model->set_status_class($id, -1);
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
		$class = $this->vendor_class_model->get_class(array(
				'class_status >='	=> NULL,
				'active'		=> NULL
		))->result();
		
		foreach($class as &$cls) {
			$cls->vendor_name = $this->vendor_model->get_profile(array('id'=>$cls->vendor_id))->row()->name;
			$cls->category_name = $this->vendor_class_model->get_category(array('id'=>$cls->category_id))->row()
					->category_name;
			$cls->level_name = $this->vendor_class_model->get_level(array('id'=>$cls->level_id))->row()
					->name;
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
		))->result();
		
		foreach($class as &$cls) {
			$cls->vendor_name = $this->vendor_model->get_profile(array('id'=>$cls->vendor_id))->row()->name;
			$cls->category_name = $this->vendor_class_model->get_category(array('id'=>$cls->category_id))->row()
					->category_name;
			$cls->level_name = $this->vendor_class_model->get_level(array('id'=>$cls->level_id))->row()
					->name;
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
	
	public function payment_invoice() {
		$data['active'] = 541;
		$data['breadcumb'] = $this->admin_model->get_breadcumb(array('Teacher Driven'=>'teacher_driven',
																	 'Payment'=>'teacher_driven/payment_invoice',
																	 'Invoice'=>''
		));
		
		$invoice = $this->vendor_class_model->get_transaction_all();
		
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
	
	public function do_payment_confirm($code) {
		$this->load->model('email_model');
		
		if($this->email_model->send_admin_confirmed_payment_message($code)){
			$this->session->set_flashdata('f_class', 'Payment Confirmed!');
		} else {
			$this->session->set_flashdata('f_class_error', 'Failed To Confirm Payment!');
		}
		redirect('admin/teacher_driven/payment_confirm');
	}
	
	public function reject_payment_confirm() {
		
	}
}

// END OF teacher_driven.php File