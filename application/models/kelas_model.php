<?php

class Kelas_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /*** ADMIN ***/
    function get_kelas($page=0){
        $offset = 20;
        $start = $page*$offset;
        $this->db->join('murid','murid.murid_id=kelas.murid_id', 'left outer');
        $this->db->join('guru','guru.guru_id=kelas.guru_id', 'left outer');
        $this->db->join('matpel','matpel.matpel_id=kelas.matpel_id', 'left outer');
        $this->db->join('lokasi','lokasi.lokasi_id=kelas.lokasi_id', 'left outer');
        $this->db->limit($offset,$start);
        $this->db->order_by('kelas_id','desc');
        return $this->db->get('kelas');
    }
    
    public function get_kelas_count(){
        return $this->db->count_all_results('kelas');
    }
    
    public function get_kelas_by_id($id){
        $this->db->join('murid','murid.murid_id=kelas.murid_id', 'left outer');
        $this->db->join('guru','guru.guru_id=kelas.guru_id', 'left outer');
        $this->db->join('duta_guru','duta_guru.duta_guru_id=kelas.duta_guru_id', 'left outer');
        $this->db->join('matpel','matpel.matpel_id=kelas.matpel_id', 'left outer');
        //$this->db->join('guru_matpel','guru_matpel.matpel_id=matpel.matpel_id and `guru_matpel`.`guru_id`=`guru`.`guru_id`', 'left outer');
        $this->db->join('lokasi','lokasi.lokasi_id=kelas.lokasi_id', 'left outer');
        $this->db->join('jenjang_pendidikan','jenjang_pendidikan.jenjang_pendidikan_id=matpel.jenjang_pendidikan_id', 'left outer');
        $this->db->where('kelas_id',$id);
        $result = $this->db->get('kelas');
        if($result->num_rows() > 0){
            return $result->first_row();
        }else{
            return null;
        }
    }
    
    public function get_referal_duta_from_guru($guru_id){
		$this->db->where('guru_id',$guru_id);
		return $this->db->get('guru')->first_row();
    }
    
      public function get_duta_info($duta_id){
		$this->db->where('duta_guru_id',$duta_id);
		return $this->db->get('duta_guru')->first_row();
    }
    
     public function get_kelas_pertemuan_by_id($kelas_pertemuan_id){
        $this->db->where('kelas_pertemuan_id',$kelas_pertemuan_id);
        return $this->db->get('kelas_pertemuan')->first_row();
    }
    
    public function get_kelas_pertemuan($kelas_id){
        $this->db->join('kelas_pertemuan_status','kelas_pertemuan_status.kelas_pertemuan_status_id=kelas_pertemuan.kelas_pertemuan_status_id', 'left outer');
        $this->db->where('kelas_id',$kelas_id);
        $this->db->order_by('kelas_pertemuan_date','asc');
        return $this->db->get('kelas_pertemuan');
    }
    
    public function get_kelas_by_guru_id($guru_id,$id=null){
        $this->db->join('murid','murid.murid_id=kelas.murid_id', 'left outer');
        $this->db->join('guru','guru.guru_id=kelas.guru_id', 'left outer');
        $this->db->join('matpel','matpel.matpel_id=kelas.matpel_id', 'left outer');
        $this->db->join('lokasi','lokasi.lokasi_id=kelas.lokasi_id', 'left outer');
        $this->db->join('jenjang_pendidikan','jenjang_pendidikan.jenjang_pendidikan_id=matpel.jenjang_pendidikan_id', 'left outer');
        $this->db->where('kelas.guru_id',$guru_id);
	   $this->db->order_by('kelas.kelas_mulai','desc');
        if(!empty($id)){
            $this->db->where('kelas.kelas_id',$id);
        }
        return $this->db->get('kelas');
    }
    
    public function get_kelas_by_murid_id($murid_id,$id=null){
        $this->db->join('murid','murid.murid_id=kelas.murid_id', 'left outer');
        $this->db->join('guru','guru.guru_id=kelas.guru_id', 'left outer');
        $this->db->join('matpel','matpel.matpel_id=kelas.matpel_id', 'left outer');
        $this->db->join('lokasi','lokasi.lokasi_id=kelas.lokasi_id', 'left outer');
        $this->db->join('jenjang_pendidikan','jenjang_pendidikan.jenjang_pendidikan_id=matpel.jenjang_pendidikan_id', 'left outer');
        $this->db->where('murid.murid_id',$murid_id);
	   $this->db->order_by('kelas.kelas_mulai','desc');
        if(!empty($id)){
            $this->db->where('kelas.kelas_id',$id);
        }
        return $this->db->get('kelas');
    }
    
    public function get_kelas_by_duta_guru_id($duta_guru_id,$id=null){
        
        $this->db->join('guru','guru.guru_id=kelas.guru_id', 'left outer');
	   $this->db->join('murid','murid.murid_id=kelas.murid_id', 'left outer');
        $this->db->join('matpel','matpel.matpel_id=kelas.matpel_id', 'left outer');
        $this->db->join('lokasi','lokasi.lokasi_id=kelas.lokasi_id', 'left outer');
        $this->db->join('jenjang_pendidikan','jenjang_pendidikan.jenjang_pendidikan_id=matpel.jenjang_pendidikan_id', 'left outer');
        $this->db->join('duta_guru','duta_guru.duta_guru_id=guru.guru_referral or duta_guru.duta_guru_id=murid.murid_referral');
        $this->db->where('duta_guru.duta_guru_id',$duta_guru_id);
        if(!empty($id)){
            $this->db->where('kelas.kelas_id',$id);
        }
        return $this->db->get('kelas');
    }
    
     public function get_duta_guru_in_kelas($duta_guru_id){
        
        $this->db->join('guru','guru.guru_id=kelas.guru_id', 'left outer');
	   $this->db->join('murid','murid.murid_id=kelas.murid_id', 'left outer');
        $this->db->join('matpel','matpel.matpel_id=kelas.matpel_id', 'left outer');
        $this->db->join('lokasi','lokasi.lokasi_id=kelas.lokasi_id', 'left outer');
        $this->db->join('jenjang_pendidikan','jenjang_pendidikan.jenjang_pendidikan_id=matpel.jenjang_pendidikan_id', 'left outer');
        $this->db->join('duta_guru','duta_guru.duta_guru_id=guru.guru_referral', 'left outer');
        $this->db->where('kelas.duta_guru_id',$duta_guru_id);
        return $this->db->get('kelas');
    }
    
     public function get_duta_murid_in_kelas($duta_guru_id, $murid_id){
        $this->db->join('matpel','matpel.matpel_id=kelas.matpel_id', 'left outer');
        $this->db->join('jenjang_pendidikan','jenjang_pendidikan.jenjang_pendidikan_id=matpel.jenjang_pendidikan_id', 'left outer');
        $this->db->where('kelas.duta_murid_id',$duta_guru_id);
        $this->db->where('kelas.murid_id',$murid_id);
        return $this->db->get('kelas');
    }
    
     public function get_kelas_by_dutaguru_id($duta_guru_id,$id=null){
        
        $this->db->join('guru','guru.guru_id=kelas.guru_id', 'left outer');
        $this->db->join('matpel','matpel.matpel_id=kelas.matpel_id', 'left outer');
        $this->db->join('jenjang_pendidikan','jenjang_pendidikan.jenjang_pendidikan_id=matpel.jenjang_pendidikan_id', 'left outer');
        $this->db->where('kelas.duta_guru_id',$duta_guru_id);
	   $this->db->group_by('kelas.guru_id');
        return $this->db->get('kelas');
	}
	
	public function get_kelas_by_dutamurid_id($duta_guru_id,$id=null){
        
        $this->db->join('guru','guru.guru_id=kelas.guru_id', 'left outer');
	   $this->db->join('murid','murid.murid_id=kelas.murid_id', 'left outer');
        $this->db->join('matpel','matpel.matpel_id=kelas.matpel_id', 'left outer');
        $this->db->join('lokasi','lokasi.lokasi_id=kelas.lokasi_id', 'left outer');
        $this->db->join('jenjang_pendidikan','jenjang_pendidikan.jenjang_pendidikan_id=matpel.jenjang_pendidikan_id', 'left outer');
        $this->db->join('duta_guru','duta_guru.duta_guru_id=guru.guru_referral or duta_guru.duta_guru_id=murid.murid_referral');
        $this->db->where('kelas.duta_murid_id',$duta_guru_id);
        if(!empty($id)){
            $this->db->where('kelas.kelas_id',$id);
        }
        return $this->db->get('kelas');
	}
    
        public function get_kelas_by_guru($guru_id){
	   $this->db->select('kelas.kelas_id');
	   $this->db->distinct();
	   $this->db->join('kelas_pertemuan','kelas_pertemuan.kelas_id = kelas.kelas_id', 'left outer');
        $this->db->where('kelas.guru_id',$guru_id);
	   $result = $this->db->get('kelas');
        return $result;
    }
    
        public function get_kelas_pertemuan_by_guru($kelas_id){
        $this->db->join('kelas_pertemuan_status','kelas_pertemuan_status.kelas_pertemuan_status_id=kelas_pertemuan.kelas_pertemuan_status_id', 'left outer');
        $this->db->where('kelas_pertemuan.kelas_id',$kelas_id);
        $this->db->where('kelas_pertemuan.kelas_pertemuan_status_id',1);
        $this->db->order_by('kelas_pertemuan_date','asc');
        return $this->db->get('kelas_pertemuan');
    }
    
        public function get_status_pembayaran_duta($guru_id, $duta_guru_id){
        $this->db->where('guru_id',$guru_id);
        $this->db->where('duta_guru_id',$duta_guru_id);
        $this->db->where('kelas_pembayaran_duta_guru >', 0);
        return $this->db->get('kelas')->first_row();
    }
    /**** CRUD ****/
    
    public function add($input){
        $this->db->set('murid_id',$input['murid']);
        $this->db->set('request_id',$input['request_id']);
        $this->db->set('guru_id',$input['guru']);
        $this->db->set('duta_guru_id',$input['duta_guru']);
        $this->db->set('duta_murid_id',$input['duta_murid']);
        $this->db->set('matpel_id',$input['matpel']);
        $this->db->set('kelas_mulai',$input['mulai']);
        $this->db->set('lokasi_id',$input['lokasi']);
        $this->db->set('kelas_discount',$input['disc']);
        $this->db->set('kelas_catatan',$input['catatan']);
        $this->db->set('kelas_status',1);
        $this->db->set('kelas_pembayaran_status',1);
        $this->db->insert('kelas');
    }
    
    public function delete($id){
        $this->db->where('kelas_id',$id);
        $this->db->delete('kelas');
    }
    
    public function edit_pembayaran($input){
        $this->db->set('kelas_total_jam',$input['total_jam']);
        $this->db->set('kelas_harga',$input['harga']);
        $this->db->set('kelas_frekuensi',$input['frek']);
        $this->db->set('kelas_durasi',$input['durasi']);
        $this->db->set('kelas_total_harga',$input['total_harga']);
        $this->db->set('kelas_tahapan_pembayaran',$input['tahap_pembayaran']);
        $this->db->set('kelas_persen_pembayaran',$input['persen_pembayaran']);
        $this->db->set('kelas_status',1);
        $this->db->where('kelas_id',$input['id']);
        $this->db->update('kelas');
    }
    
     public function update_kelas($input, $id){
        $this->db->set('guru_id',$input['guru']);
        $this->db->set('matpel_id',$input['matpel']);
        $this->db->set('lokasi_id',$input['lokasi']);
        $this->db->set('kelas_mulai',$input['mulai']);
        $this->db->set('kelas_catatan',$input['catatan']);
        $this->db->where('kelas_id',$id);
        $this->db->update('kelas');
    }
    
     public function update_pembayaran_murid($input){
	   $this->db->set('kelas_pembayaran_murid',$input['pembayaran_murid']);
        $this->db->set('kelas_rek_murid',$input['no_rek_murid']);
        $this->db->set('kelas_date_verified',$input['date_verified']);
        $this->db->set('kelas_pembayaran_status',$input['status_pembayaran']);
        $this->db->where('kelas_id',$input['id']);
        $this->db->update('kelas');
    }
    
     public function update_pembayaran_murid_kedua($input){
	   $this->db->set('kelas_pembayaran_murid_kedua',$input['pembayaran_murid_kedua']);
        $this->db->set('kelas_date_verified_kedua',$input['date_verified_kedua']);
        $this->db->set('kelas_pembayaran_kedua_status',$input['status_pembayaran_kedua']);
        $this->db->where('kelas_id',$input['id']);
        $this->db->update('kelas');
    }
    
     public function update_pembayaran_guru($input){
	   $this->db->set('kelas_pembayaran_guru_setengah',$input['half_to_guru']);
        $this->db->set('kelas_pembayaran_guru_penuh',$input['full_to_guru']);
        $this->db->set('kelas_jenis_pembayaran_guru',$input['jenis_pembayaran']);
        $this->db->set('kelas_date_payment1',$input['date_payment1']);
        $this->db->set('kelas_date_payment2',$input['date_payment2']);
        $this->db->where('kelas_id',$input['id']);
        $this->db->update('kelas');
    }
    
     public function update_pembayaran_dutaguru($input){
        $this->db->set('kelas_pembayaran_duta_guru',$input['to_duta_guru']);
        $this->db->where('kelas_id',$input['id']);
        $this->db->update('kelas');
    }
    
     public function update_pembayaran_dutamurid($input){
        $this->db->set('kelas_pembayaran_duta_murid',$input['to_duta_murid']);
        $this->db->where('kelas_id',$input['id']);
        $this->db->update('kelas');
    }
    
    public function edit_kelas_status($id,$status){
        $this->db->set('kelas_status',$status,TRUE);
        $this->db->where('kelas_id',$id);
        $this->db->update('kelas');
    }
    
    public function edit_pertemuan_status($id,$status){
        $this->db->set('kelas_pertemuan_status_id',$status,TRUE);
        $this->db->where('kelas_pertemuan_id',$id);
        $this->db->update('kelas_pertemuan');
    }
    
    public function add_pertemuan($input){
        $this->db->set('kelas_id',$input['id']);
        $this->db->set('kelas_pertemuan_date',$input['date']);
        $this->db->set('kelas_pertemuan_jam_mulai',$input['mulai_jam'].':'.$input['mulai_menit']);
        $this->db->set('kelas_pertemuan_jam_selesai',$input['selesai_jam'].':'.$input['selesai_menit']);
        $this->db->set('kelas_pertemuan_status_id',1);
        $this->db->insert('kelas_pertemuan');
    }
    
    public function delete_kelas($id){
        $this->db->where('kelas_id',$id);
        $this->db->delete('kelas');      
    }
    
    public function delete_kelas_pertemuan($id){
        $this->db->where('kelas_pertemuan_id',$id);
        $this->db->delete('kelas_pertemuan');      
    }
    
    public function update_status_kelas_guru($input){
        foreach($input['status'] as $key=> $row){
            $this->edit_pertemuan_status($key,$row);
        }
    }
    
     public function edit_status_kelas_pertemuan($input,$id_kelas,$id_kelas_pertemuan){
        $this->db->set('kelas_pertemuan_date',$input['date']);
        $this->db->set('kelas_pertemuan_jam_mulai',$input['mulai_jam'].':'.$input['mulai_menit']);
        $this->db->set('kelas_pertemuan_jam_selesai',$input['selesai_jam'].':'.$input['selesai_menit']);
        $this->db->set('kelas_pertemuan_status_id',$input['status_pertemuan']);
	   $this->db->where('kelas_id',$id_kelas);
	   $this->db->where('kelas_pertemuan_id',$id_kelas_pertemuan);
        $this->db->update('kelas_pertemuan');
    }
    
    //FEEDBACK
    public function send_request_feedback($kelas_id){
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
	   $this->email->from('info@ruangguru.com', 'Ruangguru.com');
        
        $kelas = $this->get_kelas_by_id($kelas_id);
        if(empty($kelas)){
            return;
        }
	
     $this->email->to($kelas->murid_email);
	$this->email->subject('Feedback Kelas Ruangguru');
        
        $content = $this->load->view('front/murid/template/request_feedback',array('kelas'=>$kelas),TRUE);
        
        $this->email->message($content);
	$this->email->send();
    }
    
    //INVOICE
    public function send_invoice($kelas_id){
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
		$this->email->from('info@ruangguru.com', 'Ruangguru.com');
        
		$hash=md5($kelas_id);
		$class_code = substr($hash, 0, 2).substr($hash, 6, 2).$kelas_id.substr($hash, 30, 2);
		$kelas = $this->get_kelas_by_id($kelas_id);
		$this->email->to($kelas->murid_email);
		$this->email->subject('Tagihan Pembayaran Murid');
        
		$content = $this->load->view('front/murid/template/send_invoice',array('kelas'=>$kelas, 'kode'=>$class_code),TRUE);
        
		$this->email->message($content);
		$this->email->send();
      }
	 
	//INVOICE
     public function send_invoice_guru($kelas_id){
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
		 $this->email->from('info@ruangguru.com', 'Ruangguru.com');
        
	   	$hash=md5($kelas_id);
		$class_code = substr($hash, 4, 2).substr($hash, 12, 2).$kelas_id.substr($hash, 26, 2);
		$kelas=$this->get_kelas_by_id($kelas_id);
		$this->email->to($kelas->guru_email);
        
		if($kelas->kelas_jenis_pembayaran_guru == 0){
			$this->email->subject('Bukti Pembayaran Guru Kelas Pertama');
			$content = $this->load->view('front/profile/template/send_invoice',array('kelas'=>$kelas, 'kode'=>$class_code, 'jenis_pembayaran' => $kelas->kelas_jenis_pembayaran_guru),TRUE);
		}else{
			$this->email->subject('Bukti Pembayaran Guru Kelas Terakhir');
			$content = $this->load->view('front/profile/template/send_invoice_full',array('kelas'=>$kelas, 'kode'=>$class_code, 'jenis_pembayaran' => $kelas->kelas_jenis_pembayaran_guru),TRUE);
		}
		
		$this->email->message($content);
		$this->email->send();
      }
	 
	//INVOICE
     public function send_invoice_duta($kelas_id){
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
		 $this->email->from('info@ruangguru.com', 'Ruangguru.com');
        
	     $hash=md5($kelas_id);
		$class_code = substr($hash, 2, 2).substr($hash, 10, 2).$kelas_id.substr($hash, 24, 2);
		$kelas=$this->get_kelas_by_id($kelas_id);
		$this->email->to($kelas->duta_guru_email);
		$this->email->subject('Bukti Pembayaran Duta Guru');
        
		$content = $this->load->view('front/duta_guru/template/send_invoice',array('kelas'=>$kelas, 'kode'=>$class_code),TRUE);
        
		$this->email->message($content);
		$this->email->send();
      }
	 
	 public function send_invoice_duta_murid($kelas_id){
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
		 $this->email->from('info@ruangguru.com', 'Ruangguru.com');
        
		$hash=md5($kelas_id);
		$class_code = substr($hash, 10, 2).substr($hash, 24, 2).$kelas_id.substr($hash, 2, 2);
		$kelas=$this->get_kelas_by_id($kelas_id);
		$duta = $this->get_duta_info($kelas->duta_murid_id);
		$this->email->to($duta->duta_guru_email);
		$this->email->subject('Bukti Pembayaran Duta Murid');
        
		$content = $this->load->view('front/duta_guru/template/send_invoice_duta',array('kelas'=>$kelas, 'duta'=>$duta, 'kode'=>$class_code),TRUE);
        
		$this->email->message($content);
		$this->email->send();
      }
	 
	 public function send_bukti_pembayaran($kelas_id){
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
		 $this->email->from('info@ruangguru.com', 'Ruangguru.com');
        
		$hash=md5($kelas_id);
		$class_code = substr($hash, 30, 2).substr($hash, 0, 2).$kelas_id.substr($hash, 6, 2);
		$kelas=$this->get_kelas_by_id($kelas_id);
		$this->email->to($kelas->duta_guru_email);
		$this->email->subject('Bukti Penerimaan Pembayaran dari Murid');
        
		$content = $this->load->view('front/murid/template/send_bukti_penerimaan',array('kelas'=>$kelas, 'kode'=>$class_code),TRUE);
        
		$this->email->message($content);
		$this->email->send();
      }
	 
    public function get_feedback_question(){
        $this->db->order_by('feedback_question_sort','asc');
        return $this->db->get('feedback_question');
    }
    
    public function get_feedback_answer($question_id){
        $this->db->where('feedback_question_id',$question_id);
        $this->db->order_by('feedback_answer_sort','asc');
        return $this->db->get('feedback_answer');
    }
    
    public function insert_feedback($input){
        $kelas_id = $input['kelas_id'];
        if(empty($kelas_id) || $kelas_id <= 0){
            return;
        }
        //insert feedback
        foreach($input['feedback'] as $question_id => $answer_id){
            $this->insert_feedback_item($kelas_id, $question_id, $answer_id);
        }
        //update testimoni
        $this->update_testimoni($kelas_id, $input['testimoni']);
    }
    
    public function insert_feedback_item($kelas_id,$question_id,$answer_id){
        $this->db->set('kelas_id',$kelas_id);
        $this->db->set('feedback_question_id',$question_id);
        $this->db->set('feedback_answer_id',$answer_id);
        $this->db->insert('kelas_feedback');
    }
    
    public function update_testimoni($kelas_id,$testimoni){
        if(empty($kelas_id) || $kelas_id <= 0){
            return;
        }
        $this->db->set('kelas_feedback_status',1,TRUE);
        $this->db->set('kelas_testimoni',$testimoni);
        $this->db->where('kelas_id',$kelas_id);
        $this->db->update('kelas');
    }
    
    public function get_feedback_by_kelas_id($kelas_id){
        $this->db->join('feedback_question','feedback_question.feedback_question_id=kelas_feedback.feedback_question_id', 'left outer');
        $this->db->join('feedback_answer','feedback_answer.feedback_answer_id=kelas_feedback.feedback_answer_id', 'left outer');
        $this->db->where('kelas_id',$kelas_id);
        return $this->db->get('kelas_feedback');
    }
    
     public function update_rating($guru_id, $input){
        $this->db->set('guru_rating',$input['skor']);
        $this->db->where('guru_id',$guru_id);
        $this->db->update('guru');
    }

     public function add_kelas_submit($input){
        $this->db->set('guru_id',$input['id_guru']);
        $this->db->set('kelas_guru_nama',$input['nama']);
        $this->db->set('kelas_guru_deskripsi',$input['deskripsi']);
        $this->db->set('kelas_guru_matpel',$input['matpel']);
	   if(empty($input['matpel_lain'])){
	      $this->db->set('kelas_guru_matpel_lain','-');
	   }else{
		 $this->db->set('kelas_guru_matpel_lain',$input['matpel_lain']);
	   }
        $this->db->set('kelas_guru_lokasi',$input['lokasi']);
        $this->db->set('kelas_guru_target',$input['target']);
        $this->db->set('kelas_guru_harga',$input['tarif']);
        $this->db->set('kelas_guru_video',$input['link_video']);
        $this->db->set('kelas_guru_image',$input['file']);
        $this->db->set('kelas_guru_status',0);
        $this->db->insert('kelas_guru');
	   $id = $this->db->insert_id();
	   $count = count($input['date']);
		   for($i=0; $i<$count; $i++){
			$this->add_jadwal_kelas_guru($id, $input['date'][$i], $input['mulai_jam'][$i], $input['selesai_jam'][$i], $input['mulai_menit'][$i], $input['selesai_menit'][$i], $input['waktu'][$i]);
		   }
    }
    
	public function add_jadwal_kelas_guru($id, $tgl, $jam_mulai, $jam_selesai, $menit_mulai, $menit_selesai, $waktu){
        $this->db->set('kelas_guru_id',$id);
        $this->db->set('kelas_guru_tanggal',$tgl);
        $this->db->set('kelas_guru_jam_mulai',$jam_mulai);
        $this->db->set('kelas_guru_jam_selesai',$jam_selesai);
        $this->db->set('kelas_guru_menit_mulai',$menit_mulai);
        $this->db->set('kelas_guru_menit_selesai',$menit_selesai);
        $this->db->set('kelas_guru_waktu',$waktu);
        $this->db->insert('jadwal_kelas_guru');
    }
    
     public function get_buka_kelas($guru_id){
        $this->db->where('guru_id',$guru_id);
        return $this->db->get('kelas_guru');
    }
    
     public function get_buka_kelas_by_id($id_kelas){
        $this->db->where('kelas_guru_id',$id_kelas);
        return $this->db->get('kelas_guru')->first_row();
    }
     public function get_buka_kelas_all(){
	   $this->db->join('matpel','matpel.matpel_id=kelas_guru.kelas_guru_matpel', 'left outer');
        return $this->db->get('kelas_guru');
    }
    
     public function get_buka_kelas_all_active(){
	   $this->db->join('matpel','matpel.matpel_id=kelas_guru.kelas_guru_matpel', 'left outer');
	   $this->db->where('kelas_guru_status',1);
        return $this->db->get('kelas_guru');
    }
    
  
     public function get_buka_kelas_limit($offset=null, $start=null){
	   $this->db->join('matpel','matpel.matpel_id=kelas_guru.kelas_guru_matpel', 'left outer');
	   $this->db->where('kelas_guru_status',1);
	   $this->db->limit($offset,$start);
        return $this->db->get('kelas_guru');
    }
    
    
     public function get_buka_kelas_all_front(){
	   $this->db->join('matpel','matpel.matpel_id=kelas_guru.kelas_guru_matpel', 'left outer');
	   $this->db->where('kelas_guru_status',1);
        return $this->db->get('kelas_guru');
    }
    
     public function add_peserta($id_kelas, $murid_id){
        $this->db->set('kelas_guru_id',$id_kelas);
        $this->db->set('murid_id',$murid_id);
        $this->db->insert('kelas_murid');
    }
    
     public function edit_kelas_guru_status($id,$status){
        $this->db->set('kelas_guru_status',$status,TRUE);
        $this->db->where('kelas_guru_id',$id);
        $this->db->update('kelas_guru');
    }
    
     public function get_daftar_kelas(){
	   $this->db->join('murid','murid.murid_id=kelas_murid.murid_id', 'left outer');
	   $this->db->join('kelas_guru','kelas_guru.kelas_guru_id=kelas_murid.kelas_guru_id', 'left outer');
        return $this->db->get('kelas_murid');
    }
    
     public function delete_peserta($id){
        $this->db->where('kelas_murid_id',$id);
        $this->db->delete('kelas_murid');
    }
    
    
     public function add_feedback_kelas($id_kelas, $n, $input){
        $this->db->set('kelas_id',$id_kelas);
        $this->db->set('feedback_question_id',$n);
        $this->db->set('feedback_answer_id',$input);
        $this->db->insert('kelas_feedback');
    }
    
      public function update_testimonial($id_kelas, $input){
        $this->db->set('kelas_testimoni',$input['testimoni']);
        $this->db->set('kelas_feedback_status',1);
        $this->db->where('kelas_id',$id_kelas);
        $this->db->update('kelas');
    }
    
         public function add_reminder($input){
        $this->db->set('kelas_id',$input['kelas_id']);
        $this->db->set('kelas_tgl',$input['tanggal']);
        $this->db->set('kelas_ket',$input['keterangan']);
        $this->db->insert('kelas_notifikasi');
    }
    
    	public function get_reminder_all(){
        return $this->db->get('kelas_notifikasi');
    }
    
     public function get_reminder_limit($page=0){
	   $offset = 20;
        $start = $page*$offset;
        $this->db->limit($offset,$start);
        $this->db->order_by('kelas_notif_id','asc');
        return $this->db->get('kelas_notifikasi');
    }
    
	public function get_reminder_data($id){
	   $this->db->where('kelas_notif_id',$id);
        return $this->db->get('kelas_notifikasi')->first_row();
    }
    
     public function update_reminder_data($input){
        $this->db->set('kelas_tgl',$input['tanggal']);
        $this->db->set('kelas_ket',$input['keterangan']);
        $this->db->set('kelas_id',$input['kelas_id']);
        $this->db->where('kelas_notif_id',$input['notif_id']);
        $this->db->update('kelas_notifikasi');
    }
    
    	public function get_reminder_kelas($id_kelas){
	   $this->db->where('kelas_id',$id_kelas);
        return $this->db->get('kelas_notifikasi');
    }
    
     public function delete_reminder($id){
        $this->db->where('kelas_notif_id',$id);
        $this->db->delete('kelas_notifikasi');
    }
    
    	public function get_kelas_by_murid($murid){
        $this->db->join('murid','murid.murid_id=kelas.murid_id', 'left outer');
        $this->db->join('guru','guru.guru_id=kelas.guru_id', 'left outer');
        $this->db->join('matpel','matpel.matpel_id=kelas.matpel_id', 'left outer');
        $this->db->join('lokasi','lokasi.lokasi_id=kelas.lokasi_id', 'left outer');
        $this->db->join('jenjang_pendidikan','jenjang_pendidikan.jenjang_pendidikan_id=matpel.jenjang_pendidikan_id', 'left outer');
        $this->db->like('murid.murid_nama',$murid);
	   $this->db->order_by('kelas.kelas_mulai','desc');
        return $this->db->get('kelas');
    }
    
        /*/KOMUNITAS
     public function add_komunitas($input){
        $this->db->set('guru_id',$input['id_guru']);
        $this->db->set('komunitas_nama',$input['nama']);
        $this->db->set('komunitas_deskripsi',$input['deskripsi']);
        $this->db->set('komunitas_logo',$input['logo']);
	   $this->db->insert('komunitas');
    }
    
    public function get_komunitas($id){
		$this->db->where('guru_id', $id);
		return $this->db->get('komunitas');
    }
    
    public function edit_komunitas($input){
        $this->db->set('guru_id',$input['id_guru']);
        $this->db->set('komunitas_nama',$input['nama']);
        $this->db->set('komunitas_deskripsi',$input['deskripsi']);
        $this->db->set('komunitas_logo',$input['logo']);
	   $this->db->where('komunitas_id',$input['id']);
	   $this->db->update('komunitas');
    }
    
     public function edit_catatan($input){
        $this->db->set('kelas_guru_image',$input['poster']);
        $this->db->set('kelas_guru_video',$input['video']);
        $this->db->set('kelas_guru_alasan',$input['alasan']);
        $this->db->set('kelas_guru_include',$input['fasilitas']);
        $this->db->set('kelas_guru_catatan',$input['catatan']);
	   $this->db->where('guru_id',$input['id_guru']);
	   $this->db->where('kelas_guru_id',$input['id']);
	   $this->db->update('kelas_guru');
    }
    
    public function get_jadwal_kelas_guru($id){
		$this->db->where('kelas_guru_id', $id);
		return $this->db->get('jadwal_kelas_guru');
    }
    
    public function get_rate_kelas_guru($id){
		$this->db->select_sum('rate_value', 'rate');
		$this->db->select('COUNT(*) AS counter', FALSE);
		$this->db->where('kelas_guru_id', $id);
		return $this->db->get('kelas_guru_rating');
    }
    
    public function get_review_kelas_guru($id){
		$this->db->join('murid','murid.murid_id=kelas_guru_review.murid_id', 'left outer');
		$this->db->where('kelas_guru_id', $id);
		return $this->db->get('kelas_guru_review');
    }
    
    public function test($id){
		$this->db->select('COUNT(*) as counter', FALSE);
		$this->db->select_sum('guru_rating', 'rate');
		$this->db->where('kelas_guru_id', $id);
		return $this->db->get('kelas_guru');
    }
    
     public function get_galeri_kelas($id){
		$this->db->where('kelas_guru_id', $id);
		return $this->db->get('galeri_kelas');
    }
	*/
	
	public function get_status_payment($kelas_id){
		$hash = md5($kelas_id);
		$kode = "RG".$kelas_id.substr($hash, 0, 3);
        $this->db->where('order_id',$kode);
        $result = $this->db->get('payment')->first_row();
        return $result;
    }
}
?>