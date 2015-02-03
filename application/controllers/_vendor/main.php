<?php if(!defined('BASEPATH')) die('Die already!');
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 10/8/14
 * Time: 1:21 PM
 * Proj: private-development
 */
class Main extends MY_Controller{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index() {
		$this->load->view('vendor/landing');
	}
}

// END OF main.php File