<?php if(!defined('BASEPATH')) die('Die already!');
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 10/8/14
 * Time: 1:21 PM
 * Proj: private-development
 */
class Main extends MY_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('vendor_model');
	}
	
	public function index() {
		$par = array('status' => 1);
		$data['profile'] = $this->vendor_model->get_profile($par);
		foreach($data['profile']->result() as $val){
			$par_profile = array('vendor_id' => $val->id);
			$info[] = $this->vendor_model->get_info($par_profile);
		}
		$data['info'] = $info;
		$this->load->view('vendor/landing_2', $this->data);
//		$this->load->view('vendor/landing', $data);
	}
	
	public function detail($uri) {
		$vendor = $this->vendor_model->get_profile(array('uri'=>$uri));
		if(empty($vendor) || $vendor->num_rows() ==0) {
			show_404();
			return;
		}
		$vendor = $vendor->row();
		$this->data['vendor_data'] = $vendor;
		$this->data['vendor_info'] = $this->vendor_model->get_info(array('vendor_id'=>$vendor->id))->row();
		$this->data['vendor_socmed'] = $this->vendor_model->get_socmed($vendor->id);
		$this->load->view('vendor/detail2', $this->data);
	}
	
}

// END OF main.php File