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
		
		if($this->input->get('debug') === 'me') {
			error_reporting(E_ALL);
		}
		$r = 'uri_to_assoc';
		if($this->uri->segment(1) == 'cari') $r = 'ruri_to_assoc';
//		var_dump($this->uri->{$r}(2));exit;
		$default = array('p','c','k','s','l','n');
		$parameters = $this->uri->{$r}(2, $default);
		$parameters = array_filter($parameters);
		ksort($parameters);
		
		// init
		$name = $kategori = $matpel = $city = $provinsi = NULL;
		
		foreach($parameters as &$parameter) {
			$parameter = urldecode($parameter);
			$parameter = preg_replace('/\-/',' ',$parameter);
		}
		
		$key = md5(json_encode($parameters));
		if(FALSE === ($data = $this->guru_model->get_cache($key))) {
			$data = $this->guru_model->search($parameters, TRUE);
			
			$rating = array();
			$t_data = array();
	//		var_dump($data);
	
			foreach($data as $_d) {
				$rates = $this->guru_model->get_full_guru_rating($_d->guru_id);
				$rating[] = $rates;
				$t_data[] = array(
					'rating'	=> $rates,
					'data'		=> $_d
				);
			}
			
			array_multisort($rating, SORT_DESC, $data);
			$this->guru_model->set_cache($key, $data);
		}

		if($this->input->get('debug') === 'me') {
			var_dump($data);
			exit;
		}
//		$data_raw = $this->guru_model->search($parameters);
		
//		echo $data;exit;
		
		// Coba bikin pagination nya...
		// $page = halaman saat ini
		// $total_page = total halaman seluruhnya
		// $perpage = data yg ditampilkan per halaman
		// $total_data = seluruh data yang ada
		// $step = jumlah halaman ke depan/ke belakang yang di tampilkan
		// $content = no. halaman pagination yg (akan) ditampilkan
		$total_data = count($data);
		$page = ((int)$this->input->get('page', TRUE));
		if($page > 0) {
			$current = $page;
			$page -= 1;
		}else {
			$current = 1;
			$page = 0;
		}
		$perpage = 5;
		$total_page = ceil($total_data / $perpage);
		$step = 2;

		$first = $current-$step;
		$first = $first<=1?1:$first;
		$last = $current+$step;
		$last = $last>=$total_page?$total_page:$last;
		
		$add_next = FALSE;
		$add_prev = FALSE;
		if($current<$last) {
			$add_next = TRUE;
		}
		if($current>$first) {
			$add_prev = TRUE;
		}
		$list_page = range($first, $last);
		$pagination_link = '';
		foreach($list_page as $list) {
			if($list == $current) {
				$pagination_link .= 
						'<div class="page-wrap page-current">'
							.'<div class="page-link">'
								.$list
							.'</div>'
						.'</div>';
			} else {
				$pagination_link .= 
						'<div class="page-wrap">'
							.'<a class="page-link" href="'.current_url().'?page='.$list.'">'
								.$list
							.'</a>'
						.'</div>';
			}
		}
		if($add_prev) {
			$pagination_link = 
						'<div class="page-wrap">'
							.'<a class="page-link" href="'.current_url().'?page='.((int)$current-1).'">'
								.'&lt;'
							.'</a>'
						.'</div>'.$pagination_link;
		}
		if($add_next) {
			$pagination_link .= 
						'<div class="page-wrap">'
							.'<a class="page-link" href="'.current_url().'?page='.((int)$current+1).'">'
								.'&gt;'
							.'</a>'
						.'</div>';
		}
		
		$data = array_slice($data, $page * $perpage, $perpage);
		
		$title = 'Guru ';
		if(!empty($parameters['s'])) {
			$matpel = $this->guru_model->get_matpel_by_name($parameters['s']);
			$title .= $matpel->matpel_title.' ';
		} else {
			$title .= 'Privat ';
		}
		if(!empty($parameters['k'])) {
			$kategori = $this->guru_model->get_jenjang_by_name($parameters['k']);
//			$title .= 'untuk '.$parameters['k'].' ';
			$title .= 'untuk '.$kategori->jenjang_pendidikan_title.' ';
		}
		
		if(!empty($parameters['l']) || !empty($parameters['c']) || !empty($parameters['p'])) {
			$title .= 'di ';
			$f_l = TRUE; // first
			if(!empty($parameters['l'])) {
				$title .= ucwords($parameters['l']);
				$f_l = FALSE;
			}
			if(!empty($parameters['c'])) {
				$city = $this->guru_model->get_city_by_name($parameters['c']);
				if(!$f_l) $title .= ', ';
				else $title .= ' ';
				$title .= $city->lokasi_title;
				$f_l = FALSE;
			}
			if(!empty($parameters['p'])) {
				$provinsi = $this->guru_model->get_province_by_name($parameters['p']);
				if(!$f_l) $title .= ', ';
				else $title .= ' ';
				$title .= $provinsi->provinsi_title;
			}
		}
		
		$title = str_replace('  ',' ', $title);
		$desc_ = str_replace('Privat ', '', $title);
		$desc_ = str_replace('Guru ', '', $title);
		$desc  = "Guru {$desc_}; Guru Privat {$desc_}; Les {$desc_}; Les Privat {$desc_}; Guru Les {$desc_}; Guru Les Privat {$desc_}";
		
        $temp['css'] = array('jquery.alerts','validation','cariguru','profile');
        $temp['meta'] = array(
			'title'			=> $title,
			'description'	=> 'Temukan '.$title.' murah dan berkualitas di ruangguru.com',
			'keywords'		=> array(
				$desc
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
				'perpage'=> $perpage,
				'link'	=> $pagination_link
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