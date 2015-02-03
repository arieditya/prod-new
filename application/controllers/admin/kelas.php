<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelas extends CI_Controller {
    private $id;

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
	   $this->load->helper('veritrans');
        $this->load->model('admin/admin_model');
        $this->load->model('kelas_model');
        $this->load->model('guru_model');
        $this->load->model('request_model');
        $this->check();
    }
    
    public function check(){
        $this->id = $this->session->userdata('admin_id');
        if(empty($this->id)){
            redirect('admin/user/login');
        }
    }
    
    public function index(){
        $data['active'] = 7;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Kelas'=>'kelas','List'=>'kelas'));
        $data['kelas'] = $this->kelas_model->get_kelas();
        $data['page'] = 1;
        $data['count'] = $this->kelas_model->get_kelas_count();
        $data['start'] = 0;
        $data['content'] = $this->load->view('admin/kelas/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    public function page($page_number=1){
        $data['active'] = 7;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Kelas'=>'kelas','Kelas'=>'kelas'));
        $data['kelas'] = $this->kelas_model->get_kelas($page_number-1);
        $data['page'] = $page_number;
        //$data['page'] = 1;
        $data['count'] = $this->kelas_model->get_kelas_count();
        $data['start'] = ($page_number-1)*20;
        $data['content'] = $this->load->view('admin/kelas/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    /****** ADD *******/
    public function add_kelas_request($request_id, $guru_id){
        $this->load->model('guru_model');
        $data['active'] = 7;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Kelas'=>'kelas','Add'=>'add'));
        $data['jenjang'] = $this->guru_model->get_jenjang();
        $data['provinsi'] = $this->admin_model->get_table('provinsi');
	   $data['request'] = $this->request_model->get_request_by_id($request_id);
	   $data['guru'] = $guru_id;
        $data['content'] = $this->load->view('admin/kelas/add_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    public function add_kelas(){
        $this->load->model('guru_model');
        $data['active'] = 7;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Kelas'=>'kelas','Add'=>'add'));
        $data['jenjang'] = $this->guru_model->get_jenjang();
        $data['provinsi'] = $this->admin_model->get_table('provinsi');
        $data['content'] = $this->load->view('admin/kelas/add_request_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    public function add_kelas_submit(){
	    $input['request_id'] = $this->input->post('request_id');
        $input['guru'] = $this->input->post('guru');
        $input['murid'] = $this->input->post('murid');
        $input['duta_guru'] = $this->input->post('duta_guru');
        $input['duta_murid'] = $this->input->post('duta_murid');
        $input['matpel'] = $this->input->post('matpel');
        $input['mulai'] = $this->input->post('mulai');
        $input['lokasi'] = $this->input->post('lokasi');
        $input['disc'] = $this->input->post('disc');
        $input['catatan'] = $this->input->post('catatan');
        $this->kelas_model->add($input);
        $this->session->set_flashdata('f_kelas','Successfully add kelas');
        redirect('admin/kelas');
    }
    
    /****** EDIT *******/
    public function edit($kelas_id){
        $this->session->set_userdata('u_last_kelas_id',$kelas_id);
        $this->load->helper('form');
        $data['active'] = 7;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Kelas'=>'kelas','View'=>'view'));
        $data['kelas'] = $this->kelas_model->get_kelas_by_id($kelas_id);
        $data['matpel'] = $this->guru_model->get_matpel_by_id($data['kelas']->matpel_id);
        $data['lokasi'] = $this->guru_model->get_lokasi_by_id($data['kelas']->lokasi_id);
	    $data['request'] = $this->request_model->get_request_by_id($data['kelas']->request_id);
        $data['pertemuan'] = $this->kelas_model->get_kelas_pertemuan($kelas_id);
        $data['feedback'] = $this->kelas_model->get_feedback_by_kelas_id($kelas_id);
        $data['payment'] = $this->kelas_model->get_status_payment($kelas_id);
        $data['content'] = $this->load->view('admin/kelas/edit_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    public function pembayaran_submit(){
        $input['id'] = $this->input->post('id');
        $input['total_jam'] = $this->input->post('total_jam');
        $input['durasi'] = $this->input->post('durasi');
        $input['frek'] = $this->input->post('total_pertemuan');
        $input['harga'] = $this->input->post('harga');
        $input['total_harga'] = $this->input->post('total_harga');
        $input['tahap_pembayaran'] = $this->input->post('tahap_pembayaran');
        $input['persen_pembayaran'] = $this->input->post('persen_pembayaran');
        $this->kelas_model->edit_pembayaran($input);
        $this->session->set_flashdata('f_kelas','Anda telah berhasil mengubah pembayaran');
        redirect('admin/kelas/edit/'.$input['id']);
    }
    
     public function update_kelas_submit($id){
        $input['guru'] = $this->input->post('guru');
        $input['matpel'] = $this->input->post('matpel');
        $input['lokasi'] = $this->input->post('lokasi');
        $input['mulai'] = $this->input->post('mulai');
        $input['catatan'] = $this->input->post('catatan');
        $this->kelas_model->update_kelas($input, $id);
        $this->session->set_flashdata('f_kelas','Anda telah berhasil mengubah kelas');
        redirect('admin/kelas/edit/'.$id);
    }
    
     public function update_pembayaran_murid_submit(){
        $input['id'] = $this->input->post('id');
        $input['pembayaran_murid'] = $this->input->post('pembayaran_murid');
        $input['no_rek_murid'] = $this->input->post('no_rek_murid');
        $input['date_verified'] = $this->input->post('date_verified');
	   $input['status_pembayaran'] = $this->input->post('status_pembayaran');
        $this->kelas_model->update_pembayaran_murid($input);
        $this->session->set_flashdata('f_kelas','Anda telah berhasil mengubah status pembayaran murid');
        redirect('admin/kelas/edit/'.$input['id']);
    }
    
     public function update_pembayaran_murid_kedua_submit(){
        $input['id'] = $this->input->post('id');
        $input['pembayaran_murid_kedua'] = $this->input->post('pembayaran_murid_kedua');
        $input['date_verified_kedua'] = $this->input->post('date_verified_kedua');
	   $input['status_pembayaran_kedua'] = $this->input->post('status_pembayaran_kedua');
        $this->kelas_model->update_pembayaran_murid_kedua($input);
        $this->session->set_flashdata('f_kelas','Anda telah berhasil mengubah status pembayaran kedua untuk murid');
        redirect('admin/kelas/edit/'.$input['id']);
    }
    
      public function update_pembayaran_guru_submit(){
        $input['id'] = $this->input->post('id');
	   $input['half_to_guru'] = $this->input->post('half_to_guru');
	   $input['full_to_guru'] = $this->input->post('full_to_guru');
	   $input['date_payment1'] = $this->input->post('date_payment1');
	   $input['date_payment2'] = $this->input->post('date_payment2');
	   $input['jenis_pembayaran'] = $this->input->post('jenis_pembayaran');
        $this->kelas_model->update_pembayaran_guru($input);
        $this->session->set_flashdata('f_kelas','Anda telah berhasil mengubah pembayaran guru');
        redirect('admin/kelas/edit/'.$input['id']);
    }
    
      public function update_pembayaran_dutaguru_submit(){
        $input['id'] = $this->input->post('id');
	   $input['to_duta_guru'] = $this->input->post('to_duta_guru');
        $this->kelas_model->update_pembayaran_dutaguru($input);
        $this->session->set_flashdata('f_kelas','Anda telah berhasil mengubah pembayaran duta guru');
        redirect('admin/kelas/edit/'.$input['id']);
    }
    
      public function update_pembayaran_dutamurid_submit(){
        $input['id'] = $this->input->post('id');
	   $input['to_duta_murid'] = $this->input->post('to_duta_murid');
        $this->kelas_model->update_pembayaran_dutamurid($input);
        $this->session->set_flashdata('f_kelas','Anda telah berhasil mengubah pembayaran duta murid');
        redirect('admin/kelas/edit/'.$input['id']);
    }
    
    public function add_pertemuan_submit(){
        $input['id'] = $this->input->post('id');
        $input['date'] = $this->input->post('date');
        $input['mulai_jam'] = $this->input->post('mulai_jam');
        $input['mulai_menit'] = $this->input->post('mulai_menit');
        $input['selesai_jam'] = $this->input->post('selesai_jam');
        $input['selesai_menit'] = $this->input->post('selesai_menit');
        $this->kelas_model->add_pertemuan($input);
        $this->session->set_flashdata('f_kelas','Successfully add pertemuan');
        redirect('admin/kelas/edit/'.$input['id']);
    }
    
    public function change_kelas_status($kelas_id,$status){
        $this->kelas_model->edit_kelas_status($kelas_id,$status);
        $this->session->set_flashdata('f_kelas','Successfully update kelas');
        redirect('admin/kelas');
    }
    
    /****** DELETE *******/
    public function delete_kelas($id){
        $this->kelas_model->delete_kelas($id);
        $this->session->set_flashdata('f_kelas','Successfully delete kelas');
        redirect('admin/kelas');
    }
    
    public function delete_kelas_pertemuan($id){
        $kelas_id = $this->session->userdata('u_last_kelas_id');
        $this->kelas_model->delete_kelas_pertemuan($id);
        $this->session->set_flashdata('f_kelas','Successfully delete pertemuan');
        redirect('admin/kelas/edit/'.$kelas_id);
    }
    
    /****** EDIT *******/
     public function edit_kelas_pertemuan($id){
        $data['active'] = 7;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Kelas'=>'kelas','Edit Kelas Pertemuan'=>'view'));
        $data['kelas_pertemuan'] = $this->kelas_model->get_kelas_pertemuan_by_id($id);
        $data['content'] = $this->load->view('admin/kelas/edit_kelas_pertemuan_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
     public function edit_kelas_pertemuan_submit(){
        $this->check();
	   $id = $this->input->post('id');
	   $id_pertemuan = $this->input->post('id_pertemuan');
        $input['date'] = $this->input->post('date');
        $input['mulai_jam'] = $this->input->post('mulai_jam');
        $input['mulai_menit'] = $this->input->post('mulai_menit');
        $input['selesai_jam'] = $this->input->post('selesai_jam');
        $input['selesai_menit'] = $this->input->post('selesai_menit');
        $input['status_pertemuan'] = $this->input->post('status_pertemuan');
        $this->kelas_model->edit_status_kelas_pertemuan($input, $id, $id_pertemuan);
        $this->session->set_flashdata('f_kelas','Anda telah berhasil mengubah kelas pertemuan');
        redirect('admin/kelas/edit/'.$id);
    }
    
    /****** REQUEST FEEDBACK *******/
    public function request_feedback($kelas_id){
        $this->kelas_model->send_request_feedback($kelas_id);
        $this->session->set_flashdata('f_kelas','Successfully send request feedback');
        redirect('admin/kelas/edit/'.$kelas_id);
    }
    
    /****** UPDATE RATING *******/
     public function update_rating($guru_id){
	   $input['kelas_id'] = $this->input->post('kelas_id');
	   $input['skor'] = $this->input->post('skor');
        $this->kelas_model->update_rating($guru_id, $input);
        $this->session->set_flashdata('f_kelas','Successfully update rate');
        redirect('admin/kelas/edit/'.$input['kelas_id']);
    }
    
     /****** SEND INVOICE TO MURID *******/
     public function send_invoice($kelas_id){
	  $this->kelas_model->send_invoice($kelas_id);
	  $this->session->set_flashdata('f_kelas','Invoice telah berhasil dikirim');
       redirect('admin/kelas/edit/'.$kelas_id);
    }
    
     /****** SEND INVOICE TO GURU *******/
     public function send_invoice_guru($kelas_id){
	  $input['id'] = $this->input->post('id');
	  $input['jenis_pembayaran'] = $this->input->post('jenis_pembayaran');
	  $this->kelas_model->send_invoice_guru($kelas_id);
	  $this->session->set_flashdata('f_kelas','Bukti pembayaran telah berhasil dikirim');
       redirect('admin/kelas/edit/'.$kelas_id);
    }
    
     /****** SEND INVOICE TO DUTA *******/
     public function send_invoice_duta($kelas_id){
	  $this->kelas_model->send_invoice_duta($kelas_id);
	  $this->session->set_flashdata('f_kelas','Bukti pembayaran telah berhasil dikirim');
       redirect('admin/kelas/edit/'.$kelas_id);
    }
    
     /****** SEND INVOICE TO DUTA MURID*******/
     public function send_invoice_duta_murid($kelas_id){
	  $this->kelas_model->send_invoice_duta_murid($kelas_id);
	  $this->session->set_flashdata('f_kelas','Bukti pembayaran telah berhasil dikirim');
       redirect('admin/kelas/edit/'.$kelas_id);
    }
    
         /****** SEND INVOICE TO DUTA MURID*******/
     public function send_bukti_pembayaran($kelas_id){
	  $this->kelas_model->send_bukti_pembayaran($kelas_id);
	  $this->session->set_flashdata('f_kelas','Bukti penerimaan pembayaran dari murid telah berhasil dikirim');
       redirect('admin/kelas/edit/'.$kelas_id);
    }
    
     /****** ADD FEEDBACK MANUAL *******/
	   
	public function add_feedback($id_kelas){
        $data['active'] = 7;
        $data['id_kelas'] = $id_kelas;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Kelas'=>'kelas','Add Feedback'=>'view'));
        $data['content'] = $this->load->view('admin/kelas/add_feedback_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
	}
	
     public function add_feedback_submit($id_kelas){
	  $this->check();
	  $input[1] = $this->input->post('efektifitas');
       $input[2] = $this->input->post('materi');
       $input[3] = $this->input->post('komunikasi');
       $input[4] = $this->input->post('profesionalitas');
       $input[5] = $this->input->post('recommend');
       $input[6] = $this->input->post('efektif_all');
       $input['testimoni'] = $this->input->post('testimoni');
	  //print_r($input);exit();
	  for($i=1; $i<7;$i++){
		$this->kelas_model->add_feedback_kelas($id_kelas, $i, $input[$i]);
	  }
	  $this->kelas_model->update_testimonial($id_kelas, $input);
	  $this->session->set_flashdata('f_kelas','Feedback telah berhasil diinput');
       redirect('admin/kelas/edit/'.$id_kelas);
    }
    
    /**** SEARCH KELAS BY GURU ******/
    
    	public function search(){
        $data['active'] = 7;
        $keyword = $this->input->post('murid_name');
        $data['kelas'] = $this->kelas_model->get_kelas_by_murid($keyword);
        $data['page'] = 1;
        $data['count'] = $data['kelas']->num_rows();
        $data['start'] = 0;
        $data['content'] = $this->load->view('admin/kelas/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
	}
	
	
}