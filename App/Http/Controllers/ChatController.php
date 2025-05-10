<?php

namespace App\Http\Controllers;

use App\Http\Request;
use App\Services\ApiService;

class ChatController
{
    public function __construct(private ApiService $apiService)
    {

    }

    public function index()
    {
        return view('chat-form.view.php');
    }

    public function handleChat(Request $request)
    {
        if ($request->getMethod() === 'POST') {
            $userInput = $request->getData('userInput');

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

            try {
                $responseData = $this->apiService->sendRequest('POST', $requestData);

                $errors = [];
                if (! $responseData) {
                    $errors['response'] = 'No response from AI';
                }

                return view('chat-response.view.php', [
                    'response' => $responseData,
                ]);


                // Display the AI's response
                // if (isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
                //     echo "<h2>AI Response:</h2>";
                //     echo "<p>" . htmlspecialchars($responseData['candidates'][0]['content']['parts'][0]['text']) . "</p>";
                // } else {
                //     echo "<p>No response from AI.</p>";
                // }
            } catch (\Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

    }
}
