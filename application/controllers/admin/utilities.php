<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Utilities extends CI_Controller {
    private $id;

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/admin_model');
        $this->load->model('guru_model');
        $this->load->model('murid_model');
        $this->load->model('duta_guru_model');
        $this->check();
    }
    
    public function check(){
        $this->id = $this->session->userdata('admin_id');
        if(empty($this->id)){
            redirect('admin/login');
        }
    }
    
    public function index(){
        redirect('admin/guru');
    }
    
    public function cs_email(){
        $this->check();
        $data['active'] = 99;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Coming Soon'=>'utilities/cs_email','email'=>'email'));
        $data['email'] = $this->admin_model->get_cs_email();
        $data['content'] = $this->load->view('admin/comingsoon/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    // SERTIFIKAT TERBARU
    
    public function sertifikat($page_number=1){
        $this->check();
        $data['active'] = 3;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Sertifikat'=>'utilities/sertifikat','list'=>'list'));
        $data['sertifikat'] = $this->admin_model->get_sertifikat($page_number-1);
        $data['page'] = $page_number;
        //$data['page'] = 1;
        $data['count'] = $this->admin_model->get_sertifikat_count();
        $data['start'] = ($page_number-1)*20;
        $data['content'] = $this->load->view('admin/sertifikat/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    public function change_sertifikat_status($sertifikat_id,$status){
        $this->check();
        $this->admin_model->edit_sertifikat_status($sertifikat_id,$status);
        $this->session->set_flashdata('f_sertifikat','Successfully update sertifikat');
        redirect('admin/utilities/sertifikat/');
    }
    
    public function sertifikat_delete($guru_id,$sertifikat_id){
        $this->check();
        $this->load->model('profile_model');
        $this->profile_model->delete_guru_sertifikat($guru_id,$sertifikat_id);
        $this->session->set_flashdata('f_sertifikat','Successfully delete sertifikat');
        redirect('admin/utilities/sertifikat/');
    }
    
    
    // ID TERBARU
    
    public function nik($page_number=1){
        $this->check();
        $this->load->model('guru_model');
        $data['active'] = 98;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('ID Terbaru'=>'utilities/nik','list'=>'list'));
        $data['guru'] = $this->guru_model->get_nik_terbaru($page_number-1);
        $data['page'] = $page_number;
        //$data['page'] = 1;
        $data['count'] = $this->guru_model->get_nik_terbaru_count();
        $data['start'] = ($page_number-1)*20;
        $data['content'] = $this->load->view('admin/guru/nik_list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    //SUBSCRIBE
     public function subscribe(){
        $this->check();
        $data['active'] = 97;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Subscribe'=>'utilities/subscribe','email'=>'email'));
        $data['subscriber'] = $this->admin_model->get_subscribers();
        $data['content'] = $this->load->view('admin/subscribe/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
     public function search_subscribe(){
        $this->check();
	   $data['active'] = 97;
	   $input = $this->input->post('search');
	   $data['subscriber'] = $this->admin_model->get_subscribers_by_input($input);
	   $data['content'] = $this->load->view('admin/subscribe/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
        //SIGNUP
     public function signup(){
        $this->check();
        $data['active'] = 96;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Sign up'=>'utilities/signup','list'=>'list'));
        $data['guru'] = $this->guru_model->get_guru_new();
        $data['murid'] = $this->murid_model->get_murid_new();
        $data['duta'] = $this->duta_guru_model->get_duta_guru_new();
        $data['content'] = $this->load->view('admin/signup/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
     public function signup_murid(){
        $this->check();
        $data['active'] = 96;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Sign up'=>'utilities/signup','list'=>'list'));
        $data['guru'] = $this->guru_model->get_guru_new();
        $data['murid'] = $this->murid_model->get_murid_new();
        $data['duta'] = $this->duta_guru_model->get_duta_guru_new();
        $data['content'] = $this->load->view('admin/signup/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
     public function request(){
	   $this->check();
        $data['active'] = 96;
	   $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Request Sidebar'=>'utilities/request','list'=>'list'));
        $data['request'] = $this->guru_model->get_request_sidebar();
        $data['page'] = 1;
        $data['count'] = $this->guru_model->get_request_sidebar_count();
        $data['start'] = 0;
        $data['content'] = $this->load->view('admin/sidebar/list_request_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
     public function delete_request($request_id){
        $this->check();
        $this->load->model('profile_model');
        $this->guru_model->delete_request($request_id);
        $this->session->set_flashdata('f_sertifikat','Successfully delete request');
        redirect('admin/utilities/request/');
    }
    
     public function view_request($id_request){
	   $this->check();
        $data['active'] = 96;
	   $data['breadcumb'] = $this->admin_model->get_breadcumb(array('View Request'=>'utilities/view_request','data'=>'list'));
        $data['request'] = $this->guru_model->get_request_sidebar_by_id($id_request);
        $data['content'] = $this->load->view('admin/sidebar/view_request_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
     public function change_request_status($status, $id_request){
	  $this->guru_model->update_request_status($status, $id_request);
	  $this->session->set_flashdata('f_request','Successfully update status request');
	  redirect('admin/utilities/request');
    }
    
    
     public function page($page_number=1){
        $data['active'] = 1;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Request Sidebar'=>'utilities/request','list'=>'list'));
        $data['request'] = $this->guru_model->get_request_sidebar($page_number-1);
        $data['page'] = $page_number;
        $data['count'] = $this->guru_model->get_request_sidebar_count();
        $data['start'] = ($page_number-1)*20;
        $data['content'] = $this->load->view('admin/sidebar/list_request_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
     public function change_progress($id, $page=null){
	$curr_request = $this->guru_model->get_request_sidebar_by_id($id);
        if(!empty($id)){
            $this->load->database();
            $this->db->where('id_request',$id);
		  if($curr_request->progress_request == 1){
			 $this->db->set('progress_request',0);
		  }else{
			 $this->db->set('progress_request',1);
		  }
		  $this->db->update('request_langsung');
            $this->session->set_flashdata('f_request','Successfully update progress request');
            redirect('admin/utilities/request/'.$page);
		}
    }
    
     public function change_ops($id, $page=null){
	$curr_request = $this->guru_model->get_request_sidebar_by_id($id);
	$ops = $this->input->post('ops');
        if(!empty($id)){
            $this->load->database();
            $this->db->where('id_request',$id);
	       $this->db->set('handle_request', $ops);
		  $this->db->update('request_langsung');
            $this->session->set_flashdata('f_request','Successfully update ID Ops');
            redirect('admin/utilities/request/'.$page);
		}
    }
    
}