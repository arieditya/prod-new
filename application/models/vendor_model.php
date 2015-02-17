<?php if(!defined('BASEPATH')) die('Die already!');
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 10/8/14
 * Time: 4:16 PM
 * Proj: private-development
 */
class Vendor_model extends MY_Model{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_new_register_vendor() {
		return $this->db
			->from('vendor_profile')
			->join('vendor_info', 'vendor_profile.id=vendor_info.vendor_id', 'left')
			->where('vendor_profile.status', 0)
			->order_by('vendor_profile.id','desc')
			->get();
	}
	
	public function get_all_vendor() {
		return $this->db
			->from('vendor_profile')
			->join('vendor_info', 'vendor_profile.id=vendor_info.vendor_id', 'left')
			->order_by('vendor_profile.id','desc')
			->get();
	}
	
	public function get_vendor_detail($id) {
		$vendor = $this->db
			->from('vendor_profile')
			->join('vendor_info', 'vendor_profile.id=vendor_info.vendor_id', 'left')
			->where(array('vendor_profile.id'=>$id))
			->order_by('vendor_profile.id','desc')
			->get()->row();
		if(!empty($vendor)) {
			if(!empty($vendor->vendor_logo)) 
				$vendor->vendor_logo = base_url()."images/vendor/{$id}/{$vendor->vendor_logo}";
			$vendor->class_count = $this->db
					->select('COUNT(*) as cnt')
					->from('vendor_class')
					->where('vendor_id', $id)
					->get()->row()->cnt;
			return $vendor;
		}
		return FALSE;
	}
	
	public function get_profile($var) {
		if(empty($var) || !is_array($var)) return FALSE;
		$this->db->where($var);
		return $this->db->get('vendor_profile');
	}
	
	public function get_class_id_by_uri($uri) {
		return $this->db->select('id')->where('class_uri', $uri)->get('vendor_class')->scalar();
	}
	
	public function set_profile($var) {
		$data = array_intersect_key($var, array(
			'id'			=> NULL,
			'email'			=> NULL,
			'password'		=> NULL,
			'name'			=> NULL,
			'main_phone'	=> NULL,
			'address'		=> NULL
		));
		
		if(isset($var['id'])) {
			$this->db->update('vendor_profile', $data, array('id'=>$var['id']));
			$this->set_info(array('vendor_id'=>$var['id'], 'is_institute'=>1));
			return $var['id'];
		} elseif($this->db->insert('vendor_profile', $data)) {
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
			'address'		=> NULL,
			'status'		=> NULL
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
		$row = $this->db->where(array('vendor_id'=> $id))->get('vendor_rekening')->num_rows();

		if(empty($row)) {
			$this->db->insert('vendor_rekening', $var);
		} else {
			unset($var['id']);
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
	
	public function check_is_email_exists($email) {
		$guru = $this->db->from('vendor')->where('email', $email)->get();
		if($guru->num_rows() == 1) {
			return $guru->row()->id;
		}
		return FALSE;
	}
	
	public function duplicate_teacher_as_vendor($guru_id) {
		$query = $this->db->query("
			SELECT
-- 				guru_id AS id,
				guru_email AS email,
				guru_password AS password,
				guru_hp AS main_phone,
				guru_alamat AS address
			FROM
				guru
			WHERE 1
				AND guru_id = ?
		", array($guru_id));
		if($query->num_rows() != 1) return FALSE;
		$result = $query->row_array();
		if($this->db->from('vendor_profile')->where('id', $result->id)->get()->num_rows() != 0) return FALSE;
		$this->db->insert('vendor_profile', $result);
		if($this->db->affected_rows() != 1) return FALSE;
		$vendor_id = $this->db->insert_id();
		$this->db->insert('vendor_rel_guru', array('guru_id'=>$guru_id, 'vendor_id'=>$vendor_id));
		return $vendor_id;
	}
	
	public function connect_teacher($guru_id, $vendor_id) {
		$this->db->insert('vendor_rel_guru', array('guru_id'=>$guru_id, 'vendor_id'=>$vendor_id));
		return !!$this->db->affected_rows();
	}
	
	public function approve_vendor($id) {
		$this->db->update('vendor_profile', array('status'=>1), array('id'=>$id));
		return !! $this->db->affected_rows();
	}
	public function reject_vendor($id) {
		$this->db->update('vendor_profile', array('status'=>-1), array('id'=>$id));
		return !! $this->db->affected_rows();
	}
	public function deactivate_vendor($id) {
		$this->db->update('vendor_profile', array('status'=>0), array('id'=>$id));
		return !! $this->db->affected_rows();
	}
	
	public function vendor_search($keywords) {
		$this->db
			->from('vendor_profile')
			->join('vendor_info', 'vendor_profile.id=vendor_info.vendor_id', 'left')
			->order_by('vendor_profile.id','desc');
		foreach($keywords as $keyword)
			$this->db->or_like('vendor_profile.name', $keyword);
		return $this->db->get();

	}
}

// END OF vendor_model.php File