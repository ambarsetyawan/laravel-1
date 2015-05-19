<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => [
		'domain' => '',
		'secret' => '',
	],

	'mandrill' => [
		'secret' => '',
	],

	'ses' => [
		'key' => '',
		'secret' => '',
		'region' => 'us-east-1',
	],

	'stripe' => [
		'model'  => 'App\User',
		'secret' => '',
	],


	'facebook' => [
	    'client_id' => '815619671868220',
	    'client_secret' => 'ef3bf012c240a71bba5f1b3721ebc6e2',
	    'redirect' => 'http://laravel.local.com/user/loginfb',
	],


	'google' => [
	    'client_id' => '933292538426-bl87m57qa6ps4s93rjad8f8058njgikr.apps.googleusercontent.com',
	    'client_secret' => 'qTYN-_PNMX2FRpqXymrrohVo',
	    'redirect' => 'http://laravel.local.com/user/logingg',
	],

];
