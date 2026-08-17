<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chatbot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatbotController extends Controller
{
    public function ChatbotPage() {
        return view('admin.backend.chatbot.chatbot_page');
    }

    public function Index(){

        $companyId = Auth::user()->company_id;
        if (!$companyId) {
           return response()->json(['message' => 'User is not associated with a company'], 403);
        }

        $chatbots = Chatbot::where('company_id',$companyId)
            ->with('knowledgeDocuments')
            ->latest()
            ->get();

        return response()->json($chatbots->map(function ($chatbot){
            return [
                'id' => $chatbot->id,
                'name' => $chatbot->name,
                'status' => $chatbot->status,
                'knowledge_base_name' => $chatbot->knowledgeDocuments->pluck('file_name')->toArray(),
            ];
        }));
    }
     // End Method 


}
