<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function ChatbotPage() {
        return view('admin.backend.chatbot.chatbot_page');
    }
}
