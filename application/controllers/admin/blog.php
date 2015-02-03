<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blog extends CI_Controller {
    private $id;

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/admin_model');
        $this->load->model('main_model');
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
        $data['active'] = 94;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Blog'=>'Blog','list'=>'list'));
        $data['posts'] = $this->main_model->get_posts();
        $data['page'] = 1;
        //$data['count'] = $this->admin_model->get_request_guru_count();
        $data['start'] = 0;
        $data['content'] = $this->load->view('admin/blog/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    public function page($page_number=1){
        $this->check();
        $this->load->model('guru_model');
        $data['active'] = 94;
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
    
     public function add(){
        $this->check();
        $data['active'] = 94;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Blog'=>'blog','Add Post'=>'blog/add'));
        $data['content'] = $this->load->view('admin/blog/add_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    public function post_submit(){
        $input['title'] = $this->input->post('title');
        $input['konten'] = $this->input->post('content');
        $input['status'] = $this->input->post('status');
	   
	   $config['upload_path'] = './images/blog';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $this->load->library('upload',$config);
        if($this->upload->do_upload('gambar')){
            $file_data = $this->upload->data();
            $source = $file_data['full_path'];
            $new_path = './images/blog/'.$input['title'].$file_data['file_ext'];   
            rename($source,$new_path);
            $input['file'] = $input['title'].$file_data['file_ext'];
            $this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Data posting Anda telah berhasil ditambah.</span>');
        }else{
            //echo $this->upload->display_errors();
            $this->session->set_flashdata('edit_profile_notif','<span class="red-notif">Data posting Anda tidak berhasil diupload. Pastikan Anda hanya mengupload dokumen berekstensi jpg, pdf atau png.</span>');
        }
	   	   //print_r($input);exit();
	   $this->main_model->add_post($input);
	   $this->session->set_flashdata('add_pertemuan_notif','<span class="green-notif">Data posting Anda telah berhasil ditambah.</span>');
        redirect('admin/blog');
	}
	
	public function edit($id){
        $this->check();
        $data['active'] = 94;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Blog'=>'blog','Edit Post'=>'blog/edit'));
	   $data['post'] = $this->main_model->get_posts_by_id($id);
        $data['content'] = $this->load->view('admin/blog/edit_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    	public function delete($id){
	   $post = $this->main_model->get_posts_by_id($id);
	   $this->main_model->delete_post($id);
	   unlink('./images/blog/'.$post->blog_image);
	   redirect('admin/blog');
    }
    
     public function edit_submit(){
        $input['title'] = $this->input->post('title');
        $input['konten'] = $this->input->post('content');
        $input['status'] = $this->input->post('status');
        $id = $this->input->post('id');
	   
	   $post = $this->main_model->get_posts_by_id($id);
	   
	   $config['upload_path'] = './images/blog';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $this->load->library('upload', $config);
        if($this->upload->do_upload('gambar')){
            $image_data = $this->upload->data();
            $config['source_image'] = $image_data['full_path'];
            $filename = $input['title'];
		  $input['file'] = $input['title'].$image_data['file_ext'];
            $config['new_image'] = './images/blog/'.$filename.$image_data['file_ext'];       
            $this->load->library('image_lib',$config);
            if ( ! $this->image_lib->resize()) {
                $this->session->set_flashdata('edit_profile_notif','<span class="red-notif">Terjadi kesalahan saat mengunggah gambar.</span>');
                redirect('admin/blog');
            }else{
                rename($config['source_image'],$config['new_image']);
			 $input['file'] = $input['title'].$image_data['file_ext'];
            }
        }else{
		 $input['file'] = $post->blog_image;
	   }
	   //print_r($input);exit();
	   $this->main_model->edit_post($input, $id);
	   $this->session->set_flashdata('add_pertemuan_notif','<span class="green-notif">Data posting Anda telah berhasil ditambah.</span>');
        redirect('admin/blog');
	}
    
}
?>