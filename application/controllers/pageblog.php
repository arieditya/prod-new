<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pageblog extends CI_Controller {
    private $id;
        
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }
    
    public function index(){
        $this->load->view('header');
        $this->load->view('front/blog_page');
        $this->load->view('footer');
    }
}