<?php

class Profile_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function check_guru($email,$id,$password){
        if(!empty($email)){
            $this->db->where('guru_email',$email);
        }
        if(!empty($id)){
            $this->db->where('guru_id',$id);
        }
        if(!empty($password)){
            $this->db->where('guru_password',md5($password));
        }
        $this->db->select('guru_id');
        $result = $this->db->get('guru');
        if($result->num_rows > 0 ){
            return true;
        }else{
            return false;
        }
    }
    
    /*** PROFILE ***/
    function get_profile_guru($guru_id){
        $this->db->where('guru_id',$guru_id,TRUE);
        $this->db->join('kategori','guru.kategori_id=kategori.kategori_id','left');
        $this->db->join('pendidikan','guru.pendidikan_id=pendidikan.pendidikan_id','left');
        $rows = $this->db->get('guru');
        if($rows->num_rows() > 0 ){
            $result = $rows->first_row();
            $result->lokasi = $this->get_lokasi_mengajar($guru_id);
            $result->matpel = $this->get_mata_pelajaran($guru_id);
            $result->jadwal = $this->get_jadwal_map($guru_id);
            return $result;
        }else{
            return null;
        }
    }
    function get_lokasi_mengajar($guru_id){
        $result = "";
        $this->db->where('guru_id',$guru_id,TRUE);
        $this->db->join('lokasi','guru_lokasi.lokasi_id=lokasi.lokasi_id');
        $rows = $this->db->get('guru_lokasi');
        foreach($rows->result() as $row){
            $result .= $row->lokasi_title . ", ";
        }
        return substr($result, 0, strlen($result) -2);
    }
    function get_mata_pelajaran($guru_id){
        $this->db->where('guru_id',$guru_id,TRUE);
        $this->db->join('matpel','guru_matpel.matpel_id=matpel.matpel_id');
        $this->db->join('jenjang_pendidikan','matpel.jenjang_pendidikan_id = jenjang_pendidikan.jenjang_pendidikan_id');
        return $this->db->get('guru_matpel');
    }
    
    /*** BIODATA ***/
      function update_video($guru_id,$video,$jenis_video){
        $this->db->set('guru_video',$video);
        $this->db->set('guru_jenis_video',$jenis_video);
        $this->db->where('guru_id',$guru_id);
        $this->db->update('guru');
        if($this->db->affected_rows()>0){
            return true;
        }else{
            return false;
        }
    }
    
    function update_pass($guru_id,$oldpass,$pass){
        $this->db->set('guru_password',md5($pass));
        $this->db->where('guru_password',md5($oldpass));
        $this->db->where('guru_id',$guru_id);
        $this->db->update('guru');
        if($this->db->affected_rows()>0){
            return true;
        }else{
            return false;
        }
    }
    
    function update_biodata($id_guru,$input){
        if(!empty($input['nik_image'])){
            $this->db->set('guru_nik_image',$input['nik_image']);
        }
        $this->db->set('guru_nama',$input['nama']);
        $this->db->set('guru_gender',$input['gender']);
        $this->db->set('pendidikan_id',$input['pendidikan_id']);
        $this->db->set('guru_pendidikan_instansi',$input['pendidikan_instansi']);
        $this->db->set('guru_tempatlahir',$input['tempatlahir']);
        $this->db->set('guru_lahir',$input['lahir']);
        $this->db->set('guru_hp',$input['hp']);
        $this->db->set('guru_hp_2',$input['hp_2']);
        $this->db->set('guru_telp_rumah',$input['telp_rumah']);
        $this->db->set('guru_telp_kantor',$input['telp_kantor']);
        $this->db->set('guru_alamat',$input['alamat']);
        $this->db->set('guru_alamat_domisili',$input['alamat_domisili']);
        $this->db->set('kategori_id',$input['kategori']);
        $this->db->set('guru_fb',$input['fb']);
        $this->db->set('guru_twitter',$input['twitter']);
        $this->db->set('guru_referral',$input['referral']);
        $this->db->where('guru_id',$id_guru);
        $this->db->update('guru');
    }
    
    /*** PERSONAL MESSAGE/BIO ***/
    function update_personal($id_guru,$input){
    	   $total_bio = strlen($input);
	   if($total_bio <= 500){
		$this->db->set('guru_rating_bio',0);
	   }elseif($total_bio > 500 && $total_bio <= 1000){
		$this->db->set('guru_rating_bio',1);
	   }elseif($total_bio > 1000){
	   	$this->db->set('guru_rating_bio',2);
	   }
        $this->db->set('guru_bio',$input);
        $this->db->where('guru_id',$id_guru);
        $this->db->update('guru');
        
        //update rating
        $this->load->model('guru_model');
        $this->guru_model->update_current_rating($id_guru);
    }
    
    /*** PENGALAMAN MENGAJAR ***/
    function update_pengalaman($id_guru,$input){
        $this->db->set('guru_pengalaman',$input);
        $this->db->where('guru_id',$id_guru);
        $this->db->update('guru');
    }
    
     /*** METODE MENGAJAR ***/
    function update_metode($input, $id_guru){
        $this->db->set('guru_metode',$input);
        $this->db->where('guru_id',$id_guru);
        $this->db->update('guru');
    }
    
    /*** MATA PELAJARAN ***/
    function get_matpel_count(){
        return $this->db->query("SELECT COUNT(matpel_id) AS count FROM matpel")->first_row()->count;
    }
    function get_map_matpel($guru_id){
        $this->db->where('guru_id',$guru_id);
        $result = $this->db->get('guru_matpel');
        $array = array($this->get_matpel_count());
        foreach($result->result() as $matpel){
            $array[$matpel->matpel_id] = true;
        }
        return $array;
    }
    function get_array_matpel($guru_id){
        $array = array();
        $this->db->where('guru_id',$guru_id);
        $result = $this->db->get('guru_matpel');
        if($result->num_rows() > 0){
            foreach($result->result() as $row){
                $array[] = $row->matpel_id;
            }
        }
        return $array;
    }
    function update_guru_matpel($guru_id,$input){
        $current_matpel = $this->get_array_matpel($guru_id);
        $del_matpel = array_diff($current_matpel, $input);
        $ins_matpel = array_diff($input, $current_matpel);
        //deleteing matpel
        $this->delete_guru_matpel($guru_id,$del_matpel);
        //inserting matpel
        foreach($ins_matpel as $value) {
            $this->db->set('matpel_id', $value);
            $this->db->set('guru_id', $guru_id);
            $this->db->insert('guru_matpel');
        }
        return (count($ins_matpel)>0)?true:false;
    }
    function delete_guru_matpel($guru_id,$arr_matpel){
        if(!empty($arr_matpel)){
            $this->db->where_in('matpel_id',$arr_matpel);
            $this->db->where('guru_id',$guru_id);
            $this->db->delete('guru_matpel');
        }
    }
    function add_guru_matpel($guru_id,$matpel,$tarif){
        $this->db->set('guru_id',$guru_id,true);
        $this->db->set('matpel_id',$matpel,true);
        $this->db->set('guru_matpel_tarif',$tarif,true);
        $this->db->insert('guru_matpel');
    }
    
    function get_list_matpel($guru_id){
        $this->db->join('matpel','matpel.matpel_id = guru_matpel.matpel_id');
        $this->db->join('jenjang_pendidikan','jenjang_pendidikan.jenjang_pendidikan_id = matpel.jenjang_pendidikan_id');
        $this->db->where('guru_id',$guru_id);
        $result = $this->db->get('guru_matpel');
        return $result->result();
    }
    
    function get_matpel($pend_id,$guru_id=null){
        $this->db->select('guru_matpel.guru_matpel_tarif');
        $this->db->select('matpel.*');
        if(!empty($guru_id)){
            $this->db->join('guru_matpel','guru_matpel.matpel_id=matpel.matpel_id and guru_matpel.guru_id='.$guru_id,'left');
            $this->db->where('guru_matpel.matpel_id',null);
        }
        $this->db->where('jenjang_pendidikan_id',$pend_id);
        return $this->db->get('matpel');
    }
    
    /*** TARIF MATA PELAJARAN ***/
    function update_guru_tarif($guru_id,$input){
        foreach($input as $key => $value) {
            $this->db->set('guru_matpel_tarif', $value);
            $this->db->where('matpel_id', $key);
            $this->db->where('guru_id', $guru_id);
            $this->db->update('guru_matpel');
        }
    }
    
    /*** LOKASI ***/
    function get_lokasi_count(){
        return $this->db->query("SELECT COUNT(lokasi_id) AS count FROM lokasi")->first_row()->count;
    }
    function get_array_lokasi($guru_id){
        $this->db->where('guru_id',$guru_id);
        $result = $this->db->get('guru_lokasi');
        $array = array();
        foreach($result->result() as $lokasi){
            $array[$lokasi->lokasi_id] = true;
        }
        return $array;
    }
    function update_guru_lokasi($guru_id,$input){
        $this->delete_guru_lokasi($guru_id);
        foreach($input as $value) {
            $this->db->set('lokasi_id', $value);
            $this->db->set('guru_id', $guru_id);
            $this->db->insert('guru_lokasi');
        }
    }
    function delete_guru_lokasi($guru_id){
        $this->db->where('guru_id',$guru_id);
        $this->db->delete('guru_lokasi');
    }
    
    /*** JADWAL ***/
    function get_jadwal_map($guru_id){
        $this->db->where('guru_id',$guru_id);
        $result = $this->db->get('guru_jadwal');
        $array = array();
        foreach($result->result() as $value){
            $array[$value->guru_jadwal_day][$value->guru_jadwal_hour] = true;
        }
        return $array;
    }
    
    function update_guru_jadwal($guru_id,$input){
        $this->delete_guru_jadwal($guru_id);
        foreach($input as $day => $arr_hour){
            foreach($arr_hour as $hour => $value){
                $this->db->set('guru_id',$guru_id);
                $this->db->set('guru_jadwal_day',$day);
                $this->db->set('guru_jadwal_hour',$hour);
                $this->db->insert('guru_jadwal');
            }
        }
    }
    function delete_guru_jadwal($guru_id){
        $this->db->where('guru_id',$guru_id);
        $this->db->delete('guru_jadwal');
    }
    
    /*** KUALIFIKASI ***/
    function get_kualifikasi($guru_id){
        $this->db->select('guru_kualifikasi');
        $this->db->where('guru_id',$guru_id);
        $result = $this->db->get('guru');
        if($result->num_rows()>0){
            return $result->first_row();
        }else{
            return null;
        }
    }
    
    function get_sertifikat($guru_id){
        $this->db->where('guru_id',$guru_id);
        $result = $this->db->get('guru_sertifikat');
        return $result;
    }
    
    function update_guru_kualifikasi($guru_id,$kualifikasi){
        $this->db->set('guru_kualifikasi',$kualifikasi);
        $this->db->where('guru_id',$guru_id);
        $this->db->update('guru');
    }
    
    function insert_guru_sertifikat($guru_id,$input){
        $this->db->set('guru_sertifikat_title',$input['title']);
        $this->db->set('guru_sertifikat_file',$input['file']);
        $this->db->set('guru_id',$guru_id);
        $this->db->insert('guru_sertifikat');
    }
    
    function delete_guru_sertifikat_file($guru_id,$sertifikat_id){
        $this->db->where('guru_id',$guru_id);
        $this->db->where('guru_sertifikat_id',$sertifikat_id);
        $result = $this->db->get('guru_sertifikat');
        if($result->num_rows()>0){
            $file = $result->first_row();
            unlink('./files/sertifikat/'.$file->guru_sertifikat_file);
        }
    }
    
    function delete_guru_sertifikat($guru_id,$sertifikat_id){
        $this->delete_guru_sertifikat_file($guru_id,$sertifikat_id);
        $this->db->where('guru_id',$guru_id);
        $this->db->where('guru_sertifikat_id',$sertifikat_id);
        $this->db->delete('guru_sertifikat');
    }
    
    /*** UPDATE ***/
    function update_guru($guru_id,$input){
        if(!empty($input['kualifikasi'])){
            $this->db->set('guru_kualifikasi',$input['kualifikasi']);
        }
        if(!empty($input['pengalaman'])){
            $this->db->set('guru_pengalaman',$input['pengalaman']);
        }
        if(!empty($input['personal_message'])){
            $this->db->set('guru_bio',$input['personal_message']);
        }
        $this->db->where('guru_id',$guru_id);
        $this->db->update('guru');
    }
    
    /*** BANK ***/
    function get_guru_bank_by_id($id){
        $this->db->select('bank.*');
        $this->db->select('guru.guru_bank_rekening');
        $this->db->select('guru.guru_bank_pemilik');
        $this->db->join('bank','guru.bank_id=bank.bank_id');
        $this->db->where('guru_id',$id);
        return $this->db->get('guru')->first_row();
    }
    
    function get_bank(){
        return $this->db->get('bank');
    }
    
    function update_bank($id,$input){
        $this->db->set('bank_id',$input['bank']);
        $this->db->set('guru_bank_rekening',$input['rekening']);
        $this->db->set('guru_bank_pemilik',$input['pemilik']);
        $this->db->where('guru_id',$id);
        $this->db->update('guru');
    }
}
