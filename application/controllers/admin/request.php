<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Request extends CI_Controller {
    private $id;

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/admin_model');
        $this->load->model('request_model');
        $this->load->model('guru_model');
        $this->check();
    }
    
    public function check(){
        $this->id = $this->session->userdata('admin_id');
        if(empty($this->id)){
            redirect('admin/user/login');
        }
    }
    
    public function index(){
        $data['active'] = 5;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Request'=>'request','List'=>'request'));
        $data['request'] = $this->request_model->get_request();
        $data['page'] = 1;
        $data['count'] = $this->request_model->get_request_count();
        $data['start'] = 0;
        $data['content'] = $this->load->view('admin/request/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    public function page($page_number=1){
        $data['active'] = 5;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Request'=>'request','List'=>'request'));
        $data['request'] = $this->request_model->get_request($page_number-1);
        $data['page'] = $page_number;
        //$data['page'] = 1;
        $data['count'] = $this->request_model->get_request_count();
        $data['start'] = ($page_number-1)*20;
        $data['content'] = $this->load->view('admin/request/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    public function edit_submit(){
        $id = $this->input->post('id');
        if(!empty($id)){
            $input['request_status'] = $this->input->post('active');
            $this->load->database();
            $this->db->where('request_id',$id);
            $this->db->update('request', $input); 
            $this->session->set_flashdata('f_request','Successfully update request');
            redirect('admin/request/view/'.$id);
        }else{
            $this->session->set_flashdata('f_request','failed update request');
            redirect('admin/request/view/'.$id);
        }
    }
    
    /****** VIEW *******/
    public function view($id){
        $this->load->helper('form');
        $data['active'] = 5;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Request'=>'request','View'=>'view'));
	   $data['request'] = $this->request_model->get_request_by_id($id);
	   $data['matpel'] = $this->guru_model->get_matpel_by_id($data['request']->matpel_id);
        $data['lokasi'] = $this->guru_model->get_lokasi_by_id($data['request']->lokasi_id);
        $data['guru'] = $this->request_model->get_request_guru_by_id($id);
	   $data['days'] = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
	   if($data['request']->requested_by == 0){
		$input['id_guru'] = $this->input->post('id_guru');
		$data['request_guru'] = $this->request_model->cari_guru($input);
	   }
        $data['content'] = $this->load->view('admin/request/view_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
        /****** ADD GURU *******/
    public function add_guru($request_id){
        $this->load->helper('form');
        $data['active'] = 5;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Request'=>'request','View'=>'view'));
        $input['id_guru'] = $this->input->post('id_guru');
	   $this->request_model->add_guru($request_id,$input['id_guru'],1);
        redirect('admin/request/view/'.$request_id);
    }
    
     /****** STATUS *******/
    public function change_status($request_id, $guru_id ,$status){
        $this->request_model->update_respon_guru($request_id,$guru_id,$status);
	   $this->session->set_flashdata('f_request','Respon Request telah berhasil diubah');
        redirect('admin/request/view/'.$request_id);
    }
    
     public function change_status_request($request_id, $status){
        $this->request_model->update_request_pilih_status($request_id,$status);
	   $this->session->set_flashdata('f_request','Status Request telah berhasil diubah');
        redirect('admin/request/view/'.$request_id);
    }
    
    /****** DELETE *******/
    public function delete($request_id){
        $this->request_model->delete_request($request_id);
        $this->session->set_flashdata('f_request','Request has been deleted successfully');
        redirect('admin/request/');
    }
    
    /*********EDIT REQUEST*************/
     public function edit_request_submit($request_id){
	   $input['matpel'] = $this->input->post('matpel');
	   $input['lokasi'] = $this->input->post('lokasi');
	   $input['request_frek'] = $this->input->post('request_frek');
	   $input['duta_murid'] = $this->input->post('duta_murid');
	   $input['budget'] = $this->input->post('budget');
	   $input['mulai'] = $this->input->post('mulai');
	   $input['gender'] = $this->input->post('gender');
	   $input['catatan'] = $this->input->post('catatan');
	   $input['disc'] = $this->input->post('disc');
	   
	   //array jadwal to string//
	   $jadwal_available = $this->input->post('catch_jadwal');
	   $jyt = "";
	   foreach($jadwal_available as $jdwl){
			$jyt .= $jdwl.';';
	   }
	   //end of jadwal//
	   $input['jadwal'] = $jyt;
        $this->request_model->update_request($request_id,$input);
        $this->session->set_flashdata('f_request','Request has been updated successfully');
        redirect('admin/request/view/'.$request_id);
    }
    
     public function delete_guru($request_id, $guru_id){
        $this->request_model->delete_guru_request($request_id, $guru_id);
        $this->session->set_flashdata('f_request','Guru '.$guru_id.' telah dihapus dari daftar Request '.$request_id);
        redirect('admin/request/view/'.$request_id);
    }
    
     public function add_request(){
        $this->load->helper('form');
        $data['active'] = 5;
	   $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Request'=>'request','Add'=>'add'));
	   $data['days'] = array('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu');
	   $data['request'] = $this->request_model->get_request();
	   $data['content'] = $this->load->view('admin/request/add_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
     public function add_request_submit(){
	   $input['murid_id'] = $this->input->post('id_murid');
	   $input['matpel'] = $this->input->post('matpel');
	   $input['lokasi'] = $this->input->post('lokasi');
	   $input['freq'] = $this->input->post('request_frek');
	   $input['budget'] = $this->input->post('budget');
	   $input['referal'] = $this->input->post('duta_murid');
	   $input['disc'] = $this->input->post('disc');
	   //array jadwal to string//
	   $jadwal_available = $this->input->post('catch_jadwal');
	   $jyt = "";
	   foreach($jadwal_available as $jdwl){
			$jyt .= $jdwl.';';
	   }
	   //end of jadwal//
	   $input['jyt'] = $jyt;
	   $input['jkd'] = $this->input->post('mulai');
	   $input['catatan'] = $this->input->post('catatan');
	   $input['gender'] = $this->input->post('gender');
	   $input['requested_by'] = $this->input->post('requested_by');
	   $input['guru'] = array($this->input->post('id_guru'));
	   $input['prioritas'] = array(1);
        $this->request_model->add($input);
        $this->session->set_flashdata('f_request','Request telah diberhasil dibuat');
        redirect('admin/request');
    }
    
     public function change_call($id, $page=null){
	$curr_request = $this->request_model->get_request_by_id($id);
        if(!empty($id)){
            $this->load->database();
            $this->db->where('request_id',$id);
		  if($curr_request->request_status == 1){
			 $this->db->set('request_status',0);
		  }else{
			 $this->db->set('request_status',1);
		  }
		  $this->db->update('request');
            $this->session->set_flashdata('f_request','Successfully update call status');
            redirect('admin/request/page/'.$page);
		}
    }
    
     public function change_progress($id, $page=null){
	$curr_request = $this->request_model->get_request_by_id($id);
        if(!empty($id)){
            $this->load->database();
            $this->db->where('request_id',$id);
		  if($curr_request->request_progress == 1){
			 $this->db->set('request_progress',0);
		  }else{
			 $this->db->set('request_progress',1);
		  }
		  $this->db->update('request');
            $this->session->set_flashdata('f_request','Successfully update progress request');
            redirect('admin/request/page/'.$page);
		}
    }
    
     public function change_ops($id, $page=null){
	$curr_request = $this->request_model->get_request_by_id($id);
	$ops = $this->input->post('ops');
        if(!empty($id)){
            $this->load->database();
            $this->db->where('request_id',$id);
	       $this->db->set('request_handle_by', $ops);
		  $this->db->update('request');
            $this->session->set_flashdata('f_request','Successfully update ID Ops');
            redirect('admin/request/page/'.$page);
		}
    }
    
     /**** SEARCH KELAS BY MURID ******/
    
    	public function search(){
        $data['active'] = 7;
        $keyword = $this->input->post('murid_name');
        $data['request'] = $this->request_model->get_by_search($keyword);
        $data['page'] = 1;
        $data['count'] = $data['request']->num_rows();
        $data['start'] = 0;
        $data['content'] = $this->load->view('admin/request/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
	}
}