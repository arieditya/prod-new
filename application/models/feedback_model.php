<?php if(!defined('BASEPATH')) die('Die already!');
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 4/9/15
 * Time: 9:45 AM
 * Proj: prod-new
 */
class Feedback_model extends MY_Model{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_questions() {
		$query = "
		SELECT
			COUNT(*) AS cnt,
			from_type,
			to_type
		FROM
			feedback_question_new
		WHERE 1
		GROUP BY from_type, to_type";
		return $this->db->query($query)->result();
	}
	
	public function get_question($code = NULL) {
		$where = '';
		if(!empty($code))
			$where = "			AND a.code = ?";
		$query = "
		SELECT
			*
		FROM
			feedback a
			LEFT JOIN feedback_question_new b
				ON b.from_type = a.from_type AND b.to_type = a.to_type
		WHERE 1
{$where}
		ORDER BY b.sort ASC
		";
		return $this->db->query($query, $code)->result();
	}
	
	public function get_detail_question($from, $to) {
		$where = 
"			AND from_type = ?
			AND to_type = ?
";
		$query = "
		SELECT
			*
		FROM
			feedback_question_new
		WHERE 1
{$where}
		ORDER BY sort ASC
		";
		return $this->db->query($query, array($from, $to))->result();
	}
	
	public function create_feedback($from_type, $from_id, $to_type, $to_id, $code = NULL) {
		if(empty($code) || strlen($code) < 40)
			$code = hashgenerator(40);
		$insert = array(
			'code'			=> $code,
			'from_type'		=> $from_type,
			'from_id'		=> $from_id,
			'to_type'		=> $to_type,
			'to_id'			=> $to_id
		);
		$this->db->insert('feedback', $insert);
		return $code;
	}
	
	public function get_usertype() {
		return $this->db->get('feedback_user_type')->result();
	}
	
	public function create_question($from_type, $to_type, $type, $title, $question, $sort = NULL) {
		if(!in_array($type, array('rate','text','both'))) $type = 'both';
		if(empty($sort)) {
			$max = $this->db->query('
			SELECT 
				MAX(sort) as srt 
			FROM feedback_question_new 
			WHERE from_type = ? AND to_type = ?',
			array($from_type, $to_type))->row()->srt;
			if(empty($max)) $max = 0;
			$sort = ((int) $max)+1;
		}
		$this->db->insert('feedback_question_new', array(
			'from_type'			=> $from_type,
			'to_type'			=> $to_type,
			'type'				=> $type,
			'title'				=> $title,
			'question'			=> $question,
			'sort'				=> $sort
		));
		return $this->db->insert_id();
	}
	
	public function delete_question($id) {
		$this->db->delete('feedback_question_new', array('id'=>$id));
	}
	
	public function update_question($id, $type, $title, $question, $sort = NULL) {
		$data = array(
			'type'				=> $type,
			'title'				=> $title,
			'question'			=> $question,
		);
		if(!empty($sort) && is_int($sort)) $data['sort'] = $sort;
		$this->db->update('feedback_question_new', $data, array(
			'id'				=> $id
		));
		return !! $this->db->affected_rows();
	}
	
	public function answer_question($data) {
		$feedback = $this->db->get_where('feedback', array('code'=>$data['code']))->row();
		if(empty($feedback)) {
			$this->CI->session->set_flashdata('status.warning', 'Kode feedback yang anda masukan salah!');
			return FALSE;
		}
		$question = $this->db->get_where('feedback_question_new', array('id'=>$data['question_id']))->row();
		if(empty($feedback) || $question->from_type != $feedback->from_type || $question->to_type != $feedback->to_type) {
			$this->CI->session->set_flashdata('status.warning', 'Feedback yang anda masukan salah!');
			return FALSE;
		}
		$this->db->insert('feedback_value', $data);
		return TRUE;
	}
}

// END OF feedback_model.php File