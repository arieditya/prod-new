<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Guru extends MY_Controller {
    private $id;

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
	   $this->load->helper('pdf_helper');
        $this->load->model('guru_model');
    }
    
    public function check(){
        $this->id = $this->session->userdata('guru_id');
        if(empty($this->id)){
            redirect('guru/login');
        }
    }
    
    public function index(){
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(empty($is_logged_in)){
            redirect('guru/reg_guru');
        }else{
            redirect('profile');
        }
    }
    
    public function view($guru_id){
        $this->load->model('profile_model');
	   $data['pilihan_guru'] = $this->session->userdata('pilihan_guru');
        $data['guru'] = $this->profile_model->get_profile_guru($guru_id);
        $data['rating'] = $this->guru_model->get_calculated_rating($guru_id);
        $temp['css'] = array(1=>'guru',2=>'profile');
        $temp['kelas'] = $this->guru_model->get_kelas($guru_id);
        $this->load->view('header',$temp);
        $this->load->view('front/guru/view',$data);
        $this->load->view('footer');
    }
    
    /*** LOGIN ***/
    public function login(){
        $temp['css'] = array(1=>'validation',2=>'guru');
        $this->load->view('header',$temp);
          if(($this->session->userdata('murid_id') || $this->session->userdata('duta_guru_id') || $this->session->userdata('is_logged_in'))){
			$this->session->sess_destroy();
			redirect('main/page');
		} else {
			$this->load->view('front/guru/login');
		}
        $this->load->view('footer');
    }
    
    public function login_submit(){
        $input['email'] = $this->input->post('email');
        $input['password'] = $this->input->post('password');
        $guru = $this->guru_model->check_login($input);
        if(empty($guru)){
            $this->session->set_flashdata('login_guru_notif','Kombinasi email dan password yang Anda masukkan salah, silahkan coba lagi.');
            redirect('guru/login');
        }else if($guru->guru_blocked == 1){
            $this->session->set_flashdata('login_guru_notif','Akun Anda terblokir, silahkan hubungi tim Ruangguru.');
            redirect('kontak_kami');
        }else{
            $this->session->set_userdata('guru_id',$guru->guru_id);
            $this->session->set_userdata('guru_nama',$this->guru_model->ses_get_nama());
            $this->session->set_userdata('is_logged_in',TRUE);
            redirect('guru');
        }
    }
    
    public function logout(){
	   date_default_timezone_set("Asia/Jakarta");
	   $data['id_guru'] = $this->session->userdata('guru_id');
	   $data['last_login'] = date("Y-m-d H:i:s");
	   $this->guru_model->update_last_login($data);
        $this->session->sess_destroy();
        redirect('main');
    }
    
     public function notification_logout(){
		$this->session->set_flashdata('notif_logout',true);
		$this->session->set_flashdata('enable_overlay',true);
		redirect('main/page');
    }
    
    public function reset_password(){
        $temp['css'] = array(1=>'validation',2=>'guru');
        $this->load->view('header',$temp);
        $this->load->view('front/guru/reset_password');
        $this->load->view('footer');
    }
    
    public function reset_password_submit(){
        $email = $this->input->post('email');
        $result = $this->guru_model->reset_password($email);
        if($result){
            $this->session->set_flashdata('reset_pass_guru_notif','Password baru Anda telah dikirimkan ke email: '.$email);
        }else{
            $this->session->set_flashdata('reset_pass_guru_notif','Email yang Anda masukkan tidak terdaftar dalam sistem Ruangguru. Silahkan coba lagi');
        }
        redirect('guru/reset_password');
    }
    
    /*** REGISTRASI ***/
    
    public function reg_guru(){
        $this->load->library('recaptcha');
        $data['email'] = $this->input->post('username');
        if($data['email'] == "masukkan email"){
            $data['email'] = "";
        }
        $data['pass'] = $this->input->post('password');
        if(empty($data['pass'])){
            $data['pass'] = "";
        }
        $data['pendidikan'] = $this->guru_model->get_pendidikan();
        $data['kategori'] = $this->guru_model->get_kategori();
        $data['jenjang'] = $this->guru_model->get_jenjang();
        $data['lokasi_jkt'] = $this->guru_model->get_lokasi_jkt();
        $data['lokasi_lain'] = $this->guru_model->get_lokasi_lain();
        if($this->session->userdata('reg_guru_input')){
            $data['input'] = $this->session->userdata('reg_guru_input');
            $data['email'] = $data['input']['email'];
            $data['nama'] = $data['input']['nama'];
            $data['nik'] = $data['input']['nik'];
            $data['tempatlahir'] = $data['input']['tempatlahir'];
            $data['gender'] = $data['input']['gender'];
            $data['alamat'] = $data['input']['alamat'];
            $data['alamat_domisili'] = $data['input']['alamat_domisili'];
            $data['hp'] = $data['input']['hp'];
            $data['hp_2'] = $data['input']['hp_2'];
            $data['telp_rumah'] = $data['input']['telp_rumah'];
            $data['telp_kantor'] = $data['input']['telp_kantor'];
        }
        $temp['css'] = array(1=>'validation',2=>'guru');
        $this->load->view('header',$temp);
        $this->load->view('front/guru/daftar',$data);
        $this->load->view('footer');
    }
    
    public function reg_submit(){
        //$this->load->library('recaptcha');
        $this->load->library('form_validation');
        $input['email'] = $this->input->post('email');
        $input['pass'] = $this->input->post('pass');
        $input['nama'] = $this->input->post('nama');
        $input['nik'] = $this->input->post('nik');
        $input['pendidikan_id'] = $this->input->post('pendidikan_id');
        $input['pendidikan_instansi'] = $this->input->post('pendidikan_instansi');
        $input['gender'] = $this->input->post('gender');
        $input['tempatlahir'] = $this->input->post('tempatlahir');
        $input['lahir'] = $this->input->post('tahun')."-".$this->input->post('bulan')."-".$this->input->post('tanggal');
        $input['hp'] = $this->input->post('hp');
        $input['hp_2'] = $this->input->post('hp_2');
        $input['telp_rumah'] = $this->input->post('telp_rumah');
        $input['telp_kantor'] = $this->input->post('telp_kantor');
        $input['alamat'] = $this->input->post('alamat');
        $input['alamat_domisili'] = $this->input->post('alamat_domisili');
        $input['fb'] = $this->input->post('fb');
        $input['twitter'] = $this->input->post('twitter');
        $input['referral'] = $this->input->post('referral');
        $input['guru_rating'] = 0;
        $input['guru_rating_bio'] = 0;
        $info = $this->input->post('source_info');
        $lainnya = $this->input->post('lainnya');
	   $x = "";
	   foreach($info as $in){
		$x .= $in.",";
	   }
	   $input['source_info'] = $x.$lainnya;
	   $metode = $this->input->post('metode');
	   $m = "";
	   foreach($metode as $met){
		$m .= $met.",";
	   }
        $input['metode'] = $m;
        $input['kategori'] = $this->input->post('kategori');
        $input['last_login'] = date("Y-m-d H:i:s");
        $input['guru_daftar'] = date("Y-m-d H:i:s");
        if($this->guru_model->check_email($input['email'])){
            $this->session->set_flashdata('reg_guru_notif','Email yang Anda masukkan sudah terdaftar dalam sistem kami. Mohon gunakan email lain.');
            $this->session->set_userdata('reg_guru_input',$input);
            redirect('guru/reg_guru');
        }
        if ($this->form_validation->run('reg_guru')) {
            $guru_id = $this->guru_model->insert_guru($input);
            //lokasi
            $lokasi = $this->input->post('lokasi');
            $lokasi_lain = $this->input->post('lokasi_lain');
            if ($lokasi_lain > 0) {
                $lokasi[$lokasi_lain] = $lokasi_lain;
            }
            if(!empty($lokasi)){
                $this->guru_model->insert_guru_info($guru_id, "lokasi", $lokasi);
            }
            //matpel
            //$matpel = $this->input->post('matpel');
            //if(!empty($matpel)){
               // $this->guru_model->insert_guru_info($guru_id, "matpel", $matpel);
            //}
            //$this->session->unset_userdata('reg_guru_input');
            
            $this->session->set_userdata('guru_id',$guru_id);
            redirect('guru/reg_guru_detail');
        } else {
            $this->session->set_flashdata('reg_guru_notif','Kode keamanan yang Anda masukkan salah silahkan coba lagi.');
            $this->session->set_userdata('reg_guru_input',$input);
            redirect('guru/reg_guru');
        }
        
    }
    
    public function reg_guru_detail(){
        $this->check();
        $this->load->model('profile_model');
        $this->load->library('recaptcha');
        $data['matpel'] = $this->profile_model->get_list_matpel($this->id);
        $data['days'] = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
        $temp['css'] = array(1=>'guru',2=>'profile',3=>'validation');
        
        //check session data
        if($this->session->userdata('reg_guru_detail_input')){
            $input = $this->session->userdata('reg_guru_detail_input');
            $data['personal_message'] = $input['personal_message'];
            $data['kualifikasi'] = $input['kualifikasi'];
            $data['pengalaman'] = $input['pengalaman'];
            //$data['tarif'] = $input['tarif'];
            //$data['jadwal'] = $input['jadwal'];
            $this->session->unset_userdata('reg_guru_detail_input');
        }
        
        $this->load->view('header',$temp);
        $this->load->view('front/guru/daftar_detail',$data);
        $this->load->view('footer');
    }
    
    public function reg_detail_submit(){
        $this->check();
        $this->load->library('recaptcha');
        $this->load->library('form_validation');
        $this->load->model('profile_model');
        
        $input['personal_message'] = $this->input->post('personal_message');
	   $total_bio = strlen($input['personal_message']);
	   if($total_bio <= 500){
		$input['guru_rating_bio'] = 0;
		$input['guru_rating'] = 0;
	   }elseif($total_bio > 500 && $total_bio <= 1000){
		$input['guru_rating_bio'] = 1;
		$input['guru_rating'] = 1;
	   }elseif($total_bio > 1000){
	   	$input['guru_rating_bio'] = 2;
		$input['guru_rating'] = 2;
	   }
        $input['kualifikasi'] = $this->input->post('kualifikasi');
        $input['pengalaman'] = $this->input->post('pengalaman');
        //$input['tarif'] = $this->input->post('tarif');
        //$input['jadwal'] = $this->input->post('jadwal');
        if ($this->form_validation->run('reg_guru_detail')) {
            $this->profile_model->update_guru($this->id,$input);
            //$this->profile_model->update_guru_tarif($this->id, $input['tarif']);
            //$this->profile_model->update_guru_jadwal($this->id, $input['jadwal']);
            $this->guru_model->set_guru_active($this->id,TRUE);
            //$this->guru_model->send_email_reg($this->id);
            $this->session->set_userdata('is_logged_in',TRUE);
		  $this->session->set_flashdata('guru_regsuccess',true);
		  $this->session->set_flashdata('enable_overlay',true);
            redirect('main/page');
        } else {
            $this->session->set_flashdata('reg_guru_detail_notif','Kode keamanan yang Anda masukkan salah silahkan coba lagi.');
            $this->session->set_userdata('reg_guru_detail_input',$input);
            redirect('guru/reg_guru_detail');
        }
        
    }


    /*** REQUEST ***/
    public function request(){
        $this->check();
        $data['request'] = $this->guru_model->get_request_by_guru($this->id);
        $temp['css'] = array(1=>'validation',2=>'guru');
        $this->load->view('header',$temp);
        $this->load->view('front/guru/request',$data);
        $this->load->view('footer');
    }
    
    /*** ADDITIONAL FUNCTION ***/
    
    public function getuniv($id){
        if($id==1){
            $data = $this->guru_model->get_matpel(4);
        }else{
            $data = $this->guru_model->get_matpel(9);
        }
        echo json_encode($data->result());
    }
    
    function check_captcha($val) {
        if ($this->recaptcha->check_answer($this->input->ip_address(), $this->input->post('recaptcha_challenge_field'), $val)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_captcha', $this->lang->line('recaptcha_incorrect_response'));
            return FALSE;
        }
    }
    
      /*** PANDUAN RATING ***/
    public function panduan_rating(){
        $temp['css'] = array(1=>'validation',2=>'guru');
        $this->load->view('header',$temp);
        $this->load->view('front/guru/panduan_rating');
        $this->load->view('footer');
    }
    
     public function simpan_pdf($kode, $jenis_pembayaran){
	   $this->load->model('kelas_model');
	   $this->load->model('request_model');
	   $this->load->model('profile_model');
	   $id_kelas = substr($kode,4,2);
	   $data['kelas']=$this->kelas_model->get_kelas_by_id($id_kelas);
	   $data['bank']=$this->profile_model->get_guru_bank_by_id($data['kelas']->guru_id);
	   $data['jenis_pembayaran']=$jenis_pembayaran;
	   $data['request']=$this->request_model->get_request_for_guru_by_id($data['kelas']->request_id, $data['kelas']->guru_id);
        $this->load->view('pdfreport_guru',$data);
    }
    
    /*** KELAS ***/
    public function kelas($id_kelas){
	   $this->load->model('kelas_model');
	   $this->load->model('guru_model');
	   $data['kelas']=$this->kelas_model->get_buka_kelas_by_id($id_kelas);
	   $data['guru']=$this->guru_model->get_guru_by_id($data['kelas']->guru_id);
        $temp['css'] = array(1=>'validation',2=>'guru');
        $this->load->view('header',$temp);
        $this->load->view('front/guru/kelas', $data);
        $this->load->view('footer');
    }
    
     public function check_murid($url=null){
        $this->id = $this->session->userdata('murid_id');
        if(empty($this->id)){
            if(!empty($url)){
                $this->session->set_userdata('redirected_url',$url);
            }
            redirect('murid/login');
        }
    }
    
     public function daftar_kelas($id_kelas, $id_murid=null){
	   $this->check_murid('guru/kelas/'.$id_kelas);
	   $this->load->model('kelas_model');
	   $this->kelas_model->add_peserta($id_kelas, $id_murid);
	   $this->session->set_flashdata('kelas_success',true);
        $this->session->set_flashdata('enable_overlay',true);
	   redirect('main/page');
    }
}