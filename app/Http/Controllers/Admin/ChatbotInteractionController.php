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

            $context = '';
            if ($relevantChunks->isNotEmpty()) {
                $context = "Here is some relevant information from our knowledge base:\n";
                foreach ($relevantChunks as $chunk) {
                    $context .= "- " . $chunk->content . "\n";
                }
                $context .= "\nBased on the above information, answer the following questions:\n";
            } else {
                $context = "No relevant information found in the knowledge base. Answer the following question based on general knowledge, or state that you don't have enough information:\n";
            }

            // 4. Construct the prompt for gemini 
            $prompt = "You are a helpful chatbot for a company. " .
                "Your goal is to answer questions accurately and concisely, drawing primarily from the provided context. " .
                "If the question cannot be answered from the context, state that you don't have enough information. " .
                "Do not make up answers.\n\n" .
                $context .
                "Question: " . $userQuery;

            if (!empty($chatbot->persona)) {
                $prompt = "You are a helpful chatbot with the following persona: '{$chatbot->persona}'. " . $prompt;
            }

            // 5. Send the prompt to gemini for text generation 
            $aiResponse = $this->geminiService->generateText($prompt);

            if (!$aiResponse) {
                return response()->json(['answer' => 'I am currently unable to generate a response. Please try again later'], 500);
            }

            return response()->json(['answer' => $aiResponse]);
        } catch (\Exception $e) {
            return response()->json(['answer' => 'An unexpected error occurred. Plz try again'], 500);
        }
    }
}
