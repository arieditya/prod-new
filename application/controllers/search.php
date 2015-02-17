<?php if(!defined('BASEPATH')) die('Die already!');
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 2/16/15
 * Time: 10:09 AM
 * Proj: prod-new
 */
class Search extends MY_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('guru_model');
		$this->load->model('kelas_model');
		$this->load->model('profile_model');
	}
	
	public function _remap() {
		/**
		 * p: province
		 * c: city
		 * k: kategori
		 * s: subject
		 * l: location => will search thorough address, city and province!
		 */
		$default = array('p','c','k','s','l');
		$parameters = $this->uri->uri_to_assoc(2, $default);
		$parameters = array_filter($parameters);
		
		// init
		$kategori = $matpel = $city = $provinsi = NULL;
		
		foreach($parameters as &$parameter) {
			$parameter = urldecode($parameter);
			$parameter = preg_replace('/\-/',' ',$parameter);
		}
		
		$data_raw = $this->guru_model->search($parameters);
		$data = $data_raw->result();
		
		$rating = array();
		$t_data = array();
//		var_dump($data);

		foreach($data as $_d) {
			$r1 = $this->guru_model->get_rating_by_feedback($_d->guru_id);
			$r2 = $this->guru_model->get_calculated_rating($_d->guru_id);
			$rating[] = $r1 + $r2;
			$t_data[] = array(
				'rating'	=> $r1 + $r2,
				'data'		=> $_d
			);
		}
		
		array_multisort($rating, SORT_DESC, $data);

		$total_data = count($data);
		$page = ((int)$this->input->get('page', TRUE));
		if($page > 0) $page -= 1;
		else $page = 0;
		$perpage = 10;
		
		$data = array_slice($data, $page * $perpage, $perpage);
		
//		var_dump($data); 
//		var_dump($rating); 
		
//		exit;
		
		$title = '';
		if(!empty($parameters['s'])) {
			$title .= $parameters['s'].' ';
			$matpel = $this->guru_model->get_matpel_by_name($parameters['s']);
		}
		if(!empty($parameters['k'])) {
			$title .= 'untuk '.$parameters['k'].' ';
			$kategori = $this->guru_model->get_jenjang_by_name($parameters['k']);
		}
		
		if(!empty($parameters['l']) || !empty($parameters['c']) || !empty($parameters['p'])) {
			$title .= 'di ';
			$f_l = TRUE; // first
			if(!empty($parameters['l'])) {
				$title .= $parameters['l'].' ';
				$f_l = FALSE;
			}
			if(!empty($parameters['c'])) {
				if(!$f_l) $title .= ', ';
				$title .= $parameters['c'].' ';
				$city = $this->guru_model->get_city_by_name($parameters['c']);
				$f_l = FALSE;
			}
			if(!empty($parameters['p'])) {
				if(!$f_l) $title .= ', ';
				$title .= $parameters['p'].' ';
				$provinsi = $this->guru_model->get_province_by_name($parameters['p']);
			}
		}
		
        $temp['css'] = array('jquery.alerts','validation','cariguru','profile');
        $temp['meta'] = array(
			'title'			=> $title,
			'description'	=> 'Cari guru privat '.$title.' murah dan bagus di ruangguru.com',
			'keywords'		=> array(
					'Guru Privat '.$title,
					'Guru '.$title
			)
		);
		$input = array(
			'matpel'	=> $matpel,
			'jenjang'	=> $kategori,
			'provinsi'	=> $provinsi,
			'lokasi'	=> $city
		);
		$dataview = array(
			'temp'	=> $temp,
			'guru'	=> array(
				'data'	=> $data,
				'total'	=> $total_data,
				'page'	=> $page,
			),
			
			'show_result'	=> TRUE,
			'input'	=>	$input,
			'pagination' => array(
				'page'	=> $page,
				'perpage'=> $perpage
			),
			'page'	=> 0
		);
		if($this->input->get('debug') == 'me') {
			var_dump($data);exit;
		}
        $temp['css'] = array('jquery.alerts','validation','cariguru','profile');
        
        $this->load->view('front/cari-guru/index2',$dataview);
        
//		var_dump($this->db->last_query());
	}
}

// END OF search.php File