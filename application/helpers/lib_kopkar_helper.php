<?php

function curl_kopkar(){
    // return array("title" => null, "robots" => "noindex, nofollow" );

        $url 		= 'https://api.kopkarbsm.co.id/portal_api/Rest_api/Login_global?app=mykopkar&action=login';

		$user_auth  = "k0pk4r85m-324-#$@87$#@x";
		$pass_auth  = "923#@&%$-hows32&^3221";

		$ch 		= curl_init($url); // create a new cURL resource
		$result 	= json_decode(file_get_contents('php://input'), true); // setup request to send json via POST
		//$data	 	= json_encode(array("token" => "0adbfc029162963a272b0c28f6425345")); // define get data berdasarkan norek

		$data	 	= json_encode(array("email" => $email,"pass"=>$password)); // define get data berdasarkan norek

		curl_setopt($ch, CURLOPT_HTTPHEADER, array("cache-control: no-cache","Authorization: Basic ".base64_encode($user_auth.":".$pass_auth)));

		curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // attach encoded JSON string to the POST fields
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return response instead of outputting
		$result = curl_exec($ch); // execute the POST request
		curl_close($ch); // close cURL resource
		//get response
		// print $result;
		// echo'<hr />';
		$json = json_decode($result,true);

}
