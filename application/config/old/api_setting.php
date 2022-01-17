<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

		
		$config['url_api']    			= 'https://dev-it.kopkarbsm.co.id/portal_api/Rest_api/Login_global?app=mykopkar&action=';
		$config['url_api_pembiayaan']   = 'https://dev-it.kopkarbsm.co.id/mykopkarbsm/Rest_api/Api_global?action=dokumen_awal_pembiayaan';
		$config['user_api']    			= "k0pk4r85m-324-#$@87$#@x";
		$config['password_api']    		= "923#@&%$-hows32&^3221";
		// $config['ch']    				= curl_init($url); // create a new cURL resource
		$config['result']    			= json_decode(file_get_contents('php://input'), true); // setup request to send 
?>