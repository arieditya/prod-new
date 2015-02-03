<?php if(!defined('BASEPATH')) die('Die already!');
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 10/8/14
 * Time: 12:52 PM
 * Proj: private-development
 */
class Auth extends MY_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('vendor_model');
	}
	
	public function logout() {
		$this->exec_logout();
		redirect('vendor/auth/logreg');
	}
	
	public function logreg() {
		$this->data['is_page'] = TRUE;
		if($this->input->get('simple_form') == '1') $this->data['is_page'] = FALSE;
		$this->load->view('vendor/auth/logreg', $this->data);
	}
	
	public function do_login() {
		$data['email'] = $this->input->post('email', TRUE);
		$data['password'] = md5($this->input->post('password', TRUE));
		$vendor = $this->vendor_model->get_profile($data);
		if($vendor->num_rows() == 1) {
			$dt_vendor = $vendor->row();
			$dt['email'] = $dt_vendor->email;
			$dt['id'] = $dt_vendor->id;
			$dt['name'] = $dt_vendor->name;
			$dt['type'] = 'vendor';
			$this->exec_login($dt);
			redirect('vendor/profile/edit');
			return;
		} else {
			$this->session->set_flashdata('status.warning', 'Email / Password is not match!');
			redirect('vendor/auth/logreg');
			return;
		}
	}
	
	public function do_register() {
		$data['email'] = $this->input->post('email', TRUE);
		$data['password'] = md5($this->input->post('password', TRUE));
		$conf_pass = md5($this->input->post('confirm_password', TRUE));
		if($data['password'] != $conf_pass) {
			$this->session->set_flashdata('status.warning', 'Password confirmation not match!');
			redirect('vendor/auth/logreg');
			return;
		}
		$data['name'] = $this->input->post('vendor_name', TRUE);
		$data['main_phone'] = $this->input->post('vendor_phone', TRUE);
		$data['address'] = $this->input->post('vendor_address', TRUE);
		$id = $this->vendor_model->set_profile($data);
		if($id) {
			$data['id'] = $id;
			$data['type'] = 'vendor';
			$this->exec_login($data);
			redirect('vendor/profile/edit');
		} else {
			$this->session->set_flashdata('status.warning', 'Cannot create new vendor!');
			redirect('vendor/auth/logreg');
		}
	}
}

// END OF logreg.php File