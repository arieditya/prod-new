<<<<<<< .
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Event extends CI_Controller {
    private $id;

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/admin_model');
        $this->load->model('event_model');
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
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Event'=>'event'));
        $data['event'] = $this->event_model->get_registran_limit();
        $data['page'] = 1;
	   $data['event_all'] = $this->event_model->get_registran_all();
        $data['count'] = $data['event_all']->num_rows();
        $data['start'] = 0;
        $data['content'] = $this->load->view('admin/event/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    public function page($page_number=1){
        $data['active'] = 7;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Reminder'=>'reminder'));
        $data['event'] = $this->event_model->get_registran_limit($page_number-1);
        $data['page'] = $page_number;
        $data['notif_all'] = $this->event_model->get_registran_all();
        $data['count'] = $data['notif_all']->num_rows();
        $data['start'] = ($page_number-1)*20;
        $data['content'] = $this->load->view('admin/event/list_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
    
        /****** DELETE *******/
     public function delete($id){
        $this->event_model->delete_registran($id);
        $this->session->set_flashdata('f_kelas','Anda berhasil menghapus data');
        redirect('admin/event');
    }
    
    
      /*** EMAIL REGISTRASI ***/
    public function send_email_invitation($id){
     $data = $this->event_model->get_registran($id);
	$hash = md5($id);
	$kode = substr($hash, 0, 2).substr($hash, 30, 2).$id;
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
	$this->email->to($data->email_registrasi);

	$this->email->subject('Tiket Open House Ruangguru');
     $content = $this->load->view('admin/event/email_tiket',array('data'=>$data, 'kode'=>$kode),TRUE);
	$this->email->message($content);

	$this->email->send();
	$this->event_model->send_ticket($id);
	redirect('admin/event');
    }
=======
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Event extends CI_Controller {
    private $id;

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/admin_model');
        $this->load->model('event_model');
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
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Event'=>'event'));
        $data['event'] = $this->event_model->get_registran_limit();
        $data['page'] = 1;
	   $data['event_all'] = $this->event_model->get_registran_all();
        $data['count'] = $data['event_all']->num_rows();
        $data['start'] = 0;
        $data['content'] = $this->load->view('admin/event/list_v',$data,TRUE);
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
    
     public function view($id){
        $data['active'] = 7;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Kelas'=>'kelas','Edit Kelas Pertemuan'=>'view'));
        $data['kelas'] = $this->kelas_model->get_reminder_data($id);
        $data['content'] = $this->load->view('admin/reminder/view_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
        /****** DELETE *******/
     public function delete($id){
        $this->event_model->delete_registran($id);
        $this->session->set_flashdata('f_kelas','Anda berhasil menghapus data');
        redirect('admin/event');
    }
    
      /*** EMAIL REGISTRASI ***/
    public function send_email_invitation($id){
     $data = $this->event_model->get_registran($id);
	$hash = md5($id);
	$kode = substr($hash, 0, 2).substr($hash, 30, 2).$id;
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
	$this->email->to($data->email_registrasi);

	$this->email->subject('Tiket Open House Ruangguru');
     $content = $this->load->view('admin/event/email_tiket',array('data'=>$data, 'kode'=>$kode),TRUE);
	$this->email->message($content);

	$this->email->send();
	redirect('admin/event');
    }
>>>>>>> .r88
}