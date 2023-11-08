<?php

include("accessTokenGeneration.php");
date_default_timezone_set("Africa/Nairobi");
$processRequestUrl = "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest";
$callbackUrl = "http://nyagahtest.000webhostapp.com/daraja/daraja.php";
$passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
$bussinessShortCode = "174379";
$timeStamp = date('YmdHis');
$password = base64_encode($bussinessShortCode . $passkey . $timeStamp);
$phone = '254740467735';
$money = '1';
$partyA = $phone;
$partyB = '254708374149';
$accountReference = 'Vins Labs';
$transactionDesc = 'stkPush test';
$amount = $money;
$stkpushheader = ['content-Type:applicatio/json', 'Authorixation:Bearer ' . $accessToken];
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $initiate_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader);
$curl_post_data = array(
    'bussinessShortCode' => $bussinessShortCode,
    'Password' => $password,
    'Timestamp' => $timeStamp,
    'TransactionType' => 'CustomerpaybillOnline',
    'Amount' => $amount,
    'Partya' => $partyA,
    'PartyB' => $bussinessShortCode,
    'PhoneNumber' => $partyA,
    'CallbackUrl' => $callbackUrl,
    'AccountReference' => $accountReference,
    'TransactionDesc' => $transactionDesc
);

$dataString = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $dataString);

$curl_response = curl_exec($curl);

