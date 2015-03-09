<?php if(!defined('BASEPATH')) die('Die already!');
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 10/8/14
 * Time: 12:53 PM
 * Proj: private-development
 * 
 * @property Admin_model $admin_model
 * @property Cache_model $cache_model
 * @property Csmodel $csmodel
 * @property Discount_model $discount_model
 * @property Duta_guru_model $duta_guru_model
 * @property Email_model $email_model
 * @property Event_model $event_model
 * @property Guru_model $guru_model
 * @property Kelas_model $kelas_model
 * @property Main_model $main_model
 * @property Matpel_model $matpel_model
 * @property Murid_model $murid_model
 * @property Profile_model $profile_model
 * @property Point_model $point_model
 * @property Payment_model $payment_model
 * @property Request_model $request_model
 * @property Utilities_model $utilities_model
 * @property Vendor_class_model $vendor_class_model
 * @property Vendor_model $vendor_model
 */
class MY_Controller extends CI_Controller{
	
	var $data = array();
	var $new_design = FALSE;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('utility');
		$this->load->library('session');
		$this->data['large_header'] = TRUE;
		
		$this->load->helper('cookie');
		$new_design = FALSE;
		if($this->input->cookie('new_design') == 'okeh' || $this->input->get('new_design')=='please') {
			$new_design = TRUE;
		}
		if($new_design) {
			$this->input->set_cookie('new_design','okeh', 3600);
			if(isset($_GET['stop_new_design'])) {
				delete_cookie('new_design');
				$new_design = FALSE;
			}
		}
		$this->new_design = $new_design;
	}
	
	protected function exec_login($data) {
		$this->exec_logout(FALSE);
		$this->session->set_userdata('user_type', $data['type']);
		$this->session->set_userdata('user_name', $data['name']);
		$this->session->set_userdata('user_email', $data['email']);
		$this->session->set_userdata('user_id', $data['id']);
	}
	
	protected function exec_logout($force = TRUE){
		$this->session->set_userdata('user_type', FALSE);
		$this->session->set_userdata('user_name', FALSE);
		$this->session->set_userdata('user_email', FALSE);
		$this->session->set_userdata('user_id', FALSE);
		$this->session->unset_userdata('user_type');
		$this->session->unset_userdata('user_name');
		$this->session->unset_userdata('user_email');
		$this->session->unset_userdata('user_id');
		if($force) $this->session->sess_destroy();
	}
	
	protected function _login() {
		
	}
}

class Admin_Controller extends MY_Controller {
	var $admin_id;
	public function __construct(){
		parent::__construct();
	}
}

class Guru_Controller extends MY_Controller {
	
}

class Murid_Controller extends MY_Controller {
	
}

class Vendor_Controller extends MY_Controller {
	var $vendor;
	public function __construct() {
		parent::__construct();
		$this->data['user']['type'] = $this->session->userdata('user_type');
		$this->data['user']['name'] = $this->session->userdata('user_name');
		$this->data['user']['email'] = $this->session->userdata('user_email');
		$this->data['user']['id'] = $this->session->userdata('user_id');
		$this->data['large_header'] = FALSE;
		if( FALSE
			|| empty($this->data['user']['type'])
			|| empty($this->data['user']['name'])
			|| empty($this->data['user']['email'])
			|| empty($this->data['user']['id'])
		) {
			$this->session->set_flashdata('status.warning', 'Please login or register first!');
			redirect('vendor/auth/logreg');
			return;
		}
		$this->load->model('vendor_model');
		$vendor = $this->vendor_model->get_profile(array(
			'email'	=> $this->data['user']['email'],
			'id'	=> $this->data['user']['id']
		));
		$vendor_info = $this->vendor_model->get_info(array(
			'vendor_id'	=> $this->data['user']['id']
		))->row();
		if($vendor->num_rows() != 1) {
			$this->session->set_flashdata('status.warning', 'User authentication failed!');
			redirect('vendor/auth/logreg');
			return;
		}
		$this->vendor = $vendor->row();
		$this->data['vendor']['profile'] = $this->vendor;
		$this->data['vendor']['info'] = $vendor_info;
	}
}

class API_Controller extends MY_Controller {
	public function __construct(){
		parent::__construct();
		header('Content-type: application/json');
	}
	
}

// END OF MY_Controller.php File