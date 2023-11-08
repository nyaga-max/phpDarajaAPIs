<?php
// Your mpesa app keys //from my apps-> your app
$consumerKey = "MZoGmiDlD4BsTdxNM2uqw1Ay6X6BKB1N";
$consumerSecret ="ajIayZAdSMoiZFs2";

// Your access token url // from the apis-> authorization
$accessTokenUrl = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
$headers = ['content-Type:application/json; charset=utf8'];
$curl = curl_init($accessTokenUrl);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl, CURLOPT_HEADER,0);
curl_setopt($curl, CURLOPT_USERPWD, $consumerKey .":". $consumerSecret);
$result = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$result = json_decode($result, true);

// echos the accessToken extracted from the result 
echo $accessToken = $result['access_token'];
curl_close($curl);