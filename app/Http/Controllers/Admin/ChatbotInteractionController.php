<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\GeminiApiService;
use Illuminate\Http\Request;

class ChatbotInteractionController extends Controller
{
    protected GeminiApiService $geminiService;

    public function __construct(GeminiApiService $geminiService){
        $this->geminiService = $geminiService;
    }


    public function Chat(){

    }
}
