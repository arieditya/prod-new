<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Request_guru extends CI_Controller {
    private $id;
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('guru_model');
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
        $this->load->library('recaptcha');
        $temp['css'] = array('cariguru','validation');
        $this->load->view('header',$temp);
        $guru = $this->session->userdata('pilihan_guru');
        $data['pilihan'] = $this->guru_model->get_guru_in_array($guru);
	   $data['days'] = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
        $this->load->view('front/request_guru/request',$data);
        $this->load->view('footer');
    }
    
     public function request(){
	$this->load->library('form_validation');
		if ($this->form_validation->run('request_sidebar')) {
			$input['nama'] = $this->input->post('nama');
			$input['email'] = $this->input->post('email');
			$input['telp'] = $this->input->post('telp');
			$input['matpel'] = $this->input->post('matpel');
			$input['request'] = $this->input->post('request');
			$input['lokasi'] = $this->input->post('lokasi');
			$this->guru_model->insert_request($input);
			$this->session->set_flashdata('request_regsuccess',true);
			$this->session->set_flashdata('enable_overlay',true);
			redirect('main/page');
		} else {
			$this->session->set_flashdata('reg_request_notif','Harap lengkapi isian Anda');
			redirect('main/page');
		}
     }
    
}