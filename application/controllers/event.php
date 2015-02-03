<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Event extends CI_Controller {
    private $id;
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
	   $this->load->helper('pdf_helper');
        $this->load->model('event_model');
    }
    
    
    public function index(){
	   $this->load->library('recaptcha');
	   $this->load->helper('form');
        $temp['css'] = array('jquery.alerts','validation','cariguru','profile');
        $this->load->view('header',$temp);
        $this->load->view('front/event/index');
        $this->load->view('footer');
    }
    
     public function email_check($str){
        if ($this->event_model->check_email($str)) {
            $this->form_validation->set_message('email_check', 'Email yang Anda masukkan sudah terdaftar dalam sistem kami.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
     public function registrasi(){
        $this->load->helper('form');
        $this->load->library('recaptcha');
        $this->load->library('form_validation');
        if ($this->form_validation->run('event_registrasi') == FALSE) {
            $temp['css'] = array(1=>'validation',2=>'guru',3=>'murid');
            $this->load->view('header', $temp);
            $this->load->view('front/event/index');
            $this->load->view('footer');
        } else {
            $input['email'] = $this->input->post('email');
            $input['nama'] = $this->input->post('nama');
            $input['telp'] = $this->input->post('telp');
            $input['institusi'] = $this->input->post('institusi');
            $input['rg_status'] = $this->input->post('rg_status');
            $input['coaching'] = $this->input->post('coaching');
		  
		  if($this->event_model->check_email($input['email'])){
			$this->session->set_userdata('event_registrasi',$input);
			redirect('openhouse');
		  }else{
		     $id = $this->event_model->registrasi_event($input);
			$hash = md5($id);
			$kode = substr($hash, 0, 2).substr($hash, 30, 2).$id;
			$this->send_email_reg($id, $kode);
			$this->session->set_flashdata('registrasi_event',true);
			$this->session->set_flashdata('enable_overlay',true);
			redirect('main/page');
		  }
		}
    }
    
     /*** EMAIL REGISTRASI ***/
    public function send_email_reg($id, $kode){
     $data = $this->event_model->get_registran($id);
     $this->load->library('email');
	$config['useragent'] = 'Ruangguru Web Service';
	$config['protocol'] = 'smtp';
	$config['smtp_host'] = 'mail.ruangguru.com';
	$config['smtp_port'] = 25;
	$config['smtp_user'] = 'no-reply@ruangguru.com';
	$config['smtp_pass'] = $this->config->item('smtp_password');
	$config['priority'] = 1;
	$config['mailtype'] = 'html';
	$config['charset'] = 'utf-8';
	$config['wordwrap'] = TRUE; 
	$this->email->initialize($config);
	$this->email->from('no-reply@ruangguru.com', 'Ruangguru.com');
	$this->email->to($data->email_registrasi);

	$this->email->subject('Email Verifikasi Essential Skills Series Vol. 03');
     $content = $this->load->view('front/event/daftar_email',array('data'=>$data, 'kode'=>$kode),TRUE);
	$this->email->message($content);

	$this->email->send();
    }
    
     public function verifikasi($kode){
	$len = strlen($kode);
	$diff = $len - 4;
	$hash = substr($kode, 4, $diff);
	$this->event_model->register_verifikasi($hash);
	redirect('main/page');
	}
	
	public function tiket($kode){
	$len = strlen($kode);
	$diff = $len - 4;
	$id = substr($kode, 4, $diff);
	$data['registrasi']=$this->event_model->get_registran($id);
     $this->load->view('tiket',$data);
    }
    
}