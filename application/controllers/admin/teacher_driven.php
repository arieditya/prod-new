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
	
	public function do_class_confirm() {
		
	}
	
	public function reject_class_confirm() {
		
	}
	
	public function approve_unpublish_class() {
		
	}
	
	public function reject_unpublish_class() {
		
	}
	
	public function class_list() {
		
	}
	
	public function get_class_detail() {
		
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
		
	}
	
	public function get_class_attendance_detail() {
		
	}
	
	public function payment_invoice() {
		
	}
	
	public function get_payment_invoice_detail() {
		
	}
	
	public function payment_confirm() {
		
	}
	
	public function do_payment_confirm() {
		
	}
	
	public function reject_payment_confirm() {
		
	}
}

// END OF teacher_driven.php File