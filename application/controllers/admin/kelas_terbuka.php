<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelas_terbuka extends CI_Controller {
    private $id;

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
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
        $data['active'] = 8;
        $data['kelas'] = $this->kelas_model->get_buka_kelas_all();
        $data['page'] = 1;
        $data['count'] = $data['kelas']->num_rows();
        $data['start'] = 0;
        $data['content'] = $this->load->view('admin/teacher_class/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
     public function daftar(){
        $data['active'] = 9;
        $data['kelas'] = $this->kelas_model->get_daftar_kelas();
        $data['page'] = 1;
        $data['count'] = $data['kelas']->num_rows();
        $data['start'] = 0;
        $data['content'] = $this->load->view('admin/teacher_class/listkelas_v',$data,TRUE);
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
        $this->kelas_model->edit_pembayaran($input);
        $this->session->set_flashdata('f_kelas','Anda telah berhasil mengubah pembayaran');
        redirect('admin/kelas/edit/'.$input['id']);
    }
    
    public function change_status($kelas_id,$status){
        $this->kelas_model->edit_kelas_guru_status($kelas_id,$status);
        $this->session->set_flashdata('f_kelas','Successfully update kelas');
        redirect('admin/kelas_terbuka');
    }
    
    /****** DELETE *******/
    public function delete($id){
        $this->kelas_model->delete_peserta($id);
        $this->session->set_flashdata('f_kelas','Successfully delete peserta');
        redirect('admin/kelas_terbuka');
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
    
    
}