<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Matpel extends CI_Controller {
    private $id;

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/admin_model');
        $this->load->model('matpel_model');
        $this->check();
    }
    
    public function check(){
        $this->id = $this->session->userdata('admin_id');
        if(empty($this->id)){
            redirect('admin/user/login');
        }
    }
	
    /****** JENJANG PENDIDIKAN *******/
	
    public function index(){
        $data['active'] = 7;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Kategori Pendidikan'=>'matpel'));
	    $data['jenjang'] = $this->matpel_model->get_jenjang_pendidikan();
        $data['content'] = $this->load->view('admin/jenjang/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    /****** ADD *******/
    
    public function add(){
        $data['active'] = 95;
		$data['jenjang_idx'] = $this->matpel_model->get_jenjang_max();
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Kategori Pendidikan'=>'matpel','Tambah'=>'tambah'));
        $data['content'] = $this->load->view('admin/jenjang/add_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    public function add_submit(){
	    $input['pend_label'] = $this->input->post('pend_label');
        $input['pend_index'] = $this->input->post('pend_index');
        $this->matpel_model->add_jenjang_pendidikan($input);
        $this->session->set_flashdata('f_kelas','Anda berhasil menambahkan mata pelajaran');
        redirect('admin/matpel');
    }
    
     /****** EDIT *******/
     public function edit($id){
        $data['active'] = 7;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Kategori Pendidikan'=>'matpel','Ubah'=>'ubah'));
        $data['jenjang'] = $this->matpel_model->get_jenjang_pendidikan_by_id($id);
        $data['content'] = $this->load->view('admin/jenjang/edit_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
     public function edit_submit(){
        $this->check();
        $input['pend_id'] = $this->input->post('pend_id');
        $input['pend_label'] = $this->input->post('pend_label');
        $input['pend_index'] = $this->input->post('pend_index');
        $this->matpel_model->edit_jenjang_pendidikan($input);
        $this->session->set_flashdata('f_kelas','Anda telah berhasil mengubah data kategori pendidikan');
        redirect('admin/matpel');
    }

     public function delete($id){
        $this->matpel_model->delete_jenjang_pendidikan($id);
        $this->session->set_flashdata('f_kelas','Anda berhasil menghapus data jenjang pendidikan');
        redirect('admin/matpel');
    }
	
	public function up($id){
		$curr_id = $this->matpel_model->get_jenjang_pendidikan_by_id($id);
		$idx = $curr_id->jenjang_pendidikan_index;
		$temp = intval($idx) - 10;
		if($temp >= 10){
			$prev_index = $this->matpel_model->get_jenjang_pendidikan_by_index($temp);
			$prev_id = $prev_index->jenjang_pendidikan_id;
			$this->matpel_model->update_jenjang_pendidikan($id, $temp);
			$this->matpel_model->update_jenjang_pendidikan($prev_id, $idx);
		}
		redirect('admin/matpel');
	}
	
	public function down($id){
		$curr_id = $this->matpel_model->get_jenjang_pendidikan_by_id($id);
		$m = $this->matpel_model->get_jenjang_max();
		$max_index = $m->jenjang_pendidikan_index;
		$idx = $curr_id->jenjang_pendidikan_index;
		$temp = intval($idx) + 10;
		if($idx <= $max_index){
			$next_index = $this->matpel_model->get_jenjang_pendidikan_by_index($temp);
			$next_id = $next_index->jenjang_pendidikan_id;
			$this->matpel_model->update_jenjang_pendidikan($id, $temp);
			$this->matpel_model->update_jenjang_pendidikan($next_id, $idx);
		}
		redirect('admin/matpel');
	}
	
	public function list_matpel($id){
        $data['active'] = 95;
		$data['matpel'] = $this->matpel_model->get_matpel($id);
		$data['jenjang'] = $this->matpel_model->get_jenjang_pendidikan_by_id($id);
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Mata Pelajaran'=>'matpel','Tambah'=>'tambah'));
        $data['content'] = $this->load->view('admin/matpel/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
	
	/****** MATPEL *******/
	
	public function add_matpel($id){
        $data['active'] = 95;
		$data['jenjang'] = $this->matpel_model->get_jenjang_pendidikan_by_id($id);
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Mata Pelajaran'=>'matpel','Tambah'=>'tambah'));
        $data['content'] = $this->load->view('admin/matpel/add_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
	
	public function add_matpel_submit(){
	    $input['pend_id'] = $this->input->post('pend_id');
        $input['matpel_label'] = $this->input->post('matpel_label');
        $this->matpel_model->add_matpel($input);
        $this->session->set_flashdata('f_kelas','Anda berhasil menambahkan mata pelajaran');
        redirect('admin/matpel/list_matpel/'.$input['pend_id']);
    }
	
	public function edit_matpel($id_matpel){
        $data['active'] = 95;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Matpel'=>'matpel','Ubah'=>'ubah'));
        $data['matpel'] = $this->matpel_model->get_matpel_by_id($id_matpel);
		$data['jenjang'] = $this->matpel_model->get_jenjang_pendidikan_by_id($data['matpel']->jenjang_pendidikan_id);
        $data['content'] = $this->load->view('admin/matpel/edit_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
	
	public function edit_matpel_submit(){
        $input['matpel_label'] = $this->input->post('matpel_label');
        $input['matpel_id'] = $this->input->post('matpel_id');
        $id_jenjang = $this->input->post('pend_id');
        $this->matpel_model->edit_matpel($input);
        $this->session->set_flashdata('f_kelas','Anda telah berhasil mengubah data mata pelajaran');
        redirect('admin/matpel/list_matpel/'.$id_jenjang);
    }
	
	public function delete_matpel($id){
		$matpel = $this->matpel_model->get_matpel_by_id($id);
        $this->matpel_model->delete_matpel($id);
        $this->session->set_flashdata('f_kelas','Anda berhasil menghapus data mata pelajaran');
        redirect('admin/matpel/list_matpel/'.$matpel->jenjang_pendidikan_id);
    }
}