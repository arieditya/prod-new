<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Guru extends CI_Controller {
    private $id;

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/admin_model');
        $this->load->model('guru_model');
        $this->load->model('profile_model');
        $this->check();
    }
    
    public function check(){
        $this->id = $this->session->userdata('admin_id');
        if(empty($this->id)){
            redirect('admin/user/login');
        }
    }
    
    public function index(){
        $data['active'] = 1;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Guru'=>'guru','List'=>'guru'));
        $data['guru'] = $this->guru_model->get_guru();
        $data['page'] = 1;
        $data['count'] = $this->guru_model->get_guru_count();
        $data['start'] = 0;
        $data['content'] = $this->load->view('admin/guru/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    public function page($page_number=1){
        $data['active'] = 1;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Guru'=>'guru','List'=>'guru'));
        $data['guru'] = $this->guru_model->get_guru($page_number-1);
        $data['page'] = $page_number;
        //$data['page'] = 1;
        $data['count'] = $this->guru_model->get_guru_count();
        $data['start'] = ($page_number-1)*20;
        $data['content'] = $this->load->view('admin/guru/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    public function search(){
        $data['active'] = 1;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Guru'=>'guru','List'=>'guru'));
        $keyword = $this->input->post('guru_name');
        $data['guru'] = $this->guru_model->get_guru_by_name($keyword);
        $data['page'] = 1;
        $data['count'] = $data['guru']->num_rows();
        $data['start'] = 0;
        $data['content'] = $this->load->view('admin/guru/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    public function delete($guru_id){
        $this->guru_model->delete_guru($guru_id);
        $this->session->set_flashdata('f_guru','Guru is deleted');
        redirect('admin/guru/');
    }
    
    /****** RATING *******/
    public function rating($guru_id){
        $this->load->helper('form');
        $data['active'] = 1;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Guru'=>'guru','Rating'=>'rating'));
        $data['guru'] = $this->guru_model->get_guru_by_id($guru_id);
        $data['content'] = $this->load->view('admin/guru/rating_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    public function rating_submit(){
        $id = $this->input->post('id');
        if(!empty($id)){
            $input['guru_rating_sma'] = $this->input->post('sma');
            $input['guru_rating_diploma'] = $this->input->post('diploma');
            $input['guru_rating_s1_top'] = $this->input->post('s1_top');
            $input['guru_rating_s1'] = $this->input->post('s1');
            $input['guru_rating_s2_top'] = $this->input->post('s2_top');
            $input['guru_rating_s2'] = $this->input->post('s2');
            $input['guru_rating_s3_top'] = $this->input->post('s3_top');
            $input['guru_rating_s3'] = $this->input->post('s3');
            $input['guru_rating_beasiswa'] = $this->input->post('beasiswa');
            $input['guru_rating_sertifikat'] = $this->input->post('sertifikat');
            $input['guru_rating_toefl_ibt'] = $this->input->post('toefl_ibt');
            $input['guru_rating_toefl_itp'] = $this->input->post('toefl_itp');
            $input['guru_rating_ielts'] = $this->input->post('ielts');
            $input['guru_rating_gre'] = $this->input->post('gre');
            $input['guru_rating_gmat'] = $this->input->post('gmat');
            $input['guru_rating_cfa'] = $this->input->post('cfa');
            $this->load->database();
            $this->db->where('guru_id',$id);
            $this->db->update('guru', $input); 
            $this->session->set_flashdata('f_guru','Successfully update rating');
            
            //update calculated rating
            $this->db->flush_cache();
            $input['guru_rating'] = $this->guru_model->get_calculated_rating($id);
            $this->db->where('guru_id',$id);
            $this->db->update('guru', $input); 
            
            //redirect to admin page
            redirect('admin/guru/rating/'.$id);
        }else{
            $this->session->set_flashdata('f_guru','Failed update rating');
            redirect('admin/guru/');
        }
    }
    
    /****** SERTIFIKAT *******/
    public function sertifikat($guru_id){
        $data['active'] = 1;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Guru'=>'guru','Sertifikat'=>'sertifikat'));
        $data['guru'] = $this->guru_model->get_guru_by_id($guru_id);
        $data['sertifikat'] = $this->profile_model->get_sertifikat($guru_id);
        $data['content'] = $this->load->view('admin/guru/sertifikat_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
	
	public function sertifikat_upload($guru_id) {
        if($_FILES){
            $upload = $_FILES['guru_sertifikat_file']['tmp_name'];
            $name 	= $_FILES['guru_sertifikat_file']['name'];
        }
        if(trim($upload) != ""){
            $name=explode('.',strtolower($name));
            $ext = array_pop($name);
            $name_files = preg_replace('/[^a-z0-9]/','-', implode('.',$name));
            while(TRUE) {
                $tmp_name_files = str_replace('--', '-', $name_files);
                if($tmp_name_files==$name_files) break;
            }
            $new_files = $guru_id.'-'.$name_files.'.'.$ext;
            copy($upload,'./files/sertifikat/'.$new_files);
        }
        $this->load->model('profile_model');
        $this->profile_model->insert_guru_sertifikat($guru_id,array(
            'title'=>$this->input->post('guru_sertifikat_title', true),
            'file'=>$new_files
        ));
        redirect('admin/guru/sertifikat/'.$guru_id);
    }
    
    /****** EDIT *******/
    public function edit($guru_id){
        $this->load->helper('form');
        $data['active'] = 1;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Guru'=>'guru','Rating'=>'rating'));
        $data['guru'] = $this->guru_model->get_guru_by_id($guru_id);
        $data['content'] = $this->load->view('admin/guru/edit_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    public function edit_submit(){
        $id = $this->input->post('id');
        if(!empty($id)){
            $input['guru_blocked'] = $this->input->post('blocked');
            $input['guru_nik_verified'] = $this->input->post('id_verified');
            $input['guru_pendidikan_verified'] = $this->input->post('edu_verified');
            $this->load->database();
            $this->db->where('guru_id',$id);
            $this->db->update('guru', $input); 
            $this->session->set_flashdata('f_guru','Successfully update guru');
            redirect('admin/guru/view/'.$id);
        }else{
            $this->session->set_flashdata('f_guru','Failed update guru');
            redirect('admin/guru/view/'.$id);
        }
    }
    
      public function edit_profile_submit(){
        $id = $this->input->post('id');
        if(!empty($id)){
            $input['guru_bio'] = $this->input->post('personal');
            $input['guru_kualifikasi'] = $this->input->post('kualifikasi');
            $input['guru_pengalaman'] = $this->input->post('pengalaman');
            $this->load->database();
            $this->db->where('guru_id',$id);
            $this->db->update('guru', $input); 
            $this->session->set_flashdata('f_guru','Successfully update guru');
            redirect('admin/guru/view/'.$id);
        }else{
            $this->session->set_flashdata('f_guru','Failed update guru');
            redirect('admin/guru/view/'.$id);
        }
    }
    
    
    /****** VIEW *******/
    public function view($guru_id){
        $this->load->helper('form');
        $data['active'] = 1;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Guru'=>'guru','View'=>'view'));
        $data['guru'] = $this->guru_model->get_guru_by_id($guru_id);
        $data['sertifikat'] = $this->profile_model->get_sertifikat($guru_id);
        $data['content'] = $this->load->view('admin/guru/view_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
     public function rating_xp_submit(){
        $id = $this->input->post('id');
        if(!empty($id)){
            $input['guru_rating_bio'] = $this->input->post('bio');
            $this->load->database();
            $this->db->where('guru_id',$id);
            $this->db->update('guru', $input); 
            $this->session->set_flashdata('f_guru','Successfully update rating');
            
            //update calculated rating
            $this->db->flush_cache();
            $input['guru_rating'] = $this->guru_model->get_calculated_rating($id);
            $this->db->where('guru_id',$id);
            $this->db->update('guru', $input); 
            
            //redirect to admin page
            redirect('admin/guru/rating/'.$id);
        }else{
            $this->session->set_flashdata('f_guru','Failed update rating');
            redirect('admin/guru/');
        }
    }
    
     /*** EMAIL REGISTRASI ***/
     public function report_profile($id){
     $data = $this->guru_model->get_guru_by_id($id);
     $this->load->library('email');
	$config['useragent'] = 'Ruangguru Web Service';
	$config['protocol'] = 'smtp';
	$config['smtp_host'] = 'mail.ruangguru.com';
	$config['smtp_port'] = 26;
	$config['smtp_user'] = 'no-reply@ruangguru.com';
	$config['smtp_pass'] = $this->config->item('smtp_password');
	$config['priority'] = 1;
	$config['mailtype'] = 'html';
	$config['charset'] = 'utf-8';
	$config['wordwrap'] = TRUE; 
	$this->email->initialize($config);
	$this->email->from('no-reply@ruangguru.com', 'Ruangguru.com');
	$this->email->to($data->guru_email);

	$this->email->subject('Perbarui Profil Akun Guru Anda');
     $content = $this->load->view('admin/guru/report_profile',array('data'=>$data),TRUE);
	$this->email->message($content);

	$this->email->send();
	redirect('admin/guru/page/'.$page);
    }
}