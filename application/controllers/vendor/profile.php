<?php if(!defined('BASEPATH')) die('Die already!');
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 10/8/14
 * Time: 10:13 PM
 * Proj: private-development
 * @property Vendor_class_model $vendor_class_model
 * @property Vendor_model $vendor_model
 */
class Profile extends Vendor_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->vendor->id = $this->session->userdata('user_type')=='vendor'?$this->session->userdata('user_id'):FALSE;
	}
	
	public function edit($sub='profile') {
		$sub = strtolower($sub);
		if(!in_array($sub, array('profile','reponsible'))) $sub='profile';
		if($sub=='reponsible') $sub = 'penanggungjawab';
		$this->data['sub'] = $sub;
		$this->data['vendor']['info'] = $this->vendor_model->get_info(array('vendor_id'=>$this->vendor->id))->row();
		$this->data['bank_list'] = $this->vendor_model->get_bank_list();
		$this->data['bank_account'] = $this->vendor_model->get_rekening($this->vendor->id);
		$this->data['socmed'] = $this->vendor_model->get_socmed($this->vendor->id);
		$this->data['sidebar'] = $sub;
		$this->new_design?
			$this->load->view('vendor/profile/edit_2', $this->data):
			$this->load->view('vendor/profile/edit', $this->data);
	}
	
	public function update_profile(){
		$update = array();
		$status = '';
		$flag = 0;
		$stat = TRUE;
		$update['show_address'] = 0;
		foreach($_POST as $k => $v) {
			if(($k == "vendor_description") ||($k == "vendor_logo") && $flag==0){
				$this->update_info(TRUE);
				$flag = 1;
			}else{
				if($k == "password"){
					$pass = trim($this->input->post($k, TRUE));
					if(!empty($pass) )
						$update[$k]	= md5($pass);
				}elseif($k=='show_address') {
					if($v == 'yes') $update[$k] = 1;
				}else{
					$update[$k]	= $this->input->post($k, TRUE);
				}
			}
		}
		$update['id'] = $this->vendor->id;
		$stat = $this->vendor_model->update_profile($update);
		if(!$stat) {
			$status = 'Gagal update profile!';
		}

		if(!empty($status)) $this->session->set_flashdata('status.warning', $status);
		else $this->session->set_flashdata('status.notice', 'Berhasil update data profile!');
		redirect('vendor/profile/edit');
	}
	
	public function update_info($flag=FALSE){
		$update = array();
		$desc = $this->input->post('vendor_description');
		$logo = $this->input->post('vendor_logo');
		
		if((empty($desc)) && (empty($logo))){
			foreach($_POST as $k => $v) {
				$update[$k]	= $this->input->post($k, TRUE);
			}
		}else{
			$update['vendor_description'] = $this->input->post('vendor_description');
		}

		$update['id'] = $this->session->userdata('user_type')=='vendor'?$this->session->userdata('user_id'):FALSE;

		$no_files = FALSE;
		if(!empty($_FILES['vendor_logo']) ) {
			if($_FILES['vendor_logo']['error'] > 0 || $_FILES['vendor_logo']['size'] < 10){
				$no_files = TRUE;
			} else {
				$exts = explode('|','gif|jpg|jpeg|png');
				$name = $_FILES['vendor_logo']['name'];
				$ext = array_pop(explode('.',$name));
				if(in_array($ext, $exts)) {
					@mkdir(rtrim(str_replace('\\','/',FCPATH), '/')."/images/vendor/{$this->vendor->id}/", 0777, TRUE);
					$opt = array(
						'file_name'		=> 'main_picture',
						'upload_path'	=> rtrim(FCPATH, '/')."/images/vendor/{$this->vendor->id}/",
						'allowed_types'	=> '*',
						'overwrite'		=> TRUE
					);
					$this->load->library('upload', $opt);
					if(!$this->upload->do_upload('vendor_logo')){
						$no_files = TRUE;
					} else {
						echo $this->upload->display_errors();
						$files = $this->upload->data();
					}
				} else {
					$no_files = TRUE;
				}
			}
		} else {
			$no_files = TRUE;
		}
		if(!$no_files) {
			$update['vendor_logo'] = $files['file_name'];
		} else {
//			$data['class_image'] = NULL;
		}
		$result = $this->vendor_model->update_info($update);
		if($flag) return $result;
		else {
			if(!$result) $this->session->set_flashdata('status.warning', 'Gagal update info!');
			else $this->session->set_flashdata('status.notice', 'Berhasil update info!');
			redirect('vendor/profile/edit/responsible#rekbank');
		}
	}
	
	public function update_account() {
		$bank = $this->input->post('account_bank', TRUE);
		if($bank == 'x') {
			$bank = 0;
		}
		$update = array(
			'vendor_id'		=> $this->vendor->id,
			'bank_id'		=> $bank,
			'bank_lain'		=> $this->input->post('bank_new', TRUE),
			'no_rek'		=> $this->input->post('account_number', TRUE),
			'atasnama'		=> $this->input->post('account_name', TRUE),
			'cabang'		=> $this->input->post('account_branch', TRUE)
		);
		if($this->vendor_model->set_rekening($update)) {
			$this->session->set_flashdata('status.notice','Update akun bank berhasil');
		} else {
			$this->session->set_flashdata('status.warning','Update akun bank Gagal');
		}

		redirect('vendor/profile/edit/reponsible');
	}
	
	public function update_socmed() {
		$update = array(
			'vendor_id'		=> $this->vendor->id,
			'facebook'		=> $this->input->post('socmed_fb', TRUE),
			'twitter'		=> $this->input->post('socmed_tw', TRUE),
			'instagram'		=> $this->input->post('socmed_ig', TRUE),
			'pinterest'		=> $this->input->post('socmed_pt', TRUE),
		);
		$this->vendor_model->set_socmed($update);

		redirect('vendor/profile/edit/reponsible');

	}
}

// END OF profile.php File