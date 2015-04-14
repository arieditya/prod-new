<?php if(!defined('BASEPATH')) die('Die already!');
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 4/10/15
 * Time: 10:19 AM
 * Proj: prod-new
 */
class Feedback extends ADMIN_Controller{
	
	var $data = array();
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/admin_model');
		$this->load->model('feedback_model');
		$this->data['usertype'] = $this->feedback_model->get_usertype();
	}
	
	public function index() {
		redirect('admin/feedback/manage_question');
	}
	
	public function manage_question() {
		$this->data['active'] = 610;
		$this->data['breadcrumb'] 	= $this->admin_model->get_breadcumb(array('Feedback'=>'feedback',
																			  'Question'=>'feedback/menage_question'));
		$this->data['questions'] = $this->feedback_model->get_questions();
		$this->data['content'] = $this->load->view('admin/feedback/manage_question', $this->data, TRUE);
		$this->load->view('admin/admin_v',$this->data);
	}
	
	public function manage_answer() {
		$this->data['active'] = 620;
	}
	
	public function detail_question($from_type, $to_type) {
		$this->data['active'] = 611;
		$this->data['breadcrumb'] 	= $this->admin_model->get_breadcumb(array('Feedback'=>'feedback',
																			  'Question'=>'feedback/menage_question',
																			  'Detail'=>''));
		$this->data['questions'] = $this->feedback_model->get_detail_question($from_type, $to_type);
		$this->data['from'] = $from_type;
		$this->data['to'] = $to_type;
		$this->data['content'] = $this->load->view('admin/feedback/detail_question', $this->data, TRUE);
		$this->load->view('admin/admin_v',$this->data);
	}
	
	public function submit_question() {
		$referer = array_pop(explode('/',empty($_SERVER['HTTP_REFERER'])?'empty':$_SERVER['HTTP_REFERER']));
		if( ! method_exists($this, array_shift(explode('?',$referer)))) 
			show_error('unauthorized call of function!', 401);

		$id = (int)$this->input->get('id', TRUE);
		$type = $this->input->post('type', TRUE);
		$title = $this->input->post('title', TRUE);
		$question = $this->input->post('question', TRUE);

		if(empty($id)) {
			$from_type = (int)$this->input->get('from', TRUE);
			$to_type = (int)$this->input->get('to', TRUE);
			if($this->feedback_model->create_question($from_type, $to_type, $type, $title, $question)) {
				$this->session->set_flashdata(array('f_class'=>'Question Added!'));
			} else {
				$this->session->set_flashdata(array('f_class_error'=>'Question Failed to be Added!'));
			}
		} else {
			
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function detail_answer() {
		
	}
}

// END OF feedback.php File