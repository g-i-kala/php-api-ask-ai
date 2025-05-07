<?php

namespace App\Http\Controllers;

class ChatController
{
    public function index()
    {
        view('chat-form.view.php');
    }

    public function handleChat()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userInput = $_POST['userInput'];

            // Prepare the data to send in the POST request
            $requestData = [
                "contents" => [
                    [
                        "parts" => [
                            [
                                "text" => $userInput
                            ]
                        ]
                    ]
                ]
            ];

            // Convert the data to JSON
            $jsonData = json_encode($requestData);

            // Initialize cURL session
            $ch = curl_init();

            // Set the URL and other options
            $apiKey = $_ENV['API_KEY'] ?? null;
            $apiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$apiKey}";

            curl_setopt($ch, CURLOPT_URL, $apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($jsonData)
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);

            // Execute the request and capture the response
            $response = curl_exec($ch);

            // Check for errors
            if ($response === false) {
                echo "cURL Error: " . curl_error($ch);
            } else {
                // Decode the response
                $responseData = json_decode($response, true);

                // Display the AI's response
                if (isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
                    echo "<h2>AI Response:</h2>";
                    echo "<p>" . htmlspecialchars($responseData['candidates'][0]['content']['parts'][0]['text']) . "</p>";
                } else {
                    echo "<p>No response from AI.</p>";
                }
            }

            // Close the cURL session
            curl_close($ch);
        } else {
            echo "Invalid request method.";
        }
    }
}
