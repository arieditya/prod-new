<?php if(!defined('BASEPATH')) die('Die already!');
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 2/23/15
 * Time: 1:14 PM
 * Proj: prod-new
 */
class Sitemap extends MY_Controller{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index() {
		error_reporting(E_ALL);
		$force_update = FALSE;
		if(isset($_GET['refresh'])) {
			$force_update = TRUE;
		}
		$key = 'sitemap.xml';
		if($force_update || ($urls = get_cache($key)) === FALSE) {
			$this->load->model('guru_model');
			$guru = $this->guru_model->sitemap_guru($force_update);
			$this->config->load('sitemaps');
			$urls = $this->config->item('sitemap');
			
			$this->config->load('catalogue');
			$catalog_pages = $this->config->item('catalogue_pages');
	
			foreach($catalog_pages as $catalog_page) {
				foreach($catalog_page as $page_key => $pages) {
					if($page_key === 'title') continue;
					$pg = '';
					foreach($pages as $key => $page) {
						if($key === 'title') continue;
						$pg.=$page.'/';
					}
					$urls['urls'][] = array(
						'loc'		=> 'cari/'.$pg
					);
	//				$pg = trim($pg, '/');
				}
			}
			
			foreach($guru as $id=>$nulled) {
				$urls['urls'][] = array(
					'loc'		=> 'guru/view/'.$id
				);
			}
		}
		
		$data = array(
			'urls'	=> array(
							array(
								'loc'			=> base_url().'main/page',
								'changefreq'	=> 'monthly',
								'priority'		=> 0.9
							)
						)
		);
		header('Content-type: text-xml');
		$this->load->view('general/sitemap', $urls);
	}
}

// END OF sitemap.php File