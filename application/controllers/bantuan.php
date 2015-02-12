<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bantuan extends CI_Controller {
    private $id;

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('guru_model');
        $this->id = $this->session->userdata('guru_id');
    }

    public function index(){
        $this->load->view('header');
        $this->load->view('front/bantuan');
        $this->load->view('footer');
    }
}