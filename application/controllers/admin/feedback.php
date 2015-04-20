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
		$this->data['breadcumb'] 	= $this->admin_model->get_breadcumb(array('Feedback'=>'feedback',
																			  'Question'=>'feedback/manage_question'));
		$this->data['questions'] = $this->feedback_model->get_questions();
		$this->data['content'] = $this->load->view('admin/feedback/manage_question', $this->data, TRUE);
		$this->load->view('admin/admin_v',$this->data);
	}
	
	public function class_attendance($class_id) {
		$this->load->model('vendor_class_model');
		$participants = $this->vendor_class_model->get_class_participant_full($class_id, 4)->result();
		if(empty($participants)) {
			$this->session->set_flashdata(array('f_class_error'=>'Participant for this class is GONE!'));
			redirect($_SERVER['HTTP_REFERER']);
			exit;
		}

		$this->data['active'] = 630;
		$this->data['breadcumb'] 	= $this->admin_model->get_breadcumb(array('Feedback'=>'feedback',
																			  'Blaster'=>'feedback/manage_question',
																			  'Class Attendance'=>''));
		$from_type = 6;
		$to_type = 9;
		
		$responses = $this->feedback_model->get_feedback_response($from_type, $to_type, NULL, $class_id);
		$resp = array();
		foreach($responses as $response) {
			$resp[$response->from_id] = $response->code;
		}
		
		$this->data['questions'] = $this->feedback_model->get_detail_question($from_type, $to_type);
		$this->data['from_type'] = $from_type;
		$this->data['to_type'] = $to_type;
		$this->data['to_id']	= $class_id;
		$this->data['participants'] = $participants;
		$this->data['responses'] = $resp;
		$this->data['content'] = $this->load->view('admin/feedback/prepare_question_blast', $this->data, TRUE);
		$this->load->view('admin/admin_v',$this->data);
	}
	
	public function blast() {
		$from_id = $this->input->post('from_id',TRUE);
		$from_type = $this->input->post('from_type',TRUE);
		$to_id = $this->input->post('to_id',TRUE);
		$to_type = $this->input->post('to_type',TRUE);
		
		if(is_array($from_id)) {
			$type = 'from';
			$epyt = 'to';
		} elseif(is_array($to_id)) {
			$type = 'to';
			$epyt = 'from';
		} else {
			show_error('Gagal chuy...', 401);
			exit;
		}
		$to = NULL;
		$from = NULL;
		$this->load->model('email_model');
		$send2admin = FALSE;
		foreach(${$type.'_id'} as $$type) {
			$$epyt = $type=='from'?$to_id:$from_id;
			$code = $this->feedback_model->create_feedback($from_type, $from, $to_type, $to);
			if($from == 6 and $to == 9) {
				// student to class
				$this->load->model('vendor_class_model');
				$this->load->model('vendor_model');
				$recepient = $this->vendor_class_model->get_participant($from_id);
				$target = $this->vendor_class_model->get_class(array('id'=>$to_id))->row();
				$vendor = $this->vendor_model->get_profile(array('id'=>$target->vendor_id))->row();
				$this->email_model->student_class_feedback($recepient, $target, $vendor, $code);
				if(!$send2admin) {
					$recepient->name = 'Admin';
					$recepient->email = 'kelas@ruangguru.com';
					$this->email_model->student_class_feedback($recepient, $target, $vendor, 'FAKECODE-'.$code);
					$send2admin = TRUE;
				}
			}
		}
		
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function manage_answer() {
		$this->data['active'] = 620;
	}
	
	public function detail_question($from_type, $to_type) {
		$this->data['active'] = 611;
		$this->data['breadcumb'] 	= $this->admin_model->get_breadcumb(array('Feedback'=>'feedback',
																			  'Question'=>'feedback/manage_question',
																			  'Detail'=>''));
		$this->data['questions'] = $this->feedback_model->get_detail_question($from_type, $to_type);
		$this->data['from'] = $from_type;
		$this->data['to'] = $to_type;
		$this->data['content'] = $this->load->view('admin/feedback/detail_question', $this->data, TRUE);
		$this->load->view('admin/admin_v',$this->data);
	}
	
	public function submit_question() {
		$referer = $_SERVER['HTTP_REFERER'];
		$query_string = array_shift(explode('?',$referer));
		$referer = str_replace('?'.$query_string,'', $referer);
		$segments = explode('/',empty($referer)?'empty':$referer);
		if(count($segments) < 5) {
			show_error('Failed to retrieve referer!'.print_r($segments, TRUE), 401);
		}
		$to = array_pop($segments);
		$from = array_pop($segments);
		$method = array_pop($segments);
		
		if( ! method_exists($this, $method)) 
			show_error('unauthorized call of function!', 401);

		$id = (int)$this->input->get('id', TRUE);
		$type = $this->input->get('type', TRUE);
		$title = $this->input->get('title', TRUE);
		$question = $this->input->get('question', TRUE);
		if(empty($id)) {
			$from_type = (int)$this->input->get('from', TRUE);
			$to_type = (int)$this->input->get('to', TRUE);
			if($this->feedback_model->create_question($from_type, $to_type, $type, $title, $question)) {
				$this->session->set_flashdata(array('f_class'=>'Question Added!'));
			} else {
				$this->session->set_flashdata(array('f_class_error'=>'Question Failed to be Added!'));
			}
		} else {
			if($this->feedback_model->update_question($id, $type, $title, $question)) {
				$this->session->set_flashdata(array('f_class'=>'Question Updated!'));
			} else {
				$this->session->set_flashdata(array('f_class_error'=>'Question Failed to be Updated!'));
			}
		}
		redirect($referer);
	}
	
	public function delete_question($id) {
		$referer = empty($_SERVER['HTTP_REFERER'])?'':$_SERVER['HTTP_REFERER'];
		$query_string = array_shift(explode('?',$referer));
		$referer = str_replace('?'.$query_string,'', $referer);
		$segments = explode('/',empty($referer)?'empty':$referer);
		if(count($segments) < 5) {
			show_error('Failed to retrieve referer!'.print_r($segments, TRUE), 401);
			exit;
		}
		$to = array_pop($segments);
		$from = array_pop($segments);
		$method = array_pop($segments);
		
		if( ! method_exists($this, $method)) {
			show_error('unauthorized call of function!', 401);
			exit;
		}

		$this->feedback_model->delete_question($id);
		
		redirect($referer, 'refresh');
	}
	
	public function detail_answer() {
		
	}
}

// END OF feedback.php File