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
		$this->load->model('guru_model');
	}
	
	public function logout() {
		$this->exec_logout();
		redirect('vendor');
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
	public function teacher_connect() {
		$guru_id = $this->session->userdata('guru_id');
		if(empty($guru_id)) {
			$this->load->view('vendor/auth/teacher_login');
			return;
		}
		$guru = $this->guru_model->get_guru_by_id($guru_id);
		$this->session->set_userdata('g_password', $guru->guru_password);
		$this->load->view('vendor/auth/teacher_confirm_password', array('guru'=>$guru));
	}

	public function teacher_validate() {
		$password = $this->input->post('password', TRUE);
		$g_password = $this->session->userdata('g_password');
		if($g_password == md5($password)) {
			$vendor_id = $this->vendor_model->duplicate_teacher_as_vendor($this->session->userdata('guru_id'));
			$vendor = $this->vendor_model->get_profile(array('id'=>$vendor_id));
			$dt_vendor = $vendor->row();
			$dt['email'] = $dt_vendor->email;
			$dt['id'] = $dt_vendor->id;
			$dt['name'] = $dt_vendor->name;
			$dt['type'] = 'vendor';
			$this->exec_login($dt);
			redirect('vendor/profile/edit');
			// redirect ke edit profile
		} else {
			redirect('vendor/auth/teacher_connect');
		}
	}

	public function teacher_login() {
		$password = $this->input->post('password', TRUE);
		$gurumail = $this->input->post('email', TRUE);
		
		$data = array(
			'email'			=> $gurumail,
			'password'		=> $password
		);
		$guru = $this->guru_model->check_login($data);
		
	}
}

// END OF logreg.php File