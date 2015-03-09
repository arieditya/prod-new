<?php if(!defined('BASEPATH')) die('Die already!');
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 3/9/15
 * Time: 11:02 AM
 * Proj: prod-new
 */
class Kelas extends API_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('vendor_class_model');
	}
	
	public function _remap($segment) {
		if($segment == 'all') {
			$this->all();
			return;
		}
		$this->detail($segment);
	}
	
	public function all() {
		$page = (int)$this->input->get('page', TRUE);
		if(empty($page)) $page = 1;
		$perpage = (int) $this->input->get('row', TRUE);
		if(empty($perpage)) $perpage = 5;
		echo json_encode(array('status'=>'ok','data'=>$this->vendor_class_model->get_class(array(), $page, 
						$perpage)->result()));
		
	}
	
	public function detail($uri) {
		$class = $this->vendor_class_model->get_class(array('class_uri'=>$uri))->row();
		if(empty($class)) {
			set_status_header(404, 'No Class Found');
			echo json_encode(array('status'=>'KO', 'message'=>'No Class Found!'));
			return;
		}
		echo json_encode(array(
			'status'	=> 'OK',
			'data'		=> $class
		));
		return;
	}
	
}

// END OF kelas.php File