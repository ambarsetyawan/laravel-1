<?php 
namespace App\Library;
use URL;
class LibraryPublic {

	public static function get_url_image($url){
		$url_image = "";
		if (filter_var($url, FILTER_VALIDATE_URL) === false)
			$url_image = URL::to('/') . "/public/images/avatar/" . $url;
		else
			$url_image = $url;
		return $url_image;
	}

}