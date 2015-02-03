<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Duta_guru extends CI_Controller {
    private $id;

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/admin_model');
        $this->load->model('duta_guru_model');
        $this->check();
    }
    
    public function check(){
        $this->id = $this->session->userdata('admin_id');
        if(empty($this->id)){
            redirect('admin/user/login');
        }
    }
    
    public function index(){
        $data['active'] = 2;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Duta Guru'=>'duta_guru','List'=>'duta_guru'));
        $data['duta_guru'] = $this->duta_guru_model->get_duta_guru();
        $data['page'] = 1;
        $data['count'] = $this->duta_guru_model->get_duta_guru_count();
        $data['start'] = 0;
        $data['content'] = $this->load->view('admin/duta_guru/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    public function page($page_number=1){
        $data['active'] = 2;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Guru'=>'guru','List'=>'guru'));
        $data['duta_guru'] = $this->duta_guru_model->get_duta_guru($page_number-1);
        $data['page'] = $page_number;
        //$data['page'] = 1;
        $data['count'] = $this->duta_guru_model->get_duta_guru_count();
        $data['start'] = ($page_number-1)*20;
        $data['content'] = $this->load->view('admin/duta_guru/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    public function edit_submit(){
        $id = $this->input->post('id');
        if(!empty($id)){
            $input['duta_guru_active'] = $this->input->post('active');
            $this->load->database();
            $this->db->where('duta_guru_id',$id);
            $this->db->update('duta_guru', $input); 
            $this->session->set_flashdata('f_duta_guru','Successfully update duta guru');
            redirect('admin/duta_guru/view/'.$id);
        }else{
            $this->session->set_flashdata('f_duta_guru','failed update duta guru');
            redirect('admin/duta_guru/view/'.$id);
        }
    }
    
    /****** VIEW *******/
    public function view($id){
        $this->load->helper('form');
        $data['active'] = 2;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Duta Guru'=>'duta_guru','View'=>'view'));
        $data['duta_guru'] = $this->duta_guru_model->get_duta_guru_by_id($id);
        $data['guru'] = $this->duta_guru_model->get_guru_referral($id);
        $data['murid'] = $this->duta_guru_model->get_murid_referral($id);
        $data['pembayaran'] = $this->duta_guru_model->get_pembayaran($id);
        $data['content'] = $this->load->view('admin/duta_guru/view_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    /****** PEMBAYARAN *******/
    public function add_pembayaran_submit(){
        $input['id_kelas'] = $this->input->post('id_kelas');
        $input['user_referral'] = $this->input->post('user_referral');
        $input['duta_guru_id'] = $this->input->post('id');
        $input['title'] = $this->input->post('title');
        $input['amount'] = $this->input->post('amount');
        $input['date_verified'] = $this->input->post('date_verified');
        $input['status'] = $this->input->post('status');
        $this->duta_guru_model->add_pembayaran($input);
        $this->session->set_flashdata('f_duta_guru','Pembayaran telah berhasil ditambahkan');
        redirect('admin/duta_guru/view/'.$input['duta_guru_id']);
    }
    
     public function edit_pembayaran($duta_id,$id){
        $this->load->helper('form');
        $data['active'] = 2;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Duta Guru'=>'duta_guru','Edit'=>'Edit'));
        $data['pembayaran'] = $this->duta_guru_model->get_pembayaran_data($id);
        $data['duta_id'] = $duta_id;
        $data['content'] = $this->load->view('admin/duta_guru/edit_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
     public function edit_pembayaran_submit(){
        $input['id'] = $this->input->post('id');
        $input['duta_id'] = $this->input->post('duta_id');
        $input['title'] = $this->input->post('title');
        $input['amount'] = $this->input->post('amount');
        $input['date_verified'] = $this->input->post('date_verified');
        $input['status'] = $this->input->post('status');
        $this->duta_guru_model->update_pembayaran($input);
        $this->session->set_flashdata('f_duta_guru','Pembayaran telah berhasil diubah');
        redirect('admin/duta_guru/view/'.$input['duta_id']);
    }
    
    /****** DELETE *******/
    public function delete($id){
        $this->duta_guru_model->delete_duta_guru($id);
        $this->session->set_flashdata('f_duta_guru','Duta Guru has been deleted successfully');
        redirect('admin/duta_guru/');
    }
    
     public function delete_pembayaran($duta_id, $pembayaran_id){
        $this->duta_guru_model->delete_pembayaran($pembayaran_id);
        $this->session->set_flashdata('f_duta_guru','Pembayaran has been deleted successfully');
        redirect('admin/duta_guru/view/'.$duta_id);
    }
    
    /****** SEARCH *******/ 
      public function search(){
        $data['active'] = 2;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Duta Guru'=>'duta_guru','List'=>'list'));
        $keyword = $this->input->post('duta_guru_name');
        $data['duta_guru'] = $this->duta_guru_model->get_duta_guru_by_name($keyword);
        $data['page'] = 1;
        $data['count'] = $data['duta_guru']->num_rows();
        $data['start'] = 0;
        $data['content'] = $this->load->view('admin/duta_guru/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
}