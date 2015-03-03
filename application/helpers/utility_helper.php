<?php
/**
 * Created by :
 *
 * User: AndrewMalachel
 * Date: 11/10/14
 * Time: 3:38 PM
 * Proj: private-development
 */

if(!function_exists('arr_uniq')) {
	function arr_uniq($array) {
		return array_merge(array_flip(array_flip($array)));
	}
}

if(!function_exists('mime_content_type')) {

	function mime_content_type($filename) {

		$mime_types = array(

			'txt' => 'text/plain',
			'htm' => 'text/html',
			'html' => 'text/html',
			'php' => 'text/html',
			'css' => 'text/css',
			'js' => 'application/javascript',
			'json' => 'application/json',
			'xml' => 'application/xml',
			'swf' => 'application/x-shockwave-flash',
			'flv' => 'video/x-flv',

			// images
			'png' => 'image/png',
			'jpe' => 'image/jpeg',
			'jpeg' => 'image/jpeg',
			'jpg' => 'image/jpeg',
			'gif' => 'image/gif',
			'bmp' => 'image/bmp',
			'ico' => 'image/vnd.microsoft.icon',
			'tiff' => 'image/tiff',
			'tif' => 'image/tiff',
			'svg' => 'image/svg+xml',
			'svgz' => 'image/svg+xml',

			// archives
			'zip' => 'application/zip',
			'rar' => 'application/x-rar-compressed',
			'exe' => 'application/x-msdownload',
			'msi' => 'application/x-msdownload',
			'cab' => 'application/vnd.ms-cab-compressed',

			// audio/video
			'mp3' => 'audio/mpeg',
			'qt' => 'video/quicktime',
			'mov' => 'video/quicktime',

			// adobe
			'pdf' => 'application/pdf',
			'psd' => 'image/vnd.adobe.photoshop',
			'ai' => 'application/postscript',
			'eps' => 'application/postscript',
			'ps' => 'application/postscript',

			// ms office
			'doc' => 'application/msword',
			'rtf' => 'application/rtf',
			'xls' => 'application/vnd.ms-excel',
			'ppt' => 'application/vnd.ms-powerpoint',

			// open office
			'odt' => 'application/vnd.oasis.opendocument.text',
			'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
		);

		$ext = strtolower(array_pop(explode('.',$filename)));
		if (array_key_exists($ext, $mime_types)) {
			return $mime_types[$ext];
		}
		elseif (function_exists('finfo_open')) {
			$finfo = finfo_open(FILEINFO_MIME);
			$mimetype = finfo_file($finfo, $filename);
			finfo_close($finfo);
			return $mimetype;
		}
		else {
			return 'application/octet-stream';
		}
	}
}

function alphanumeric($type = 'all', $case = 0){
	$case = (int)$case;
	$alphanum = NULL;
	switch($type){
		case 'safe':
			if($case < 0)
				$alphanum = 'abcdefghijkmnpqrtuvwxyz23456789';
			elseif($case > 0) 
				$alphanum = '23456789ABCDEFGHJKLMNPQRSTUVWXY';
			else
				$alphanum = 'abcdefghijkmnpqrtuvwxyz23456789ABCDEFGHJKLMNPQRSTUVWXY';
			break;
		case 'hex':
			$alphanum = '0123456789ABCDEF';
			break;
		case 'alphabet':
			$alphanum = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			break;
		case 'numeric':
			$alphanum = '0123456789';
			break;
		case 'all':
			$alphanum = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
			break;
		default:
			$alphanum = FALSE;
	}
	return $case!==0?($case < 0?strtolower($alphanum):strtoupper($alphanum)):$alphanum;
}

function hashgenerator($length = 20, $type = 'all', $case = 0){
	$alphanum = alphanumeric($type, $case);
	$i = 0;
	$char = '';
	$chars = '';
	while(strlen($char) < $length){
		$ke = mt_rand(0, strlen($alphanum)-1);
		$c = substr($alphanum, $ke, 1);
		$char .= $c;
		if(strlen($char) % 4 == 1) $chars .= ' ';
		$chars .= $c;
	}
	return array($char, trim($chars));
}

function rupiah_format ($number) {
	return 'Rp '.number_format($number,0).',-';
}

function double_digit($number) {
	$number = (int) $number;
	if($number < 10) {
		$number = '0'.$number;
	}
	return $number;
}

