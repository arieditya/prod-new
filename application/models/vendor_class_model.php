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
		if(empty($id)) {
			return $this->db->last_query();
		}
		if(!empty($data_ext['class_category']))
			$this->db->insert('vendor_class_category', array(
				'class_id' 		=> $id,
				'category_id'	=> $data_ext['class_category']
			));
		if(!empty($data_ext['class_level'])){
			if(!is_array($data_ext['class_level'])) {
				$data_ext['class_level'] = array($data_ext['class_level']);
			}
			foreach($data_ext['class_level'] as $level) {
				$this->db->insert('vendor_class_level', array(
					'class_id' 		=> $id,
					'level_id'	=> $level
				));
			}
		}
		return $id;
	}

	public function update_class($data, $data_ext = array()) {
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

	public function get_class($var=null, $page=1, $perpage=5, $time='all') {
		$where = array(
				'class_status >='	=> 1,
				'active'		=> 1,
			);
		if($page==0 && $perpage==0){
			
		} else {
			$this->db->limit($perpage, ($page-1)*$perpage);
		}
		
//		if(is_string($var)){
//			$where[] = $var;
//		} else {
		if(!empty($var)) {
			$where = $var + $where;
		}
		
//		var_dump($where);exit;
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
		$where = array_filter($where, 'strlen');
//		}
		$this->db->join('vendor_class_category', 'vendor_class.id=vendor_class_category.class_id', 'left');
		$this->db->join('vendor_category_list', 'vendor_category_list.id=vendor_class_category.category_id AND vendor_category_list.status=1', 'left');
		$this->db->join('vendor_class_level', 'vendor_class.id=vendor_class_level.class_id', 'left');
		$this->db->join('vendor_level_list', 'vendor_level_list.id=vendor_class_level.level_id AND vendor_level_list.status=1', 'left');
		$this->db->join('vendor_class_price', 'vendor_class_price.class_id=vendor_class.id', 'left');
		$this->db->join('vendor_class_jadwal', 'vendor_class_jadwal.class_id=vendor_class.id', 'left');
        $this->db->join('lokasi', 'lokasi.lokasi_id=vendor_class.class_lokasi_id', 'left');
		$this->db->where($where);
        if($time == 'current')
            $this->db->where('class_tanggal >=','CURRENT_DATE()', false);
        elseif($time == 'past')
            $this->db->where('class_tanggal <','CURRENT_DATE()', false);

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
		$this->db->select('COUNT(`vendor_class_jadwal`.`jadwal_id`) AS `count_session`', TRUE);
		$this->db->select('MIN(`vendor_class_jadwal`.`class_tanggal`) AS `class_tanggal`');
		$this->db->select('vendor_class_jadwal.class_jam_mulai');
		$this->db->select('vendor_class_jadwal.class_menit_mulai');
		$this->db->select('vendor_class_jadwal.class_jam_selesai');
		$this->db->select('vendor_class_jadwal.class_menit_selesai');
		$this->db->select('vendor_class_price.discount');
		$this->db->select('vendor_class_price.price_per_session');
        $this->db->select('lokasi.lokasi_title');
        $this->db->order_by('vendor_class.id','DESC');
        $this->db->order_by('vendor_class_jadwal.class_tanggal','DESC');
		$this->db->group_by('vendor_class.id');
		$result = $this->db->get('vendor_class');
//		var_dump($this->db->last_query()); exit;
        return $result;
	}
	
	public function get_class_sort_by_next_open() {
		$q = "
		SELECT
			a.id, 
			MIN(b.class_tanggal) AS tgl
		FROM 
			vendor_class a
			LEFT JOIN vendor_class_jadwal b ON
				b.class_id = a.id
		WHERE 1 
				AND a.class_status <= 1
				AND a.active = 1
				AND a.id IS NOT NULL
				AND b.class_id IS NOT NULL
		GROUP BY b.class_id
		ORDER BY tgl ASC";
		$query = $this->db->query($q);
		$result = $query->result();
		$class = array();
		foreach($result as $row) {
			$cls = $this->get_class(array('id'=>$row->id))->row();
			if(!empty($cls)) $class[] = $cls;
		}
		return $class;
	}
	
	public function get_class_detail($var=null, $page=1, $perpage=5) {
		$class = $this->get_class($var, $page, $perpage)->row();
		unset($class->count_session);
		unset($class->class_tanggal);
		unset($class->class_jam_mulai);
		unset($class->class_jam_selesai);
		unset($class->class_menit_mulai);
		unset($class->class_menit_selesai);
		$jadwal = $this->get_class_schedule(array('class_id'=>$class->id))->result();
		
	}
	
	public function class_hits($id) {
		$query = "INSERT INTO vendor_class_hits VALUE ('{$id}', 1) ON DUPLICATE KEY UPDATE hits = VALUES(hits)+1";
		$this->db->query($query);
		return $this->db->affected_rows() == 1;
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
	
	public function remove_class_schedule($class_id) {
		$this->db->where('class_id', $class_id);
		$this->db->delete('vendor_class_jadwal');
	}

	public function add_class_schedule($class_id, $data){
		$data['class_id'] = $class_id;
		$this->db->insert('vendor_class_jadwal', $data);
//		var_dump($this->db->last_query());exit;
		return $this->db->insert_id();
	}
	
	public function add_update_class_schedule($sched){
		$count = $this->db
				->from('vendor_class_jadwal')
				->where(array(
						'class_id'=>$sched['class_id'],
						'jadwal_id'=>$sched['jadwal_id'],
				))->get()->num_rows();
		$jadwal_id = $sched['jadwal_id'];
		$class_id = $sched['class_id'];
		unset($sched['class_id']);
		unset($sched['jadwal_id']);
//		var_dump($sched);
		if($count) {
			return $this->update_class_schedule($jadwal_id, $sched);
		} else {
			return $this->add_class_schedule($class_id, $sched);
		}
	}

	public function update_class_schedule($sched_id, $data) {
		$this->db->where(array('jadwal_id' => $sched_id));
		$this->db->update('vendor_class_jadwal', $data);
		return $this->db->affected_rows();
	}
	public function clear_class_schedule($class_id) {
		$this->db->where(array('class_id' => $class_id));
		$this->db->delete('vendor_class_jadwal');
		return;
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
		$this->db->order_by('class_tanggal', 'ASC');
		return $this->db->get('vendor_class_jadwal');
	}
	
	public function get_class_schedule_participant($var) {
		$this->db->where($var);
		return $this->db->get('vendor_class_participant');
	}
	
	public function add_class_pemesan($data) {
		$this->db->where(array('email'=>$data['email']));
		$q = $this->db->get('vendor_class_pemesan');
		if(!$q->num_rows()) {
			$this->db->insert('vendor_class_pemesan', $data);
			return 	$this->db->insert_id();
		} else {
			return $q->row()->id;
		}
	}
	
	public function get_class_pemesan($id) {
		$this->db->where(array('id'=>$id));
		return $this->db->get('vendor_class_pemesan')->row();
	}
	
	public function add_class_peserta($data) {
		$this->db->where(array('email'=>$data['email']));
		$q = $this->db->get('vendor_class_student');
		if(!$q->num_rows()) {
			$this->db->insert('vendor_class_student', $data);
			return 	$this->db->insert_id();
		} else {
			return $q->row()->id;
		}
	}
	
	public function get_class_peserta($id) {
		$this->db->where(array('id'=>$id));
		return $this->db->get('vendor_class_student')->row();
	}
	
	public function get_class_schedule_availability($sched_id) {
		$class = $this->get_class_schedule(array('jadwal_id'=>$sched_id))->row();
		if(!empty($class)) $class_id = $class->class_id;
		else return 0;
//		var_dump($this->get_class(array('vendor_class.id'=>$class_id, 'active'=>NULL, 'class_status'=>NULL))->row());exit;
		$max = $this->get_class(array('id'=>$class_id,'active'=>NULL, 'class_status'=>NULL))->row()->class_peserta_max;
		$participant = $this->get_class_schedule_participant(array('jadwal_id'=>$sched_id,'status >'=>0))->num_rows();
		return $max-$participant;
	}
	
	public function get_class_attendance($class_id) {
		return @$this->db
				->distinct()
				->select('code')
				->where('class_id',$class_id)
				->where('status',4)
				->get('vendor_class_participant')
				->num_rows();
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
		$cat = $this->db->get('vendor_class_category')->row();
		if(empty($cat))
			return FALSE;
		$category_id = $cat->category_id;
		if(empty($category_id))
			return FALSE;
		return $this->db->where(array('id'=>$category_id))->get('vendor_category_list')->row();
	}
	
	public function add_class_category($class_id, $category_id) {
		if(!is_array($category_id)) $category_id = array($category_id);
		$affected_rows = 0;
		foreach($category_id as $cat){
			$this->db->insert('vendor_class_category', array('class_id'=>$class_id,'category_id'=>$cat));
			if($this->db->affected_rows()) $affected_rows++;
		}
		return count($category_id) == $affected_rows;
	}
	
	public function clear_class_category($class_id) {
		$this->db->delete('vendor_class_category', array('class_id'=>$class_id));
	}
	
	public function get_level($var = array()) {
		$this->db->where($var);
		$this->db->where(array('status'=>1));
		return $this->db->get('vendor_level_list');
	}
	
	public function get_level_name($var = array()) {
		$this->db->select('GROUP_CONCAT(name) as nama', FALSE);
		$this->db->where($var);
		$this->db->where(array('status'=>1));
//		$this->db->group_by('name');
		$level =  $this->db->get('vendor_level_list');
//		var_dump($level->row());exit;
		return $level;
	}
	
	public function get_class_multiple_level($class_id) {
		$level_id = $this->db
            ->select('GROUP_CONCAT(`level_id`) as level_ids', FALSE)
            ->where(array('class_id'=>$class_id))
            ->get('vendor_class_level')
            ->row()->level_ids;
		if(empty($level_id))
			return FALSE;
		$result = $this->db->where_in('id', explode(',',$level_id))->get('vendor_level_list')->result();
		$return = array();
		foreach($result as $rslt) {
			$return[$rslt->id] = $rslt;
		}
		return $return;
	}

	public function get_class_level($class_id) {
		$level = $this->db->where(array('class_id'=>$class_id))->get('vendor_class_level')->row();
		if(!empty($level)){
			$level_id = $level->level_id;
		}
		if(empty($level_id))
			return FALSE;
		return $this->db->where(array('id'=>$level_id))->get('vendor_level_list')->row();
	}
	
	public function add_class_level($class_id, $level_id) {
		if(!is_array($level_id)) $level_id = array($level_id);
		$affected_rows = 0;
		foreach($level_id as $lvl){
			$this->db->insert('vendor_class_level', array('class_id'=>$class_id,'level_id'=>$lvl));
			if($this->db->affected_rows()) $affected_rows++;
		}
		return count($level_id) == $affected_rows;
	}
	
	public function clear_class_level($class_id) {
		$this->db->delete('vendor_class_level', array('class_id'=>$class_id));
	}
	
	public function add_class_price($class_id, $data){
		if($this->db->where('class_id', $class_id)->get('vendor_class_price')->num_rows() > 0){
			$this->db->where('class_id', $class_id)->delete('vendor_class_price');
		}
		$include = $data['class_include'];
		unset($data['class_include']);
		$this->update_class(array('id'=>$class_id, 'class_include'=>$include), array());
		$data['class_id'] = $class_id;
		$this->db->insert('vendor_class_price', $data);
		return $this->db->affected_rows();
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
		$this->db->query("DELETE FROM vendor_class_tag WHERE class_id = ? AND tag_words = ?", array($id, $data));
		if($this->db->affected_rows() > 0) {
			$this->db->query("UPDATE vendor_tag_collections SET counter = counter - 1 WHERE tag_words = ?", array($data));
		}
	}
	
	public function get_tags($id) {
		$query = "
		SELECT GROUP_CONCAT(tag_words) AS tags FROM vendor_class_tag WHERE 1 AND class_id = ?
		";
		$result = $this->db->query($query, array($id));
		if(!empty($result) && $result->num_rows() > 0) {
			$tags = $result->row()->tags;
		} else {
			$tags = '';
		}
		return $tags;
	}
	
	public function set_published_class($id, $status){
		$status = (int) $status;
		$this->db->update('vendor_class', array('active'=>$status), array('id'=>$id));
		return !! $this->db->affected_rows();
	}
	
	public function set_status_class($id, $status){
		$status = (int) $status;
		$this->db->update('vendor_class', array('class_status'=>$status), array('id'=>$id));
		return !! $this->db->affected_rows();
	}
	
    public function get_status_class($id) {
        $query = "SELECT class_status, active FROM vendor_class WHERE id = ?";
        $result = $this->db->query($query, $id)->row();
        return $result;
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
		
		$exists = !!$this->db->where('class_id',$id)->get('vendor_class_featured')->num_rows();
		if(!$exists){
			$this->db->insert('vendor_class_featured', array(
				'class_id'		=> $id,
				'sort'			=> $sort,
				'active'		=> 1,
	//			'start_time'	=> $start,
	//			'end_time'		=> $end,
			));
			return $this->db->affected_rows();
		} else {
			return $this->reactivate_featured($id);
		}
		
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
	
	public function check_participant_class($class_id, $student_id) {
		return $this->db
				->select('code')
				->select('status')
				->distinct()
				->where('class_id', $class_id)
				->where('participant_id', $student_id)
				->from('vendor_class_participant')
		->get()->row();
		;
	}

	public function add_class_participant($class_id, $jadwal_id, $student_id, $pemesan_id, $code = NULL) {
		$test_code = $this->check_participant_class($class_id, $student_id);
		if(!empty($test_code)) {
			if(!empty($test_code->status) && (int)$test_code->status < 2 ){
				$code = $test_code->code;
			} else {
				return "BAD";
			}
		}
		if(empty($code)) {
			$hash = hashgenerator(6, 'safe',1);
			$code = $hash[0];
		}
		
		$this->db->insert('vendor_class_participant', array(
			'pemesan_id'		=> $pemesan_id,
			'participant_id'	=> $student_id,
			'class_id'			=> $class_id,
			'jadwal_id'			=> $jadwal_id,
			'status'			=> 1,
			'code'				=> $code
		));
		if(!!($this->db->affected_rows())) {
			$q =	$this->db
						 ->select('code')
						 ->where(array(
							'participant_id'	=> $student_id,
							'class_id'			=> $class_id,
							))
						 ->from('vendor_class_participant')
						 ->get()->row();
			if(!empty($q->code)) return $q->code;
			else return FALSE;
		}
		return $code;
	}
	
	public function get_class_participant($code) {
		$this->db->where(array('code'=>$code));
		return $this->db->get('vendor_class_participant');
	}
	
	public function get_transaction_all() {
		$trx = $this->db
			 ->get('vendor_class_transaction')->result();
		if(count($trx) == 0) return array();
		foreach($trx as &$t) {
			$t->student = $this->get_participant($t->student_id);
			$t->pemesan = $this->get_participant($t->pemesan_id);
			$t->status = $this->get_invoice_status($t->code);
		}
		return $trx;
	}
	
	public function get_invoice_status($code) {
		return $this->db->select('status')->distinct()->from('vendor_class_participant')->where('code', 
				$code)->get()->row()->status;
	}
	
	public function add_new_transaction($data) {
		$this->db->insert('vendor_class_transaction', $data);
		return !!$this->db->affected_rows();
	}
	
	public function update_transaction($code, $set) {
		$this->db->where(array('code'=>$code));
		$this->db->update('vendor_class_transaction', $set);
		return !!$this->db->affected_rows();
	}
	
	public function get_transaction($code){
		$this->db->where(array('code'=>$code));
		return $this->db->from('vendor_class_transaction')->get()->row();
	}
	
	public function remove_transaction($code){
		$this->db->where(array('code'=>$code));
		$this->db->delete('vendor_class_transaction');
		$this->db->where(array('code'=>$code));
		$this->db->delete('vendor_class_participant');
	}
	
	public function set_participant_status($code, $status) {
		$this->db->where(array('code'=>$code));
		$this->db->update('vendor_class_participant', array('status'=>$status));
		return $this->db->affected_rows();
	}
	
	public function get_class_empty_seat($class_id) {
		$seat = (int) @$this->db
				->select('class_peserta_max')
				->from('vendor_class')
				->where('id', $class_id)
				->get()
				->row()
				->class_peserta;
		$query =  "
	SELECT
		COUNT(*) AS participant
	FROM
		(SELECT DISTINCT 
			participant_id 
		FROM vendor_class_participant a
		WHERE 1 AND class_id = ?) b";
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
		if(is_array($data)) $data = (object) $data;
		if(empty($data)) $data = new StdClass;
		return $data->$k;
	}
	
	public function collect_transaction_data() {
		$var = array(
			'class_id'		=> 0,
			'jadwal'		=> array(),
			
		);
	}
	
	public function create_invoice($code) {
		$query = "
		SELECT 
			a.*,
			e.name AS pemesan_name,
			e.email AS pemesan_email,
			e.phone AS pemesan_phone,
			e.address AS pemesan_address,
			f.name AS murid_name,
			f.email AS murid_email,
			f.phone AS murid_phone,
			c.*,
			g.price_per_session,
			d.*
		FROM 
			vendor_class_transaction a
			LEFT JOIN vendor_class_participant b
				ON b.code = a.code
			LEFT JOIN vendor_class_pemesan e
				ON e.id = b.pemesan_id
			LEFT JOIN vendor_class_student f
				ON f.id = b.participant_id
			LEFT JOIN vendor_class c
				ON c.id = b.class_id
			LEFT JOIN vendor_class_price g
				ON g.class_id = c.id
			LEFT JOIN vendor_class_jadwal d
				ON d.jadwal_id = b.jadwal_id
		WHERE 1
			AND a.code = ?
		ORDER BY d.class_tanggal, d.class_jam_mulai
		";
		$class = array();
		foreach($this->db->query($query, array($code))->result() as $datas) {
			if(empty($class[$datas->class_id])) {
				$class[$datas->class_id] = array(
					'pemohon'		=> array(
						'name'			=> $datas->pemesan_name,
						'address'			=> $datas->pemesan_address,
						'email'			=> $datas->pemesan_email,
						'phone'			=> $datas->pemesan_phone,
					),
					'murid'			=> array(
						'name'			=> $datas->murid_name,
						'email'			=> $datas->murid_email,
						'phone'			=> $datas->murid_phone,
					),
					'kelas'			=> array(
						'name'			=> $datas->class_nama,
						'desc'			=> $datas->class_deskripsi,
						'include'		=> $datas->class_include,
						'catatan'		=> $datas->class_catatan,
						'image'			=> $datas->class_image,
						'lokasi'		=> $datas->class_lokasi,
						'peta'			=> $datas->class_peta,
						'transaksi' 	=> array(),
					),
					'subtotal'			=> $datas->subtotal,
					'discount'			=> $datas->discount,
					'total'				=> $datas->total,
				);
			}
			$class[$datas->class_id]['kelas']['transaksi'][] = array(
				'jadwal'		=> array(
					'tanggal'		=> date('d-M-Y', strtotime($datas->class_tanggal)),
					'mulai'			=> date('H:i:s', strtotime($datas->class_tanggal.' '.$datas->class_jam_mulai.':'.$datas->class_menit_mulai)),
					'selesai'		=> date('H:i:s', strtotime($datas->class_tanggal.' '.$datas->class_jam_selesai.':'.$datas->class_menit_selesai)),
				),
				'topik'			=> $datas->class_jadwal_topik,
				'harga'			=> $datas->price_per_session
			);
		}
		return $class;	}
	
	public function invalidate_invoice() {
		
	}
	
	public function set_confirm_payment_transfer($code) {
		$admin_id = $this->CI->session->userdata('admin_id');
		if($admin_id == 1) {
			show_error('ONLY ADMIN WITH PERSONAL ADMIN ACCOUNT CAN CONFIRM! Ask aried!', 400);
			return;
		}
		$this->db
			 ->update(
					'vendor_class_transaction', 
					array(
						'status_4'			=> date('Y-m-d H:i:s'),
						'status_4_approval'	=> $admin_id
					),
					array('code'=>$code)
				);
		if(!!$this->db->affected_rows()) {
			$this->db->update(
				'vendor_class_participant',
				array(
					'status'	=> 4
				),
				array(
					'code'		=> $code
				)
			);
			return !! $this->db->affected_rows();
		}
		return FALSE;
	}
	
	public function get_confirm_payment_transfer() {
		$codes = $this->db
				->select('code')
				->distinct()
				->where('status', 3)
				->get('vendor_class_participant')->result();
		if(count($codes) == 0) return array();
		$result = array();
		foreach($codes as $code) {
			$code = $code->code;
			$trx = $this->get_transaction($code);
			$bank_from = ((int)$trx->status_3_bank_from)==0?
					$trx->status_3_bank_from_other:
					$this->get_bank($trx->status_3_bank_from);
			$trx->bank_from =  $bank_from;
			$trx->bank_to =  $this->get_bank($trx->status_3_bank_to);
			$result[$code] = $trx;
		}
		return $result;
	}
	
	public function get_class_from_invoice($code) {
		$cls = $this->db->select('class_id')->from('vendor_class_participant')->where('code', $code)->get()->result();
		$class = array();
		foreach($cls as $cl) {
			$class[] = $cl->class_id;
		}
		return $class;
	}
	
	public function get_bank($id) {
		$bank = $this->db->where('bank_id', $id)->get('bank')->row();
		return empty($bank)?'':$bank->bank_title;
	}
	
	public function get_class_participant_full($class_id=0, $status=4) {
		$query = "
		SELECT DISTINCT 
			pemesan_id,
			b.name AS nama_pemesan,
			b.email AS email_pemesan,
			b.phone AS phone_pemesan,
			b.address AS alamat_pemesan,
			c.name AS nama_peserta,
			c.email AS email_peserta,
			c.phone AS phone_peserta,
			participant_id as peserta_id,
			a.status
		FROM
			vendor_class_participant a
			LEFT JOIN vendor_class_pemesan b
			ON b.id = a.pemesan_id
			LEFT JOIN vendor_class_student c
			ON c.id = a.participant_id
		WHERE 1
";
		if(!empty($class_id)) $query .="
			AND a.class_id = ?";
		if(!empty($status)) {
			if(is_numeric($status))
				$query .="
			AND a.status = ?";
			elseif(is_string($status))
				$query .= "
			AND a.status {$status}";
		}
		$query .= "
		ORDER BY a.class_id ASC, a.pemesan_id ASC, a.participant_id ASC, a.status ASC";
		return $this->db->query($query, array($class_id, $status));
	}
	
	public function get_class_sponsor_full($class_id, $status=4) {
		$query = "
		SELECT DISTINCT 
			pemesan_id,
			b.name AS nama_pemesan,
			b.email AS email_pemesan,
			b.phone AS phone_pemesan,
			b.address AS alamat_pemesan
		FROM
			vendor_class_participant a
			LEFT JOIN vendor_class_pemesan b
			ON b.id = a.pemesan_id
			LEFT JOIN vendor_class_student c
			ON c.id = a.participant_id
		WHERE 1
			AND a.class_id = ?
";
		if(!empty($status)) $query .="
			AND a.status = ?";
		return $this->db->query($query, array($class_id, $status));
	}
	
	public function get_class_attendance_full($class_id, $status=4) {
		$query = "
		SELECT DISTINCT 
			participant_id as peserta_id,
			c.name AS nama_peserta,
			c.email AS email_peserta,
			c.phone AS phone_peserta
		FROM
			vendor_class_participant a
			LEFT JOIN vendor_class_student c
			ON c.id = a.participant_id
		WHERE 1
			AND a.class_id = ?
";
		if(!empty($status)) $query .="
			AND a.status = ?";
		return $this->db->query($query, array($class_id, $status));
	}
	
	public function get_class_per_sched_participant_full($class_id, $status=4) {
		$query = "
		SELECT 
 			pemesan_id,
 			b.name AS nama_pemesan,
 			b.email AS email_pemesan,
 			b.phone AS phone_pemesan,
 			b.address AS alamat_pemesan,
			participant_id as peserta_id,
			c.name AS nama_peserta,
			c.email AS email_peserta,
			c.phone AS phone_peserta,
			d.jadwal_id,
			CONCAT(d.class_tanggal,' ', d.class_jam_mulai,':',d.class_menit_mulai,' - ', d.class_jam_selesai,':',d.class_menit_selesai) AS jadwal_waktu,
			d.class_jadwal_topik AS topik
		FROM
			vendor_class_participant a
 			LEFT JOIN vendor_class_pemesan b
 			ON b.id = a.pemesan_id
			LEFT JOIN vendor_class_student c
			ON c.id = a.participant_id
			LEFT JOIN vendor_class_jadwal d
			ON d.jadwal_id = a.jadwal_id
		WHERE 1
			AND a.class_id = ?
";
		if(!empty($status)) $query .="
			AND a.status = ?";
		$query .= "
		ORDER BY d.jadwal_id ASC";
		return $this->db->query($query, array($class_id, $status));
	}
	
	public function get_participant($id) {
		return $this->db->from('vendor_class_student')->where('id', $id)->get()->row();
	}

	public function get_sponsor($id) {
		return $this->db->from('vendor_class_pemesan')->where('id', $id)->get()->row();
	}
	
	public function get_participant_all() {
		$results = $this->db->from('vendor_class_student')->get()->result();
		$ret = array();
		foreach($results as $result) {
			$ret[$result->id] = $result;
		}
		return $ret;
	}

	public function get_sponsor_all() {
		$results = $this->db->from('vendor_class_pemesan')->get()->result();
		$ret = array();
		foreach($results as $result) {
			$ret[$result->id] = $result;
		}
		return $ret;
	}
	
	public function get_sent_message($class_id, $email_id = NULL) {
		if(!empty($email_id))
			return $this->db->where(array('class_id'=>$class_id,'id'=>$email_id))->get('vendor_class_message')->row();
		return $this->db->where('class_id', $class_id)->get('vendor_class_message')->result();
	}
	
	public function get_new_invoice_data($code) {
		$transaction = $this->db
				->where('code',$code)
				->get('vendor_class_transaction')->row();
		$participants = $this->db
				->where('code',$code)
				->get('vendor_class_participant')->result();
		$class = array();
		$peserta = NULL;
		$pemohon = NULL;
		foreach($participants as $participant) {
			if(empty($peserta)) {
				$peserta = $this->db
						->where('id', $participant->participant_id)
						->get('vendor_class_student')->row();
			}
			if(empty($pemohon)) {
				$pemohon = $this->db
						->where('id', $participant->pemesan_id)
						->get('vendor_class_pemesan')->row();
			}
			if(empty($class[$participant->class_id])) {
				$class_data = $this->db
						->where('id', $participant->class_id)
						->join('vendor_class_price', 'vendor_class_price.class_id = vendor_class.id', 'left')
						->get('vendor_class')->row();
				$vendor = $this->db
						->where('id', $class_data->vendor_id)
						->get('vendor_profile')->row();
				$class[$participant->class_id] = array(
					'profile'	=> $class_data,
					'vendor'	=> $vendor,
					'jadwal'	=> array()
				);
			}
			$jadwal = $this->db
				->where('jadwal_id', $participant->jadwal_id)
				->get('vendor_class_jadwal')->row();
			$class[$participant->class_id]['jadwal'][] = $jadwal;
			
		}
		return array(
			'transaction'	=> $transaction,
			'peserta'		=> $peserta,
			'pemohon'		=> $pemohon,
			'class'			=> $class
		);
	}
}

// END OF vendor_class_model.php File