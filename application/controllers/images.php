<?php if(!defined('BASEPATH')) die('Die already!');
/**
 * Created by :
 * 
 * User: AndrewMalachel
 * Date: 10/20/14
 * Time: 8:53 AM
 * Proj: private-development
 */
class Images extends MY_Controller{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function _remap() {
		ini_set('memory_limit','512M');
		$url = $this->uri->ruri_string();
		$url_split = explode('/', $url);
		$file = array_pop($url_split);
//		var_dump($file);
		$this->load->helper('file');
		$mime = get_mime_by_extension($file);
		$mimes = explode('/',$mime);
		if($mimes[0] !='image') {
			show_404();
		}
//		var_dump($mime);
		$file_parts = explode('.', $file);
		if(count($file_parts)<3) {
			show_404();
		}
		$file_ext = array_pop($file_parts);

		$file_size = array_pop($file_parts);

		$treatment = 'r';
		if($file_parts > 2) {
			// if C: crop, if K: keep aspect ratio
			if(in_array($file_size, array('c','k'))) {
				$treatment = $file_size;
				$file_size = array_pop($file_parts);
			}
		}

		$realfile = implode('.', $file_parts).'.'.$file_ext;
		$tempfile = implode('.', $file_parts).'.temp.'.$file_ext;
//		var_dump($realfile);
		$realpath = str_replace('\\', '/', rtrim(FCPATH,'/\\').(implode('/', $url_split)).'/'.$realfile);
		$temppath = str_replace('\\', '/', rtrim(FCPATH,'/\\').(implode('/', $url_split)).'/'.$tempfile);
		$new_path = str_replace('\\', '/', rtrim(FCPATH,'/\\').(implode('/', $url_split)).'/'.$file);
		if(!file_exists($realpath)){
			show_404();
		}
		$image_size = getimagesize($realpath);

		$sizes = explode('x', $file_size);
		if(count($sizes) !== 2 ) {
			show_404();
		}
		if(empty($sizes[0])){
			$img_ratio = $sizes[1]/100;
			$sizes = array(
				(int)floor($image_size[0]*$img_ratio),
				(int)floor($image_size[1]*$img_ratio)
			);
			$vars = array(
				'image_library'		=> 'gd2',
				'source_image'		=> $realpath,
	//			'dynamic_output'	=> TRUE,
				'new_image'			=> $new_path,
				'width'				=> $sizes[0],
				'height'			=> $sizes[1],
				'maintain_ratio'	=> $treatment=='k',
				'quality'			=> "100"
			);
			$this->load->library('image_lib', $vars);
			$method = $treatment=='c'?'crop':'resize';
			$this->image_lib->{$method}();
		} else {
			// $sizes[0] = width
			// $sizes[1] = height

			//// IMAGE RATIO
			// image ratio akhir
		$generated_img_ratio = $sizes[0]/$sizes[1];
		
			// image ratio asli
			$original_img_ratio = $image_size[0]/$image_size[1];

			//// ORIENTATION
			// anggap orientation asli awal adalah landscape
			$original_orientation = 1; // 1 = landscape, 0=potrait
			// panjang < tinggi ~> potrait
			if($original_img_ratio < 1) $original_orientation = 0; 
			// anggap orientation generated awal adalah landscape
			$generated_orientation = 1; // 1 = landscape, 0=potrait
			// panjang < tinggi ~> potrait
			if($generated_img_ratio < 1) $generated_orientation = 0; 
			
			if($original_orientation != $generated_orientation) {
				// anggap asli nya landscape, berarti generated = potrait. ambil height nya
				// => height asli di convert ke height generated
				if($original_orientation) {
					$temp_ratio = $sizes[1] / $image_size[1];
					$temp_img_ratio = array(
						floor($image_size[0]*$temp_ratio),
						$sizes[1]
					);
					$diff = floor(($sizes[0]-floor($image_size[0]*$temp_ratio))/2);
					$axis = 'x_axis';
				// anggap asli nya potrait, berarti generated = landscape. ambil width nya
				// => width asli di convert ke width generated
				} else {
					$temp_ratio = $sizes[0] / $image_size[0];
					$temp_img_ratio = array(
						$sizes[0],
						floor($image_size[1]*$temp_ratio)
					);
					$diff = floor(($sizes[1]-floor($image_size[1]*$temp_ratio))/2);
					$axis = 'y_axis';
				}
				if(!is_file($temppath)) {
					$vars = array(
						'image_library'		=> 'gd2',
						'source_image'		=> $realpath,
			//			'dynamic_output'	=> TRUE,
						'new_image'			=> $temppath,
						'width'				=> $temp_img_ratio[0],
						'height'			=> $temp_img_ratio[1],
						'maintain_ratio'	=> FALSE,
						'quality'			=> "100"
					);
					$this->load->library('image_lib', $vars);
					$resize = $this->image_lib->resize();
					$this->image_lib->clear();
				} else {
					$vars = array(
						'image_library'		=> 'gd2',
						'source_image'		=> $temppath,
			//			'dynamic_output'	=> TRUE,
						'new_image'			=> $new_path,
						'width'				=> $sizes[0],
						'height'			=> $sizes[1],
						'maintain_ratio'	=> FALSE,
						'quality'			=> "100",
						$axis				=> abs($diff)
					);
					$this->load->library('image_lib', $vars);
					$crop = $this->image_lib->crop();
					unlink($temppath);
//					var_dump($crop);
//					var_dump($vars);exit;
				}
			} else {
				$vars = array(
					'image_library'		=> 'gd2',
					'source_image'		=> $realpath,
		//			'dynamic_output'	=> TRUE,
					'new_image'			=> $new_path,
					'width'				=> $sizes[0],
					'height'			=> $sizes[1],
					'maintain_ratio'	=> $treatment=='k',
					'quality'			=> "100"
				);
				$this->load->library('image_lib', $vars);
				$method = $treatment=='c'?'crop':'resize';
				$this->image_lib->{$method}();
			}
		}
		// 
//*
		$generated_img_ratio = $sizes[0]/$sizes[1];
		
		$original_img_ratio = $image_size[0]/$image_size[1];
		
		$original_orientation = 1; // 1 = landscape, 0=potrait
		if($original_img_ratio>=1) $original_orientation = 1;
		else $original_orientation = 0;
		
		$orientation = 1; // 1 = landscape, 0=potrait
		if($generated_img_ratio>=1) $orientation = 1;
		else $orientation = 0;

		if($original_orientation != $orientation) {
			if(file_exists($temppath)){
				$vars = array(
					'image_library'		=> 'gd2',
					'source_image'		=> $temppath,
		//			'dynamic_output'	=> TRUE,
					'new_image'			=> $new_path,
					'width'				=> (int)$sizes[0],
					'height'			=> (int) $sizes[1],
					'maintain_ratio'	=> FALSE,
					'quality'			=> "100"
				);
				$this->load->library('image_lib', $vars);
				$this->image_lib->crop();
				unlink($temppath);
			} else {
				$vars = array(
					'image_library'		=> 'gd2',
					'source_image'		=> $realpath,
		//			'dynamic_output'	=> TRUE,
					'new_image'			=> $temppath,
					'width'				=> (int)$sizes[0],
					'height'			=> (1/$original_img_ratio) * (int)$sizes[1],
					'maintain_ratio'	=> FALSE,
					'quality'			=> "100"
				);
//				var_dump($vars);exit;
				$this->load->library('image_lib', $vars);
				$this->image_lib->resize();
			}
		} else {
			$vars = array(
				'image_library'		=> 'gd2',
				'source_image'		=> $realpath,
	//			'dynamic_output'	=> TRUE,
				'new_image'			=> $new_path,
				'width'				=> (int)$sizes[0],
				'height'			=> (int)$sizes[1],
				'maintain_ratio'	=> FALSE,
				'quality'			=> "100"
			);
			$this->load->library('image_lib', $vars);
			
			$method = $treatment=='c'?'crop':'resize';
			$this->image_lib->{$method}();
		}
		
		redirect($url);
//		var_dump($x);
//*/		
	}
}

// END OF images.php File