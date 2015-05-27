<?php 
namespace App\Library;
use URL;
use Mail;
class LibraryPublic {

	public static function get_url_image($url){
		$url_image = "";
		if (filter_var($url, FILTER_VALIDATE_URL) === false)
			$url_image = URL::to('/') . "/public/images/avatar/" . $url;
		else
			$url_image = $url;
		return $url_image;
	}

	public static function send_mail_res($data){
		$hashKey = env('APP_KEY');
		Mail::send('emails.register', $data, function  ($message) use($data) {
			$message->to($data['email'], 'Intergroup')->subject('Welcome to inter-group!!!');
		});
	}
}