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
	
	public function detail($id) {
		$par_profile = array('vendor_id' => $id);
		$data['info'] = $this->vendor_model->get_info($par_profile);
		$this->load->view('vendor/detail', $data);
	}
}

// END OF main.php File