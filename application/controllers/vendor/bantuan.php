<?php
/**
 * Created by PhpStorm.
 * User: saqib
 * Date: 2/12/15
 * Time: 10:05 PM
 */
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
        $this->load->view('vendor/bantuan');
        $this->load->view('vendor/general/footer');
    }
}