<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kontak_kami extends CI_Controller {
    private $id;
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('guru_model');
        $this->id = $this->session->userdata('guru_id');
    }
    
    public function index(){
        $this->load->library('recaptcha');
        $this->load->view('header');
        $this->load->view('front/contact_us');
        $this->load->view('footer');
	   //print_r($this->session);
	}
	
	public function send_email(){
	 // $this->check('kontak_kami/index');
       $this->load->library('recaptcha');
       $this->load->library('form_validation');
	  $this->load->library('email');
	  $input['kategori'] = $this->input->post('kategori');
	  $input['nama'] = $this->input->post('nama');
	  $input['email'] = $this->input->post('email');
	  $input['telepon'] = $this->input->post('telepon');
	  $input['subject'] = $this->input->post('subject');
	  $input['question'] = $this->input->post('question');
	  if ($this->form_validation->run('request_guru')) {
		$this->email->from($input['email'], $input['nama']);
		$this->email->to('info@ruangguru.com'); 
		//$this->email->cc('another@another-example.com'); 
		//$this->email->bcc('them@their-example.com'); 
		$cat = $input['kategori'];
		$this->email->subject("[Website Ruangguru.com - Hubungi Kami (". $cat . ") : " . $input['subject'] ."]");
		$content = $this->load->view('front/layout/kontak_kami',array('kontak'=>$input),TRUE);
		$this->email->message($content);	
		$this->email->send();
		$this->session->set_flashdata('contact_send',true);
		$this->session->set_flashdata('enable_overlay',true);
		//echo $this->email->print_debugger();
		redirect('kontak_kami/index');
	  } else {
		$this->session->set_flashdata('contact_send',true);
		$this->session->set_flashdata('enable_overlay',true);
		//$this->session->set_flashdata('request_notification','Kode recaptcha yang anda masukkan salah');
		redirect('kontak_kami/index');
	  }
	}
}