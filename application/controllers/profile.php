<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile extends MY_Controller {
    private $id;

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
	   $this->load->helper('pdf_helper');
        $this->id = $this->session->userdata('guru_id');
        if(empty($this->id)){
            redirect('guru/login');
        }
        $this->load->model('profile_model');
        $this->load->model('guru_model');
        $this->load->model('kelas_model');
    }
	
	public function resize_img($tmp_img,$img,$type,$w,$flag,$path){
		if(trim($tmp_img) != "")
		{
			$ext = explode('.',$img);
			$images = $tmp_img;
			if($flag == 1){
				$new_images = $this->id.'.'.jpg;
			} else {
				$new_images = $this->id.'-'.time().'.'.jpg;
			}
			copy($tmp_img,$path.$img);
			$width=$w; //*** Fix Width & Heigh (Auto caculate) ***//
			$size=GetimageSize($images);
			$height=round($width*$size[1]/$size[0]);
			if($type == "image/png"){
				$images_orig = ImageCreateFromPNG($images);
				$photoX = ImagesX($images_orig);
				$photoY = ImagesY($images_orig);
				$images_fin = ImageCreateTrueColor($width, $height);
				ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
				ImagePNG($images_fin,$path.$new_images);
				ImageDestroy($images_orig);
				ImageDestroy($images_fin);
			} elseif ($type == "image/jpeg"){
				$images_orig = ImageCreateFromJPEG($images);
				$photoX = ImagesX($images_orig);
				$photoY = ImagesY($images_orig);
				$images_fin = ImageCreateTrueColor($width, $height);
				ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
				ImageJPEG($images_fin,$path.$new_images);
				ImageDestroy($images_orig);
				ImageDestroy($images_fin);
			} else {
				$images_orig = ImageCreateFromGIF($images);
				$photoX = ImagesX($images_orig);
				$photoY = ImagesY($images_orig);
				$images_fin = ImageCreateTrueColor($width, $height);
				ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
				ImageGIF($images_fin,$path.$new_images);
				ImageDestroy($images_orig);
				ImageDestroy($images_fin);
			}
			unlink($path.$img);
			return $new_images;
		}
	}
	
	public function upload_files($tmp_files, $files, $type){
		if(trim($tmp_files) != ""){
			if(($type == "image/jpeg") || ($type == "image/png") || ($type == "application/pdf")){
				$file_expl = explode('.',strtolower($files));
				$ext = array_pop($file_expl);
//				$name_files = str_replace(' ', '_', $this->input->post('title'));
				$name_files = preg_replace('/[^a-z0-9]/','-', implode('.',$file_expl));
				$name_files = str_replace('--', '-', $name_files);
				$name_files = trim($name_files,'-');
				$new_files = $this->id.'-'.$name_files.'.'.$ext;
				copy($tmp_files,'./files/sertifikat/'.$new_files);
				return $new_files;
			} else {
				show_error('Jenis file yang di-unggah tidak sesuai: '.$type);
			}
		} else {
			show_error('Gagal mengunggah file!', 400);
			exit;
		}
	}
    
    public function index(){
        $data['guru'] = $this->profile_model->get_profile_guru($this->id);
        $data['rating'] = $this->guru_model->get_calculated_rating($this->id);
	    $data['kelas'] = $this->guru_model->get_kelas($this->id);
        $data['menu'] = $this->load->view('front/profile/menu',array('active'=>'profile'),TRUE);
        $temp['css'] = array(1=>'validation',2=>'guru',3=>'profile');
        $this->load->view('header',$temp);
        $this->load->view('front/guru/akun',$data);
        $this->load->view('footer');
    }
    
    public function edit(){
        $data['guru'] = $this->profile_model->get_profile_guru($this->id);
        $data['menu'] = $this->load->view('front/profile/menu',array('active'=>'edit'),TRUE);
        $data['kategori'] = $this->guru_model->get_kategori();
        $data['pendidikan'] = $this->guru_model->get_pendidikan();
        $data['jenjang'] = $this->guru_model->get_jenjang();
        $data['lokasi'] = $this->profile_model->get_array_lokasi($this->id);
        $data['lokasi_jkt'] = $this->guru_model->get_lokasi_jkt();
        $data['lokasi_lain'] = $this->guru_model->get_lokasi_lain();
        $data['sertifikat'] = $this->profile_model->get_sertifikat($this->id);
        $data['days'] = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
        $temp['css'] = array(1=>'validation',2=>'guru',3=>'profile');
        $this->load->view('header',$temp);
        $this->load->view('front/profile/edit',$data);
        $this->load->view('footer');
    }
    
    public function submit_profpic(){
		if($_FILES){
		//print_r($_FILES);exit();
			$upload = $_FILES['profpic']['tmp_name'];
			$name 	= $_FILES['profpic']['name'];
			$type	= $_FILES['profpic']['type'];
			$size	= $_FILES['profpic']['size'];
			$dir = "./images/pp/";
			$thumbpic = $this->resize_img($upload,$name,$type,125,1,$dir);
		}
        /*$this->load->library('upload');
        if(!$this->upload->do_upload('profpic')){
            $this->session->set_flashdata('edit_profile_notif',$this->upload->display_errors('<span>','</span>'));
        }else{
            $image_data = $this->upload->data();
            $config['image_library'] = 'gd2';
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 125;
            $config['height'] = 125;
            $config['source_image'] = $image_data['full_path'];
            $config['new_image'] = './images/pp/'.$this->id.'.jpg';            
            $this->load->library('image_lib',$config);
            if ( ! $this->image_lib->resize()) {
                $this->session->set_flashdata('edit_profile_notif',$this->image_lib->display_errors('<span>','</span>'));
            }else{
                
                $this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Foto profil telah berhasil diubah.</span>');
            }
            unlink($image_data['full_path']);
        }*/
        redirect('profile/edit');
    }
    
     public function submit_video(){
	   $video = $this->input->post('video');
	   $jenis_video = $this->input->post('jenis_video');
	   if($this->profile_model->update_video($this->id,$video, $jenis_video)){
	       $this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Link video telah berhasil diubah.</span>');
        }else{
            $this->session->set_flashdata('edit_profile_notif','<span class="red-notif">Link video lama Anda salah!</span>');
        }
        redirect('profile/edit');
    }
    //BIODATA
    
    public function biodata(){
        $data['guru'] = $this->guru_model->get_guru_by_id($this->id);
        $data['kategori'] = $this->guru_model->get_kategori();
        $temp['css'] = array(1=>'validation',2=>'guru',3=>'profile');
        $this->load->view('header',$temp);
        $this->load->view('front/profile/biodata',$data);
        $this->load->view('footer');
    }
    
    public function pass_submit(){
        $oldpass = $this->input->post('oldpass');
        $pass = $this->input->post('pass');
        if($this->profile_model->update_pass($this->id,$oldpass,$pass)){
            $this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Password telah berhasil diubah.</span>');
        }else{
            $this->session->set_flashdata('edit_profile_notif','<span class="red-notif">Password lama Anda salah!</span>');
        }
        redirect('profile/edit');
    }
    
    public function biodata_submit(){
        $input['nama'] = $this->input->post('nama');
        $input['gender'] = $this->input->post('gender');
        $input['pendidikan_id'] = $this->input->post('pendidikan_id');
        $input['pendidikan_instansi'] = $this->input->post('pendidikan_instansi');
        $input['tempatlahir'] = $this->input->post('tempatlahir');
        $input['lahir'] = $this->input->post('tahun')."-".$this->input->post('bulan')."-".$this->input->post('tanggal');
        $input['hp'] = $this->input->post('hp');
        $input['hp_2'] = $this->input->post('hp_2');
        $input['telp_rumah'] = $this->input->post('telp_rumah');
        $input['telp_kantor'] = $this->input->post('telp_kantor');
        $input['alamat'] = $this->input->post('alamat');
        $input['alamat_domisili'] = $this->input->post('alamat_domisili');
        $input['kategori'] = $this->input->post('kategori');
        $input['fb'] = $this->input->post('fb');
        $input['twitter'] = $this->input->post('twitter');
        $input['referral'] = $this->input->post('referral');
        
		if($_FILES){
		//print_r($_FILES);exit();
			$upload = $_FILES['nik_image']['tmp_name'];
			$name 	= $_FILES['nik_image']['name'];
			$type	= $_FILES['nik_image']['type'];
			$size	= $_FILES['nik_image']['size'];
			$dir = "./images/nik/";
			$thumbpic = $this->resize_img($upload,$name,$type,400,2,$dir);
		}
        /*$this->load->library('upload');
        if($this->upload->do_upload('nik_image')){
            $image_data = $this->upload->data();
            $config['source_image'] = $image_data['full_path'];
            $filename = $this->id."-".time();
            $config['new_image'] = './images/nik/'.$filename.'.jpg';            
            $this->load->library('image_lib',$config);
            if ( ! $this->image_lib->resize()) {
                $this->session->set_flashdata('edit_profile_notif','<span class="red-notif">Terjadi kesalahan saat mengunggah scan NIK/ SIM/ Paspor/ Kartu Pelajar.</span>');
                redirect('profile/biodata');
            }else{
                $input['nik_image'] = $filename.'.jpg';
                unlink('./images/nik/'.$this->guru_model->get_guru_by_id($this->id)->guru_nik_image);
            }
            unlink($image_data['full_path']);
        }*/
        $this->profile_model->update_biodata($this->id,$input);
        $this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Biodata telah berhasil diubah.</span>');
        redirect('profile/edit');
    }
    
    //PERSONAL MESSAGE
    public function personal(){
        $data['guru'] = $this->guru_model->get_guru_by_id($this->id);
        $data['default_text'] = $this->load->view('front/profile/template/personal',null,true);
        $temp['css'] = array(1=>'validation',2=>'guru',3=>'profile');
        $this->load->view('header',$temp);
        $this->load->view('front/profile/personal',$data);
        $this->load->view('footer');
    }
    
    public function personal_submit(){
        $personal_message = $this->input->post('personal_message');
        $this->profile_model->update_personal($this->id,$personal_message);
        $this->guru_model->update_current_rating($this->id);
        $this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Tentang Saya telah berhasil diubah.</span>');
        redirect('profile/edit');
    }
    
    //PERSONAL MESSAGE
    public function pengalaman_submit(){
        $pengalaman = $this->input->post('pengalaman');
        $this->profile_model->update_pengalaman($this->id,$pengalaman);
        $this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Pengalaman Mengajar telah berhasil diubah.</span>');
        redirect('profile/edit');
    }
    
    //MATA PELAJARAN
    public function matpel(){
        $data['matpel'] = $this->profile_model->get_map_matpel($this->id);
        $data['jenjang'] = $this->guru_model->get_jenjang();
        $temp['css'] = array(1=>'guru',2=>'profile');
        $this->load->view('header',$temp);
        $this->load->view('front/profile/matpel',$data);
        $this->load->view('footer');
    }
    
    public function matpel_submit(){
        $matpel = $this->input->post('matpel');
        $is_added = $this->profile_model->update_guru_matpel($this->id, $matpel);
        $this->session->set_flashdata('matpel_notif','<span class="green-notif">Preferensi Mata Pelajaran telah berhasil diubah.</span>');
        if($is_added){
            redirect('profile/tarif');
        }else{
            redirect('profile/matpel');
        }
    }
    
    public function add_matpel(){
        $matpel = $this->input->post('matpel');
        $tarif = $this->input->post('tarif');
		if($tarif < 50000) {
			$this->session->set_flashdata('edit_profile_notif','<span class="red-notif">Minimum Preferensi Tarif Mata Pelajaran adalah Rp. 50.000,- .</span>');
		} else {
			$this->profile_model->add_guru_matpel($this->id,$matpel,$tarif);
			$this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Preferensi Mata Pelajaran telah berhasil ditambah.</span>');
		}
        redirect('profile/edit');
    }
    
     public function delete_matpel($matpel_id){
        $matpel[$matpel_id] = $matpel_id;
        $this->profile_model->delete_guru_matpel($this->id,$matpel);
        $this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Preferensi Mata Pelajaran telah berhasil dihapus.</span>');
        redirect('profile/edit');
    }
    
    public function getuniv($id){
        if($id==1){
            $data = $this->guru_model->get_matpel(4);
        }else if($id==2){
            $data = $this->guru_model->get_matpel(9);
        }else{
            $data = $this->guru_model->get_matpel(4);
        }
        $str = "";
        $matpel = $this->profile_model->get_array_matpel($this->id);
        foreach($data->result() as $m){
            $checked='';
            if(!empty($matpel[$m->matpel_id])){
                $checked="checked";
            }
            $str .= '<span class="inline-block rgc">';
            $str .= '<input type="checkbox" name="matpel['.$m->matpel_id.']" value="'.$m->matpel_id.'" '.$checked.'/>'.$m->matpel_title;
            $str .= '</span>';
        }
        echo $str;
    }
    
    //TARIF
    public function tarif(){
        $data['matpel'] = $this->profile_model->get_list_matpel($this->id);
        $temp['css'] = array(1=>'guru',2=>'profile');
        $this->load->view('header',$temp);
        $this->load->view('front/profile/tarif',$data);
        $this->load->view('footer');
    }
    
    public function tarif_submit(){
        $tarif = (int) $this->input->post('tarif');
		if(min($tarif) < 50000){
			$this->session->set_flashdata('tarif_notif','<span class="red-notif">Minimum Preferensi Tarif untuk setiap mata pelajaran adalah Rp. 50.000,-.</span>');
		} else {
			$this->profile_model->update_guru_tarif($this->id, $tarif);
			$this->session->set_flashdata('tarif_notif','<span class="green-notif">Preferensi Tarif untuk setiap mata pelajaran telah berhasil diubah.</span>');
		}
        redirect('profile/tarif');
    }
    
    //LOKASI
    public function lokasi(){
        $data['lokasi'] = $this->profile_model->get_array_lokasi($this->id);
        $data['lokasi_jkt'] = $this->guru_model->get_lokasi_jkt();
        $data['lokasi_lain'] = $this->guru_model->get_lokasi_lain();
        $temp['css'] = array(1=>'guru',2=>'profile');
        $this->load->view('header',$temp);
        $this->load->view('front/profile/lokasi',$data);
        $this->load->view('footer');
    }
    
     public function metode_submit(){
        $metode = $this->input->post('metode');
	   $m = "";
	   foreach($metode as $met){
		$m .= $met.",";
	   }
        $this->profile_model->update_metode($m, $this->id);
        $this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Preferensi Metode Belajar telah berhasil diubah.</span>');
        redirect('profile/edit');
    }
    
    public function lokasi_submit(){
        $lokasi = $this->input->post('lokasi');
        $lokasi_lain = $this->input->post('lokasi_lain');
        if ($lokasi_lain > 0) {
            $lokasi[$lokasi_lain] = $lokasi_lain;
        }
        $this->profile_model->update_guru_lokasi($this->id, $lokasi);
        $this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Preferensi Lokasi telah berhasil diubah.</span>');
        redirect('profile/edit');
    }
    
    //JADWAL
    public function jadwal(){
        $data['days'] = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
        $data['jadwal'] = $this->profile_model->get_jadwal_map($this->id);
        $temp['css'] = array(1=>'guru',2=>'profile');
        $temp['js'] = array(1=>'profile');
        $this->load->view('header',$temp);
        $this->load->view('front/profile/jadwal',$data);
        $this->load->view('footer');
    }
    
    public function jadwal_submit(){
        $jadwal = $this->input->post('jadwal');
        $this->profile_model->update_guru_jadwal($this->id, $jadwal);
        $this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Preferensi Jadwal telah berhasil diubah.</span>');
        redirect('profile/edit');
    }
    
    //SERTIFIKAT
    public function kualifikasi(){
        $data['guru'] = $this->profile_model->get_kualifikasi($this->id);
        $data['sertifikat'] = $this->profile_model->get_sertifikat($this->id);
        $data['default_text'] = $this->load->view('front/profile/template/kualifikasi',null,true);
        $temp['css'] = array(1=>'guru',2=>'profile',3=>'validation');
        $this->load->view('header',$temp);
        $this->load->view('front/profile/kualifikasi',$data);
        $this->load->view('footer');
    }
    
    public function kualifikasi_submit(){
        $kualifikasi = $this->input->post('kualifikasi');
        $this->profile_model->update_guru_kualifikasi($this->id, $kualifikasi);
        $this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Kualifikasi telah berhasil diubah.</span>');
        redirect('profile/edit');
    }
    
    public function sertifikat_submit(){
		if($_FILES){
		//print_r($_FILES);exit();
			$upload = $_FILES['sertifikat']['tmp_name'];
			$name 	= $_FILES['sertifikat']['name'];
			$type	= $_FILES['sertifikat']['type'];
			$size	= $_FILES['sertifikat']['size'];
			$upload_file = $this->upload_files($upload,$name,$type);
			$title = preg_replace('/[^a-z0-9]/', '-', $this->input->post('title'));
			$title = str_replace('--', '-', $title);
			$input['title'] = trim($title, '-');
			$input['file'] = $upload_file;
			$this->profile_model->insert_guru_sertifikat($this->id,$input);
		}
		redirect('profile/edit');
        /*$input['title'] = str_replace(' ', '_', $this->input->post('title'));
        $config['upload_path'] = './files/sertifikat';
        $config['allowed_types'] = 'jpg|png|pdf';
        $this->load->library('upload',$config);
        if($this->upload->do_upload('sertifikat')){
            $file_data = $this->upload->data();
            $source = $file_data['full_path'];
            $new_path = './files/sertifikat/'.$this->id.'-'.$input['title'].$file_data['file_ext'];   
            rename($source,$new_path);
            $input['file'] = $this->id.'-'.$input['title'].$file_data['file_ext'];
            $this->profile_model->insert_guru_sertifikat($this->id,$input);
            $this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Sertifikat telah berhasil ditambah.</span>');
        }else{
            //echo $this->upload->display_errors();
            $this->session->set_flashdata('edit_profile_notif','<span class="red-notif">Sertifikat tidak berhasil diupload. Pastikan Anda hanya mengupload dokumen berekstensi jpg, pdf atau png.</span>');
        }*/
//        $ext = explode('.',$name);
    }
    
    public function sertifikat_delete($sertifikat_id){
        $this->profile_model->delete_guru_sertifikat($this->id,$sertifikat_id);
        $this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Sertifikat telah berhasil dihapus.</span>');
        redirect('profile/edit');
    }
    
    
    //RATING
    public function rating(){
        $this->load->helper('form');
        $data['guru'] = $this->guru_model->get_guru_by_id($this->id);
        $data['rating'] = $this->guru_model->get_calculated_rating($this->id);
        $data['kelas'] = $this->kelas_model->get_kelas_by_guru_id($this->id);
        $data['menu'] = $this->load->view('front/profile/menu',array('active'=>'rating'),TRUE);
        $temp['css'] = array(1=>'validation',2=>'guru',3=>'profile');
        $this->load->view('header',$temp);
        $this->load->view('front/profile/rating',$data);
        $this->load->view('footer');
    }
    
    //BANK
    public function bank(){
        $this->load->helper('form');
        $data['guru'] = $this->profile_model->get_guru_bank_by_id($this->id);
        $data['bank'] = $this->profile_model->get_bank();
        $data['menu'] = $this->load->view('front/profile/menu',array('active'=>'bank'),TRUE);
        $temp['css'] = array(1=>'validation',2=>'guru',3=>'profile');
        $this->load->view('header',$temp);
        $this->load->view('front/profile/bank',$data);
        $this->load->view('footer');
    }
    
    public function bank_submit(){
        $input['bank'] = $this->input->post('bank');
        $input['rekening'] = $this->input->post('rekening');
        $input['pemilik'] = $this->input->post('pemilik');
        $pass = $this->input->post('password');
        if($this->profile_model->check_guru(null,$this->id,$pass)){
            $this->profile_model->update_bank($this->id,$input);
            $this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Data rekening bank berhasil diubah.</span>');
        }else{
            $this->session->set_flashdata('edit_profile_notif','<span class="red-notif">Password yang Anda masukkan salah.</span>');
        }
        redirect('profile/bank');
    }
    
    //REQUEST
    public function request(){
        $this->load->model('request_model');
        $this->load->helper('form');
        $data['guru'] = $this->guru_model->get_guru_by_id($this->id);
        $data['request'] = $this->request_model->get_request_by_guru_id($this->id);
        $data['menu'] = $this->load->view('front/profile/menu',array('active'=>'request'),TRUE);
        $temp['css'] = array(1=>'validation',2=>'guru',3=>'profile');
        $this->load->view('header',$temp);
        $this->load->view('front/profile/request',$data);
        $this->load->view('footer');
    }
    
    public function update_request($id){
        $this->load->model('request_model');
        $this->load->helper('form');
        $data['guru'] = $this->guru_model->get_guru_by_id($this->id);
        $data['request'] = $this->request_model->get_request_for_guru_by_id($id,$this->id);
	   $jyt = $this->request_model->convert_jadwal($data['request']->request_jadwal);
	   if($jyt["flag"] == 1) {
		    $dd = sprintf('%d', key($jyt[$this->id]));
		    $hari = $this->request_model->convert_day($dd);
		    $jam = $this->request_model->convert_hour($jyt[$this->id][$dd]);
		    $jadwal_kursus = $hari ." (". $jam .")";
	   } else {
		    $jadwal_kursus = $jyt[0];
	   }
	   $data['jadwal'] = $jadwal_kursus;
        $data['status'] = $this->guru_model->get_table('request_guru_status');
        $data['menu'] = $this->load->view('front/profile/menu',array('active'=>'request'),TRUE);
        $temp['css'] = array(1=>'validation',2=>'guru',3=>'profile');
        $this->load->view('header',$temp);
        $this->load->view('front/profile/request_update',$data);
        $this->load->view('footer');
    }
    
    public function update_request_submit(){
        $this->load->model('request_model');
        $id = $this->input->post('id');
        $guru_id = $this->id;
        $status = $this->input->post('status');
        $this->request_model->update_respon_guru($id,$guru_id,$status);
        $this->session->set_flashdata('update_request_notif','<span class="green-notif">Respon Anda telah berhasil diubah.</span>');
        redirect('profile/update_request/'.$id);
    }
    
    //KELAS
    public function kelas($id=null){
        $this->load->model('kelas_model');
	   $this->load->model('request_model');
        $data['kelas'] = $this->kelas_model->get_kelas_by_guru_id($this->id,$id);
        $data['menu'] = $this->load->view('front/profile/menu',array('active'=>'kelas'),TRUE);
        $temp['css'] = array(1=>'validation',2=>'guru',3=>'profile');
        $this->load->view('header',$temp);
        $this->load->view('front/profile/kelas',$data);
        $this->load->view('footer');
    }
    
    public function update_kelas(){
        $this->load->model('kelas_model');
        $input['kelas_id'] = $this->input->post('kelas_id');
        $input['status'] = $this->input->post('status');
        $this->kelas_model->update_status_kelas_guru($input);
        $this->session->set_flashdata('update_kelas_notif','<span class="green-notif">Status kelas saat ini telah berhasil diubah.</span>');
        redirect('profile/kelas');
    }
    
     public function tambah_kelas($id=null){
        $this->load->model('kelas_model');
	   $this->load->model('request_model');
        $data['kelas'] = $this->kelas_model->get_kelas_by_guru_id($this->id,$id);
        $data['menu'] = $this->load->view('front/profile/menu',array('active'=>'kelas'),TRUE);
        $temp['css'] = array(1=>'validation',2=>'guru',3=>'profile');
        $this->load->view('header',$temp);
        $this->load->view('front/profile/tambah_kelas',$data);
        $this->load->view('footer');
    }
    
    public function add_pertemuan_submit(){
        $input['id'] = $this->input->post('id');
        $input['date'] = $this->input->post('date');
        $input['mulai_jam'] = $this->input->post('mulai_jam');
        $input['mulai_menit'] = $this->input->post('mulai_menit');
        $input['selesai_jam'] = $this->input->post('selesai_jam');
        $input['selesai_menit'] = $this->input->post('selesai_menit');
        $this->kelas_model->add_pertemuan($input);
	   $this->session->set_flashdata('add_pertemuan_notif','<span class="green-notif">Pertemuan telah berhasil ditambah.</span>');
        redirect('profile/kelas');
    }
    
    //PEMBAYARAN
    public function pembayaran(){
        $this->load->model('kelas_model');
        $data['kelas'] = $this->kelas_model->get_kelas_by_guru_id($this->id);
        $data['menu'] = $this->load->view('front/profile/menu',array('active'=>'pembayaran'),TRUE);
        $temp['css'] = array(1=>'validation',2=>'guru',3=>'profile');
        $this->load->view('header',$temp);
        $this->load->view('front/profile/pembayaran',$data);
        $this->load->view('footer');
    }
    
    //SERVICE
    public function get_matpel($pend_id){
        $matpel = $this->profile_model->get_matpel($pend_id,$this->id);
        echo json_encode($matpel->result());
    }
    
     public function get_matpel_all($pend_id){
        $matpel = $this->guru_model->get_matpel($pend_id);
        echo json_encode($matpel->result());
    }
    
     public function tagihan($id_kelas){
        $this->load->model('kelas_model');
        $this->load->model('request_model');
	   $temp['css'] = array(1=>'validation',2=>'guru',3=>'profile');
	   $data['kelas']=$this->kelas_model->get_kelas_by_id($id_kelas);
	   $data['request']=$this->request_model->get_request_for_guru_by_id($data['kelas']->request_id, $data['kelas']->guru_id);
	   $data['bank']=$this->profile_model->get_guru_bank_by_id($data['kelas']->guru_id);
        $this->load->view('header',$temp);
        $this->load->view('front/profile/tagihan',$data);
        $this->load->view('footer');
    }
    
     public function simpan_pdf($id_kelas){
	   $this->load->model('kelas_model');
	   $this->load->model('request_model');
	   $data['kelas']=$this->kelas_model->get_kelas_by_id($id_kelas);
	   $data['bank']=$this->profile_model->get_guru_bank_by_id($data['kelas']->guru_id);
	   $data['request']=$this->request_model->get_request_for_guru_by_id($data['kelas']->request_id, $data['kelas']->guru_id);
        $this->load->view('pdfreport_guru',$data);
    }
    
     public function lamar_request($id_request_home=null){
	   $this->load->model('main_model');
	   $data['menu'] = $this->load->view('front/profile/menu',array('active'=>'lamar_request'),TRUE);
	   $temp['css'] = array(1=>'validation',2=>'guru',3=>'profile');
	   $data['request_guru_home']=$this->main_model->get_request_guru_by_id($id_request_home);
	   $data['list_request'] = $this->main_model->get_vacancy_request_guru_home($this->session->userdata('guru_id'));
	   $data['list_request_apply'] = $this->main_model->get_vacancy_by_request($id_request_home, $this->session->userdata('guru_id'));
	   $data['all_request'] = $this->main_model->get_all_request_guru();
	   $this->load->view('header',$temp);
        $this->load->view('front/profile/lamaran',$data);
	   $this->load->view('footer');
    }
    
     public function add_vacancy($request_guru_id,$guru_id){
	   $this->load->model('main_model');
	   $lamaran =$this->main_model->get_vacancy_by_request($request_guru_id,$guru_id);
	   if(empty($lamaran)){
		$this->main_model->set_vacancy_request_guru_home($request_guru_id,$guru_id);
	   }
        redirect('profile/lamar_request/');
    }
    
     public function delete_vacancy($request_guru_id,$guru_id){
	   $this->load->model('main_model');
	   $this->main_model->delete_lamaran_request_by_guru($request_guru_id,$guru_id);
        redirect('profile/lamar_request/');
    }
    
     public function edit_matpel($id_matpel){
	   $input['id_guru'] = $this->input->post('id_guru');
	   $input['id_matpel'] = $this->input->post('id_matpel');
	   $tarif = $this->input->post('harga'.$input['id_matpel']);
		if($tarif < 50000) {
			$this->session->set_flashdata('edit_profile_notif','<span class="red-notif">Minimum Preferensi Tarif Mata Pelajaran adalah Rp. 50.000,- .</span>');
		} else {
			$input['tarif'] = $tarif;
			$this->guru_model->update_matpel($input);
			$this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Preferensi Mata Pelajaran telah berhasil diubah.</span>');
		}
        redirect('profile/edit');
    }
    
     public function buka_kelas(){
        $this->load->model('kelas_model');
	   $data['kelas'] = $this->kelas_model->get_buka_kelas($this->id);
	   $data['komunitas'] = $this->kelas_model->get_komunitas($this->id);
	   $data['guru'] = $this->profile_model->get_profile_guru($this->id);
	   $data['jenjang'] = $this->guru_model->get_jenjang();
        $data['menu'] = $this->load->view('front/profile/menu',array('active'=>'buka_kelas'),TRUE);
        $temp['css'] = array(1=>'validation',2=>'guru',3=>'profile');
        $this->load->view('header',$temp);
        $this->load->view('front/profile/buka_kelas',$data);
        $this->load->view('footer');
    }
    
     public function kelas_submit(){
        $input['id_guru'] = $this->id;
        $input['nama'] = $this->input->post('nama', TRUE);
        $input['deskripsi'] = $this->input->post('deskripsi', TRUE);
        $input['tarif'] = $this->input->post('tarif', TRUE);
        $input['lokasi'] = $this->input->post('lokasi', TRUE);
        $input['peserta'] = $this->input->post('peserta', TRUE);
	   $input['view_profil'] = $this->input->post('group4', TRUE);
	   $input['peta'] = $this->input->post('maps', TRUE);
		$input['kelas_paket'] = $this->input->post('kelas_paket', TRUE) == 'ya';
	   
	   /*$config['upload_path'] = './images/class';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $this->load->library('upload',$config);
        if($this->upload->do_upload('gambar')){
            $file_data = $this->upload->data();
		  //print_r($file_data);exit();
            $source = $file_data['full_path'];
            $new_path = './images/class/'.$this->id.'-'.$input['nama'].$file_data['file_ext'];   
            rename($source,$new_path);
            $input['file'] = $this->id.'-'.$input['nama'].$file_data['file_ext'];
            $this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Gambar telah berhasil ditambah.</span>');
        }else{
            //echo $this->upload->display_errors();
            $this->session->set_flashdata('edit_profile_notif','<span class="red-notif">Gambar tidak berhasil diupload. Pastikan Anda hanya mengupload dokumen berekstensi jpg, pdf atau png.</span>');
        }*/
	   
        $this->kelas_model->add_kelas_submit($input);
	   
	   $this->session->set_flashdata('add_pertemuan_notif','<span class="green-notif">Kelas telah berhasil ditambah.</span>');
        redirect('profile/buka_kelas');
    }
    
     public function edit_kelas($id){
        $this->load->model('kelas_model');
	   $data['kelas'] = $this->kelas_model->get_buka_kelas_by_id($id);
	   $data['jadwal'] = $this->kelas_model->get_jadwal_by_kelas_id($id);
        $data['menu'] = $this->load->view('front/profile/menu',array('active'=>'buka_kelas'),TRUE);
        $temp['css'] = array(1=>'validation',2=>'guru',3=>'profile');
        $this->load->view('header',$temp);
        $this->load->view('front/profile/edit_kelas',$data);
        $this->load->view('footer');
    }
    
     public function edit_kelas_submit(){
        $input['id_kelas'] = $this->input->post('id_kelas');
	   $date = $this->input->post('date');
	   $jam_mulai = $this->input->post('mulai_jam');
	   $menit_selesai = $this->input->post('mulai_menit');
	   $jam_selesai = $this->input->post('selesai_jam');
	   $menit_mulai = $this->input->post('selesai_menit');
	   $waktu = $this->input->post('waktu');
	   
	   $n = count($date);
	   for($i=0; $i<$n; $i++){
		 //add date and time of classes
           $this->kelas_model->add_jadwal_kelas_guru($input['id_kelas'], $date[$i], $jam_mulai[$i], $jam_selesai[$i], $menit_mulai[$i], $menit_selesai[$i], $waktu[$i]);
	   }
	   
	   $this->session->set_flashdata('add_pertemuan_notif','<span class="green-notif">Jadwal kelas telah berhasil ditambah.</span>');
        redirect('profile/edit_kelas/'.$input['id_kelas']);
    }
    
     public function delete_jadwal($id_jadwal, $id_kelas){
	   $this->kelas_model->delete_jadwal($id_jadwal);
        redirect('profile/edit_kelas/'.$id_kelas);
    }
    
     public function galeri_kelas($id){
        $this->load->model('kelas_model');
	   $data['kelas'] = $this->kelas_model->get_buka_kelas_by_id($id);
	   $data['galeri'] = $this->kelas_model->get_galeri_by_kelas($id);
        $data['menu'] = $this->load->view('front/profile/menu',array('active'=>'buka_kelas'),TRUE);
        $temp['css'] = array(1=>'validation',2=>'guru',3=>'profile');
        $this->load->view('header',$temp);
        $this->load->view('front/profile/galeri_kelas',$data);
        $this->load->view('footer');
    }
    
     public function galeri_kelas_submit(){
        $input['id_kelas'] = $this->input->post('id_kelas_guru');
	   $rnum = rand(10, 99);
	   
        $config['upload_path'] = './images/class';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $this->load->library('upload',$config);
        if($this->upload->do_upload('galeri')){
            $file_data = $this->upload->data();
		  //print_r($file_data);exit();
            $source = $file_data['full_path'];
            $new_path = './images/class/'.$input['id_kelas'].$rnum.'-'.$file_data['file_name'];   
            rename($source,$new_path);
            $input['file'] = $input['id_kelas'].$rnum.'-'.$file_data['file_name'];
            $this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Gambar telah berhasil ditambah.</span>');
        }else{
            //echo $this->upload->display_errors();
            $this->session->set_flashdata('edit_profile_notif','<span class="red-notif">Gambar tidak berhasil diupload. Pastikan Anda hanya mengupload dokumen berekstensi jpg, pdf atau png.</span>');
        }
	   
	   //Update kelas guru with maps & profile
        $this->kelas_model->add_galeri_kelas($input);
	   
	   $this->session->set_flashdata('add_pertemuan_notif','<span class="green-notif">Kelas telah berhasil ditambah.</span>');
        redirect('profile/galeri_kelas/'.$input['id_kelas']);
    }
    
        public function add_komunitas_submit(){
        $input['id_guru'] = $this->id;
        $input['nama'] = $this->input->post('nama');
        $input['deskripsi'] = $this->input->post('deskripsi');
        
	   $rnum = rand(10, 99);
	   $config['upload_path'] = './images/class';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $this->load->library('upload',$config);
        if($this->upload->do_upload('logo')){
            $file_data = $this->upload->data();
		  //print_r($file_data);exit();
            $source = $file_data['full_path'];
            $new_path = './images/komunitas/'.$this->id.$rnum.'-'.$file_data['file_name'];   
            rename($source,$new_path);
            $input['logo'] = $this->id.$rnum.'-'.$file_data['file_name'];
            $this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Logo telah berhasil diupload.</span>');
        }else{
            //echo $this->upload->display_errors();
            $this->session->set_flashdata('edit_profile_notif','<span class="red-notif">Logo tidak berhasil diupload. Pastikan Anda hanya mengupload dokumen berekstensi jpg, pdf atau png.</span>');
        }
	   
        $this->kelas_model->add_komunitas($input);
	   $this->session->set_flashdata('add_pertemuan_notif','<span class="green-notif">Pertemuan telah berhasil ditambah.</span>');
        redirect('profile/buka_kelas');
    }
    
	public function edit_komunitas(){
	   $data['komunitas'] = $this->kelas_model->get_komunitas($this->id);
        $data['menu'] = $this->load->view('front/profile/menu',array('active'=>'buka_kelas'),TRUE);
        $temp['css'] = array(1=>'validation',2=>'guru',3=>'profile');
        $this->load->view('header',$temp);
        $this->load->view('front/profile/edit_komunitas',$data);
        $this->load->view('footer');
    }
    
    
     public function edit_komunitas_submit(){
        $input['id_guru'] = $this->id;
        $input['id'] = $this->input->post('id');
        $input['nama'] = $this->input->post('nama');
        $input['deskripsi'] = $this->input->post('deskripsi');
        
	   $rnum = rand(10, 99);
	   $config['upload_path'] = './images/class';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $this->load->library('upload',$config);
        if($this->upload->do_upload('logo')){
            $file_data = $this->upload->data();
		  //print_r($file_data);exit();
            $source = $file_data['full_path'];
            $new_path = './images/komunitas/'.$this->id.$rnum.'-'.$file_data['file_name'];   
            rename($source,$new_path);
            $input['logo'] = $this->id.$rnum.'-'.$file_data['file_name'];
            $this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Logo telah berhasil diupload.</span>');
        }else{
		  $current_data = $this->kelas_model->get_komunitas($this->id);
		  foreach($current_data->result() as $k){
			$input['logo'] = $k->komunitas_logo;
		  }
            $this->session->set_flashdata('edit_profile_notif','<span class="red-notif">Logo tidak berhasil diupload. Pastikan Anda hanya mengupload dokumen berekstensi jpg, pdf atau png.</span>');
        }
	   
        $this->kelas_model->edit_komunitas($input);
	   $this->session->set_flashdata('add_pertemuan_notif','<span class="green-notif">Detil komunitas telah berhasil diubah.</span>');
        redirect('profile/buka_kelas');
    }
    
     public function catatan_kelas($id){
        $this->load->model('kelas_model');
	   $data['kelas'] = $this->kelas_model->get_buka_kelas_by_id($id);
        $data['menu'] = $this->load->view('front/profile/menu',array('active'=>'buka_kelas'),TRUE);
        $temp['css'] = array(1=>'validation',2=>'guru',3=>'profile');
        $this->load->view('header',$temp);
        $this->load->view('front/profile/catatan_kelas',$data);
        $this->load->view('footer');
    }
    
     public function edit_catatan_submit(){
        $input['id_guru'] = $this->id;
        $input['id'] = $this->input->post('id');
        $input['poster'] = $this->input->post('poster');
        $input['video'] = $this->input->post('video');
        $input['alasan'] = $this->input->post('alasan');
        $input['fasilitas'] = $this->input->post('fasilitas');
        $input['catatan'] = $this->input->post('catatan');
	   
	   $current_data = $this->kelas_model->get_buka_kelas_by_id($this->input->post('id'));
        
	   $rnum = rand(10, 99);
	   $config['upload_path'] = './images/class';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $this->load->library('upload',$config);
        if($this->upload->do_upload('poster')){
            $file_data = $this->upload->data();
		  //print_r($file_data);exit();
            $source = $file_data['full_path'];
            $new_path = './images/class/'.$this->id.$rnum.'-'.$file_data['file_name'];   
            rename($source,$new_path);
            $input['poster'] = $this->id.$rnum.'-'.$file_data['file_name'];
            $this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Logo telah berhasil diupload.</span>');
        }else{
		  $input['poster'] = $current_data->kelas_guru_image;
            $this->session->set_flashdata('edit_profile_notif','<span class="red-notif">Logo tidak berhasil diupload. Pastikan Anda hanya mengupload dokumen berekstensi jpg, pdf atau png.</span>');
        }
	   
        $this->kelas_model->edit_catatan($input);
	   $this->session->set_flashdata('add_pertemuan_notif','<span class="green-notif">Catatan kelas telah berhasil diubah.</span>');
        redirect('profile/buka_kelas');
    }

	public function get_address_geo() {
		$cityclean = $this->input->get('address', TRUE);
		$cityclean = urlencode($cityclean);
//		var_dump($cityclean);exit;
//		$cityclean = str_replace (" ", "+", $address);
		$details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . $cityclean . "&sensor=false";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $details_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$geolocs_results = json_decode(curl_exec($ch), true);
		$geolocs = $geolocs_results['results'];
//		echo json_encode($geolocs);
		$this->load->view('front/profile/geo_address', array('geolocs'=>$geolocs));
	}

}