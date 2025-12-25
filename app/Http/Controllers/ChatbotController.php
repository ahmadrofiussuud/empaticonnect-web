<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ChatbotService;

class ChatbotController extends Controller
{
    protected $chatbotService;

    public function __construct(ChatbotService $chatbotService)
    {
        $this->chatbotService = $chatbotService;
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $message = $request->input('message');
        $intent = $this->chatbotService->analyzeIntent($message);
        $response = $this->chatbotService->getResponse($intent, $message);

        return response()->json([
            'status' => 'success',
            'intent' => $intent,
            'response' => $response
        ]);
    }
}
