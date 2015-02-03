<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Murid extends CI_Controller {
    private $id;

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/admin_model');
        $this->load->model('murid_model');
        $this->check();
    }
    
    public function check(){
        $this->id = $this->session->userdata('admin_id');
        if(empty($this->id)){
            redirect('admin/user/login');
        }
    }
    
    public function index(){
        $data['active'] = 4;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Murid'=>'murid','List'=>'murid'));
        $data['murid'] = $this->murid_model->get_murid();
        $data['page'] = 1;
        $data['count'] = $this->murid_model->get_murid_count();
        $data['start'] = 0;
        $data['content'] = $this->load->view('admin/murid/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
     public function search(){
        $data['active'] = 4;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Murid'=>'murid','List'=>'murid'));
        $keyword = $this->input->post('murid_name');
        $data['murid'] = $this->murid_model->get_murid_by_name($keyword);
        $data['page'] = 1;
        $data['count'] = $data['murid']->num_rows();
        $data['start'] = 0;
        $data['content'] = $this->load->view('admin/murid/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    public function page($page_number=1){
        $data['active'] = 4;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Murid'=>'murid','List'=>'murid'));
        $data['murid'] = $this->murid_model->get_murid($page_number-1);
        $data['page'] = $page_number;
        //$data['page'] = 1;
        $data['count'] = $this->murid_model->get_murid_count();
        $data['start'] = ($page_number-1)*20;
        $data['content'] = $this->load->view('admin/murid/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    /****** VIEW *******/
    public function view($murid_id){
        $this->load->helper('form');
        $data['active'] = 4;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Murid'=>'murid','View'=>'view'));
        $data['murid'] = $this->murid_model->get_murid_by_id($murid_id);
        $data['content'] = $this->load->view('admin/murid/view_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    /****** EDIT *******/
    public function edit_submit(){
        $id = $this->input->post('id');
        if(!empty($id)){
            $input['murid_active'] = $this->input->post('active');
            $this->load->database();
            $this->db->where('murid_id',$id);
            $this->db->update('murid', $input); 
            $this->session->set_flashdata('f_murid','Successfully update murid');
            redirect('admin/murid/view/'.$id);
        }else{
            $this->session->set_flashdata('f_murid','failed update murid');
            redirect('admin/murid/view/'.$id);
        }
    }
    
    /****** DELETE *******/
    public function delete($murid_id){
        $this->murid_model->delete_murid($murid_id);
        $this->session->set_flashdata('f_murid','Murid has been deleted successfully');
        redirect('admin/murid/');
    }
    
     public function change_progress($id, $page=null){
	$curr_murid = $this->murid_model->get_murid_by_id($id);
        if(!empty($id)){
            $this->load->database();
            $this->db->where('murid_id',$id);
		  if($curr_murid->murid_call_progress == 1){
			 $this->db->set('murid_call_progress',0);
		  }else{
			 $this->db->set('murid_call_progress',1);
		  }
		  $this->db->update('murid');
            $this->session->set_flashdata('f_murid','Successfully update call progress');
            redirect('admin/murid/page/'.$page);
		}
    }
    
     public function change_call($id, $page=null){
	$curr_murid = $this->murid_model->get_murid_by_id($id);
        if(!empty($id)){
            $this->load->database();
            $this->db->where('murid_id',$id);
		  if($curr_murid->murid_call_status == 1){
			 $this->db->set('murid_call_status',0);
		  }else{
			 $this->db->set('murid_call_status',1);
		  }
		  $this->db->update('murid');
            $this->session->set_flashdata('f_murid','Successfully update call status');
            redirect('admin/murid/page/'.$page);
		}
    }
    
     public function change_ops($id, $page=null){
	$curr_murid = $this->murid_model->get_murid_by_id($id);
	$ops = $this->input->post('ops');
        if(!empty($id)){
            $this->load->database();
            $this->db->where('murid_id',$id);
	       $this->db->set('murid_handle_by', $ops);
		  $this->db->update('murid');
            $this->session->set_flashdata('f_murid','Successfully update ID Ops');
            redirect('admin/murid/page/'.$page);
		}
    }
    
}