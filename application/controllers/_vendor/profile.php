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
	}
	
	public function edit() {
		$this->data['vendor']['info'] = $this->vendor_model->get_info(array('vendor_id'=>$this->vendor->id))->row();
		$this->data['bank_list'] = $this->vendor_model->get_bank_list();
		$this->data['bank_account'] = $this->vendor_model->get_rekening($this->vendor->id);
		$this->data['socmed'] = $this->vendor_model->get_socmed($this->vendor->id);
		$this->load->view('vendor/profile/edit', $this->data);
	}
	
	public function update_profile(){
		$update = array();
		$update_vendor = array();
		foreach($_POST as $k => $v) {
			if(($k == "vendor_description") ||($k == "vendor_logo")){
				$this->update_info();
				$flag = 0;
			}else{
				$update[$k]	= $this->input->post($k, TRUE);
				$flag = 1;
			}
		}
		$update['id'] = $this->vendor->id;
		//var_dump($update);exit;
		$this->vendor_model->update_profile($update);
		redirect('vendor/profile/edit');
	}
	
	public function update_info($flag = null){
		$update = array();
		$desc = $this->input->post('vendor_description');
		$logo = $this->input->post('vendor_logo');
		
		if(($flag == 0) && (empty($desc)) && (empty($logo))){
			foreach($_POST as $k => $v) {
				$update[$k]	= $this->input->post($k, TRUE);
			}
		}else{
			$update['vendor_description'] = $this->input->post('vendor_description');
			$update['vendor_logo'] = $this->input->post('vendor_logo');
		}

		$update['id'] = $this->vendor->id;

		$no_files = FALSE;
		if(!empty($_FILES['vendor_logo']) ) {
			if($_FILES['vendor_logo']['error'] > 0 || $_FILES['vendor_logo']['size'] < 10){
			} else {
				@mkdir(rtrim(str_replace('\\','/',FCPATH), '/')."/images/vendor/{$this->vendor->id}/", 0777, TRUE);
				$opt = array(
					'file_name'		=> 'main_picture',
					'upload_path'	=> rtrim(FCPATH, '/')."/images/vendor/{$this->vendor->id}/",
					'allowed_types'	=> 'gif|jpg|jpeg|png',
					'overwrite'		=> TRUE
				);
				$this->load->library('upload', $opt);
				if(!$this->upload->do_upload('vendor_logo')){
					$no_files = TRUE;
				} else {
					$files = $this->upload->data();
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
//		var_dump($update);exit;
		$this->vendor_model->update_info($update);
		redirect('vendor/profile/edit');
	}
	
	public function update_account() {
		$bank = $this->input->post('account_bank', TRUE);
		if($bank == 'x') {
			$bank = 0;
		}
		$update = array(
			'id'		=> $this->vendor->id,
			'bank_id'		=> $bank,
			'bank_lain'		=> $this->input->post('bank_new', TRUE),
			'no_rek'		=> $this->input->post('account_number', TRUE),
			'atasnama'		=> $this->input->post('account_name', TRUE),
			'cabang'		=> $this->input->post('account_branch', TRUE)
		);
		
		$this->vendor_model->set_rekening($update);

		redirect('vendor/profile/edit');
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

		redirect('vendor/profile/edit');

	}
}
?>