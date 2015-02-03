<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {
    private $id;

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/admin_model');
        $this->load->model('guru_model');
        $this->check();
    }
    
    public function check(){
        $this->id = $this->session->userdata('admin_id');
        if(empty($this->id)){
            redirect('admin/login');
        }
    }
    
    public function index($page_number=1){
        $this->check();
        $this->load->model('guru_model');
        $data['active'] = 6;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Home'=>'home','list'=>'list'));
        $data['guru_unggulan'] = $this->guru_model->get_guru_unggulan();
        $data['request_guru'] = $this->admin_model->get_request_guru_home();
        $data['page'] = 1;
        $data['count'] = $this->admin_model->get_request_guru_count();
        $data['start'] = 0;
        $data['content'] = $this->load->view('admin/home/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    public function page($page_number=1){
        $this->check();
        $this->load->model('guru_model');
        $data['active'] = 6;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Home'=>'home','list'=>'list'));
        $data['guru_unggulan'] = $this->guru_model->get_guru_unggulan();
        $data['request_guru'] = $this->admin_model->get_request_guru_home($page_number-1);
        $data['page'] = $page_number;
        //$data['page'] = 1;
        $data['count'] = $this->admin_model->get_request_guru_count();
        $data['start'] = ($page_number-1)*20;
        $data['content'] = $this->load->view('admin/home/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    //public function guru_unggulan_submit(){
       // $this->check();
        //$this->load->model('guru_model');
        //$guru_unggulan = $this->input->post('guru_unggulan');
        //$this->guru_model->update_guru_unggulan($guru_unggulan);
        //$this->session->set_flashdata('f_home','Successfully update guru unggulan');
       // redirect('admin/home');
  //  }
    
    /*** GURU UNGGULAN ***/
     public function add_guru_unggulan(){
        $this->check();
        $data['active'] = 6;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Home'=>'home','Add Guru Unggulan'=>'home/add_guru_unggulan'));
        $data['provinsi'] = $this->admin_model->get_table('provinsi');
        $data['content'] = $this->load->view('admin/home/add_unggulan_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    public function guru_unggulan_submit(){
        $this->check();
	   $input['id_guru'] = $this->input->post('id_guru');
	   $input['nama_guru'] = $this->input->post('nama_guru');
	   $input['prestasi'] = $this->input->post('prestasi');
	  $this->guru_model->add_guru_unggulan($input);
       $this->session->set_flashdata('f_home','Successfully add guru unggulan');
       redirect('admin/home');
    }
    
     public function edit_guru_unggulan($id){
        $this->check();
        $data['active'] = 6;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Home'=>'home','Edit Request Guru'=>'home/edit_request_guru'));
        $data['guru_unggulan'] = $this->guru_model->get_guru_unggulan_by_id($id);
        $data['content'] = $this->load->view('admin/home/edit_unggulan_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
      public function edit_guru_unggulan_submit(){
        $this->check();
	   $id = $this->input->post('id');
        $input['id_guru'.$id] = $this->input->post('id_guru'.$id);
        $input['nama_guru'.$id] = $this->input->post('nama_guru'.$id);
        $input['prestasi'.$id] = $this->input->post('prestasi'.$id);
        $this->guru_model->update_guru_unggulan($input, $id);
        $this->session->set_flashdata('f_home','Successfully edit guru unggulan');
        redirect('admin/home');
    }
    
    /*** REQUEST GURU ***/
    public function add_request_guru(){
        $this->check();
        $data['active'] = 6;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Home'=>'home','Add Request Guru'=>'home/add_request_guru'));
        $data['provinsi'] = $this->admin_model->get_table('provinsi');
        $data['content'] = $this->load->view('admin/home/add_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    public function add_request_guru_submit(){
        $this->check();
        $input['title'] = $this->input->post('title');
        $input['lokasi'] = $this->input->post('lokasi');
        $input['text'] = $this->input->post('text');
        $this->admin_model->add_request_guru($input);
        $this->session->set_flashdata('f_home','Successfully add request guru');
        redirect('admin/home');
    }
    
    public function edit_request_guru($id){
        $this->check();
        $data['active'] = 6;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Home'=>'home','Edit Request Guru'=>'home/edit_request_guru'));
        $data['provinsi'] = $this->admin_model->get_table('provinsi');
        $data['lokasi'] = $this->admin_model->get_table('lokasi');
        $data['request_guru'] = $this->admin_model->get_request_guru($id);
        $data['content'] = $this->load->view('admin/home/edit_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    public function edit_request_guru_submit(){
        $this->check();
        $input['id'] = $this->input->post('id');
        $input['title'] = $this->input->post('title');
        $input['lokasi'] = $this->input->post('lokasi');
        $input['text'] = $this->input->post('text');
        $input['date'] = $this->input->post('date');
        $data['provinsi'] = $this->admin_model->update_request_guru($input);
        $this->session->set_flashdata('f_home','Successfully edit request guru');
        redirect('admin/home/edit_request_guru/'.$input['id']);
    }
    
    public function delete_request_guru($id){
        $this->check();
        $this->admin_model->delete_request_guru($id);
        $this->admin_model->delete_lamaran_request_guru($id);
        $this->session->set_flashdata('f_home','Successfully delete request guru');
        redirect('admin/home/');
    }
    
     public function delete_request_guru_by_guru($id_guru, $id){
        $this->check();
        $this->admin_model->delete_lamaran_request_by_guru($id_guru, $id);
        $this->session->set_flashdata('f_home','Anda berhasil menghapus guru yang melamar lowongan tersebut');
        redirect('admin/home/');
    }
    
     public function delete_request_by_guru($id_guru, $id){
        $this->check();
        $this->admin_model->delete_lamaran_request_by_guru($id_guru, $id);
        $this->session->set_flashdata('f_home','Anda telah berhasil menghapus guru yang melamar lowongan tersebut');
        redirect('admin/home/');
    }
    
    public function change_request_guru_status($request_guru_id,$status){
        $this->check();
        $this->admin_model->edit_request_guru_status($request_guru_id,$status);
        $this->session->set_flashdata('f_home','Successfully update request guru');
        redirect('admin/home/');
    }
}
?>