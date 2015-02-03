<?php

ob_start();

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cari_guru extends CI_Controller {
    private $id;
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('guru_model');
        $this->load->model('profile_model');
        $this->load->model('kelas_model');
        $this->load->model('murid_model');
        $this->load->model('request_model');
        $this->load->model('duta_guru_model');
    }
    
    public function check($url=null){
        $this->id = $this->session->userdata('murid_id');
        if(empty($this->id)){
            if(!empty($url)){
                $this->session->set_userdata('redirected_url',$url);
            }
            redirect('murid/login');
        }
    }
    
    public function index(){
        $temp['css'] = array(1=>'cariguru');
        $this->load->view('header',$temp);
        $data['progress'] = $this->load->view('front/cari_guru/progress',array('progress'=>1),TRUE);
        $this->load->view('front/cari_guru/cari',$data);
        $this->load->view('footer');
    }
    
    public function review(){
        $this->load->model('profile_model');
        $temp['css'] = array(1=>'cariguru',2=>'profile');
        $this->load->view('header',$temp);
        $guru = $this->session->userdata('pilihan_guru');
        $data['pilihan'] = $this->guru_model->get_guru_in_array($guru);
        $data['progress'] = $this->load->view('front/cari_guru/progress',array('progress'=>2),TRUE);
        $this->load->view('front/cari_guru/review',$data);
        $this->load->view('footer');
    }
    
    public function track(){
        $temp['css'] = array('cariguru','validation');
        $this->load->view('header',$temp);
        $data['progress'] = $this->load->view('front/cari_guru/progress',array('progress'=>4),TRUE);
        $this->load->view('front/cari_guru/track',$data);
        $this->load->view('footer');
    }
    
    public function track_submit(){
        $this->load->library('form_validation');
        $input['email'] = $this->input->post('email');
        $input['hp'] = $this->input->post('handphone');
        $input['code'] = $this->input->post('code');
        if ($this->form_validation->run('track_request')) {
            $this->load->model('request_model');
            $request = $this->request_model->find($input);
            if(empty($request)){
                $this->session->set_flashdata('track_notification','Request Anda tidak dapat kami temukan');
                redirect('cari_guru/track');
            }else{
                $temp['css'] = array('cariguru');
                $this->load->view('header', $temp);
                $data['request'] = $request;
                $data['progress'] = $this->load->view('front/cari_guru/progress', array('progress' => 4), TRUE);
                $this->load->view('front/cari_guru/track_view', $data);
                $this->load->view('footer');
            }
        }else{
            $this->session->set_flashdata('track_notification','Ada kesalahan dalam data yang Anda berikan');
            redirect('cari_guru/track');
        }
    }
    
    public function request(){
        $this->check('cari_guru/request');
        $this->load->library('recaptcha');
        $temp['css'] = array('cariguru','validation');
        $this->load->view('header',$temp);
        $guru = $this->session->userdata('pilihan_guru');
        $data['pilihan'] = $this->guru_model->get_guru_in_array($guru);
	   $data['days'] = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
        $data['jadwal'] = $this->profile_model->get_jadwal_map($this->id);
        $data['progress'] = $this->load->view('front/cari_guru/progress',array('progress'=>3),TRUE);
        $this->load->view('front/cari_guru/request',$data);
        $this->load->view('footer');
    }
    
    public function request_submit(){
        $this->load->library('recaptcha');
        $this->load->library('form_validation');
	   
	   //array jadwal to string//
	   $jadwal_available = $this->input->post('catch_jadwal');
	   $jyt = "";
	   
	   $guru = $this->session->userdata('pilihan_guru');
	   $matpel = $this->session->userdata['cari_guru']['matpel'];
	   
	   if(empty($jadwal_available)){
		$this->session->set_flashdata('request_notification','Pilih preferensi waktu belajar Anda, minimal 2 pilihan');
		if($this->input->post('requested_by') == 1){
			redirect('cari_guru/request');
		  }else{
			redirect('request_guru');
		  }
	   }else{
		foreach($jadwal_available as $jdwl){
		  $jyt .= $jdwl.';';
		}
	   }
	   //end of jadwal//
	   if($this->input->post('requested_by') == 1){
		$check_duta = $this->duta_guru_model->get_duta_guru_by_id($this->input->post('referal'));
	   
		$rj = $this->request_model->convert_jadwal($jyt); 
			foreach($guru as $g){
				if($rj["flag"] == 1) {
					$dd = array_keys($rj[$g]);
					$n = count($dd);
					$jadwal_kursus = "";
					$hari = 0;
					for($j=0;$j<$n;$j++){
						$hari++;
						$key = $dd[$j];
						if(max($rj[$g][$key]) == min($rj[$g][$key])){
							$jam = 1;
						}else{
							$jam = max($rj[$g][$key])-min($rj[$g][$key]);
						}
					} 
				}
			$total_jam = $jam * $hari;
			$tarif = $this->guru_model->get_hargapermatpel($g, $matpel)->result();
			$total_tarif = $total_jam * $tarif[0]->guru_matpel_tarif * $this->input->post('freq');
			if($total_tarif >= 1000000){
				$data_flag[$g] = 1;
			}else{
				$data_flag[$g] = 0;
			}
		}
		$ada = in_array(1, $data_flag);
		if($ada && $check_duta){
			$input['disc'] = 1;
		}else{
			$input['disc'] = 0;
		}
	   }

        $input['nama'] = $this->input->post('nama');
        $input['alamat'] = $this->input->post('alamat');
        $input['email'] = $this->input->post('email');
        $input['telp'] = $this->input->post('telp');
        $input['prioritas'] = $this->input->post('prioritas');
        $input['guru'] = $this->input->post('pilihan');
        $input['matpel'] = $this->input->post('matpel');
        $input['lokasi'] = $this->input->post('location');
        $input['freq'] = $this->input->post('freq');
        $input['budget'] = $this->input->post('budget');
	   $input['referal'] = $this->input->post('referal');
        $input['jyt'] = $jyt;
        $input['jkd'] = $this->input->post('jkd');
        $input['catatan'] = $this->input->post('catatan');
        $input['gender'] = $this->input->post('gender');
        $input['requested_by'] = $this->input->post('requested_by');
	   $metode = $this->input->post('metode');
	   $m = "";
	   foreach($metode as $met){
		$m .= $met.",";
	   }
	   $input['metode'] = $m;
	   //data murid//
	   $input['pass'] = 'e10adc3949ba59abbe56e057f20f883e';
	   $input['nik'] = '';
	   $input['kota'] = $input['lokasi'];
	   $input['alamat_domisili'] = '';
	   $input['hp'] =  $input['telp'];
	   $input['hp_2'] = '';
	   $input['telp_rumah'] = '';
        $input['telp_kantor'] = '';
        $input['instansi'] = '';
	   $input['tempatlahir'] = '';
        $input['lahir'] = '';
        $input['referral'] = '';
	   $input['murid_daftar'] = date("Y-m-d H:i:s");
        if ($this->form_validation->run('request_guru')) {
            $this->load->model('request_model');
		  if($this->email_check($input['email'])){
			$murid_id = $this->murid_model->insert_murid($input);
			$this->murid_model->send_email_request($id);
			$input['murid_id'] = $murid_id;
			$input['disc']=0;
		  }else{
			$input['murid_id'] = $this->session->userdata('murid_id');
			$input['disc']=0;
		  }
            $this->request_model->add($input);
		  if(empty($input['lokasi'])){
			if($input['disc']==0){
				$this->session->set_flashdata('request_guru_success',true);
			}else{
				$this->session->set_flashdata('request_guru_disc_success',true);
			}
		  }else{
			$this->session->set_flashdata('request_guru_by_success',true);
		  }
            $this->session->set_flashdata('enable_overlay',true);
            redirect('main/page');
        }else{
            $this->session->set_flashdata('request_notification','Kode keamanan yang Anda masukkan salah');
		  if($input['requested_by'] == 1){
			redirect('cari_guru/request');
		  }else{
			redirect('request_guru');
		  }
       }
    }
    
     public function email_check($str){
        if ($this->murid_model->check_email($str)) {
            $this->form_validation->set_message('email_check', 'Email yang Anda masukkan sudah terdaftar dalam sistem kami. Silahkan gunakan email yang lain');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    public function get_matpel($pend_id){
        $matpel = $this->guru_model->get_matpel($pend_id);
        echo json_encode($matpel->result());
    }
    
    public function result($page=null){
        $this->load->model('profile_model');
        //get input
	   if($page == null){
		if(($this->input->post('location') != "") || ($this->input->post('nama') != "") && ($this->input->post('location')>=0)){
			$input['nama'] = $this->input->post('nama');
			$input['provinsi'] = $this->input->post('provinsi');
			$input['lokasi'] = $this->input->post('location');
			$input['jenjang'] = $this->input->post('education');
			$input['matpel'] = $this->input->post('matpel');
			$input['guru'] = $this->input->post('guru');
			$input['gender'] = $this->input->post('gender');
			$input['umur'] = $this->input->post('age');
			$input['kategori'] = $this->input->post('edu');
			$input['sertifikat'] = $this->input->post('cert');
			$input['urutan'] = $this->input->post('sort');
			$input['matpel'] = $this->input->post('matpel');
			$input['tarif'] = $this->input->post('tarif');
			$metode = $this->input->post('metode');
			$m = "";
			foreach((array)$metode as $met){
				$m .= $met.",";
			}
			$input['metode'] = $m;
			$this->session->set_userdata('cari_guru',$input);
			$data['show_result'] = true;
		}else{
			$input = $this->session->userdata('cari_guru');
			$data['show_result'] = true;
			//if(empty($input['lokasi'])){
			//echo 4;
				//$input = $this->session->userdata('cari_guru');
				//$data['show_result'] = true;
				//redirect('cari_guru');
			//}
		}
	} else {
		$input = $this->session->userdata('cari_guru');
		$data['show_result'] = true;
	}
	   
	   //print_r($this->input->post('edu'));
        //get result
        $data['offset'] = 5;
        $data['page'] = (empty($page))?0:$page;
        if($page==null){
            $start = 0;
        }else{
            $start = $page;
        }
        $data['guru'] = $this->guru_model->find_and($input,$start,$data['offset']);
        $data['input'] = $input;
        //$data['guru_total'] = $this->guru_model->find_all($input);
        $this->load->library('pagination');
        $config['base_url'] = base_url().'cari_guru/result/';
        $config['total_rows'] = $data['guru']['total'];
        $config['per_page'] = $data['offset'];
        $this->pagination->initialize($config);
        //displaying result
        $data['pagination'] = $this->pagination->create_links();
        $data['pilihan_guru'] = $this->session->userdata('pilihan_guru');
        $data['progress'] = $this->load->view('front/cari_guru/progress',array('progress'=>1),TRUE);
        $temp['css'] = array('jquery.alerts','validation','cariguru','profile');
        $this->load->view('header',$temp);
        $this->load->view('front/cari_guru/cari',$data);
        $this->load->view('footer');
    }
    
    public function update_pilih_guru($guru_id,$mode){
        $guru = $this->session->userdata('pilihan_guru');        
        if($mode == "add") {
            if (count($guru) >= 3) {
                echo "false";
            } else if (!empty($guru)) {
                if (!in_array($guru_id, $guru)) {
                    $guru[$guru_id] = $guru_id;
                    $this->session->set_userdata('pilihan_guru', $guru);
                }
                echo "true";
            } else {
                $guru[$guru_id] = $guru_id;
                $this->session->set_userdata('pilihan_guru', $guru);
                echo "true";
            }
        }else if($mode=="remove"){
            if(!empty($guru)){
                unset($guru[$guru_id]);
                $this->session->set_userdata('pilihan_guru', $guru);
                echo "true";
            }else{
                echo "false";
            }
        }
    }
    
    public function  hapus_pilihan($guru_id){
        $this->update_pilih_guru($guru_id, "remove");
        redirect('cari_guru/review');
    }
    
    public function  hapus_pilihan_request($guru_id){
        $this->update_pilih_guru($guru_id, "remove");
        redirect('cari_guru/request');
    }
    
    public function  debug(){
        $guru = $this->session->userdata('pilihan_guru');
        echo print_r($guru);
    }
    
    function check_captcha($val) {
        if ($this->recaptcha->check_answer($this->input->ip_address(), $this->input->post('recaptcha_challenge_field'), $val)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_captcha', $this->lang->line('recaptcha_incorrect_response'));
            return FALSE;
        }
    }
}