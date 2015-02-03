<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload extends CI_Controller {
    private $id;

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('admin/admin_model');
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
        $this->check();
	   $data['active'] = 95;
	   $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Upload'=>'upload'));
        $data['email'] = $this->admin_model->get_cs_email();
        $data['content'] = $this->load->view('admin/upload/upload_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
	public function generateRandomString() {
		$length = 6;
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}
	
	public function submit(){
		$input['duta'] = $this->input->post('tobe_duta');
		$config['upload_path'] = './images/class';
          $config['allowed_types'] = 'csv|txt';
          $this->load->library('upload',$config);
          if($this->upload->do_upload('tobe_duta')){
            $file_data = $this->upload->data();
            $source = $file_data['full_path'];
		  $file_handle = fopen($source, "r");
		  while (!feof($file_handle)) {
			$line = fgets($file_handle);
			$contents = preg_split("/;/", $line);
			//$input['pass'] = $this->generateRandomString();
			$input['nama'] = $contents[0];
			$input['email'] = $contents[1];
			//$input['gender'] = $contents[2];
			//$input['tempatlahir'] = $contents[3];
			//$input['lahir'] = $contents[4];
			//$input['hp'] = $contents[5];
			//$input['alamat'] = $contents[6];
			//$input['source_info'] = $contents[7];
			//$input['duta_guru_daftar'] = date('Y-m-d');
			//$input['kota'] = "";
			//$input['alamat_domisili'] = "";
			//$input['hp_2'] = "";
			//$input['telp_rumah'] = "";
			//$input['telp_kantor'] = "";
			
			//if(!$this->duta_guru_model->check_email($contents[1])){
				//$id = $this->duta_guru_model->insert_duta_guru($input);
			//$id = 1;
				$this->email_reg($input);
			//}
		}
		fclose($file_handle);
            $this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Data telah berhasil ditambah.</span>');
          }else{
            $this->session->set_flashdata('edit_profile_notif','<span class="red-notif">Data tidak berhasil diupload. Pastikan Anda hanya mengupload dokumen berekstensi jpg, pdf atau png.</span>');
          }
		redirect('admin');
    }
    
     public function email_reg($data_duta, $id){
     
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
	$this->email->from('apply@ruangguru.com', 'Ruangguru.com');
     $this->email->to($data_duta['email']);

	$this->email->subject('Penawaran menarik untuk Duta Ruangguru.com');
     $content = $this->load->view('admin/upload/template_email',array('dutaguru'=>$data_duta, 'id' => $id),TRUE);
	$this->email->message($content);

	$this->email->send();
    }
    
     public function email_event($content){
     
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
	$this->email->from($content['sender'], 'Ruangguru.com');
     $this->email->to($content['email']);

	$this->email->subject($content['subject']);
     $content_msg = $this->load->view('admin/upload/template_email_blast',array('content'=>$content),TRUE);
	$this->email->message($content_msg);

	$this->email->send();
    }
    
     public function send_email(){
        $this->check();
	   $data['active'] = 95;
	   $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Send Email'=>'send_email'));
        $data['content'] = $this->load->view('admin/upload/upload_contact_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
     public function edit_email(){
        $this->load->helper('form');
        $data['active'] = 1;
        $data['breadcumb'] = $this->admin_model->get_breadcumb(array('Edit'=>'edit'));
        $data['template'] = $this->admin_model->get_email_template();
        $data['content'] = $this->load->view('admin/upload/edit_email_v',$data,TRUE);
        $this->load->view('admin/admin_v',$data);
    }
    
     public function edit_email_submit(){
		$input['sender'] = $this->input->post('sender');
		$input['subject'] = $this->input->post('subject');
		$input['template_email'] = $this->input->post('content');
		$this->admin_model->edit_email_template($input);
		redirect('admin/upload/send_email');
    }
    
    	public function send_all(){
		$input['data_email'] = $this->input->post('data_email');
		$config['upload_path'] = './images/class';
          $config['allowed_types'] = 'csv|txt';
		$template = $this->admin_model->get_email_template();
          $this->load->library('upload',$config);
          if($this->upload->do_upload('data_email')){
            $file_data = $this->upload->data();
            $source = $file_data['full_path'];
		  $file_handle = fopen($source, "r");
		  while (!feof($file_handle)) {
			$line = fgets($file_handle);
			$contents = preg_split("/;/", $line);
			$input['nama'] = $contents[0];
			$input['email'] = $contents[1];
			$input['sender'] = $template->sender;
			$input['subject'] = $template->subject;
			$input['content'] = $template->template_email;
			
			$this->email_event($input);
		}
		fclose($file_handle);
            $this->session->set_flashdata('edit_profile_notif','<span class="green-notif">Email telah berhasil dikirim.</span>');
          }else{
            $this->session->set_flashdata('edit_profile_notif','<span class="red-notif">Email tidak berhasil dikirim. Pastikan data yang Anda upload file bertipe *.csv atau *.txt</span>');
          }
		redirect('admin');
    }
}