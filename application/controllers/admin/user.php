<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends MY_Controller {
    private $id;

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/admin_model');
    }
    
    public function check(){
        $this->id = $this->session->userdata('admin_id');
        if(empty($this->id)){
            redirect('4dm1nzqu/login');
        }
    }
    
    public function index(){
        $this->check();
        redirect('admin/guru');
    }
    
    /*** LOGIN ***/
    public function login(){
        $this->load->view('admin/user/login_v');
    }
    
    public function login_submit(){
        $input['username'] = $this->input->post('username');
        $input['password'] = $this->input->post('password');
        $admin = $this->admin_model->check_login($input);
        if(empty($admin)){
            $this->session->set_flashdata('f_login','Wrong username and password combintaion');
            redirect('4dm1nzqu/login');
        }else{
            $this->session->set_userdata('admin_id',$admin->admin_id);
            $this->session->set_userdata('admin_username',$admin->admin_username);
			$user_name = array_shift(explode('@',$admin->admin_username));
			$this->exec_login(array(
				'type'		=> 'admin',
				'name'		=> $user_name,
				'email'		=> $admin->admin_username,
				'id'		=> $admin->admin_id
			));
            redirect('admin/guru');
        }
   }
    
    public function logout(){
        $this->session->sess_destroy();
        redirect('4dm1nzqu/login');
    }
    
    /**** PROFILE ****/
    public function profile(){
        $this->check();
        $this->load->model('admin/admin_m');
        $data['active'] = 1;
        $data['breadcumb'] = $this->admin_m->get_breadcumb(array('User'=>'user','Profile'=>'profile'));
        $data['content'] = $this->load->view('admin/user/profile_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    public function profile_submit(){
        $this->check();
        $input['old'] = $this->input->post('old');
        $input['new'] = $this->input->post('new');
        $input['new2'] = $this->input->post('new2');
        if($input['new'] == $input['new2']){
            $user = $this->user_m->get_active_user();
            if(!empty($user)){
                if($user->user_pwd == md5($input['old'])){
                    $this->user_m->change_pass($user->user_id,$input['new']);
                    $this->session->set_flashdata('f_user','Password Changed');
                }else{
                    $this->session->set_flashdata('f_user','Wrong old password, Password not changed');
                }
            }else{
                $this->session->set_flashdata('f_user','User is empty, Password not changed');
            }
        }else{
            $this->session->set_flashdata('f_user','Retyped new password didn\'t match, Password not changed');
        }
        redirect('admin/user/profile');
    }
}