<?php
// accessToken.php

// Your consumer key and consumer secret
$consumerKey = 'kzv8BPT9fW4sWacH3YYd5FtDbLYnR7qd2KvyfubiNKyokmak'; // Replace with your consumer key
$consumerSecret = '9ZdzsaMHnGdBngcnXz7KACEsLq29FdcAVmUlKHizVK5u1Y0xCgO7NNUOn9GH7YmZ'; // Replace with your consumer secret

// Define the API URL
$apiUrl = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials'; // For production, use 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials'

// Initialize a cURL session
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $apiUrl);
$credentials = base64_encode($consumerKey . ':' . $consumerSecret);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $credentials));
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($curl);

// Check for cURL errors
if ($response === false) {
    die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
}

curl_close($curl);

// Decode the JSON response to get the access token
$token = json_decode($response);

// Output the access token
echo 'Access Token: ' . $token->access_token;
