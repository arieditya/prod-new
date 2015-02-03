<?php if(!defined('BASEPATH')) die('Die already!');
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 10/9/14
 * Time: 3:58 PM
 * Proj: private-development
 */
class Vendor_class_model extends MY_Model{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function add_new_class($data, $data_ext) {
		$this->db->insert('vendor_class', $data);
		$id = $this->db->insert_id();
		if(!empty($data_ext['class_category']))
			$this->db->insert('vendor_class_category', array(
				'class_id' 		=> $id,
				'category_id'	=> $data_ext['class_category']
			));
		if(!empty($data_ext['class_level']))
			$this->db->insert('vendor_class_level', array(
				'class_id' 		=> $id,
				'level_id'	=> $data_ext['class_level']
			));
		return $id;
	}

	public function update_class($data, $data_ext) {
		$id = $data['id'];
		unset($data['id']);
		$this->db->where('id', $id);
		$this->db->update('vendor_class', $data);
		if(!empty($data_ext['class_category']))
			if($this->db->where('class_id', $id)->get('vendor_class_category')->num_rows() == 1) {
				$this->db->where('class_id', $id);
				$this->db->update('vendor_class_category', array(
					'category_id'	=> $data_ext['class_category']
				));
			} else {
				$this->db->insert('vendor_class_category', array(
					'class_id' 		=> $id,
					'category_id'	=> $data_ext['class_category']
				));
			}
		if(!empty($data_ext['class_level']))
			if($this->db->where('class_id', $id)->get('vendor_class_level')->num_rows() == 1) {
				$this->db->where('class_id', $id);
				$this->db->update('vendor_class_level', array(
					'level_id'	=> $data_ext['class_level']
				));
			} else {
				$this->db->insert('vendor_class_level', array(
					'class_id' 		=> $id,
					'level_id'	=> $data_ext['class_level']
				));
			}
		return $id;
	}

	public function get_class($var=null) {
		$where = array(
				'class_status'	=> 1,
				'active'		=> 1
			);
//		if(is_string($var)){
//			$where[] = $var;
//		} else {
		if(!empty($var)) {
			$where = $var + $where;
		}
//		var_dump($where);
		if(!empty($where['id'])) {
			if(is_array($where['id'])) {
				$wherein['vendor_class.id'] = $where['id'];
			} else {
				$where['vendor_class.id'] = $where['id'];
			}
			unset($where['id']);
		}
		if(!empty($where['category_id'])) {
			$where['vendor_class_category.category_id'] = $where['category_id'];
			unset($where['category_id']);
		}
		if(!empty($where['level_id'])) {
			$where['vendor_class_level.level_id'] = $where['level_id'];
			unset($where['level_id']);
		}
//		}
		$where = array_filter($where);
//		}
		$this->db->join('vendor_class_category', 'vendor_class.id=vendor_class_category.class_id', 'left');
		$this->db->join('vendor_category_list', 'vendor_category_list.id=vendor_class_category.category_id AND vendor_category_list.status=1', 'left');
		$this->db->join('vendor_class_level', 'vendor_class.id=vendor_class_level.class_id', 'left');
		$this->db->join('vendor_level_list', 'vendor_level_list.id=vendor_class_level.level_id AND vendor_level_list.status=1', 'left');
		$this->db->join('vendor_class_price', 'vendor_class_price.class_id=vendor_class.id', 'left');
		$this->db->join('vendor_class_jadwal', 'vendor_class_jadwal.class_id=vendor_class.id', 'left');
		$this->db->where($where);
		if(!empty($wherein)) {
			foreach($wherein as $k=>$v)
				$this->db->where_in($k, $v);
		}
		$this->db->select('vendor_class.*');
		$this->db->select('vendor_class_category.category_id');
		$this->db->select('vendor_category_list.category_name');
		$this->db->select('vendor_category_list.category_description');
		$this->db->select('vendor_class_level.level_id');
		$this->db->select('vendor_level_list.name');
		$this->db->select('vendor_level_list.nama');
		$this->db->select('vendor_class_price.price_per_session');
		$this->db->select('vendor_class_jadwal.class_tanggal');
		$this->db->select('vendor_class_jadwal.class_jam_mulai');
		$this->db->select('vendor_class_jadwal.class_menit_mulai');
		$this->db->select('vendor_class_price.discount');
		$this->db->select('vendor_class_price.price_per_session');
		$this->db->group_by('vendor_class.id');
		$result = $this->db->get('vendor_class');
//		$lq = $this->db->last_query();
//		var_dump($lq);exit;
		return $result;
	}
	
	public function check_uri($title) {
		$this->CI->load->helper('url');
		$title = url_title(strtolower($title));
		$this->db->where('class_uri', strtolower($title));
		$count = $this->db->get('vendor_class')->num_rows();
		if($count == 1) {
			$breakit = explode('-', $title);
			$last = array_pop($breakit);
			if(is_numeric($last)) {
				$last = ((int) $last ) + 1;
			} else {
				$breakit[] = $last;
				$last = 1;
			}
			$breakit[] = $last;
			return $this->check_uri(implode('-', $breakit));
		} else {
			return $title;
		}
	}

	public function add_class_schedule($class_id, $data){
		$data['class_id'] = $class_id;
		$this->db->insert('vendor_class_jadwal', $data);
		return $this->db->insert_id();
	}

	public function update_class_schedule($sched_id, $data) {
		$this->db->where(array('jadwal_id' => $sched_id));
		$this->db->update('vendor_class_jadwal', $data);
		return $this->db->affected_rows();
	}
	
	public function check_schedule_exists($class_id, $sched_id) {
		return $this->db
				->where(array('jadwal_id'=>$sched_id, 'class_id'=>$class_id))
				->get('vendor_class_jadwal')
				->num_rows() == 1;
	}
	
	public function delete_class_schedule($sched_id) {
		$this->db->where(array('jadwal_id' => (int)$sched_id));
		$this->db->delete('vendor_class_jadwal');
	}

	public function get_class_schedule($var) {
		$this->db->where($var);
		return $this->db->get('vendor_class_jadwal');
	}

	public function add_class_gallery($class_id, $data) {
		$data['class_id'] = $class_id;
		$this->db->insert('vendor_class_gallery', $data);
		return $this->db->insert_id();
	}
	
	public function delete_class_gallery($class_id, $galery_id) {
		$data['class_id'] = $class_id;
		$data['galeri_id'] = $galery_id;
		$this->db->delete('vendor_class_gallery', $data);
	}
	
	public function get_class_gallery($var) {
		$this->db->where($var);
		return $this->db->get('vendor_class_gallery');
	}

	public function add_class_review($class_id, $data) {
		$data['class_id'] = $class_id;
		$this->db->insert('vendor_class_review', $data);
		return $this->db->insert_id();
	}

	public function get_class_review($var) {
		$this->db->join('murid','murid.murid_id=vendor_class_review.murid_id', 'left');
		$this->db->where($var);
		return $this->db->get('vendor_class_review');
	}

	public function add_class_rating($class_id, $data) {
		$data['class_id'] = $class_id;
		$this->db->insert('vendor_class_rating', $data);
		return $this->db->insert_id();
	}

	public function get_class_rating($class_id) {
		$this->db->select_sum('rate_value', 'rate');
		$this->db->select('COUNT(*) AS counter', FALSE);
		$this->db->where(array('class_id'=>$class_id));
		return $this->db->get('vendor_class_rating');
	}
	
	public function get_category_list(){
		$this->db->where(array('status'=>1));
		return $this->db->get('vendor_category_list');
	}
	
	public function get_class_level_list() {
		$this->db->where(array('status'=>1));
		return $this->db->get('vendor_level_list');
	}
	
	public function get_category($var = array()){
		$this->db->where($var);
		$this->db->where(array('status'=>1));
		return $this->db->get('vendor_category_list');
	}
	
	public function get_class_category($class_id) {
		$this->db->where(array('class_id'=>$class_id));
		$category_id = $this->db->get('vendor_class_category')->row()->category_id;
		if(empty($category_id))
			return FALSE;
		return $this->db->where(array('id'=>$category_id))->get('vendor_category_list')->row();
	}
	
	public function get_level($var = array()) {
		$this->db->where($var);
		$this->db->where(array('status'=>1));
		return $this->db->get('vendor_level_list');
	}
	
	public function get_class_level($class_id) {
		$level_id = $this->db->where(array('class_id'=>$class_id))->get('vendor_class_level')->row()->level_id;
		if(empty($level_id))
			return FALSE;
		return $this->db->where(array('id'=>$level_id))->get('vendor_level_list')->row();
	}
	
	public function add_class_price($class_id, $data){
		if($this->db->where('class_id', $class_id)->get('vendor_class_price')->num_rows() > 0){
			$this->db->where('class_id', $class_id)->delete('vendor_class_price');
		}
		$include = $data['include'];
		unset($data['include']);
		$this->update_class(array('id'=>$class_id, 'class_include'=>$include), array());
		$data['class_id'] = $class_id;
		$this->db->insert('vendor_class_price', $data);
		return !! $this->db->affected_rows();
	}
	
	public function get_price($vars) {
		$this->db->where($vars);
		return $this->db->get('vendor_class_price');
	}
	
	public function set_tags($id, $data) {
		$data = strtolower($data);
		$this->db->query("INSERT IGNORE INTO vendor_class_tag VALUE (?,?)", array($id, $data));
		if($this->db->affected_rows() > 0) {
			$this->db->query("
			INSERT INTO vendor_tag_collections VALUE (?, 1)
			ON DUPLICATE KEY UPDATE counter = counter + 1
			", array($data));
		}
	}
	
	public function delete_tags($id, $data) {
		$data = strtolower($data);
		$this->db->query("DELETE FROM vendor_class_tag WHERE vendor_id = ? AND tag_words = ?", array($id, $data));
		if($this->db->affected_rows() > 0) {
			$this->db->query("UPDATE vendor_tag_collections SET counter = counter - 1 WHERE tag_words = ?", array($data));
		}
	}
	
	public function get_tags($id) {
		$query = "
		SELECT GROUP_CONCAT(tag_words) AS tags FROM vendor_class_tag WHERE 1 AND vendor_id = ?
		";
		$result = $this->db->query($query, array($id))->row();
		if(empty($result)) {
			$tags = '';
		} else {
			$tags = $result->tags;
		}
		return $tags;
	}
	
	public function set_published_class($id, $status){
		$status = (int) $status;
		$this->db->update('vendor_class', array('active'=>$status), array('id'=>$id));
		return !! $this->db->affected_rows();
	}
	
	public function get_id_by_uri($uri) {
		$return = $this->db->select('id')->from('vendor_class')->where('class_uri', $uri)->get()->row();
		if(!empty($return->id)) return $return->id;
		return FALSE;
	}

	public function get_featured_id() {
		$featured = 
			$this->db
				->select('class_id')
				->from('vendor_class_featured')
				->where('active', 1)
//				->where('start_time', ' <= '. time())
//				->where('end_time', ' >= '. time())
				->order_by('sort','ASC')
				->get()
				->result();
		$k = array_fill(0, count($featured), 'class_id');
		return array_map(array($this, '_get_value'), $k, $featured);
	}

	public function set_featured_id($id, $sort = 0) {
		$this->db->insert('vendor_class_featured', array(
			'class_id'		=> $id,
			'sort'			=> $sort,
			'active'		=> 1,
//			'start_time'	=> $start,
//			'end_time'		=> $end,
		));
		return $this->db->affected_rows();
	}

	public function deactivate_featured($id) {
		$this->db->update('vendor_class_featured', array('active'=>0), array('class_id'=>$id));
		return $this->db->affected_rows();
	}
	public function reactivate_featured($id) {
		$this->db->update('vendor_class_featured', array('active'=>1), array('class_id'=>$id));
		return $this->db->affected_rows();
	}
	public function set_sort_featured($id, $sort) {
		$this->db->update('vendor_class_featured', array('sort'=>$sort), array('class_id'=>$id));
		return $this->db->affected_rows();
	}

	public function add_class_participant($class_id, $student_id, $jadwal_id) {
		$this->db->insert('vendor_class_participant', array(
			'student_id'	=> $student_id,
			'class_id'		=> $class_id,
			'jadwal_id'		=> $jadwal_id,
		));
	}

	public function get_class_empty_seat($class_id) {
		$seat = (int) @$this->db
				->select('class_peserta')
				->from('vendor_class')
				->where('id', $class_id)
				->get()
				->row()
				->class_peserta;
		$query =  "SELECT COUNT(student_id) AS participant FROM vendor_class_participant WHERE 1 AND class_id = ?";
		$participant = (int) @$this->db
				->query($query, $class_id)
				->row()
				->participant;
		return $seat - $participant;
	}

	public function is_one_shot_class($class_id) {
		$query = "SELECT COUNT(*) AS cnt FROM vendor_class_jadwal WHERE class_id = ?";
		$cnt = (int) @$this->db
				->query($query, $class_id)
				->row()
				->cnt;
		return $cnt == 1 ? TRUE : FALSE;
	}
	
	public function get_one_shot() {
		$query = "SELECT class_id FROM (SELECT class_id, COUNT(*) AS cnt FROM vendor_class_jadwal GROUP BY class_id) AS x WHERE cnt = 1";
		$result = $this->db->query($query)->result();
		$key = array_fill(0, count($result), 'class_id');
		return array_map(array($this, '_get_value'), $key, $result);
	}
	
	public function get_in_price_range($lo, $hi) {
		$query = "
		SELECT 
			a.id,
			(COUNT(b.class_id) * a.class_harga) AS total_price
		FROM 
			vendor_class a
			LEFT JOIN vendor_class_jadwal b
				ON a.id = b.class_id
		WHERE 1
			AND b.class_tanggal >= DATE(NOW())
		GROUP BY b.class_id
		HAVING total_price >= {$lo} AND total_price <= {$hi} ";
		$result = $this->db->query($query)->result();
		if(count($result) == 0) return array();
		$key = array_fill(0, count($result), 'id');
		return array_map(array($this, '_get_value'), $key, $result);
	}
	
	public function get_upcoming() {
		$query = "
		SELECT
			a.id,
			MIN(b.class_tanggal) as first_class
		FROM
			vendor_class a
			LEFT JOIN vendor_class_jadwal b
				ON b.class_id = a.id
		GROUP BY a.id
		HAVING first_class >= DATE(NOW())";
		$result = $this->db->query($query)->result();
		$key = array_fill(0, count($result), 'id');
		return array_map(array($this, '_get_value'), $key, $result);
	}

	public function get_ongoing() {
		$query = "
		SELECT
			a.id,
			MIN(b.class_tanggal) as first_class,
			MAX(b.class_tanggal) as last_class
		FROM
			vendor_class a
			LEFT JOIN vendor_class_jadwal b
				ON b.class_id = a.id
		GROUP BY a.id
		HAVING 
			first_class <= DATE(NOW())
			AND last_class >= DATE(NOW())
		";
		$result = $this->db->query($query)->result();
		$key = array_fill(0, count($result), 'id');
		return array_map(array($this, '_get_value'), $key, $result);
	}
	public function get_past() {
		$query = "
		SELECT
			a.id,
			MAX(b.class_tanggal) as last_class
		FROM
			vendor_class a
			LEFT JOIN vendor_class_jadwal b
				ON b.class_id = a.id
		GROUP BY a.id
		HAVING last_class < DATE(NOW())
		";
		$result = $this->db->query($query)->result();
		$key = array_fill(0, count($result), 'id');
		return array_map(array($this, '_get_value'), $key, $result);
	}

	public function get_filtered_class($var) {
		$where = '';
		$classes = array();
		if(!empty($var['oneshot'])) {
			$classes = array_merge($classes, $this->get_one_shot());
//			$where .= ' AND a.id IN ( '.implode(',',$classes).' ) ';
		}
		if(!empty($var['category'])) {
			if(!is_array($var['category'])) {
				$category = $var['category'];
				$var['category'] = array($category);
			}
			$where .= ' AND b.category_id IN ( '.implode(',', $var['category']). ' ) ';
		}
		if(!empty($var['level'])) {
			$where .= ' AND c.level_id = ' . (int) $var['level'];
		}
		if(!empty($var['price'])) {
			$classes = array_merge($classes, $this->get_in_price_range($var['price']['lo'],$var['price']['hi']));
//			$where .= ' AND a.id IN ( '.implode(',',$classes2).' ) ';
		}
		if(!empty($var['upcoming'])){
			$classes = array_merge($classes, $this->get_upcoming());
//			$where .= ' AND a.id IN ( '.implode(',',$classes).' ) ';
		}elseif(!empty($var['ongoing'])){
			$classes = array_merge($classes, $this->get_ongoing());
//			$where .= ' AND a.id IN ( '.implode(',',$classes).' ) ';
		}elseif(!empty($var['past'])){
			$classes = array_merge($classes, $this->get_past());
//			$where .= ' AND a.id IN ( '.implode(',',$classes).' ) ';
		}
		if(!empty($classes)) {
			$classes = array_unique($classes);
			$where .= ' AND a.id IN ( '.implode(',',$classes).' ) ';
		}
		$query = "
		SELECT DISTINCT
			a.id
		FROM
			vendor_class a
			LEFT JOIN vendor_class_category b
				ON b.class_id = a.id
			LEFT JOIN vendor_class_level c 
				ON c.class_id = a.id
			LEFT JOIN vendor_class_jadwal d
				ON d.class_id = a.id
		WHERE 1
		" . $where;
		$result = $this->db->query($query)->result();
		if(count($result) == 0) return array();
		$key = array_fill(0, count($result), 'id');
		return array_map(array($this, '_get_value'), $key, $result);
	}
	
	public function get_class_available_session($class_id) {
		$query = "
		SELECT
			*
		FROM
			vendor_class_jadwal
		WHERE 1
			AND class_waktu = 1
			AND class_id = ?
			AND class_tanggal > DATE(NOW())
		";
		return $this->db->query($query, array($class_id));
	}
	
	protected function _get_value($k, $data) {
		return $data->$k;
	}
}

// END OF vendor_class_model.php File