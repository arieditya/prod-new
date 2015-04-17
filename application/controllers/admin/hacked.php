<?php if(!defined('BASEPATH')) die('Die already!');
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 4/13/15
 * Time: 4:03 PM
 * Proj: prod-new
 */
class Hacked extends ADMIN_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/admin_model');
		$this->load->model('guru_model');
	}
	
	public function sertifikat() {
		$search = (int)$this->input->get('key',TRUE);
		$this->load->helper('file');
		$path = str_replace('/administrator', '', FCPATH).'/./files/sertifikat';
		$files = get_dir_file_info($path);
		$u = array();
		foreach($files as $file) {
			$id = array_shift(explode('-',$file['name']));
			if(!empty($search)) if((int)$id != $search) continue;
			if(empty($u[$id])) $u[$id] = array();
			$u[$id][] = $file['name'];
			sort($u[$id]);
			
		}
		krsort($u);
		$this->load->model('guru_model');
		$sertifikat = $this->guru_model->kualifikasi_check();
		$data = array();
		foreach($u as $id => $user) {
			if(!is_numeric($id)) {
				//var_dump($id);
				continue;
			}
			if(empty($data[$id])) $data[$id] = array();
			foreach($user as $file) {
				$kid = 0;
				$kualifikasi = array('text'=>'', 'id'=>$kid);
				if(!empty($sertifikat[$id]) && !empty($sertifikat[$id][$file])) {
					$kualifikasi = $sertifikat[$id][$file];
				}
				$data[$id][$file] = $kualifikasi;
			}
			
		}
//		echo "<pre>";var_dump($data);exit;
//		var_dump($data);exit;
        $this->data['active'] = 1;
        $this->data['breadcumb'] = $this->admin_model->get_breadcumb(array('hacked'=>'hack'));
		$this->data['data'] = $data;
		$this->data['content'] = $this->load->view('admin/feedback/sertifikasi_titipan_hacked.php',$this->data,TRUE);
        $this->load->view('admin/admin_v',$this->data);
	}
	
	public function sertifikat_copy() {
		header('Content-type: application/json');
		$guru_id = $this->input->get('guru_id', TRUE);
		$kualifikasi = $this->input->get('kualifikasi', TRUE);
		
		$file = rawurldecode($this->input->get('file', TRUE));
		$ext = array_pop(explode('.',$file));
		$new_file = $this->check_sertifikat($guru_id).'.'.$ext;
		$path = str_replace('/administrator','',FCPATH.'files/sertifikat/');
		copy($path.$file, $path.$new_file);
		$data = array(
			'guru_id'		=> $guru_id,
			'kualifikasi'	=> $kualifikasi,
			'sertifikat'	=> $new_file,
			'is_checked'	=> 0
		);
		$insert_id = $this->guru_model->insert_kualifikasi_2($data);
		if($insert_id > 0) {
			echo json_encode(array(
				'status'	=> 'OK',
				'message'	=> '',
				'data'		=> array(
					'file_from' 	=> $file,
					'file_to'		=> $new_file,
					'kualifikasi'	=> $kualifikasi,
					'guru_id'		=> $guru_id,
					'form_id'		=> $this->input->get('form_id', TRUE),
					'kualifikasi_id'=> $insert_id
				)
			));
		} else {
			echo json_encode(array(
				'status'	=> 'KO',
				'message'	=> 'Fail!',
				'data'		=> array(
					'file_from' 	=> $file,
					'file_to'		=> $new_file,
					'kualifikasi'	=> $kualifikasi,
					'guru_id'		=> $guru_id,
					'form_id'		=> $this->input->get('form_id', TRUE),
					'kualifikasi_id'=> $insert_id
				)
			));
		}
	}
	public function check_sertifikat($id, $printout = FALSE) {
		if($printout)echo "<pre>";
		$path = str_replace('/administrator','',FCPATH.'files/sertifikat');
		$data = glob($path."/{$id}-*");
		$counter = 1;
		if($printout)var_dump($data);
		foreach($data as $dt) {
			$ext = array_pop(explode('.',$dt));
			$dt = str_replace('.'.$ext, '', $dt);
			$explode = explode('-',$dt);
			if($printout)var_dump($explode);
			if(count($explode) == 2) {
				preg_match('/[^0-9]/', $explode[1],$match);
				if($printout)var_dump($match);
				if(empty($match)) {
					$cnt = (int) $explode[1];
					//echo "EXPLODE[1]: {$cnt}\n";
					if($counter <= $cnt) {
						$counter = $cnt+1;
					}
				}
				
			}
		}
		if(!$printout)
			return "{$id}-{$counter}";
		else
			echo "{$id}-{$counter}";
	}
	public function sertifikat_update() {
		header('Content-type: application/json');
		$guru_id = $this->input->get('guru_id', TRUE);
		$kualifikasi = $this->input->get('kualifikasi', TRUE);
		$file = $this->input->get('file', TRUE);
		$id = $this->input->get('kualifikasi_id', TRUE);
		$data = array(
			'kualifikasi'	=> $kualifikasi,
		);
		if($this->guru_model->update_kualifikasi($data, $id)) {
			echo json_encode(array(
				'status'	=> 'OK',
				'message'	=> '',
				'data'		=> array(
					'file_from' 	=> $file,
					'file_to'		=> $file,
					'kualifikasi'	=> $kualifikasi,
					'guru_id'		=> $guru_id,
					'form_id'		=> $this->input->get('form_id', TRUE),
					'kualifikasi_id'=> $id
				)
			));
		} else {
			echo json_encode(array(
				'status'	=> 'KO',
				'message'	=> 'Fail!',
				'data'		=> array(
					'file_from' 	=> $file,
					'file_to'		=> $file,
					'kualifikasi'	=> $kualifikasi,
					'guru_id'		=> $guru_id,
					'form_id'		=> $this->input->get('form_id', TRUE),
					'kualifikasi_id'=> $id
				)
			));
		}
	}
}

// END OF hacked.php File