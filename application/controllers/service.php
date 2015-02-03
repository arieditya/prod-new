<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Service extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }
    
    public function get_lokasi($provinsi_id){
        $this->load->model('main_model');
        $lokasi = $this->main_model->get_lokasi($provinsi_id);
        echo json_encode($lokasi->result());
    }
    
    public function get_matpel($pend_id){
        $this->load->model('guru_model');
        $matpel = $this->guru_model->get_matpel($pend_id);
        echo json_encode($matpel->result());
    }
    
    public function validate_table_id(){
        $result = array();
        $this->load->model('utilities_model');
        $table_name = $this->input->post('fieldId');
        $id = $this->input->post('fieldValue');
        $result[0] = $table_name;
        $result[1] = $this->utilities_model->validate_table_id($table_name,$id);
        echo json_encode($result);
    }
    
}

?>