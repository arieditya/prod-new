<?php

class Utilities_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function get_table($table_name){
        return $this->db->get($table_name);
    }
    
    function get_bank(){
        return $this->db->get('bank');
    }
    
    function validate_table_id($table_name,$id){
        $this->db->where($table_name.'_id',$id);
        $result = $this->db->get($table_name);
        return ($result->num_rows()>0)?true:false;
    }
    
    //table source_info
    function get_source_info(){
        $this->db->order_by('source_info_sort','asc');
        return $this->db->get('source_info');
    }
}
