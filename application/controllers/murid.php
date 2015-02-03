<?php
/**
 * Created by :
 *
 * User: AndrewMalachel
 * Proj: private-development
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Murid extends MY_Controller {
	private $id;

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('pdf_helper');
		$this->load->model('murid_model');
		$this->load->model('kelas_model');
		$this->load->model('request_model');
	}

	public function check($url=null){
		$this->id = $this->session->userdata('murid_id');
		if(empty($this->id)){
			if(!empty($url)){
				$this->session->set_userdata('redirected_url',$url);
			}
			redirect('murid/login');
		}
	}

	public function index(){
		$this->load->model('guru_model');
		$is_logged_in = $this->session->userdata('murid_id');
		if(empty($is_logged_in)){
			redirect('murid/registrasi');
		}else{
			$this->check();
			$this->load->helper('form');
			$this->load->library('recaptcha');
			$data['murid'] = $this->murid_model->get_murid_by_id($this->id);
			$data['kota'] = $this->murid_model->get_kota();
			$data['menu'] = $this->load->view('front/murid/menu',array('active'=>'profile'),TRUE);
			$temp['css'] = array(1=>'validation',2=>'guru',3=>'profile',4=>'murid');
			$this->load->view('header',$temp);
			$this->load->view('front/murid/akun',$data);
			$this->load->view('footer');
		}
	}

	/*** LOGIN ***/
	public function login(){
		$temp['css'] = array(1=>'validation',2=>'guru',3=>'murid');
		$this->load->view('header',$temp);
		if(($this->session->userdata('murid_id') || $this->session->userdata('duta_guru_id') || $this->session->userdata('is_logged_in'))){
			$this->session->sess_destroy();
			redirect('main/page');
		} else {
			$this->load->view('front/murid/login');
		}
		$this->load->view('footer');
	}

	public function login_submit(){
		$input['email'] = $this->input->post('email');
		$input['password'] = $this->input->post('password');
		$id = $this->murid_model->check_login($input);
		if(empty($id)){
			$this->session->set_flashdata('login_murid_notif','Kombinasi email dan password yang Anda masukkan salah, silahkan coba lagi.');
			redirect('murid/login');
		}else{
			$this->session->set_userdata('murid_id',$id);
			$email = $this->murid_model->ses_get_email();
			$name = $this->murid_model->ses_get_nama();
			$this->session->set_userdata('murid_nama',$name);
			$data = array(
					'type'		=> 'murid',
					'id'		=> $id,
					'name'		=> $name,
					'email'		=> $email,
			);
			$this->exec_login($data);
			$url = $this->session->userdata('redirected_url');
			if(!empty($url)){
				$this->session->set_userdata('redirected_url',null);
				redirect($url);
			}else{
				redirect('murid');
			}
		}
	}

	public function logout(){
		$this->exec_logout();
		$this->session->sess_destroy();
		redirect('main');
	}

	public function notification_logout(){
		$this->session->set_flashdata('notif_logout',true);
		$this->session->set_flashdata('enable_overlay',true);
		redirect('main/page');
	}

	public function reset_password(){
		$temp['css'] = array(1=>'validation',2=>'guru',3=>'murid');
		$this->load->view('header',$temp);
		$this->load->view('front/murid/reset_password');
		$this->load->view('footer');
	}

	public function reset_password_submit(){
		$email = $this->input->post('email');
		$result = $this->murid_model->reset_password($email);
		if($result){
			$this->session->set_flashdata('reset_pass_murid_notif','Password baru telah dikirimkan ke email: '.$email);
		}else{
			$this->session->set_flashdata('reset_pass_murid_notif','Email yang Anda masukkan tidak terdaftar dalam sistem Ruangguru. Silahkan coba lagi');
		}
		redirect('murid/reset_password');
	}

	/*** REGISTRASI ***/

	public function registrasi(){
		$this->load->helper('form');
		$this->load->library('recaptcha');
		$this->load->library('form_validation');
		if ($this->form_validation->run('reg_murid') == FALSE) {
			$data['kota'] = $this->murid_model->get_kota();
			$data['provinsi'] = $this->murid_model->get_provinsi();
			$temp['css'] = array(1=>'validation',2=>'guru',3=>'murid');
			$this->load->view('header', $temp);
			$this->load->view('front/murid/daftar', $data);
			$this->load->view('footer');
		} else {
			$input['email'] = $this->input->post('email');
			$input['pass'] = $this->input->post('pass');
			$input['nama'] = $this->input->post('nama');
			$input['nik'] = $this->input->post('nik');
			$input['alamat'] = $this->input->post('alamat');
			$input['alamat_domisili'] = $this->input->post('alamat_domisili');
			$input['kota'] = $this->input->post('kota');
			$input['hp'] = $this->input->post('hp');
			$input['hp_2'] = $this->input->post('hp_2');
			$input['telp_rumah'] = $this->input->post('telp_rumah');
			$input['telp_kantor'] = $this->input->post('telp_kantor');
			$input['instansi'] = $this->input->post('instansi');
			$input['gender'] = $this->input->post('gender');
			$input['tempatlahir'] = $this->input->post('tempatlahir');
			$input['lahir'] = $this->input->post('tahun')."-".$this->input->post('bulan')."-".$this->input->post('tanggal');
			$input['referral'] = $this->input->post('referral');
			$info = $this->input->post('source_info');
			$lainnya = $this->input->post('lainnya');
			$x = "";
			foreach($info as $in){
				$x .= $in.",";
			}
			$input['source_info'] = $x.$lainnya;
			$input['murid_daftar'] = date("Y-m-d H:i:s");
			$id = $this->murid_model->insert_murid($input);
			$this->murid_model->send_email_reg($id);
			$this->session->set_userdata('murid_id',$id);
			$this->session->set_flashdata('murid_regsuccess',true);
			$this->session->set_flashdata('enable_overlay',true);
			$data = array(
				'type'		=> 'murid',
				'id'		=> $id,
				'name'		=> $input['nama'],
				'email'		=> $input['email'],
			);
			$this->exec_login($data);
			redirect('murid');
		}

	}

	public function email_check($str){
		if ($this->murid_model->check_email($str)) {
			$this->form_validation->set_message('email_check', 'Email yang Anda masukkan sudah terdaftar dalam sistem kami. Silahkan gunakan email yang lain');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	/**** PROFILE *****/
	public function edit(){
		$this->check();
		$data['murid'] = $this->murid_model->get_murid_by_id($this->id);
		$data['menu'] = $this->load->view('front/murid/menu',array('active'=>'edit'),TRUE);
		$data['kota'] = $this->murid_model->get_kota();
		$data['provinsi'] = $this->murid_model->get_provinsi();
		$temp['css'] = array(1=>'validation',2=>'guru',3=>'profile',4=>'murid');
		$this->load->view('header',$temp);
		$this->load->view('front/murid/edit',$data);
		$this->load->view('footer');
	}

	public function submit_profpic(){
		$this->check();
		$this->load->library('upload');
		//print_r($_FILES['profpic']['name']);exit();
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
			$config['new_image'] = './images/murid/pp/'.$this->id.'.jpg';
			$this->load->library('image_lib',$config);
			if ( ! $this->image_lib->resize()) {
				$this->session->set_flashdata('edit_profile_notif',$this->image_lib->display_errors('<span>','</span>'));
			}
			unlink($image_data['full_path']);
			$this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Foto profil telah berhasil diubah</span>');
		}
		redirect('murid/edit');
	}

	public function pass_submit(){
		$this->check();
		$oldpass = $this->input->post('oldpass');
		$pass = $this->input->post('pass');
		if($this->murid_model->update_pass($this->id,$oldpass,$pass)){
			$this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Password telah berhasil diubah.</span>');
		}else{
			$this->session->set_flashdata('edit_profile_notif','<span class="red-notif">Password lama yang Anda masukkan salah!</span>');
		}
		redirect('murid/edit');
	}

	public function biodata_submit(){
		$this->check();
		$input['nama'] = $this->input->post('nama');
		$input['nik'] = $this->input->post('nik');
		$input['gender'] = $this->input->post('gender');
		$input['tempatlahir'] = $this->input->post('tempatlahir');
		$input['lahir'] = $this->input->post('tahun')."-".$this->input->post('bulan')."-".$this->input->post('tanggal');
		$input['referral'] = $this->input->post('referral');
		$input['hp'] = $this->input->post('hp');
		$input['hp_2'] = $this->input->post('hp_2');
		$input['telp_rumah'] = $this->input->post('telp_rumah');
		$input['telp_kantor'] = $this->input->post('telp_kantor');
		$input['alamat'] = $this->input->post('alamat');
		$input['alamat_domisili'] = $this->input->post('alamat_domisili');
		$input['kota'] = $this->input->post('kota');

		$this->murid_model->update_biodata($this->id,$input);
		$this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Biodata telah berhasil diubah.</span>');
		redirect('murid/edit');
	}

	public function request(){
		$this->check();
		$this->load->model('request_model');
		$data['menu'] = $this->load->view('front/murid/menu',array('active'=>'request'),TRUE);
		$data['request'] = $this->request_model->get_list_request($this->id);
		$temp['css'] = array(1=>'validation',2=>'guru',3=>'profile',4=>'murid');
		$this->load->view('header',$temp);
		$this->load->view('front/murid/request',$data);
		$this->load->view('footer');
	}

	//KELAS
	public function kelas($id=null){
		$this->check();
		$this->load->model('kelas_model');
		$this->load->model('request_model');
		$data['kelas'] = $this->kelas_model->get_kelas_by_murid_id($this->id,$id);
		$data['menu'] = $this->load->view('front/murid/menu',array('active'=>'kelas'),TRUE);
		$temp['css'] = array(1=>'validation',2=>'guru',3=>'profile',4=>'murid');
		$this->load->view('header',$temp);
		$this->load->view('front/murid/kelas',$data);
		$this->load->view('footer');
	}

	public function kelas_feedback($kode){
		$len = strlen($kode);
		if($len == 7){
			$id = substr($kode, 4, 1);
		}elseif($len == 8){
			$id = substr($kode, 4, 2);
		}else{
			$id = substr($kode, 4, 3);
		}

		$this->load->model('kelas_model');
		$data['kelas'] = $this->kelas_model->get_kelas_by_id($id);
		//check if authorized to post a feedback
		//if(empty($data['kelas'])){
		//   redirect('main');
		//}
		//check feedback has been posted
		if($data['kelas']->kelas_feedback_status == 1){
			$temp['css'] = array(1=>'validation',2=>'guru',3=>'profile',4=>'murid');
			$this->load->view('header',$temp);
			$this->load->view('front/murid/feedback_status',$data);
			$this->load->view('footer');
		}
		$data['feedback_question'] = $this->kelas_model->get_feedback_question();
		$temp['css'] = array(1=>'validation',2=>'guru',3=>'profile',4=>'murid');
		$this->load->view('header',$temp);
		$this->load->view('front/murid/feedback',$data);
		$this->load->view('footer');
	}

	public function kelas_feedback_submit(){
		$this->check();
		$this->load->model('kelas_model');
		//saving feedback
		$input['kelas_id'] = $this->input->post('kelas_id');
		$input['feedback'] = $this->input->post('answer');
		$input['testimoni'] = $this->input->post('testimoni');
		$this->kelas_model->insert_feedback($input);
		//displaying notificaton
		$data['status'] = '<span class="green-notif">Feedback telah berhasil disimpan.</span>';
		$temp['css'] = array(1=>'validation',2=>'guru',3=>'profile',4=>'murid');
		$this->load->view('header',$temp);
		$this->load->view('front/murid/feedback_status',$data);
		$this->load->view('footer');
	}

	//PEMBAYARAN
	public function pembayaran(){
		$this->check();
		$this->load->model('kelas_model');
		$data['kelas'] = $this->kelas_model->get_kelas_by_murid_id($this->id);
		$data['menu'] = $this->load->view('front/murid/menu',array('active'=>'pembayaran'),TRUE);
		$temp['css'] = array(1=>'validation',2=>'guru',3=>'profile',4=>'murid');
		$this->load->view('header',$temp);
		$this->load->view('front/murid/pembayaran',$data);
		$this->load->view('footer');
	}

	public function tagihan($id_kelas){
		$this->check();
		$this->load->model('kelas_model');
		$this->load->model('request_model');
		$temp['css'] = array(1=>'validation',2=>'guru',3=>'profile',4=>'murid');
		$data['kelas']=$this->kelas_model->get_kelas_by_id($id_kelas);
		$data['murid']=$this->murid_model->get_murid_by_id($data['kelas']->murid_id);
		$data['request']=$this->request_model->get_request_for_guru_by_id($data['kelas']->request_id, $data['kelas']->guru_id);
		$this->load->view('header',$temp);
		$this->load->view('front/murid/tagihan',$data);
		$this->load->view('footer');
	}

	public function simpan_pdf($kode){
		$this->load->model('kelas_model');
		$this->load->model('request_model');
		$id_kelas = substr($kode, 4, 2);
		$data['kelas']=$this->kelas_model->get_kelas_by_id($id_kelas);
		if($data['kelas']->kelas_persen_pembayaran == 2){
			$data['harga']=$data['kelas']->kelas_total_harga * 0.5;
			$data['mode']=" (50% dari Total Harga)";
		}else{
			$data['harga']=$data['kelas']->kelas_total_harga;
			$data['mode']="";
		}
		$data['murid']=$this->murid_model->get_murid_by_id($data['kelas']->murid_id);
		$data['request']=$this->request_model->get_request_for_guru_by_id($data['kelas']->request_id, $data['kelas']->guru_id);
		$this->load->view('pdfreport',$data);
	}

	public function daftar_pemesanan(){
		$this->check();
		$this->load->model('guru_model');
		$guru = $this->session->userdata('pilihan_guru');
		$data['pilihan'] = $this->guru_model->get_guru_in_array($guru);
		$temp['css'] = array(1=>'cariguru',2=>'profile');
		$this->load->view('header',$temp);
		$this->load->view('front/murid/daftar_pemesanan',$data);
		$this->load->view('footer');
	}

	public function simpan_bukti($kode){
		$this->load->model('kelas_model');
		$this->load->model('request_model');
		$id_kelas = substr($kode, 4, 2);
		$data['kelas']=$this->kelas_model->get_kelas_by_id($id_kelas);
		$data['murid']=$this->murid_model->get_murid_by_id($data['kelas']->murid_id);
		$data['request']=$this->request_model->get_request_for_guru_by_id($data['kelas']->request_id, $data['kelas']->guru_id);
		$this->load->view('pdfreport_penerimaan',$data);
	}

}