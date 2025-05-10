<?php

namespace App\Http\Controllers;

use App\Http\Request;
use App\Services\ApiService;
use Core\Validator;

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
        $errors = [];

        if ($request->getMethod() === 'POST') {
            $userInput = ($request->getData('userInput'));

            if (! Validator::validateStriing($userInput, 1, 200)) {
                $errors['input'] = 'Validation failed. Adjust lenght of your question.';
                return view('chat-form.view.php', [
                    'errors' => $errors
                ]);
            }

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

                if ($responseData) {
                    throw new \Exception('No Response from AI');
                }

                return view('chat-response.view.php', [
                    'response' => $responseData,
                ]);

            } catch (\Exception $e) {
                $message = $e->getMessage();
                error_log($message);
                $errors['message'] = $e->getMessage();
            }

            return view('chat-form.view.php', ['errors' => $errors]);
        }

    }
}
