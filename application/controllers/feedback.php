<?php if(!defined('BASEPATH')) die('Die already!');
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 4/9/15
 * Time: 9:40 AM
 * Proj: prod-new
 */
class Feedback extends MY_Controller{
	var $code = '';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('feedback_model');
		$this->load->library('uri');
	}
	
	public function _remap() {
		$this->code = $this->uri->rsegment(2);
		if(empty($this->code) || strlen($this->code) < 40) show_404();
		$method = $this->uri->rsegment(3);
		if(empty($method) || !method_exists($this, $method)) $method = 'question';
		$this->$method();
	}
	
	public function question() {
		$q = $this->feedback_model->get_question($this->code);
		if(empty($q)) show_404();

		$to = '';
		$type = '';
		switch($q[0]->to_type) {
			case	1			: 
						$to = 'Admin dan Support';
						$type = 'Tim Ruangguru';
				break;
			case	2			: 
						$to = 'Admin dan Support';
						$type = 'Private.Ruangguru';
				break;
			case	3			: 
						$to = 'Admin dan Support';
						$type = 'Kelas.Ruangguru';
				break;
			case	4			: 
						$this->load->model('murid_model');
						$to_data = $this->murid_model->get_murid_by_id($q[0]->to_id);
						$to = $to_data->murid_nama;
						$type = 'Murid Private';
				break;
			case	5			: 
						$this->load->model('guru_model');
						$to_data = $this->guru_model->get_guru_by_id($q[0]->to_id);
						$to = $to_data->guru_nama;
						$type = 'Guru Private';
				break;
			case	6			: 
						$this->load->model('vendor_class_model');
						$to_data = $this->vendor_class_model->get_participant($q[0]->to_id);
						$to = $to_data->name;
						$type = 'Peserta Kelas.Ruangguru';
				break;
			case	7			: 
						$this->load->model('vendor_class_model');
						$to_data = $this->vendor_class_model->get_sponsor($q[0]->to_id);
						$to = $to_data->name;
						$type = 'Pemesan Kelas.Ruangguru';
				break;
			case	8			: 
						$this->load->model('vendor_model');
						$to_data = $this->vendor_model->get_profile(array('id'=>$q[0]->to_id));
						$to = $to_data->name;
						$type = 'Vendor Kelas.Ruangguru';
				break;
			case	9			: 
						$this->load->model('vendor_class_model');
						$to_data = $this->vendor_class_model->get_class(array('id'=>$q[0]->to_id),0,0,'all')->row();
						$to = $to_data->class_nama;
						$type = 'Kelas di Kelas.Ruangguru';
				break;
			default: 
				show_404();
				break;
		}
		$from_data = $this->vendor_class_model->get_participant($q[0]->from_id);
		$from = array(
			'name'		=> $from_data->name,
			'type' 		=> 'Peserta Kelas.Ruangguru'
		);
		$this->data['from']		= $from;
		$this->data['to']		= $to;
		$this->data['type']		= $type;
		$this->data['question']	= $q;
		$this->load->view('feedback', $this->data);
	}
}

// END OF feedback.php File