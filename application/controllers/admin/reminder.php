<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reminder extends CI_Controller {
    private $id;

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/admin_model');
        $this->load->model('kelas_model');
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
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Reminder'=>'reminder'));
        $data['notif'] = $this->kelas_model->get_reminder_limit();
        $data['page'] = 1;
	   $data['notif_all'] = $this->kelas_model->get_reminder_all();
        $data['count'] = $data['notif_all']->num_rows();
        $data['start'] = 0;
        $data['content'] = $this->load->view('admin/reminder/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    public function page($page_number=1){
        $data['active'] = 7;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Reminder'=>'reminder'));
        $data['notif'] = $this->kelas_model->get_reminder_limit($page_number-1);
        $data['page'] = $page_number;
        $data['notif_all'] = $this->kelas_model->get_reminder_all();
        $data['count'] = $data['notif_all']->num_rows();
        $data['start'] = ($page_number-1)*20;
        $data['content'] = $this->load->view('admin/reminder/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    /****** ADD *******/
    
    public function add($id_kelas){
        $data['active'] = 7;
	   $data['kelas'] = $this->kelas_model->get_kelas_by_id($id_kelas);
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Reminder'=>'kelas','Add'=>'add'));
        $data['content'] = $this->load->view('admin/reminder/add_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    public function add_submit(){
	   $input['kelas_id'] = $this->input->post('kelas_id');
        $input['tanggal'] = $this->input->post('tanggal');
        $input['keterangan'] = $this->input->post('keterangan');
        $this->kelas_model->add_reminder($input);
        $this->session->set_flashdata('f_kelas','Successfully add reminder');
        redirect('admin/kelas');
    }
    
     /****** EDIT *******/
     public function edit($id){
        $data['active'] = 7;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Kelas'=>'kelas','Edit Kelas Pertemuan'=>'view'));
        $data['kelas'] = $this->kelas_model->get_reminder_data($id);
        $data['content'] = $this->load->view('admin/reminder/edit_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
     public function edit_submit(){
        $this->check();
        $input['notif_id'] = $this->input->post('notif_id');
        $input['kelas_id'] = $this->input->post('kelas_id');
        $input['tanggal'] = $this->input->post('tanggal');
        $input['keterangan'] = $this->input->post('keterangan');
        $this->kelas_model->update_reminder_data($input);
        $this->session->set_flashdata('f_kelas','Anda telah berhasil mengubah data reminder');
        redirect('admin/kelas');
    }
    
     public function view($id){
        $data['active'] = 7;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Kelas'=>'kelas','Edit Kelas Pertemuan'=>'view'));
        $data['kelas'] = $this->kelas_model->get_reminder_data($id);
        $data['content'] = $this->load->view('admin/reminder/view_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
        /****** DELETE *******/
     public function delete($id){
        $this->kelas_model->delete_reminder($id);
        $this->session->set_flashdata('f_kelas','Anda berhasil menghapus data reminder');
        redirect('admin/reminder');
    }
}