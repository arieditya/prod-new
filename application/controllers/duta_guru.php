<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Duta_guru extends CI_Controller {
    private $id;

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
	   $this->load->helper('pdf_helper');
        $this->load->model('duta_guru_model');
        $this->load->model('kelas_model');
    }
    
    public function check(){
        $this->id = $this->session->userdata('duta_guru_id');
        if(empty($this->id)){
            redirect('duta_guru/login');
        }
    }
    
    public function index(){
	   $this->load->model('guru_model');
        $is_logged_in = $this->session->userdata('duta_guru_id');
        if(empty($is_logged_in)){
            redirect('duta_guru/registrasi');
        }  else {
            $this->check();
            $this->load->helper('form');
            $this->load->library('recaptcha');
            $data['duta_guru'] = $this->duta_guru_model->get_duta_guru_by_id($this->id);
            $data['kota'] = $this->duta_guru_model->get_kota();
            $data['menu'] = $this->load->view('front/duta_guru/menu', array('active' => 'profile'), TRUE);
            $temp['css'] = array(1 => 'validation', 2 => 'guru', 3 => 'profile', 4 => 'dutaguru');
            $this->load->view('header', $temp);
            $this->load->view('front/duta_guru/akun', $data);
            $this->load->view('footer');
        }
    }
    
    /*** LOGIN ***/
    public function login(){
        $temp['css'] = array(1=>'validation',2=>'guru');
        $this->load->view('header',$temp);
        	if(($this->session->userdata('murid_id') || $this->session->userdata('duta_guru_id') || $this->session->userdata('is_logged_in'))){
			$this->session->sess_destroy();
			redirect('main/page');
		} else {
			$this->load->view('front/duta_guru/login');
		}
        $this->load->view('footer');
    }
    
    public function login_submit(){
        $input['email'] = $this->input->post('email');
        $input['password'] = $this->input->post('password');
        $id = $this->duta_guru_model->check_login($input);
        if(empty($id)){
            $this->session->set_flashdata('login_dutaguru_notif','Kombinasi email dan password yang anda masukkan salah, silahkan coba lagi.');
            redirect('duta_guru/login');
        }else{
            $this->session->set_userdata('duta_guru_id',$id);
            $this->session->set_userdata('duta_guru_nama',$this->duta_guru_model->ses_get_nama());
            redirect('duta_guru');
        }
    }
    
    public function logout(){
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
        $this->load->view('front/duta_guru/reset_password');
        $this->load->view('footer');
    }
    
    public function reset_password_submit(){
        $email = $this->input->post('email');
        $result = $this->duta_guru_model->reset_password($email);
        if($result){
            $this->session->set_flashdata('reset_pass_duta_guru_notif','Password baru telah dikirimkan ke email: '.$email);
        }else{
            $this->session->set_flashdata('reset_pass_duta_guru_notif','Email yang anda masukkan tidak terdaftar dalam sistem Ruangguru. Silahkan coba lagi');
        }
        redirect('duta_guru/reset_password');
    }
    
    /*** REGISTRASI ***/
    
    public function registrasi(){
        $this->load->helper('form');
        $this->load->library('recaptcha');
        $this->load->library('form_validation');
        if ($this->form_validation->run('reg_duta_guru') == FALSE) {
            $data['kota'] = $this->duta_guru_model->get_kota();
            $data['provinsi'] = $this->duta_guru_model->get_provinsi();
            $temp['css'] = array(1=>'validation',2=>'guru',3=>'dutaguru');
            $this->load->view('header', $temp);
            $this->load->view('front/duta_guru/daftar', $data);
            $this->load->view('footer');
        } else {
            $input['email'] = $this->input->post('email');
            $input['pass'] = $this->input->post('pass');
            $input['nama'] = $this->input->post('nama');
            $input['alamat'] = $this->input->post('alamat');
            $input['alamat_domisili'] = $this->input->post('alamat_domisili');
            $input['kota'] = $this->input->post('kota');
            $input['hp'] = $this->input->post('hp');
            $input['hp_2'] = $this->input->post('hp_2');
            $input['telp_rumah'] = $this->input->post('telp_rumah');
            $input['telp_kantor'] = $this->input->post('telp_kantor');
            $input['gender'] = $this->input->post('gender');
            $input['tempatlahir'] = $this->input->post('tempatlahir');
            $input['lahir'] = $this->input->post('tahun')."-".$this->input->post('bulan')."-".$this->input->post('tanggal');
		  $info = $this->input->post('source_info');
		  $lainnya = $this->input->post('lainnya');
		  $x = "";
	       foreach($info as $in){
			$x .= $in.",";
		  }
		  $input['source_info'] = $x.$lainnya;        
		  $input['duta_guru_daftar'] = date('Y-m-d H:i:s');
		  $id = $this->duta_guru_model->insert_duta_guru($input);
            $this->duta_guru_model->send_email_reg($id);
            $this->session->set_userdata('duta_guru_id',$id);
		  $this->session->set_flashdata('duta_regsuccess',true);
		  $this->session->set_flashdata('enable_overlay',true);
            redirect('main/page');
        }
        
    }
    
    public function email_check($str){
        if ($this->duta_guru_model->check_email($str)) {
            $this->form_validation->set_message('email_check', 'Email yang anda masukkan sudah terdaftar dalam sistem kami. Silahkan gunakan email yang lain');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    /**** PROFILE *****/
    public function edit(){
        $this->check();
        $data['duta_guru'] = $this->duta_guru_model->get_duta_guru_by_id($this->id);
        $data['menu'] = $this->load->view('front/duta_guru/menu',array('active'=>'edit'),TRUE);
        $data['kota'] = $this->duta_guru_model->get_kota();
        $data['provinsi'] = $this->duta_guru_model->get_provinsi();
        $temp['css'] = array(1=>'validation',2=>'guru',3=>'profile',4=>'dutaguru');
        $this->load->view('header',$temp);
        $this->load->view('front/duta_guru/edit',$data);
        $this->load->view('footer');
    }
    
    public function submit_profpic(){
        $this->check();
        $this->load->library('upload');
        if(!$this->upload->do_upload('profpic')){
            $this->session->set_flashdata('edit_profile_notif',$this->upload->display_errors('<span>','</span>'));
        }else{
            $image_data = $this->upload->data();
            $config['image_library'] = 'gd2';
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 125;
            $config['height'] = 125;
            $config['source_image'] = $image_data['full_path'];
            $config['new_image'] = './images/dutaguru/pp/'.$this->id.'.jpg';            
            $this->load->library('image_lib',$config);
            if ( ! $this->image_lib->resize()) {
                $this->session->set_flashdata('edit_profile_notif',$this->image_lib->display_errors('<span>','</span>'));
            }
            unlink($image_data['full_path']);
            $this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Foto profil telah berhasil diubah</span>');
        }
        redirect('duta_guru/edit');
    }
    
    public function pass_submit(){
        $this->check();
        $oldpass = $this->input->post('oldpass');
        $pass = $this->input->post('pass');
        if($this->duta_guru_model->update_pass($this->id,$oldpass,$pass)){
            $this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Password telah berhasil diubah.</span>');
        }else{
            $this->session->set_flashdata('edit_profile_notif','<span class="red-notif">Password lama anda salah!</span>');
        }
        redirect('duta_guru/edit');
    }
    
    public function biodata_submit(){
        $this->check();
        $input['nama'] = $this->input->post('nama');
        $input['gender'] = $this->input->post('gender');
        $input['tempatlahir'] = $this->input->post('tempatlahir');
        $input['lahir'] = $this->input->post('tahun')."-".$this->input->post('bulan')."-".$this->input->post('tanggal');
        $input['hp'] = $this->input->post('hp');
        $input['hp_2'] = $this->input->post('hp_2');
        $input['telp_rumah'] = $this->input->post('telp_rumah');
        $input['telp_kantor'] = $this->input->post('telp_kantor');
        $input['alamat'] = $this->input->post('alamat');
        $input['alamat_domisili'] = $this->input->post('alamat_domisili');
        $input['kota'] = $this->input->post('kota');
        
        $this->duta_guru_model->update_biodata($this->id,$input);
        $this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Biodata telah berhasil diubah.</span>');
        redirect('duta_guru/edit');
    }
    
    //BANK
    public function bank(){
        $this->check();
        $this->load->model('utilities_model');
        $this->load->helper('form');
        $data['guru'] = $this->duta_guru_model->get_duta_guru_bank_by_id($this->id);
        $data['bank'] = $this->utilities_model->get_bank();
        $data['menu'] = $this->load->view('front/duta_guru/menu',array('active'=>'bank'),TRUE);
        $temp['css'] = array(1=>'validation',2=>'guru',3=>'profile',4=>'dutaguru');
        $this->load->view('header',$temp);
        $this->load->view('front/duta_guru/bank',$data);
        $this->load->view('footer');
    }
    
    public function bank_submit(){
        $this->check();
        $input['bank'] = $this->input->post('bank');
        $input['rekening'] = $this->input->post('rekening');
        $input['pemilik'] = $this->input->post('pemilik');
        $pass = $this->input->post('password');
        if($this->duta_guru_model->check_duta_guru(null,$this->id,$pass)){
            $this->duta_guru_model->update_bank($this->id,$input);
            $this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Data rekening bank berhasil di update.</span>');
        }else{
            $this->session->set_flashdata('edit_profile_notif','<span class="red-notif">Password yang anda masukkan salah.</span>');
        }
        redirect('duta_guru/bank');
    }
    
    //GURU
    public function guru(){
        $this->check();
        $data['guru'] = $this->duta_guru_model->get_list_guru($this->id);
        $data['kelas'] = $this->kelas_model->get_duta_guru_in_kelas($this->id);
        $data['menu'] = $this->load->view('front/duta_guru/menu',array('active'=>'list_guru'),TRUE);
        $temp['css'] = array(1=>'validation',2=>'guru',3=>'profile',4=>'dutaguru');
        $this->load->view('header',$temp);
        $this->load->view('front/duta_guru/list_guru',$data);
        $this->load->view('footer');
    }
    
    //MURID
    public function murid(){
        $this->check();
        $data['murid'] = $this->duta_guru_model->get_list_murid($this->id);
        $data['menu'] = $this->load->view('front/duta_guru/menu',array('active'=>'list_murid'),TRUE);
        $temp['css'] = array(1=>'validation',2=>'guru',3=>'profile',4=>'dutaguru');
        $this->load->view('header',$temp);
        $this->load->view('front/duta_guru/list_murid',$data);
        $this->load->view('footer');
    }
    
    //PEMBAYARAN
    public function pembayaran(){
        $this->check();
        $data['pembayaran_dutamurid'] = $this->kelas_model->get_kelas_by_dutamurid_id($this->id);
        $data['pembayaran_dutaguru'] = $this->kelas_model->get_kelas_by_dutaguru_id($this->id);
        $data['menu'] = $this->load->view('front/duta_guru/menu',array('active'=>'pembayaran'),TRUE);
        $temp['css'] = array(1=>'validation',2=>'guru',3=>'profile',4=>'dutaguru');
        $this->load->view('header',$temp);
        $this->load->view('front/duta_guru/pembayaran',$data);
        $this->load->view('footer');
    }
    
     public function tagihan($id_kelas,$mode){
	   $this->check();
        $this->load->model('kelas_model');
        $this->load->model('request_model');
	   $temp['css'] = array(1=>'validation',2=>'guru',3=>'profile',4=>'dutaguru');
	   $data['kelas']=$this->kelas_model->get_kelas_by_id($id_kelas);
	   $data['mode']=$mode;
	   $data['request']=$this->request_model->get_request_for_guru_by_id($data['kelas']->request_id, $data['kelas']->guru_id);
        $this->load->view('header',$temp);
        $this->load->view('front/duta_guru/tagihan',$data);
        $this->load->view('footer');
    }
    
     public function simpan_pdf($kode,$mode){
	   $this->load->model('kelas_model');
	   $this->load->model('request_model');
	   $id_kelas = substr($kode,4,2);
	   $data['kelas']=$this->kelas_model->get_kelas_by_id($id_kelas);
	   $data['duta'] = $this->kelas_model->get_duta_info($data['kelas']->duta_murid_id);
	   $data['mode']=$mode;
	   $data['request']=$this->request_model->get_request_for_guru_by_id($data['kelas']->request_id, $data['kelas']->guru_id);
        $this->load->view('pdfreport_duta',$data);
    }
}