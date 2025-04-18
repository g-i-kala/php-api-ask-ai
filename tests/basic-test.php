<?php

// Api kye
$apiKey = 'MiJMaTErT8OjtbCD4Sk8ZUWMRt90JKUv';

// Prep data
$requestData = [
    "lat" => 54.63082,
    "lon" => 18.49684,
    "model" => "gfs",
    "parameters" => ["temp"],
    "levels" => ["surface"],
    "key" => $apiKey
];

$jsonData = json_encode($requestData);

// Init cUrl session
$ch = curl_init();

// Set endpoint url
$apiUrl = "https://api.windy.com/api/point-forecast/v2";

// cUrl set options
curl_setopt($ch, CURLOPT_URL, $apiUrl); // set the ednpoint
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // return and allow to save in variable
curl_setopt($ch, CURLOPT_POST, true); // sets the request type
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json', // hey im sending json
    'Content-Length: ' . strlen($jsonData) // hey im sending this much data
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData); // sets the data being sent

// Execute

$response = curl_exec($ch);


function handleCurlErrors($ch)
{
    $error = curl_error($ch);
    return "cUrl Error: {$error}.";
}

function processResponse($response)
{
    $responseData = json_decode($response, true);

    if ($responseData) {
        return $responseData;
    } else {
        echo "No data received.";
    }

}



if ($response === false) {
    handleCurlErrors($ch);
} else {
    $responseData = processResponse($response);
}

curl_close($ch);

print_r($responseData);
