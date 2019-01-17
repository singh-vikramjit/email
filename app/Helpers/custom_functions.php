<?php

/**
 * This file is used to create your own custom fuction.
 *
 */

if(!function_exists('pr')){
	function pr($input) {

		echo '<pre>';
		print_r($input);
		echo '</pre>';

	}
}

if(!function_exists('prx')){
	function prx($input) {

		pr($input);
		die('prx');

	}
}


function defaultImage(){
	return asset('/default.jpg',env('REDIRECT_HTTPS'));
}