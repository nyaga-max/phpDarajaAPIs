<?php

//For us to be able to access the authorization token
include("accessTokenGeneration.php");

//setting the correct time zone so that the timestamp is precise and up to date
date_default_timezone_set("Africa/Nairobi");
$timeStamp = date('YmdHis');


//initiating the curl now
$ch = curl_init('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer 4PR9VnA1BrBJVeLhALlAk8KC3lyZ',
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_POST, 1);
$bussinessShortCode = 174379;
$timeStamp = date('YmdHis');

//passkey goten from the apis section, authorization then your app's test credentials
$passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";


//encrypting the shrortcode, passkey and timestamp to generate password
$password = base64_encode($bussinessShortCode . $passkey . $timeStamp);

//building the post payload data
$curl_post_data = array(
    'BusinessShortCode' => 174379,  // app's credentials'. Because it's not a live app but a sandboxed one
    "Password" => base64_encode($bussinessShortCode . $passkey . $timeStamp),
    "Timestamp" => $timeStamp,
    "TransactionType" => "CustomerPayBillOnline",
    "Amount" => 1,
    "PartyA" => 254740467735,
    "PartyB" => 174379,
    "PhoneNumber" => 254740467735,// your phone number or rather the phone number to get the stk payment request on
    "CallBackURL" => "http://nyagahtest.000webhostapp.com/daraja/daraja.php",
    "AccountReference" => "CompanyXLTD",
    "TransactionDesc" => "Payment of X"
);

//preparing the post payload data
$dataString = json_encode($curl_post_data);

//using the post payload now
curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


// executing and displaying the response and we get an stk push on our phone(PartyA)
$response = curl_exec($ch);
curl_close($ch);
echo $response;


