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

		if($this->uri->rsegment(4) == 'kelas') {
			$list_classes = $this->vendor_class_model->get_class(array('vendor_id'=>$vendor->id), 1, 20, 'current')->result();
			foreach($list_classes as &$cla){
				$cnt = $this->vendor_class_model->get_class_schedule(array('class_id'=>$cla->id))->num_rows();
				$cla->count_session = $cnt;
				$v['profile'] = $this->vendor_model->get_profile(array('id'=>$cla->vendor_id))->row();
				$v['info'] = $this->vendor_model->get_info(array('vendor_id'=>$cla->vendor_id))->row();
				$data['vendor']['profile'][]= $v['profile'];
				$data['vendor']['info'][]= $v['info'];
				$cla->rating = $this->vendor_class_model->get_class_rating($cla->vendor_id)->row();
				$cla->vendor = $v;
				$cla->available = $this->vendor_class_model->get_class_availability($cla->id);
			}
			$this->data['class'] = $list_classes;
			$this->data['filter-by-vendor'] = TRUE;

			$this->load->view('kelas/list_all', $this->data);
			return;
		} else {
			$this->data['vendor_info'] = $this->vendor_model->get_info(array('vendor_id'=>$vendor->id))->row();
			$this->data['vendor_socmed'] = $this->vendor_model->get_socmed($vendor->id);

			$list_classes = $this->vendor_class_model->get_class(array('vendor_id'=>$vendor->id), 1, 2, 'current')->result();
			foreach($list_classes as &$cla){
				$cnt = $this->vendor_class_model->get_class_schedule(array('class_id'=>$cla->id))->num_rows();
				$cla->count_session = $cnt;
				$v['profile'] = $this->vendor_model->get_profile(array('id'=>$cla->vendor_id))->row();
				$v['info'] = $this->vendor_model->get_info(array('vendor_id'=>$cla->vendor_id))->row();
				$data['vendor']['profile'][]= $v['profile'];
				$data['vendor']['info'][]= $v['info'];
				$cla->rating = $this->vendor_class_model->get_class_rating($cla->vendor_id)->row();
				$cla->vendor = $v;
				$cla->available = $this->vendor_class_model->get_class_availability($cla->id);
			}
			$this->data['list_classes'] = $list_classes;

			$this->load->view('vendor/detail2', $this->data);
		}
	}
}

// END OF main.php File