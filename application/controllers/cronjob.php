<?php if(!defined('BASEPATH')) die('Die already!');
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 3/30/15
 * Time: 1:26 PM
 * Proj: prod-new
 */
class Cronjob extends MY_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('vendor_model');
		$this->load->model('vendor_class_model');
		$this->load->model('payment_model');
		
	}
	
	public function list_transaction_today() {
		
	}
	
	public function status_1_expire() {
		$this->payment_model->status_1_expire();
	}
	
	public function invoice_expire() {
		$this->payment_model->invoice_expire();
	}
	
	public function get_status_1() {
		var_dump(get_custom_log('status_1_expire', '2015-03-30'));
	}
}

// END OF cronjob.php File