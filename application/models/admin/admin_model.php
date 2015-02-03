<?php

class Admin_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function get_table($name){
        return $this->db->get($name);
    }
    
    /*** LOGIN GURU ***/
    function check_login($input){
        $this->db->where('admin_username',$input['username']);
        $this->db->where('admin_password',md5($input['password']));
        $result = $this->db->get('admin');
        if($result->num_rows()>0){
            return $result->first_row();
        }else{
            return null;
        }
    }
    
    /****** UTILITIES *****/
    function get_breadcumb($array) {
        $result = '';
        $numItems = count($array);
        $i = 0;
        foreach ($array as $key => $value) {
            if (++$i === $numItems) {
                $result .= $key; 
            }else{
                $result .= '<a href="'.base_url().'admin/'.$value.'">'.$key.'</a><span class="breadcumb_separator">&gt;</span>';
            }
        }
        return $result;
    }
    
    function get_cs_email(){
         return $this->db->get('cs_email');
    }
    
    /****** SERTIFIKAT *****/
    function get_sertifikat($page=0){
        $offset = 20;
        $start = $page*$offset;
        $this->db->limit($offset,$start);
        $this->db->join('guru','guru_sertifikat.guru_id=guru.guru_id','left');
        $this->db->order_by('guru_sertifikat_id','desc');
        return $this->db->get('guru_sertifikat');
    }
    
    public function get_sertifikat_count(){
        return $this->db->count_all_results('guru_sertifikat');
    }
    
    public function edit_sertifikat_status($id,$status){
        $this->db->set('guru_sertifikat_checked',$status,TRUE);
        $this->db->where('guru_sertifikat_id',$id);
        $this->db->update('guru_sertifikat');
    }
    
    /****** REQUEST GURU HOME *****/
    public function get_request_guru_home($page=0){
        $offset = 20;
        $start = $page*$offset;
        $this->db->join('lokasi','lokasi.lokasi_id=request_guru_home.lokasi_id','left');
        $this->db->limit($offset,$start);
        $this->db->order_by('request_guru_home_id','desc');
        return $this->db->get('request_guru_home');
    }
    
    public function get_request_guru_count(){
        return $this->db->count_all_results('request_guru_home');
    }
    
    public function get_request_guru($id){
        $this->db->where('request_guru_home_id',$id);
        return $this->db->get('request_guru_home')->first_row();
    }
    
    public function delete_request_guru($id){
        $this->db->where('request_guru_home_id',$id);
        $this->db->delete('request_guru_home');
    }
    
     public function delete_lamaran_request_guru($id){
        $this->db->where('guru_request_home_id',$id);
        $this->db->delete('guru_lamaran');
    }
    
     public function delete_lamaran_request_by_guru($id_guru, $id){
        $this->db->where('guru_request_home_id',$id);
        $this->db->where('guru_id',$id_guru);
        $this->db->delete('guru_lamaran');
    }
    
     public function get_lamaran_request_guru($id){
        $this->db->where('guru_request_home_id',$id);
        return $this->db->get('guru_lamaran');
    }
    
    public function add_request_guru($input){
        $this->db->set('request_guru_home_title',$input['title']);
        $this->db->set('lokasi_id',$input['lokasi']);
        $this->db->set('request_guru_home_text',$input['text']);
        $this->db->set('request_guru_home_date',date("Y-m-d"));
        $this->db->set('request_guru_home_active',1,TRUE);
        $this->db->insert('request_guru_home');
    }
    
     public function update_request_guru($input){
        $this->db->set('request_guru_home_title',$input['title']);
        $this->db->set('lokasi_id',$input['lokasi']);
        $this->db->set('request_guru_home_text',$input['text']);
        $this->db->set('request_guru_home_date',$input['date']);
        $this->db->where('request_guru_home_id',$input['id']);
        $this->db->update('request_guru_home');
    }
    
    public function edit_request_guru_status($id,$status){
        $this->db->set('request_guru_home_active',$status,TRUE);
        $this->db->where('request_guru_home_id',$id);
        $this->db->update('request_guru_home');
    }
    
    //SUBSCRIBE
    public function get_subscribers(){
         return $this->db->get('subscribe');
    }
    
     public function get_subscribers_by_input($input){
		if(!empty($input)){
			$this->db->like('subscriber_nama',$input);
			$this->db->or_like('subscriber_email',$input);
		}
         return $this->db->get('subscribe');
    }
    
     public function edit_email_template($content){
        $this->db->set('sender',$content['sender']);
        $this->db->set('subject',$content['subject']);
        $this->db->set('template_email',$content['template_email']);
        $this->db->update('template_email');
    }
    
      public function get_email_template(){
         return $this->db->get('template_email')->first_row();
    }
}
?>