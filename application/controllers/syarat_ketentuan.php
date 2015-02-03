<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Syarat_ketentuan extends CI_Controller {
    private $id;
        
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }
    
    public function index(){
        $this->load->view('header');
        $this->load->view('front/syarat_ketentuan');
        $this->load->view('footer');
    }
    
     public function murid(){
        $this->load->view('header');
        $this->load->view('front/syarat_ketentuan_murid');
        $this->load->view('footer');
    }
    
     public function guru(){
        $this->load->view('header');
        $this->load->view('front/syarat_ketentuan_guru');
        $this->load->view('footer');
    }
    
     public function duta(){
        $this->load->view('header');
        $this->load->view('front/syarat_ketentuan_duta');
        $this->load->view('footer');
    }
    
     public function pesan_guru(){
        $this->load->view('header');
        $this->load->view('front/syarat_ketentuan_pesanguru');
        $this->load->view('footer');
    }
    
}