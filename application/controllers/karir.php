<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Karir extends CI_Controller {
    private $id;
        
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }
    
    public function index(){
        $this->load->view('header');
        $this->load->view('front/karir');
        $this->load->view('footer');
    }
}