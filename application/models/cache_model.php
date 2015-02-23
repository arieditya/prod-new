<?php if(!defined('BASEPATH')) die('Die already!');
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 2/23/15
 * Time: 5:42 PM
 * Proj: prod-new
 */
class Cache_model extends MY_Model{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function set_cache($key, $data) {
		$serialized = serialize($data);
		$compressed = gzcompress($serialized);
		$this->db->delete('cache', array('key'=>$key));
		$this->db->insert('cache', array(
			'key'				=> $key,
//			'data_serialized'	=> $serialized,
			'data_compressed'	=> $compressed
		));
	}
	public function get_cache($key) {
		$data = $this->db->get_where('cache', array('key'=>$key));
		if($data->num_rows() == 0) return FALSE;
//		return unserialize($data->row()->data_serialized);
		return unserialize(gzuncompress($data->row()->data_compressed));
	}
	
}

// END OF cache_model.php File