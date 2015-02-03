<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cari extends CI_Controller {
    private $id;
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('guru_model');
        $this->load->model('profile_model');
        $this->load->model('kelas_model');
        $this->load->model('murid_model');
        $this->load->model('request_model');
        $this->load->model('duta_guru_model');
    }
    
    
    public function eng_jkt($page=null){
        $this->load->model('profile_model');
        //get input
	   if($page == null){
			$input['provinsi'] = 1;
			$input['lokasi'] = 0;
			$input['jenjang'] = 9;
			$input['matpel'] = 96;
			$input['guru'] = $this->input->post('guru');
			$input['gender'] = 3;
			$input['umur'] = 4;
			$input['sertifikat'] = 2;
			$input['urutan'] = 1;
			$input['tarif'] = 0;
			$this->session->set_userdata('cari_guru',$input);
			$data['show_result'] = true;
		}else{
			$input = $this->session->userdata('cari_guru');
			$data['show_result'] = true;
		}
	   
	   //print_r($this->input->post('edu'));
        //get result
        $data['offset'] = 5;
        $data['page'] = (empty($page))?0:$page;
        if($page==null){
            $start = 0;
        }else{
            $start = $page;
        }
        $data['guru'] = $this->guru_model->find_and($input,$start,$data['offset']);
        $data['input'] = $input;
        //$data['guru_total'] = $this->guru_model->find_all($input);
        $this->load->library('pagination');
        $config['base_url'] = base_url().'cari_guru/result/';
        $config['total_rows'] = $data['guru']['total'];
        $config['per_page'] = $data['offset'];
        $this->pagination->initialize($config);
        //displaying result
        $data['pagination'] = $this->pagination->create_links();
        $data['pilihan_guru'] = $this->session->userdata('pilihan_guru');
        $temp['css'] = array('jquery.alerts','validation','cariguru','profile');
        $this->load->view('header',$temp);
        $this->load->view('front/cari-guru/index',$data);
        $this->load->view('footer');
    }
    
     public function mtk_jkt($page=null){
        $this->load->model('profile_model');
        //get input
	   if($page == null){
			$input['provinsi'] = 1;
			$input['lokasi'] = 0;
			$input['jenjang'] = 4;
			$input['matpel'] = 42;
			$input['guru'] = $this->input->post('guru');
			$input['gender'] = 3;
			$input['umur'] = 4;
			$input['sertifikat'] = 2;
			$input['urutan'] = 1;
			$input['tarif'] = 0;
			$this->session->set_userdata('cari_guru',$input);
			$data['show_result'] = true;
		}else{
			$input = $this->session->userdata('cari_guru');
			$data['show_result'] = true;
		}
	   
	   //print_r($this->input->post('edu'));
        //get result
        $data['offset'] = 5;
        $data['page'] = (empty($page))?0:$page;
        if($page==null){
            $start = 0;
        }else{
            $start = $page;
        }
        $data['guru'] = $this->guru_model->find_and($input,$start,$data['offset']);
        $data['input'] = $input;
        //$data['guru_total'] = $this->guru_model->find_all($input);
        $this->load->library('pagination');
        $config['base_url'] = base_url().'cari_guru/result/';
        $config['total_rows'] = $data['guru']['total'];
        $config['per_page'] = $data['offset'];
        $this->pagination->initialize($config);
        //displaying result
        $data['pagination'] = $this->pagination->create_links();
        $data['pilihan_guru'] = $this->session->userdata('pilihan_guru');
        $temp['css'] = array('jquery.alerts','validation','cariguru','profile');
        $this->load->view('header',$temp);
        $this->load->view('front/cari-guru/index',$data);
        $this->load->view('footer');
    }
    
     public function fisika_jkt($page=null){
        $this->load->model('profile_model');
        //get input
	   if($page == null){
			$input['provinsi'] = 1;
			$input['lokasi'] = 0;
			$input['jenjang'] = 4;
			$input['matpel'] =54;
			$input['guru'] = $this->input->post('guru');
			$input['gender'] = 3;
			$input['umur'] = 4;
			$input['sertifikat'] = 2;
			$input['urutan'] = 1;
			$input['tarif'] = 0;
			$this->session->set_userdata('cari_guru',$input);
			$data['show_result'] = true;
		}else{
			$input = $this->session->userdata('cari_guru');
			$data['show_result'] = true;
		}
	   
	   //print_r($this->input->post('edu'));
        //get result
        $data['offset'] = 5;
        $data['page'] = (empty($page))?0:$page;
        if($page==null){
            $start = 0;
        }else{
            $start = $page;
        }
        $data['guru'] = $this->guru_model->find_and($input,$start,$data['offset']);
        $data['input'] = $input;
        //$data['guru_total'] = $this->guru_model->find_all($input);
        $this->load->library('pagination');
        $config['base_url'] = base_url().'cari_guru/result/';
        $config['total_rows'] = $data['guru']['total'];
        $config['per_page'] = $data['offset'];
        $this->pagination->initialize($config);
        //displaying result
        $data['pagination'] = $this->pagination->create_links();
        $data['pilihan_guru'] = $this->session->userdata('pilihan_guru');
        $temp['css'] = array('jquery.alerts','validation','cariguru','profile');
        $this->load->view('header',$temp);
        $this->load->view('front/cari-guru/index',$data);
        $this->load->view('footer');
    }
    
     public function kimia_jkt($page=null){
        $this->load->model('profile_model');
        //get input
	   if($page == null){
			$input['provinsi'] = 1;
			$input['lokasi'] = 0;
			$input['jenjang'] = 4;
			$input['matpel'] = 67;
			$input['guru'] = $this->input->post('guru');
			$input['gender'] = 3;
			$input['umur'] = 4;
			$input['sertifikat'] = 2;
			$input['urutan'] = 1;
			$input['tarif'] = 0;
			$this->session->set_userdata('cari_guru',$input);
			$data['show_result'] = true;
		}else{
			$input = $this->session->userdata('cari_guru');
			$data['show_result'] = true;
		}
	   
	   //print_r($this->input->post('edu'));
        //get result
        $data['offset'] = 5;
        $data['page'] = (empty($page))?0:$page;
        if($page==null){
            $start = 0;
        }else{
            $start = $page;
        }
        $data['guru'] = $this->guru_model->find_and($input,$start,$data['offset']);
        $data['input'] = $input;
        //$data['guru_total'] = $this->guru_model->find_all($input);
        $this->load->library('pagination');
        $config['base_url'] = base_url().'cari_guru/result/';
        $config['total_rows'] = $data['guru']['total'];
        $config['per_page'] = $data['offset'];
        $this->pagination->initialize($config);
        //displaying result
        $data['pagination'] = $this->pagination->create_links();
        $data['pilihan_guru'] = $this->session->userdata('pilihan_guru');
        $temp['css'] = array('jquery.alerts','validation','cariguru','profile');
        $this->load->view('header',$temp);
        $this->load->view('front/cari-guru/index',$data);
        $this->load->view('footer');
    }
    
     public function jpn_jkt($page=null){
        $this->load->model('profile_model');
        //get input
	   if($page == null){
			$input['provinsi'] = 1;
			$input['lokasi'] = 0;
			$input['jenjang'] = 9;
			$input['matpel'] = 94;
			$input['guru'] = $this->input->post('guru');
			$input['gender'] = 3;
			$input['umur'] = 4;
			$input['sertifikat'] = 2;
			$input['urutan'] = 1;
			$input['tarif'] = 0;
			$this->session->set_userdata('cari_guru',$input);
			$data['show_result'] = true;
		}else{
			$input = $this->session->userdata('cari_guru');
			$data['show_result'] = true;
		}
	   
	   //print_r($this->input->post('edu'));
        //get result
        $data['offset'] = 5;
        $data['page'] = (empty($page))?0:$page;
        if($page==null){
            $start = 0;
        }else{
            $start = $page;
        }
        $data['guru'] = $this->guru_model->find_and($input,$start,$data['offset']);
        $data['input'] = $input;
        //$data['guru_total'] = $this->guru_model->find_all($input);
        $this->load->library('pagination');
        $config['base_url'] = base_url().'cari_guru/result/';
        $config['total_rows'] = $data['guru']['total'];
        $config['per_page'] = $data['offset'];
        $this->pagination->initialize($config);
        //displaying result
        $data['pagination'] = $this->pagination->create_links();
        $data['pilihan_guru'] = $this->session->userdata('pilihan_guru');
        $temp['css'] = array('jquery.alerts','validation','cariguru','profile');
        $this->load->view('header',$temp);
        $this->load->view('front/cari-guru/index',$data);
        $this->load->view('footer');
    }
    /* SURABAYA */
     
     public function eng_sby($page=null){
        $this->load->model('profile_model');
        //get input
	   if($page == null){
			$input['provinsi'] = 15;
			$input['lokasi'] = 24;
			$input['jenjang'] = 9;
			$input['matpel'] = 96;
			$input['guru'] = $this->input->post('guru');
			$input['gender'] = 3;
			$input['umur'] = 4;
			$input['sertifikat'] = 2;
			$input['urutan'] = 1;
			$input['tarif'] = 0;
			$this->session->set_userdata('cari_guru',$input);
			$data['show_result'] = true;
		}else{
			$input = $this->session->userdata('cari_guru');
			$data['show_result'] = true;
		}
	   
	   //print_r($this->input->post('edu'));
        //get result
        $data['offset'] = 5;
        $data['page'] = (empty($page))?0:$page;
        if($page==null){
            $start = 0;
        }else{
            $start = $page;
        }
        $data['guru'] = $this->guru_model->find_and($input,$start,$data['offset']);
        $data['input'] = $input;
        //$data['guru_total'] = $this->guru_model->find_all($input);
        $this->load->library('pagination');
        $config['base_url'] = base_url().'cari_guru/result/';
        $config['total_rows'] = $data['guru']['total'];
        $config['per_page'] = $data['offset'];
        $this->pagination->initialize($config);
        //displaying result
        $data['pagination'] = $this->pagination->create_links();
        $data['pilihan_guru'] = $this->session->userdata('pilihan_guru');
        $temp['css'] = array('jquery.alerts','validation','cariguru','profile');
        $this->load->view('header',$temp);
        $this->load->view('front/cari-guru/index',$data);
        $this->load->view('footer');
    }
    
     public function fisika_sby($page=null){
        $this->load->model('profile_model');
        //get input
	   if($page == null){
			$input['provinsi'] = 15;
			$input['lokasi'] = 24;
			$input['jenjang'] = 4;
			$input['matpel'] = 54;
			$input['guru'] = $this->input->post('guru');
			$input['gender'] = 3;
			$input['umur'] = 4;
			$input['sertifikat'] = 2;
			$input['urutan'] = 1;
			$input['tarif'] = 0;
			$this->session->set_userdata('cari_guru',$input);
			$data['show_result'] = true;
		}else{
			$input = $this->session->userdata('cari_guru');
			$data['show_result'] = true;
		}
	   
	   //print_r($this->input->post('edu'));
        //get result
        $data['offset'] = 5;
        $data['page'] = (empty($page))?0:$page;
        if($page==null){
            $start = 0;
        }else{
            $start = $page;
        }
        $data['guru'] = $this->guru_model->find_and($input,$start,$data['offset']);
        $data['input'] = $input;
        //$data['guru_total'] = $this->guru_model->find_all($input);
        $this->load->library('pagination');
        $config['base_url'] = base_url().'cari_guru/result/';
        $config['total_rows'] = $data['guru']['total'];
        $config['per_page'] = $data['offset'];
        $this->pagination->initialize($config);
        //displaying result
        $data['pagination'] = $this->pagination->create_links();
        $data['pilihan_guru'] = $this->session->userdata('pilihan_guru');
        $temp['css'] = array('jquery.alerts','validation','cariguru','profile');
        $this->load->view('header',$temp);
        $this->load->view('front/cari-guru/index',$data);
        $this->load->view('footer');
    }
    
     public function kimia_sby($page=null){
        $this->load->model('profile_model');
        //get input
	   if($page == null){
			$input['provinsi'] = 15;
			$input['lokasi'] = 24;
			$input['jenjang'] = 4;
			$input['matpel'] = 67;
			$input['guru'] = $this->input->post('guru');
			$input['gender'] = 3;
			$input['umur'] = 4;
			$input['sertifikat'] = 2;
			$input['urutan'] = 1;
			$input['tarif'] = 0;
			$this->session->set_userdata('cari_guru',$input);
			$data['show_result'] = true;
		}else{
			$input = $this->session->userdata('cari_guru');
			$data['show_result'] = true;
		}
	   
	   //print_r($this->input->post('edu'));
        //get result
        $data['offset'] = 5;
        $data['page'] = (empty($page))?0:$page;
        if($page==null){
            $start = 0;
        }else{
            $start = $page;
        }
        $data['guru'] = $this->guru_model->find_and($input,$start,$data['offset']);
        $data['input'] = $input;
        //$data['guru_total'] = $this->guru_model->find_all($input);
        $this->load->library('pagination');
        $config['base_url'] = base_url().'cari_guru/result/';
        $config['total_rows'] = $data['guru']['total'];
        $config['per_page'] = $data['offset'];
        $this->pagination->initialize($config);
        //displaying result
        $data['pagination'] = $this->pagination->create_links();
        $data['pilihan_guru'] = $this->session->userdata('pilihan_guru');
        $temp['css'] = array('jquery.alerts','validation','cariguru','profile');
        $this->load->view('header',$temp);
        $this->load->view('front/cari-guru/index',$data);
        $this->load->view('footer');
    }
    
     public function mtk_sby($page=null){
        $this->load->model('profile_model');
        //get input
	   if($page == null){
			$input['provinsi'] = 15;
			$input['lokasi'] = 24;
			$input['jenjang'] = 4;
			$input['matpel'] = 42;
			$input['guru'] = $this->input->post('guru');
			$input['gender'] = 3;
			$input['umur'] = 4;
			$input['sertifikat'] = 2;
			$input['urutan'] = 1;
			$input['tarif'] = 0;
			$this->session->set_userdata('cari_guru',$input);
			$data['show_result'] = true;
		}else{
			$input = $this->session->userdata('cari_guru');
			$data['show_result'] = true;
		}
	   
	   //print_r($this->input->post('edu'));
        //get result
        $data['offset'] = 5;
        $data['page'] = (empty($page))?0:$page;
        if($page==null){
            $start = 0;
        }else{
            $start = $page;
        }
        $data['guru'] = $this->guru_model->find_and($input,$start,$data['offset']);
        $data['input'] = $input;
        //$data['guru_total'] = $this->guru_model->find_all($input);
        $this->load->library('pagination');
        $config['base_url'] = base_url().'cari_guru/result/';
        $config['total_rows'] = $data['guru']['total'];
        $config['per_page'] = $data['offset'];
        $this->pagination->initialize($config);
        //displaying result
        $data['pagination'] = $this->pagination->create_links();
        $data['pilihan_guru'] = $this->session->userdata('pilihan_guru');
        $temp['css'] = array('jquery.alerts','validation','cariguru','profile');
        $this->load->view('header',$temp);
        $this->load->view('front/cari-guru/index',$data);
        $this->load->view('footer');
    }
    
     public function eko_sby($page=null){
        $this->load->model('profile_model');
        //get input
	   if($page == null){
			$input['provinsi'] = 15;
			$input['lokasi'] = 24;
			$input['jenjang'] = 4;
			$input['matpel'] = 69;
			$input['guru'] = $this->input->post('guru');
			$input['gender'] = 3;
			$input['umur'] = 4;
			$input['sertifikat'] = 2;
			$input['urutan'] = 1;
			$input['tarif'] = 0;
			$this->session->set_userdata('cari_guru',$input);
			$data['show_result'] = true;
		}else{
			$input = $this->session->userdata('cari_guru');
			$data['show_result'] = true;
		}
	   
	   //print_r($this->input->post('edu'));
        //get result
        $data['offset'] = 5;
        $data['page'] = (empty($page))?0:$page;
        if($page==null){
            $start = 0;
        }else{
            $start = $page;
        }
        $data['guru'] = $this->guru_model->find_and($input,$start,$data['offset']);
        $data['input'] = $input;
        //$data['guru_total'] = $this->guru_model->find_all($input);
        $this->load->library('pagination');
        $config['base_url'] = base_url().'cari_guru/result/';
        $config['total_rows'] = $data['guru']['total'];
        $config['per_page'] = $data['offset'];
        $this->pagination->initialize($config);
        //displaying result
        $data['pagination'] = $this->pagination->create_links();
        $data['pilihan_guru'] = $this->session->userdata('pilihan_guru');
        $temp['css'] = array('jquery.alerts','validation','cariguru','profile');
        $this->load->view('header',$temp);
        $this->load->view('front/cari-guru/index',$data);
        $this->load->view('footer');
    }
    
     /* BANDUNG */
     public function eng_bdg($page=null){
        $this->load->model('profile_model');
        //get input
	   if($page == null){
			$input['provinsi'] = 12;
			$input['lokasi'] = 21;
			$input['jenjang'] = 9;
			$input['matpel'] = 96;
			$input['guru'] = $this->input->post('guru');
			$input['gender'] = 3;
			$input['umur'] = 4;
			$input['sertifikat'] = 2;
			$input['urutan'] = 1;
			$input['tarif'] = 0;
			$this->session->set_userdata('cari_guru',$input);
			$data['show_result'] = true;
		}else{
			$input = $this->session->userdata('cari_guru');
			$data['show_result'] = true;
		}
	   
	   //print_r($this->input->post('edu'));
        //get result
        $data['offset'] = 5;
        $data['page'] = (empty($page))?0:$page;
        if($page==null){
            $start = 0;
        }else{
            $start = $page;
        }
        $data['guru'] = $this->guru_model->find_and($input,$start,$data['offset']);
        $data['input'] = $input;
        //$data['guru_total'] = $this->guru_model->find_all($input);
        $this->load->library('pagination');
        $config['base_url'] = base_url().'cari_guru/result/';
        $config['total_rows'] = $data['guru']['total'];
        $config['per_page'] = $data['offset'];
        $this->pagination->initialize($config);
        //displaying result
        $data['pagination'] = $this->pagination->create_links();
        $data['pilihan_guru'] = $this->session->userdata('pilihan_guru');
        $temp['css'] = array('jquery.alerts','validation','cariguru','profile');
        $this->load->view('header',$temp);
        $this->load->view('front/cari-guru/index',$data);
        $this->load->view('footer');
    }
    
     public function mtk_bdg($page=null){
        $this->load->model('profile_model');
        //get input
	   if($page == null){
			$input['provinsi'] = 12;
			$input['lokasi'] = 21;
			$input['jenjang'] = 4;
			$input['matpel'] = 42;
			$input['guru'] = $this->input->post('guru');
			$input['gender'] = 3;
			$input['umur'] = 4;
			$input['sertifikat'] = 2;
			$input['urutan'] = 1;
			$input['tarif'] = 0;
			$this->session->set_userdata('cari_guru',$input);
			$data['show_result'] = true;
		}else{
			$input = $this->session->userdata('cari_guru');
			$data['show_result'] = true;
		}
	   
	   //print_r($this->input->post('edu'));
        //get result
        $data['offset'] = 5;
        $data['page'] = (empty($page))?0:$page;
        if($page==null){
            $start = 0;
        }else{
            $start = $page;
        }
        $data['guru'] = $this->guru_model->find_and($input,$start,$data['offset']);
        $data['input'] = $input;
        //$data['guru_total'] = $this->guru_model->find_all($input);
        $this->load->library('pagination');
        $config['base_url'] = base_url().'cari_guru/result/';
        $config['total_rows'] = $data['guru']['total'];
        $config['per_page'] = $data['offset'];
        $this->pagination->initialize($config);
        //displaying result
        $data['pagination'] = $this->pagination->create_links();
        $data['pilihan_guru'] = $this->session->userdata('pilihan_guru');
        $temp['css'] = array('jquery.alerts','validation','cariguru','profile');
        $this->load->view('header',$temp);
        $this->load->view('front/cari-guru/index',$data);
        $this->load->view('footer');
    }
    
     public function fisika_bdg($page=null){
        $this->load->model('profile_model');
        //get input
	   if($page == null){
			$input['provinsi'] = 12;
			$input['lokasi'] = 21;
			$input['jenjang'] = 4;
			$input['matpel'] = 54;
			$input['guru'] = $this->input->post('guru');
			$input['gender'] = 3;
			$input['umur'] = 4;
			$input['sertifikat'] = 2;
			$input['urutan'] = 1;
			$input['tarif'] = 0;
			$this->session->set_userdata('cari_guru',$input);
			$data['show_result'] = true;
		}else{
			$input = $this->session->userdata('cari_guru');
			$data['show_result'] = true;
		}
	   
	   //print_r($this->input->post('edu'));
        //get result
        $data['offset'] = 5;
        $data['page'] = (empty($page))?0:$page;
        if($page==null){
            $start = 0;
        }else{
            $start = $page;
        }
        $data['guru'] = $this->guru_model->find_and($input,$start,$data['offset']);
        $data['input'] = $input;
        //$data['guru_total'] = $this->guru_model->find_all($input);
        $this->load->library('pagination');
        $config['base_url'] = base_url().'cari_guru/result/';
        $config['total_rows'] = $data['guru']['total'];
        $config['per_page'] = $data['offset'];
        $this->pagination->initialize($config);
        //displaying result
        $data['pagination'] = $this->pagination->create_links();
        $data['pilihan_guru'] = $this->session->userdata('pilihan_guru');
        $temp['css'] = array('jquery.alerts','validation','cariguru','profile');
        $this->load->view('header',$temp);
        $this->load->view('front/cari-guru/index',$data);
        $this->load->view('footer');
    }
    
     public function kimia_bdg($page=null){
        $this->load->model('profile_model');
        //get input
	   if($page == null){
			$input['provinsi'] = 12;
			$input['lokasi'] = 21;
			$input['jenjang'] = 4;
			$input['matpel'] = 67;
			$input['guru'] = $this->input->post('guru');
			$input['gender'] = 3;
			$input['umur'] = 4;
			$input['sertifikat'] = 2;
			$input['urutan'] = 1;
			$input['tarif'] = 0;
			$this->session->set_userdata('cari_guru',$input);
			$data['show_result'] = true;
		}else{
			$input = $this->session->userdata('cari_guru');
			$data['show_result'] = true;
		}
	   
	   //print_r($this->input->post('edu'));
        //get result
        $data['offset'] = 5;
        $data['page'] = (empty($page))?0:$page;
        if($page==null){
            $start = 0;
        }else{
            $start = $page;
        }
        $data['guru'] = $this->guru_model->find_and($input,$start,$data['offset']);
        $data['input'] = $input;
        //$data['guru_total'] = $this->guru_model->find_all($input);
        $this->load->library('pagination');
        $config['base_url'] = base_url().'cari_guru/result/';
        $config['total_rows'] = $data['guru']['total'];
        $config['per_page'] = $data['offset'];
        $this->pagination->initialize($config);
        //displaying result
        $data['pagination'] = $this->pagination->create_links();
        $data['pilihan_guru'] = $this->session->userdata('pilihan_guru');
        $temp['css'] = array('jquery.alerts','validation','cariguru','profile');
        $this->load->view('header',$temp);
        $this->load->view('front/cari-guru/index',$data);
        $this->load->view('footer');
    }
    
     public function akuntansi_bdg($page=null){
        $this->load->model('profile_model');
        //get input
	   if($page == null){
			$input['provinsi'] = 12;
			$input['lokasi'] = 21;
			$input['jenjang'] = 4;
			$input['matpel'] = 47;
			$input['guru'] = $this->input->post('guru');
			$input['gender'] = 3;
			$input['umur'] = 4;
			$input['sertifikat'] = 2;
			$input['urutan'] = 1;
			$input['tarif'] = 0;
			$this->session->set_userdata('cari_guru',$input);
			$data['show_result'] = true;
		}else{
			$input = $this->session->userdata('cari_guru');
			$data['show_result'] = true;
		}
	   
	   //print_r($this->input->post('edu'));
        //get result
        $data['offset'] = 5;
        $data['page'] = (empty($page))?0:$page;
        if($page==null){
            $start = 0;
        }else{
            $start = $page;
        }
        $data['guru'] = $this->guru_model->find_and($input,$start,$data['offset']);
        $data['input'] = $input;
        //$data['guru_total'] = $this->guru_model->find_all($input);
        $this->load->library('pagination');
        $config['base_url'] = base_url().'cari_guru/result/';
        $config['total_rows'] = $data['guru']['total'];
        $config['per_page'] = $data['offset'];
        $this->pagination->initialize($config);
        //displaying result
        $data['pagination'] = $this->pagination->create_links();
        $data['pilihan_guru'] = $this->session->userdata('pilihan_guru');
        $temp['css'] = array('jquery.alerts','validation','cariguru','profile');
        $this->load->view('header',$temp);
        $this->load->view('front/cari-guru/index',$data);
        $this->load->view('footer');
    }
}