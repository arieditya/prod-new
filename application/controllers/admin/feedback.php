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
		$this->data['questions'] = $this->feedback_model->get_question();
		$this->data['content'] = $this->load->view('admin/feedback/detail_question', $this->data, TRUE);
		$this->load->view('admin/admin_v',$this->data);
	}
	
	public function detail_answer() {
		
	}
}

// END OF feedback.php File