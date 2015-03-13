<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * @property Kelas_model $kelas_model;
 * @property Vendor_class_model $vendor_class_model;
 * @property Vendor_model $vendor_model;
 * 
 */
class Kelas extends MY_Controller {
	private $id;

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('pdf_helper');
		$this->load->model('murid_model');
		$this->load->model('kelas_model');
		$this->load->model('vendor_class_model');
		$this->load->model('vendor_model');
	}
	
	public function _remap($method){
		if(method_exists($this, '_new_'.$this->uri->rsegment(2))){
			$method = '_new_'.$this->uri->rsegment(2);
		} elseif(method_exists($this, $this->uri->rsegment(2))) {
			$method = $this->uri->rsegment(2);
		} else {
			$this->_uri_($this->uri->rsegment(2));
			return;
		}
		$this->$method($this->uri->rsegment(3));
	}
	
	public function _uri_($uri) {
		$id = $this->vendor_class_model->get_id_by_uri($uri);
//		var_dump($uri);exit;
		if(empty($id)) {
			show_404();
			return;
		}
		$this->detil('XXXX'.$id);
	}
	
	
	
	public function _new_index($view='home') {
		$set_filter = array();
		$filter = $this->input->cookie('filter', TRUE);
		if(!empty($filter)) {
			$filter = json_decode($filter, TRUE);
			$set_filter = array();
			if(!empty($filter['type'])) {
				switch($filter['type']) {
					case		'oneshot':
						$set_filter['oneshot'] = TRUE;
					case		'upcoming':
						$set_filter['upcoming'] = TRUE;
						break;
					case		'ongoing':
						$set_filter['ongoing'] = TRUE;
						break;
					case		'past':
						$set_filter['past'] = TRUE;
						break;
				}
			}
//		var keys = ['day','level','province','type','price_range','category'];
			if(!empty($filter['level'])) {
				$set_filter['level'] = $filter['level']; 
			}
			if(!empty($filter['category'])) {
				$set_filter['category'] = $filter['category']; 
			}
			if(!empty($filter['price_range'])) {
				$set_filter['price'] = $filter['price_range']; 
			}
		}
		
		$this->data['filter'] = $set_filter;
		$new_filter = $this->vendor_class_model->get_filtered_class($set_filter);
//var_dump($new_filter);exit;
//		$this->data['filter_query'] = $new_filter;
		$category = $this->input->get('category', TRUE);
		$level = $this->input->get('level', TRUE);
		$min = $this->input->get('minrange', TRUE);
		$max = $this->input->get('maxrange', TRUE);

		$cat = array();
		$lvl = array();
		$categories = $this->vendor_class_model->get_category()->result();
		foreach($categories as $cats) {
			$cat[$cats->id] = $cats;
		}
		$levels = $this->vendor_class_model->get_level()->result();
		$province = $this->murid_model->get_provinsi()->result();
		foreach($levels as $lvls){
			$lvl[$lvls->id] = $lvls;
		}
		$this->data['category'] = $cat;
		$this->data['level'] = $lvl;
		$this->data['province'] = $province;
	
		$where = array();
		if(!empty($category)) $where['category_id'] = $category;
		if(!empty($level)) $where['level_id'] = $level;
		if(!empty($min)) $where['price_per_session >= '] = $min;
		if(!empty($max)) $where['price_per_session <= '] = $max;
		
		$where2 = array();
		if(!empty($category)) $where2['category'] = $category;
		if(!empty($level)) $where2['level'] = $level;
		if(!empty($oneshot)) $where2['oneshot'] = !empty($oneshot);
		if(!empty($min) || !empty($max)) 
			$where2['price'] = array('lo' => empty($min)?0:$min, 'hi' => empty($max)?0:$max);
		if(!empty($event)) {
			if(in_array($event, array('ongoing','upcoming','past')))
				$where[$event] = TRUE;
		}
		

//		$classes = $this->vendor_class_model->get_class($where)->result();
		$where_class = '';
//		var_dump($new_filter);exit;
		if(count($new_filter) > 0){
			$where_class['id'] = array_merge($new_filter);
//			$where_class .= '`vendor_class`.`id` IN ('.implode(',',$new_filter).')';
			$classes = $this->vendor_class_model->get_class($where_class, 1, 6)->result();
		} else {
			$classes = array();
		}
//		var_dump($where_class);
		//print_r($classes);exit();
		foreach($classes as &$cla){
			$cnt = $this->vendor_class_model->get_class_schedule(array('class_id'=>$cla->id))->num_rows();
			$cla->count_session = $cnt;
			$v['profile'] = $this->vendor_model->get_profile(array('id'=>$cla->vendor_id))->row();
			$v['info'] = $this->vendor_model->get_info(array('vendor_id'=>$cla->vendor_id))->row();
            $data['vendor']['profile'][]= $v['profile'];
            $data['vendor']['info'][]= $v['info'];
			$cla->rating = $this->vendor_class_model->get_class_rating($cla->vendor_id)->row();
			$cla->vendor = $v;
		}
		$this->load->helper('text');
		$this->data['class'] = $classes;
		$this->data['vendor'] = empty($data['vendor'])?NULL:$data['vendor'];
		$this->data['show_filter'] = TRUE;
//		var_dump($classes);exit;
//        $this->data['vendor']->profile->name = word_limiter($this->data->vendor->profile->name,13);
        if($view=='all') : $this->load->view('kelas/list_all', $this->data);
        else :
            $this->new_design?
				$this->load->view('kelas/list2', $this->data):
				$this->load->view('kelas/list', $this->data);
        endif;
	}
	
	public function index(){
		$data['kelas'] = $this->kelas_model->get_buka_kelas_all_front();
		if($this->new_design)
		{
			$this->load->view('vendor/general/header');
			$this->load->view('front/kelas/index',$data);
			$this->load->view('vendor/general/footer');
		}else
			$this->load->view('kelas/list2',$data);

	}

	public function detil($kode){
		$n = count($kode);
		$hash = substr($kode, 4, $n);
		$data = $this->data;
		$data['class'] = @$this->vendor_class_model->get_class(array('vendor_class.id'=>$hash))->row();
		if(empty($data['class'])) show_404();
		$data['kelas'] = $this->kelas_model->get_buka_kelas_by_id($hash);
		$data['vendor'] = array();
		$data['vendor']['profile']= $this->vendor_model->get_profile(array('id'=>$data['class']->vendor_id))->row();
		$data['vendor']['info']= $this->vendor_model->get_info(array('vendor_id'=>$data['class']->vendor_id))->row();
		$data['schedule'] = $this->vendor_class_model->get_class_schedule(array('class_id'=>$hash));
		$data['gallery'] = $this->vendor_class_model->get_class_gallery(array('class_id'=>$hash));
		$data['class']->review = $this->vendor_class_model->get_class_review(array('class_id'=>$data['class']->vendor_id));
		$data['class']->rating = $this->vendor_class_model->get_class_rating($data['class']->vendor_id);
		$data['class']->tag = $this->vendor_class_model->get_tags($hash);
		$data['category'] = $this->vendor_class_model->get_class_category($hash);
		$this->load->model('discount_model');
		$data['deals'] = $this->discount_model->get_diskon_code_for_class($hash, 'public');
//		var_dump($data);exit;
		$this->new_design?
				$this->load->view('kelas/detil2', $data):
				$this->load->view('front/kelas/detil2',$data);
	}

}