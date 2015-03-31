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
//		var_dump($this->data['user']);
	}
	
	public function index() {
		redirect('vendor/kelas/daftar');
	}
	
	public function daftar() {
		$list_class = $this->vendor_class_model->get_class(array('vendor_id'=>$this->data['user']['id'],
																 'class_status >='=>NULL, 'active'=>NULL),1,100)->result();
		foreach($list_class as &$list) {
			$list->level = $this->vendor_class_model->get_class_level($list->id);
			$list->category = $this->vendor_class_model->get_class_category($list->id);
			$list->jadwal_count = $this->vendor_class_model->get_class_schedule(array('class_id'=>$list->id))->num_rows();
			$participant = $this->vendor_class_model->get_class_participant_full($list->id, 4);
			$list->participant_count = $participant->num_rows();
			$list->participant = $participant->result();
		}
		$this->data['sidebar'] = 'daftar_kelas';
		$this->data['classes'] = $list_class;
		$this->new_design?
			$this->load->view('vendor/class/list2', $this->data):
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
		$this->data['sidebar'] = 'tambah_kelas';
		$this->new_design?
			$this->load->view('vendor/class/create_new_2', $this->data):
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
//		var_dump($_POST);exit;
		$fields = array(
			'class_nama', 'class_deskripsi', 'class_lokasi', 
			'class_peserta_max', 'class_peserta_min', 'class_harga', 
			'class_paket','class_peta',
		);
		
		$ext = array(
			'class_level', 'class_category'
		);
		
		$data = array();
		$data_ext = array();
		foreach($_POST as $key => $value) {
			if(in_array($key, $fields)){
				$dt = $this->input->post($key, $key!=='class_deskripsi');
				$data[$key] = $dt;
			}
			if(in_array($key, $ext)) {
				$dt = $this->input->post($key, TRUE);
				$data_ext[$key] = $dt;
			}
		}
		$data['class_uri'] = $this->vendor_class_model->check_uri($data['class_nama']);
		$data['vendor_id'] = $this->vendor->id;
		$id = $this->vendor_class_model->add_new_class($data, $data_ext);
		if(is_string($id)) {
			$this->session->set_flashdata('status.warning','Ada masalah dengan penambahan kelas baru:'.$id);
			redirect('vendor/kelas/baru');
			return;
		}
		if(empty($id)){
			$this->session->set_flashdata('status.error','Gagal membuat kelas!');
			redirect('vendor/kelas/baru');
		}else{
			$this->session->set_flashdata('status.notice','Berhasil membuat kelas baru!');
			redirect('vendor/kelas/detil/'.$id.'/info');
		}
	}
	
	public function update($id){
		$fields = array(
			'id','class_uri', 'class_nama', 'class_deskripsi', 'class_lokasi', 
			'class_peserta', 'class_harga', 'class_paket','class_peta','class_provinsi_id',
			'class_lokasi_id'
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
		$where = array(
				'id'=>$id, 
				'class_status >='=>NULL,
				'class_status'=>NULL,
				'active'=>NULL
		);
		if(!$this->is_admin) {
			$where['vendor_id']=$this->vendor->id;
		}
		$data = $this->vendor_class_model->get_class($where);
//		var_dump($data->row());exit;
		if(empty($data) || $data->num_rows() !== 1) {
			show_404();
		}
		$class = $data->row();
		$class->provinsi_title = empty($class->class_provinsi_id)?
				'Belum dipilih':
				$this->main_model->get_provinsi_name($class->class_provinsi_id);
		$class->lokasi_title = empty($class->class_lokasi_id)?
				'Belum dipilih':
				$this->main_model->get_lokasi_name($class->class_lokasi_id);
		$class->level = $this->vendor_class_model->get_class_multiple_level($id);
		$class->category = $this->vendor_class_model->get_class_category($id);
		// for developer only
		$status = 4;
		if($tabs == 'profile' && $class->active > 0) $tabs = 'preview';

		$per_jadwal = $this->vendor_class_model->get_class_per_sched_participant_full($id, $status);
		$attendance_only = $this->vendor_class_model->get_class_attendance_full($id, $status)->result();
		$sponsored = $this->vendor_class_model->get_class_sponsor_full($id, $status)->result();
		$attendance = array();
		foreach($per_jadwal->result() as $attendee){
			if(empty($attendance[$attendee->jadwal_id])){
				$attendance[$attendee->jadwal_id] = array(
					'waktu'		=> $attendee->jadwal_waktu,
					'topik'		=> $attendee->topik,
					'murid'	=> array(),
				);
			}
			$attendance[$attendee->jadwal_id]['murid'][] = array(
				'pemesan'	=> array(
					'nama'		=> $attendee->nama_pemesan,
					'email'		=> $attendee->email_pemesan,
					'phone'		=> $attendee->phone_pemesan,
				),
				'peserta'	=> array(
					'nama'		=> $attendee->nama_peserta,
					'email'		=> $attendee->email_peserta,
					'phone'		=> $attendee->phone_peserta,
				),
			);
			
		}
		$this->data['schedule_attendance'] = $per_jadwal->result();
		$this->data['attendance_data'] = $attendance_only;
		$this->data['attendance'] = $attendance;
		$this->data['sponsor_data'] = $sponsored;
		$this->data['sent_message'] = $this->vendor_class_model->get_sent_message($id);

		$this->data['categories'] = $this->vendor_class_model->get_category_list();
		$this->load->model('discount_model');
//		$this->data['discount'] = $this->discount_model->check_code_available($id,'4NM98H6R');
		$this->data['discount'] = $this->discount_model->get_diskon_code_for_class($id);
		$this->data['levels'] = $this->vendor_class_model->get_class_level_list();
		$this->data['class'] = $class;
		$this->data['jadwal'] = $this->vendor_class_model->get_class_schedule(array('class_id'=>$id));
		$this->data['biaya'] = $this->vendor_class_model->get_price(array('class_id'=>$id))->row();
		$this->data['summary'] = '';
		$this->data['tags'] = $this->vendor_class_model->get_tags($id);
		$this->data['tabs'] = $tabs;
		$this->data['sidebar'] = 'daftar_kelas';
		$this->data['status'] = $this->vendor_class_model->get_status_class($id);
        $this->new_design?
			$this->load->view('vendor/class/detail2', $this->data):
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
			'class_peserta_min' => $this->input->post('class_peserta_min', TRUE),
			'class_peserta_max' => $this->input->post('class_peserta_max', TRUE),
			'class_perserta_target' => $this->input->post('class_perserta_target', TRUE),
			'class_harga' => $this->input->post('class_harga', TRUE),
			'class_paket' => $this->input->post('class_paket', TRUE),
			'class_peta' => $this->input->post('class_peta', TRUE),
			'class_alasan' => $this->input->post('class_alasan', TRUE)
		);
		
		$this->vendor_class_model->update_class($data, array());
		redirect('vendor/kelas/detil/'.$id.'/info');
	}
	
	public function update_profile_2(){
		$id = $this->input->post('id');
		
		if(empty($id)) {
			show_404();
		}
		
		$active = (int)$this->vendor_class_model->get_class(array('id'=>$id, 'active'=>NULL, 'class_status >='=>NULL))
				->row()->active;
		
		$table['vendor_class'] = array(
			'class_nama','class_uri','class_deskripsi','class_paket','class_catatan','class_lokasi',
				'class_peta','class_provinsi_id','class_lokasi_id',
			'class_perserta_target','class_peserta_min','class_peserta_max','class_harga','class_alasan',
			'class_video'
		);
		$table['vendor_class_price'] = array(
			'price_per_session','class_include','discount'
		);
		$table['vendor_class_jadwal'] = array(
			'class_tanggal','class_jam_mulai','class_jam_selesai','class_topik'
		);
		$table['vendor_class_level'] = array(
			'level_id'
		);
		$table['vendor_class_category'] = array(
			'category_id'
		);
		$table['vendor_class_tag'] = array(
			'class_tags'
		);
		$data = array();
		$jadwal = array();
		$error_status = array();
		foreach($table as $tbl => $fields) {
			foreach($fields as $field) {
				if($field == 'class_tags')
					$data[$tbl][$field] = explode(',',$this->input->post($field));
				elseif($field == 'class_paket')
					$data[$tbl][$field] = (string)$this->input->post($field);
				else
					$data[$tbl][$field] = $this->input->post($field);
			}
		}
		if(!$active) {
			$kelas_jadwal = $data['vendor_class_jadwal'];
			foreach($kelas_jadwal['class_tanggal'] as $jadwal_ke => $kelas_tanggal) {
				if(!empty($kelas_tanggal) 
						&& !empty($kelas_jadwal['class_jam_mulai'][$jadwal_ke]) 
						&& !empty($kelas_jadwal['class_jam_selesai'][$jadwal_ke])
				){
					$mulai = explode(':',$kelas_jadwal['class_jam_mulai'][$jadwal_ke]);
					$tamat = explode(':',$kelas_jadwal['class_jam_selesai'][$jadwal_ke]);
					$kelas_tanggal = date('Y-m-d', strtotime($kelas_tanggal));
					$jadwal[] = array(
						'class_id'				=> $id,
						'jadwal_id'				=> $jadwal_ke,
						'class_tanggal'			=> $kelas_tanggal,
						'class_jam_mulai'		=> $mulai[0],
						'class_menit_mulai'		=> $mulai[1],
						'class_jam_selesai'		=> $tamat[0],
						'class_menit_selesai'	=> $tamat[1],
						'class_waktu'			=> 1,
						'class_jadwal_topik'	=> $kelas_jadwal['class_topik'][$jadwal_ke]
					);
				}
			}
		}
		$data['vendor_class']['id'] = $id;
		$data['vendor_class'] = array_filter($data['vendor_class'],'strlen');

		$no_files = FALSE;
		if(!empty($_FILES['class_image']) ) {
			if($_FILES['class_image']['error'] > 0 || $_FILES['class_image']['size'] < 10){
//				var_dump($_FILES);
				$no_files = TRUE;
			} else {
				@mkdir(rtrim(str_replace('\\','/',FCPATH), '/')."/images/class/{$id}/", 0777, TRUE);
				$opt = array(
					'file_name'		=> 'main_picture',
					'upload_path'	=> rtrim(FCPATH, '/')."/images/class/{$id}/",
					'allowed_types'	=> '*',
					'is_image'		=> TRUE,
					'overwrite'		=> TRUE
				);
				$this->load->library('upload', $opt);
				if(!$this->upload->do_upload('class_image')){
//					var_dump($this->upload->error_msg);
					$no_files = TRUE;
				} else {
					$files = $this->upload->data();
				}
			}
		} else {
//			var_dump($_FILES);
			$no_files = TRUE;
		}
		
		$ori_tags = explode(',',$this->vendor_class_model->get_tags($id));
		foreach($ori_tags as $o_t) {
			$this->vendor_class_model->delete_tags($id, $o_t);
		}
		
		foreach($data['vendor_class_tag']['class_tags'] as $tag) {
			$this->vendor_class_model->set_tags($id, $tag);
		}

		if(!$no_files && !empty($files) && !empty($files['file_name'])) {
			$data['vendor_class']['class_image'] = $files['file_name'];
//		} else {
//			exit;
//			$data['class_image'] = NULL;
		}

		$this->load->helper('url');
		if(!empty($data['vendor_class']['class_uri'])){
			$data['vendor_class']['class_uri'] = url_title(strtolower($data['vendor_class']['class_uri']));
		}
//var_dump($jadwal);exit;

		$this->vendor_class_model->update_class($data['vendor_class'], array());

		if($this->vendor_class_model->add_class_price($id, $data['vendor_class_price']) === FALSE){
			$error_status[] = 'harga kelas';
		}
//		$this->vendor_class_model->update_class_schedule($id)
		if(!$active) {
			$this->vendor_class_model->clear_class_schedule($id);
			foreach($jadwal as $sched) {
				if($this->vendor_class_model->add_update_class_schedule($sched)===FALSE) {
					if(!in_array('jadwal kelas', $error_status)) $error_status[] = 'jadwal kelas';
				}
			}
		}

		$this->vendor_class_model->clear_class_level($id);
		$this->vendor_class_model->clear_class_category($id);
		if(!$this->vendor_class_model->add_class_level($id, $data['vendor_class_level']['level_id'])){
			$error_status[] = 'level kelas';
		}
		if(!$this->vendor_class_model->add_class_category($id, $data['vendor_class_category']['category_id'])){
			$error_status[] = 'kategori kelas';
		}
		if(!empty($error_status)) {
			$this->session->set_flashdata('status.warning', 'Gagal dalam update: '.implode(', ',$error_status));
		} else {
			$this->session->set_flashdata('status.notice', 'Update kelas berhasil!');
		}
		
//		echo '<pre>';
//		var_dump($data);

		redirect('vendor/kelas/detil/'.$id.'/preview');
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
					'allowed_types'	=> '*',
					'is_image'		=> TRUE,
					'overwrite'		=> TRUE
				);
				$this->load->library('upload', $opt);
				if(!$this->upload->do_upload('class_image')){
//					var_dump($this->upload->error_msg);
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
		
		$ori_tags = explode(',',$this->vendor_class_model->get_tags($id));
		
		
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
		
		header('Content-type: application/json');
		
		if($this->vendor_class_model->set_published_class($id, $status)) {
			echo json_encode(array(
				'status'		=> 'OK',
				'message'		=> $status==1?'Class is published!':'Class has been drafted!'
			));
		}else{
			echo json_encode(array(
				'status'		=> 'KO',
				'message'		=> $status==1?'Class cannot be published!':'Class cannot be unpublished!'
			));
		}
	}
	
	public function attendance_list($id, $status = 4) {
		$participant = $this->vendor_class_model->get_class_participant_full($id, $status)->result();
		$per_jadwal = $this->vendor_class_model->get_class_per_sched_participant_full($id, $status);
		$attendance_only = $this->vendor_class_model->get_class_attendance_full($id, $status)->result();
		$sponsored = $this->vendor_class_model->get_class_sponsor_full($id, $status)->result();
		$attendance = array();
		foreach($per_jadwal->result() as $attendee){
			if(empty($attendance[$attendee->jadwal_id])){
				$attendance[$attendee->jadwal_id] = array(
					'waktu'		=> $attendee->jadwal_waktu,
					'topik'		=> $attendee->topik,
					'peserta'	=> array()
				);
			}
			$attendance[$attendee->jadwal_id]['peserta'][$attendee->peserta_id] = array(
				'nama'			=> $attendee->nama_peserta,
				'email'			=> $attendee->email_peserta,
				'phone'			=> $attendee->phone_peserta
			);
			
		}
		echo "<pre>\n";
		echo "For email blast: (participant only)\n";
		var_dump($attendance_only);
		echo "For email blast: (sponsor only)\n";
		var_dump($sponsored);
		echo "For email blast: (all)\n";
		var_dump($participant);
		echo "For participant list per session:\n";
		var_dump($attendance);
	}
	
	public function add_discount() {
		$class_id = $this->input->post('id', TRUE);
		$scope = $this->input->post('scope', TRUE);
		$code = strtoupper($this->input->post('code_discount', TRUE));
		$nominal_type = $this->input->post('nominal_type', TRUE);
		$nominal_value = $this->input->post('nominal_value', TRUE);
		$usage = $this->input->post('jumlah', TRUE) == '*'?'9999':$this->input->post('usage_qty');
		
		$start_time = $this->input->post('begin', TRUE) == '*'?
				'1971-01-01 00:00:00':
				date('Y-m-d', strtotime($this->input->post('begin_date', TRUE)));
		$ended_time = $this->input->post('ended', TRUE) == '*'?
				'2200-01-01 00:00:00':
				date('Y-m-d', strtotime($this->input->post('ended_date', TRUE)));
		
		//$session_ids = $this->input->post('session', TRUE);
		$session_id = 0;
		$discount_main = array(
			'code'		=> $code,
			'class_id'	=> $class_id,
			'session_id'=> $session_id,
			'scope'		=> $scope,
			'max_amount'=> $usage,
			'start_date'=> $start_time,
			'expire_date'=> $ended_time
		);
		
		$discount_value = array(
			'type'		=> $nominal_type,
			'value'		=> $nominal_value
		);
		
		$discount = array(
			'main'	=> $discount_main,
			'value'	=> $discount_value,
		);
		$this->load->model('discount_model');
		$check = $this->discount_model->create_diskon($discount);
		if($check) {
			redirect('vendor/kelas/detil/'.$class_id.'/discount');
		} else {
			
		}
	}
	
	public function delete_discount($code_discount, $class_id) {
		if(!$this->vendor_class_model->is_my_class($class_id)) {
			$this->session->set_flashdata('status.warning','You are NOT the owner of this class!');
			redirect('vendor/kelas/detil/'.$class_id.'/discount');
			return;
		}
		$this->load->model('discount_model');
		if(!$this->discount_model->check_code($class_id, $code_discount)) {
			$this->session->set_flashdata('status.error','Discount code is not found!');
			redirect('vendor/kelas/detil/'.$class_id.'/discount');
			return;
		}
		if(!$this->discount_model->delete_discount($code_discount, $class_id)) {
			redirect('vendor/kelas/detil/'.$class_id.'/discount');
			$this->session->set_flashdata('status.error','Discount code failed to be deleted!');
			return;
		} else {
			$this->session->set_flashdata('status.notice',"Discount <strong>{$code_discount}</strong> Deleted!");
			redirect('vendor/kelas/detil/'.$class_id.'/discount');
			return;
		}
	}
	
	public function send_email() {
		$reciever_type = $this->input->post('penerima', TRUE);
		$type = $this->input->post('jenis_pesan', TRUE);
		$subject = $this->input->post('subject', TRUE);
		$message = $this->input->post('message');
		$id = (int) $this->input->post('id', TRUE);
		$attachment = FALSE;
		if(!empty($_FILES['attach'])) {
			$uploads_dir = FCPATH.'documents/email_attach/kelas/'.$id;
			if(!is_dir($uploads_dir)) mkdir($uploads_dir, 0775, TRUE);
			$save_path = NULL;
			if ($_FILES["attach"]["error"] == UPLOAD_ERR_OK) {
				$tmp_name = $_FILES["attach"]["tmp_name"];
				$name = microtime(TRUE).'-'.$_FILES["attach"]["name"];
				$name = array_shift(str_split(strtolower($name),65));
				$name = preg_replace('/^[a-z0-9\-]/','-', $name);
				$name = str_replace('--', '-', $name);
				$save_path = "$uploads_dir/$name";
				move_uploaded_file($tmp_name, $save_path);
				$attachment = TRUE;
			}
		}
		$this->load->model('email_model');
		$this->load->model('vendor_model');
		
		$message_id = $this->vendor_class_model->save_communication(array(
			'class_id'		=> $id,
			'to'			=> $reciever_type,
			'type'			=> $type,
			'subject'		=> $subject,
			'message'		=> $message,
			'attachment'	=> $attachment?$save_path:NULL
		));
		
		$this->email_model->student_communication_blast($id, $message_id);
		
//		$vendor = $this->vendor_model->get_profile(array('id'=>$this->data['user']['id']))->row();
//		$this->email_model->vendor_send_message_to($vendor, $id, $subject, $message, $reciever_type, $attachment?"{$uploads_dir}/{$name}":NULL);

		redirect('vendor/kelas/detil/'.$id.'/email_blast');
	}
	
	public function resend_email() {
		$class_id = (int)$this->input->get('class_id', TRUE);
		$email_id = (int)$this->input->get('email_id', TRUE);
		$email_data = (array)$this->vendor_class_model->get_sent_message($class_id, $email_id);
		
		$email_data['subject'] = 'Resend: '.$email_data['subject'];
		unset($email_data['id']);
		$id = $this->vendor_class_model->save_communication($email_data);
		$this->email_model->student_communication_blast($class_id, $id);
		
		redirect('vendor/kelas/detil/'.$class_id.'/email_blast');
	}

	public function request_publish($id) {
		$status = $this->vendor_class_model->get_status_class($id);
		if($status->active == 0 && $status->class_status != 4) {
			$this->vendor_class_model->set_status_class($id,4);
			$vendor = $this->vendor_model->get_vendor_detail($this->vendor->id);
			$class = $this->vendor_class_model->get_class(array('id'=>$id,'class_status >=' => NULL,
																'active'=>NULL))->row();
			$this->email_model->vendor_create_class_success($vendor, $class);
			$this->session->set_flashdata('status.notice', 'Kelas anda akan melewati proses verifikasi admin. Terima kasih');
		} else {
			if($status->active == 1) {
				$this->session->set_flashdata('status.warning', 'Kelas anda sudah di publish.');
			} elseif($status->class_status == 4) {
				$this->session->set_flashdata('status.warning', 'Kelas anda sudah dalam proses verifikasi admin.');
			}
		}
		redirect('vendor/kelas/detil/'.$id);
	}

    public function request_unpublish($id) {
		$status = $this->vendor_class_model->get_status_class($id);
		if($status->active == 1 && $status->class_status != 4) {
			$this->vendor_class_model->set_status_class($id,4);
			$this->session->set_flashdata('status.notice', 'Anda akan dihubungi oleh admin kami untuk proses unpublish');
		} else {
			if($status->active == 0) {
				$this->session->set_flashdata('status.warning', 'Kelas anda sudah di dalam draft.');
			} elseif($status->class_status == 4) {
				$this->session->set_flashdata('status.warning', 'Kelas anda sudah dalam proses verifikasi admin.');
			}
		}
		redirect('vendor/kelas/detil/'.$id);
    }
}

// END OF kelas.php File