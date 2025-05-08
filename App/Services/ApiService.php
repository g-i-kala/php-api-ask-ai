<?php

declare(strict_types=1);

namespace App\Services;

class ApiService
{
    public function __construct(private string $apiKey, private string $apiUrl)
    {
        // Constructor with property promotion
    }

    public function sendRequest(string $method, array $data = [])
    {
        $jsonData = json_encode($data);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->apiUrl . '?key=' . $this->apiKey);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));

        if (!empty($data)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($jsonData)
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        }

        $response = curl_exec($ch);

        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new \Exception('cURL Error: ' . $error);
        }

        curl_close($ch);

        $decodedResponse = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('JSON Decode Error: ' . json_last_error_msg());
        }

        return $decodedResponse;
    }
}
