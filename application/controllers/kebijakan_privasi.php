<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kebijakan_privasi extends CI_Controller {
    private $id;
        
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }
    
    public function index(){
        $this->load->view('header');
        $this->load->view('front/kebijakan_privasi');
        $this->load->view('footer');
    }
}