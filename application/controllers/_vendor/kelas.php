<?php if(!defined('BASEPATH')) die('Die already!');
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 10/9/14
 * Time: 1:51 PM
 * Proj: private-development
 */
class Kelas extends Vendor_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('vendor_class_model');
	}
	
	public function index() {
		redirect('vendor/kelas/daftar');
	}
	
	public function daftar() {
		$list_class = $this->vendor_class_model->get_class(array('vendor_id'=>$this->data['user']['id'],'class_status'=>NULL, 'active'=>NULL))->result();
		foreach($list_class as &$list) {
			$list->level = $this->vendor_class_model->get_class_level($list->id);
			$list->category = $this->vendor_class_model->get_class_category($list->id);
			$list->jadwal_count = $this->vendor_class_model->get_class_schedule(array('class_id'=>$list->id))->num_rows();
		}
		$this->data['classes'] = $list_class;
		$this->load->view('vendor/class/list', $this->data);
	}

	public function baru() {
		$this->load->model('kelas_model');
//		$data['kelas'] = $this->kelas_model->get_buka_kelas($this->id);
//		$data['komunitas'] = $this->kelas_model->get_komunitas($this->id);
//		$data['vendor'] = $this->vendor_model->get_profile_guru($this->id);
//		$data['jenjang'] = $this->guru_model->get_jenjang();
//		$data['menu'] = $this->load->view('front/profile/menu',array('active'=>'buka_kelas'),TRUE);
//		$temp['css'] = array(1=>'validation',2=>'guru',3=>'profile');
//		$this->load->view('header',$temp);
		$this->data['categories'] = $this->vendor_class_model->get_category_list();
		$this->data['levels'] = $this->vendor_class_model->get_class_level_list();
		$this->load->view('vendor/class/create_new', $this->data);
//		$this->load->view('footer');
	}
	
	public function generate_uri() {
		header('Content-type: application/json');
		$this->load->model('vendor_class_model');
		$title = $this->input->get('title', TRUE);
		if(empty($title)){
			echo json_encode(array('status'=>'KO', 'message'=>'Title failed to be tested'));
			return;
		}
		$uri = $this->vendor_class_model->check_uri($title);
		echo json_encode(array(
			'status'	=> 'OK',
			'message'	=> 'Returning URI',
			'data'		=> array(
				'uri'		=> $uri
			)
		));
		return;
	}

	public function get_address_geo() {
		$cityclean = $this->input->get('address', TRUE);
		$cityclean = urlencode($cityclean);
//		var_dump($cityclean);exit;
//		$cityclean = str_replace (" ", "+", $address);
		$details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . $cityclean . "&sensor=false";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $details_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$geolocs_results = json_decode(curl_exec($ch), true);
		$geolocs = $geolocs_results['results'];
//		echo json_encode($geolocs);
		$this->load->view('vendor/class/geo_address', array('geolocs'=>$geolocs));
	}
	
	public function submit_new(){
		$fields = array(
			'class_uri', 'class_nama', 'class_deskripsi', 'class_lokasi', 
			'class_peserta', 'class_harga', 'class_paket','class_peta',
		);
		
		$ext = array(
			'class_level', 'class_category'
		);
		
		$data = array();
		$data_ext = array();
		foreach($_POST as $key => $value) {
			if(in_array($key, $fields)){
				$dt = $this->input->post($key, TRUE);
				$data[$key] = $dt;
			}
			if(in_array($key, $ext)) {
				$dt = $this->input->post($key, TRUE);
				$data_ext[$key] = $dt;
			}
		}
		if(!empty($data['class_paket']) && $data['class_paket'] == 'ya') $data['class_paket'] = 1;
		else $data['class_paket'] = 0;
		$data['vendor_id'] = $this->vendor->id;
		$id = $this->vendor_class_model->add_new_class($data, $data_ext);
		redirect('vendor/kelas/detil/'.$id.'/info');
	}
	
	public function update($id){
		
		$fields = array(
			'id','class_uri', 'class_nama', 'class_deskripsi', 'class_lokasi', 
			'class_peserta', 'class_harga', 'class_paket','class_peta',
		);
		
		$ext = array(
			'class_level', 'class_category'
		);
		
		$data = array();
		$data_ext = array();
		foreach($_POST as $key => $value) {
			if(in_array($key, $fields)){
				$dt = $this->input->post($key, TRUE);
				$data[$key] = $dt;
			}
			if(in_array($key, $ext)) {
				$dt = $this->input->post($key, TRUE);
				$data_ext[$key] = $dt;
			}
		}
		if(!empty($data['class_paket']) && $data['class_paket'] == 'ya') $data['class_paket'] = 1;
		else $data['class_paket'] = 0;
		
		$no_files = FALSE;
		if(!empty($_FILES['class_image']) ) {
			if($_FILES['class_image']['error'] > 0 || $_FILES['class_image']['size'] < 10){
				$no_files = TRUE;
			} else {
				mkdir(rtrim(str_replace('\\','/',FCPATH), '/')."/images/class/{$id}/", 0777, TRUE);
				$opt = array(
					'file_name'		=> 'main_picture',
					'upload_path'	=> rtrim(FCPATH, '/')."/images/class/{$id}/",
					'allowed_types'	=> 'gif|jpg|jpeg|png',
					'overwrite'		=> TRUE
				);
				$this->load->library('upload', $opt);
				if(!$this->upload->do_upload('class_image')){
					$no_files = TRUE;
				} else {
					$files = $this->upload->data();
				}
			}
		} else {
			$no_files = TRUE;
		}
		if(!$no_files) {
			$data['class_image'] = $files['file_name'];
		} else {
//			$data['class_image'] = NULL;
		}

		$data['vendor_id'] = $this->vendor->id;
		$this->vendor_class_model->update_class($data, $data_ext);
//
		redirect('vendor/kelas/detil/'.$id);
	}
	
	public function detil($id, $tabs='profile') {
		$data = $this->vendor_class_model->get_class(array('id'=>$id, 'vendor_id'=>$this->vendor->id, 'class_status'=>NULL,'active'=>NULL));
		if($data->num_rows() != 1) {
			show_404();
		}
		$class = $data->row();
		$class->level = $this->vendor_class_model->get_class_level($id);
		$class->category = $this->vendor_class_model->get_class_category($id);
		
		$this->data['categories'] = $this->vendor_class_model->get_category_list();
		$this->data['levels'] = $this->vendor_class_model->get_class_level_list();
		$this->data['class'] = $class;
		$this->data['jadwal'] = $this->vendor_class_model->get_class_schedule(array('class_id'=>$id));
		$this->data['biaya'] = $this->vendor_class_model->get_price(array('class_id'=>$id));
		$this->data['summary'] = '';
		$this->data['tags'] = $this->vendor_class_model->get_tags($id);
		$this->data['tabs'] = $tabs;
		$this->load->view('vendor/class/detail', $this->data);
	}
	
	public function get_jadwal(){
		header('Content-type: application/json');
		$data = $this->vendor_class_model->get_class_schedule(array('class_id'=>$this->input->get('id', TRUE)))->result();
		
		$_data = array(
			array(
				'jadwal_id'		=> 0,
				'tanggal'		=> '2014-10-11',
				'jam_mulai'		=> '10',
				'menit_mulai'	=> '30',
				'jam_selesai'	=> '12',
				'menit_selesai'	=> '30',
			),
			array(
				'jadwal_id'		=> 0,
				'tanggal'		=> '2014-10-12',
				'jam_mulai'		=> '10',
				'menit_mulai'	=> '30',
				'jam_selesai'	=> '12',
				'menit_selesai'	=> '30',
			),
			array(
				'jadwal_id'		=> 0,
				'tanggal'		=> '2014-10-13',
				'jam_mulai'		=> '07',
				'menit_mulai'	=> '45',
				'jam_selesai'	=> '10',
				'menit_selesai'	=> '00',
			),
		);
		echo json_encode(array(
			'status'	=> 'OK',
			'message'	=> 'Success retrieving class schedule',
			'data'		=> array(
				'class_id'	=> $this->input->get('id', TRUE),
				'rows'		=> count($data),
				'schedule'	=> $data
			)
		));
	}
	
	public function add_schedule() {
		header('Content-type: application/json');
		$class = (int)$this->input->post('class_id', TRUE);
		$date = $this->input->post('jadwal_date', TRUE);
		$time_start = explode(':',$this->input->post('jadwal_time_start', TRUE));
		$time_end = explode(':',$this->input->post('jadwal_time_end', TRUE));
		
		if(empty($class) || count($time_start) != 2 || count($time_end) != 2) {
			echo json_encode(array(
				'status'		=> 'KO',
				'message'		=> 'Parameters are not set correctly'
			));
			return;
		}
		
		$data = array(
			'class_tanggal'			=> $date,
			'class_jam_mulai'		=> $time_start[0],
			'class_jam_selesai'		=> $time_end[0],
			'class_menit_mulai'		=> $time_start[1],
			'class_menit_selesai'	=> $time_end[1],
			'class_waktu'			=> 1,
		);
		
		$sched_id = $this->vendor_class_model->add_class_schedule($class, $data);
		if(empty($sched_id)) {
			echo json_encode(array(
				'status'		=> 'KO',
				'message'		=> 'Cannot add new class schedule!'
			));
			return;
		}
		echo json_encode(array(
			'status'		=> 'OK',
			'message'		=> 'Success adding new class schedule!',
			'data'			=> array(
				'id'			=> $sched_id,
				'class_id'		=> $class
			)
		));
		return;
	}
	
	public function galeri($class_id = 0) {
		$class_id = (int) $class_id;
		if(empty($class_id)) {
			redirect('vendor/kelas/daftar');
			return;
		}
		$gallery = $this->vendor_class_model->get_class_gallery(array('class_id'=>$class_id))->result();
		$this->data['gallery']= $gallery;
		$this->data['class_id']= $class_id;
		$this->load->view('vendor/class/gallery', $this->data);
	}
	
	public function upload_gallery(){
		$class_id = (int)$this->input->post('class_id', TRUE);
		if(empty($class_id)) {
			echo "ERROR!";
			return;
		}
		@mkdir(rtrim(str_replace('\\','/',FCPATH), '/')."/images/class/{$class_id}/", 0777, TRUE);
		$opt = array(
			'upload_path'	=> rtrim(FCPATH, '/')."/images/class/{$class_id}/",
			'allowed_types'	=> 'gif|jpg|jpeg|png',
			'remove_spaces'	=> TRUE,
			'encrypt_name'	=> TRUE
		);
		$this->load->library('upload', $opt);
		if(!$this->upload->do_upload('gallery_pics')){
			echo "FAILED! ";
			return;
		}
		$data = $this->upload->data();
		$id = $this->vendor_class_model->add_class_gallery($class_id, array('galeri_foto'=>$data['file_name']));
		if(empty($id)) {
			echo "FAILURE! ";
			return;
		}
		redirect('vendor/kelas/galeri/'.$class_id);
	}
	
	public function update_profile(){
		$id = $this->input->post('id');
		
		if(empty($id)) {
			show_404();
		}
		$data = array(
			'id'	=> $this->input->post('id', TRUE),
			'class_deskripsi' => $this->input->post('class_deskripsi', TRUE),
			'class_lokasi' => $this->input->post('class_lokasi', TRUE),
			'class_peserta' => $this->input->post('class_peta', TRUE),
			'class_peserta' => $this->input->post('class_peserta', TRUE),
			'class_harga' => $this->input->post('class_harga', TRUE),
			'class_paket' => $this->input->post('class_paket', TRUE) == 'ya'?1:0,
			'class_peta' => $this->input->post('class_peta', TRUE),
			'class_alasan' => $this->input->post('class_alasan', TRUE)
		);
		
		$this->vendor_class_model->update_class($data, array());
		redirect('vendor/kelas/detil/'.$id.'/info');
	}
	public function update_info(){
		$id = $this->input->post('id');

		if(empty($id)) {
			show_404();
		}
		$data = array();
		$data['id'] = $id;
		$data['class_catatan'] 	= $this->input->post('class_catatan', TRUE);
		$data['class_video']	= $this->input->post('class_video', TRUE);

		$no_files = FALSE;
		if(!empty($_FILES['class_image']) ) {
			if($_FILES['class_image']['error'] > 0 || $_FILES['class_image']['size'] < 10){
//				var_dump($_FILES);
				$no_files = TRUE;
			} else {
				mkdir(rtrim(str_replace('\\','/',FCPATH), '/')."/images/class/{$id}/", 0777, TRUE);
				$opt = array(
					'file_name'		=> 'main_picture',
					'upload_path'	=> rtrim(FCPATH, '/')."/images/class/{$id}/",
					'allowed_types'	=> 'gif|jpg|jpeg|png',
					'overwrite'		=> TRUE
				);
				$this->load->library('upload', $opt);
				if(!$this->upload->do_upload('class_image')){
					var_dump($this->upload->error_msg);
					$no_files = TRUE;
				} else {
					$files = $this->upload->data();
				}
			}
		} else {
//			var_dump($_FILES);
			$no_files = TRUE;
		}

		if(!$no_files && !empty($files) && !empty($files['file_name'])) {
			$data['class_image'] = $files['file_name'];
//		} else {
//			exit;
//			$data['class_image'] = NULL;
		}

		$this->vendor_class_model->update_class($data, array());
		
		$tags = $this->input->post('class_tags', TRUE);
		$tags = explode(',', $tags);
		if(!empty($tags)) {
			$tags = array_map('trim', $tags);
			$tags = array_map('strtolower', $tags);
			$tags = array_unique($tags);
			foreach($tags as $tag) {
				$this->vendor_class_model->set_tags($id, $tag);
			}
		}
		
		redirect('vendor/kelas/detil/'.$id.'/schedule');
	}
	
	public function delete_tags(){
		$id = (int) $this->input->post('id', TRUE);
		$tag = $this->input->post('tag', TRUE);
		
		$this->vendor_class_model->delete_tags($id, $tag);
		
	}
	
	public function update_schedule(){
		$id = $this->input->post('id');
		if(empty($id)) {
			show_404();
		}
		$date = $this->input->post('jadwal_date', TRUE);
		$time_start = $this->input->post('jadwal_time_start', TRUE);
		$time_end = $this->input->post('jadwal_time_end', TRUE);
		$topic = $this->input->post('jadwal_topik', TRUE);
		foreach($date as $sched_id => $val) {
			$start_hr = explode(':',$time_start[$sched_id]);
			$end_hr = explode(':',$time_end[$sched_id]);
			if(count($start_hr) != 2 || count($end_hr) != 2){
				continue;
			}
			$data_sched = array(
				'class_tanggal'			=> $date[$sched_id],
				'class_jam_mulai'		=> $start_hr[0],
				'class_menit_mulai'		=> $start_hr[1],
				'class_jam_selesai'		=> $end_hr[0],
				'class_menit_selesai'	=> $end_hr[1],
				'class_jadwal_topik'	=> $topic[$sched_id],
				'class_waktu'			=> 1
			);
			if($this->vendor_class_model->check_schedule_exists($id, $sched_id)) {
				$data_sched['class_id'] = $id;
				$this->vendor_class_model->update_class_schedule($sched_id, $data_sched);
			} else {
				$this->vendor_class_model->add_class_schedule($id, $data_sched);
			}	
		}
		redirect('vendor/kelas/detil/'.$id.'/biaya');
	}
	public function update_biaya(){
		$id = $this->input->post('id', TRUE);
		if(empty($id)) {
			show_404();
		}
		$data['price_per_session']	=	$this->input->post('price_per_session', TRUE);
		$data['discount']	= $this->input->post('discount_price', TRUE);
		$data['include']	= $this->input->post('class_include', TRUE);
		if($this->vendor_class_model->add_class_price($id, $data)){
			redirect('vendor/kelas/detil/'.$id.'/summary');
		} else {
			redirect('vendor/kelas/detil/'.$id.'/biaya');
		}
	}
	
	public function update_publish() {
		$id = (int)$this->input->get('id', TRUE);
		$status = (int)$this->input->get('publish', TRUE);
		
		$this->vendor_class_model->set_published_class($id, $status);
	}
	
}

// END OF kelas.php File