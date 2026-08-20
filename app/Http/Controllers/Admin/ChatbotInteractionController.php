<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chatbot;
use App\Models\KnowledgeChunk;
use App\Services\GeminiApiService;
use Illuminate\Http\Request;

class ChatbotInteractionController extends Controller
{
    protected GeminiApiService $geminiService;

    public function __construct(GeminiApiService $geminiService)
    {
        $this->geminiService = $geminiService;
    }


    public function Chat(Request $request, int $chatbotId)
    {

        $request->validate([
            'query' => 'required|string',
        ]);

        $userQuery = $request->input('query');

        try {

            // 1. Get the chatbot instance 
            $chatbot = Chatbot::find($chatbotId);
            if (!$chatbot) {
                return response()->json(['error' => 'Chatbot not found'], 404);
            }

            // 2. GET EMBEDDING FOR USER QUERY  
            $queryEmbedding = $this->geminiService->getEmbedding($userQuery);

            if (!$queryEmbedding) {
                return response()->json(['answer' => 'I am currently unable to process your request. Please try again later.'], 500);
            }

            // 3. Retrieve relavent knowledge chunks using vector similarity 
            $relevantChunks = KnowledgeChunk::where('company_id', $chatbot->company_id)
                ->whereHas('knowledgeDocument', function ($query) {
                    $query->where('status', 'processed');
                })
                ->get()
                ->map(function ($chunk) use ($queryEmbedding) {
                    $chunkEmbedding = json_decode($chunk->embedding, true);
                    if (!is_array($chunkEmbedding)) {
                        return null;
                    }
                    $similarity = $this->geminiService->calculateCosineSimilarity($queryEmbedding, $chunkEmbedding);
                    $chunk->similarity = $similarity;
                    return $chunk;
                })
                ->filter() // Remove nulls from invalid embeddings 
                ->sortByDesc('similarity') // Sort by similarity highest first
                ->take(3); // take top 3 most relevant chunks





        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
