<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Duta extends CI_Controller {
    private $id;

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('duta_guru_model');
    }

        public function check(){
        $this->id = $this->session->userdata('duta_guru_id');
        if(empty($this->id)){
            redirect('duta_guru/login');
        }
    }

        public function index(){
        $is_logged_in = $this->session->userdata('duta_guru_id');
        if(empty($is_logged_in)){
            redirect('duta_guru/registrasi');
        }  else {
		  redirect('duta_guru/login');
	   }
	}
	
	   public function login(){
	     if(($this->session->userdata('murid_id') || $this->session->userdata('duta_guru_id') || $this->session->userdata('is_logged_in'))){
			$this->session->sess_destroy();
			redirect('main/page');
		} else {
			redirect('duta_guru/login');
		}
	    }
}    
?>