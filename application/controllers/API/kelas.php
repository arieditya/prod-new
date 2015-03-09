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
		$this->load->model('vendor_model');
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
		$classes = $this->vendor_class_model->get_class(array(), $page, $perpage)->result();
		foreach($classes as &$class) {
			$class->level = array_merge( $this->vendor_class_model->get_class_multiple_level($class->id));
			unset($class->level_id);
			unset($class->name);
			unset($class->nama);
			$class->class_paket = $class->class_paket==0?'single':($class->class_paket==1?'series':'package'); 
			$class->class_image = !empty($class->class_image)?
					base_url()."images/class/{$class->id}/{$class->class_image}":
					'No Image / Foto'
			;
			$class->vendor = $this->vendor_model->get_profile(array('id'=>$class->vendor_id))->row();
			unset($class->vendor->password);
			unset($class->class_harga);
			$class->vendor->info = $this->vendor_model->get_info(array('vendor_id'=>$class->vendor_id))->row();
			$class->vendor->info->vendor_logo = 
					base_url()."images/vendor/{$class->vendor_id}/{$class->vendor->info->vendor_logo}";
		}
		echo json_encode(array('status'=>'ok','data'=>$classes));
		
	}
	
	public function detail($uri) {
		$class = $this->vendor_class_model->get_class(array('class_uri'=>$uri))->row();
		if(empty($class)) {
			set_status_header(404, 'No Class Found');
			echo json_encode(array('status'=>'KO', 'message'=>'No Class Found!'));
			return;
		}
		$class->vendor = $this->vendor_model->get_profile(array('id'=>$class->vendor_id))->row();
		unset($class->vendor->password);
		$class->class_image = !empty($class->class_image)?
				base_url()."images/class/{$class->id}/{$class->class_image}":
				'No Image / Foto'
		;
		$class->vendor->info = $this->vendor_model->get_info(array('vendor_id'=>$class->vendor_id))->row();
		$class->vendor->info->vendor_logo = 
				base_url()."images/vendor/{$class->vendor_id}/{$class->vendor->info->vendor_logo}";
		echo json_encode(array(
			'status'	=> 'OK',
			'data'		=> $class
		));
		return;
	}
	
}

// END OF kelas.php File