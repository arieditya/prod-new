<?php if(!defined('BASEPATH')) die('Die already!');
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 10/8/14
 * Time: 4:16 PM
 * Proj: private-development
 */
class Vendor_model extends CI_Model{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_profile($var) {
		if(empty($var) || !is_array($var)) return FALSE;
		$this->db->where($var);
		return $this->db->get('vendor_profile');
	}
	
	public function set_profile($var) {
		$data = array_intersect_key($var, array(
			'email'			=> NULL,
			'password'		=> NULL,
			'name'			=> NULL,
			'main_phone'	=> NULL,
			'address'		=> NULL
		));
		if($this->db->insert('vendor_profile', $data)) {
			$id = $this->db->insert_id();
			$this->set_info(array('vendor_id'=>$id, 'is_institute'=>1));
			return $id;
		}
		return FALSE;
		
	}
	
	public function update_profile($var) {
		$data = array_intersect_key($var, array(
			'email'			=> NULL,
			'password'		=> NULL,
			'name'			=> NULL,
			'main_phone'	=> NULL,
			'address'		=> NULL
		));
		if($this->db->update('vendor_profile', $data, array('id'=>$var['id']))) {
			return !! $this->db->affected_rows();
		}
		return FALSE;
		
	}
	
	public function get_info($var) {
		if(empty($var) || !is_array($var)) return FALSE;
		$this->db->where($var);
		return $this->db->get('vendor_info');
	}
	
	public function set_info($var) {
		$this->db->insert('vendor_info', $var);
	}
	public function update_info($var) {
		$id = $var['id'];
		unset($var['id']);
		if($this->db->update('vendor_info', $var, array('vendor_id'=>$id))) {
			return !! $this->db->affected_rows();
		}
		return FALSE;
	}
	
	public function set_rekening($var){
		$id = $var['id'];
		unset($var['id']);
		$row = $this->db->where(array('vendor_id'=> $id))->get('vendor_rekening')->num_rows();

		if(empty($row)) {
			$this->db->insert('vendor_rekening', $var);
		} else {
			$this->db->update('vendor_rekening', $var, array('vendor_id'=> $id));
		}
		return !! $this->db->affected_rows();
	}
	
	public function get_bank_list(){
		return $this->db->get('bank')->result();
	}
	
	public function get_rekening($id) {
		return $this->db->where('vendor_id', $id)->get('vendor_rekening')->row();
	}
	
	public function set_socmed($var){
		if(empty($var['id'])) {
			$this->db->insert('vendor_socmed', $var);
		} else {
			$id = $var['id'];
			unset($var['id']);
			$this->db->update('vendor_socmed', $var, array('vendor_id'=> $id));
		}
		return !! $this->db->affected_rows();
	}
	
	public function get_socmed($id){
		return $this->db->where('vendor_id', $id)->get('vendor_socmed')->row();
	}
	
	public function set_tag($tags, $id) {
		$tags = explode(',',$tags);
		$q = array();
		foreach($tags as &$tag) {
			$tag = trim($tag);
			$q[] = "('{$id}, '{$tag}')";
		}

		$this->db->query('INSERT IGNORE INTO vendor_class_tag (vendor_id, tag_words) VALUES '. implode(',', $q));

		foreach($tags as $tag) {
			$this->db->query("
		INSERT INTO 
		vendor_tag_collections (tag_words, counter) 
		VALUES ('{$tag}', 1) 
		ON DUPLICATE KEY UPDATE counter = counter+1 " );
		}
	}
	public function get_tag($id) {
		return $this->db->query("
			SELECT
				*
			FROM
				vendor_class_tags a
				LEFT JOIN vendor_tag_collections b
					ON a.tag_words = b.tag_words
			WHERE 1
				AND a.vendor_id = ?
		", array($id))->result();
	}
}

// END OF vendor_model.php File