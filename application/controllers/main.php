<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('main_model');
        $this->load->model('guru_model');
    }
    
    public function index(){
        //$data['page'] = 'home';
        //$this->load->view('comingsoon/home',$data);
        //$this->page();
        if($this->session->userdata('murid_id')){
            redirect('murid/dashboard');
        } else if($this->session->userdata('is_logged_in')){
            redirect('guru/dashboard');
        } else {
            redirect('main/page');
        }
    }
    
    public function page($page=null){
        $temp['is_home']  = true;
        $data['guru_unggulan'] = $this->guru_model->get_guru_unggulan();
        $data['request_guru'] = $this->main_model->get_request_guru();
        $data['provinsi'] = $this->main_model->get_table('provinsi');
        $data['jenjang'] = $this->main_model->get_jenjang();
	    $data['jml_guru'] = $this->guru_model->get_guru_count();
        
        $this->load->view('header', $temp);
        $this->load->view('front/home', $data);
        $this->load->view('footer');


        // $temp2['title'] = 'Sedang Dalam Maintenance';
        // $this->load->view('header_maintenance', $temp2);
        // $this->load->view('front/home_maintenance');

        
    }

    public function not_found() {
        $temp['css'] = array(1=>'tentang');
        $this->load->view('header', $temp);
        $this->load->view('front/not_found');
        $this->load->view('footer');
    }
    
     public function subscribe(){
        $input['nama'] = $this->input->post('nama');
	   $input['email'] = $this->input->post('email');
	   $email = $this->main_model->get_subscribers($input['email']);
	   if(!empty($email)){
		$this->session->set_flashdata('subscribe_fail',true);
		$this->session->set_flashdata('enable_overlay',true);
	   }else{
		$this->main_model->insert_subscribers($input);
		$this->session->set_flashdata('subscribe_success',true);
		$this->session->set_flashdata('enable_overlay',true);
	   }
	   redirect('main/page');
    }
    
    public function request_guru($page=null){   
	   $data['page'] = (empty($page))?0:$page;
        if($page==null){
            $start = 0;
        }else{
            $start = $page;
        }

	   $data['request_guru'] = $this->main_model->get_request_guru_by_limit($start);
	   $data['request_guru_total'] = $this->main_model->get_all_request_guru();
	   
	   $this->load->library('pagination');
        $config['base_url'] = base_url().'main/request_guru/';
        $config['total_rows'] = $data['request_guru_total']->num_rows();
        $config['per_page'] = 5;
        $this->pagination->initialize($config);
        //displaying result
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('header');
        $this->load->view('front/request',$data);
        $this->load->view('footer');
    }
    
    public function view_request_guru($id){
        $data['request_guru'] = $this->main_model->get_request_guru($id);
        if($data['request_guru']->num_rows()>0){
            $data['request_guru'] = $data['request_guru']->first_row();
            $this->load->view('header');
            $this->load->view('front/request_view',$data);
            $this->load->view('footer');
        }else{
            redirect('main');
        }
    }
    
    public function submit_email(){
        $this->load->model('csmodel');
        $email = $this->input->post('email');
        if ($email == ""){
            redirect('main');
        }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            redirect('main');
        }
        if($this->csmodel->check_email($email)){
            $data['page']='failed';
            $this->load->view('comingsoon/home',$data);
        }else{
            $this->csmodel->insert($email);
            $data['page']='success';
            $this->load->view('comingsoon/home',$data);
        }
    }
    
    public function mail(){
//        $this->load->model('csmodel');
//        $this->csmodel->email();
    }
    
    public function get_matpel($pend_id){
        $matpel = $this->main_model->get_matpel($pend_id,TRUE);
        echo json_encode($matpel->result());
    }

    public function get_provinsi(){
        $provinsi = $this->main_model->get_provinsi();
        echo json_encode($provinsi);
    }

    public function get_kota(){
        $id = $this->input->post('prov_id');
        $kota = $this->main_model->get_lokasi($id);
        echo json_encode($kota->result_array());
    }
}
