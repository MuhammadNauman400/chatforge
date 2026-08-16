<?php

namespace App\Jobs;

use App\Models\KnowledgeChunk;
use App\Models\KnowledgeDocument;
use App\Services\GeminiApiService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProcessKnowledgeDocument implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected KnowledgeDocument $document;

    /**
     * Create a new job instance.
     */
    public function __construct(KnowledgeDocument $document)
    {
        $this->document = $document;
    }

    /**
     * Execute the job.
     */
    public function handle(GeminiApiService $geminiService): void
    {
        try {
            //Update document status from to processing

            $this->document->update([
                'status' => 'processing',
            ]);

            $content = Storage::disk('public')->get($this->document->file_path);

            $chunkSize = 500;   //Characters
            $overlap = 100;     //Characters
            $chunks = $this->splitIntoChunks($content, $chunkSize, $overlap);

            /// Get embedding for each chunk and store to knowledgechunk table

            foreach ($chunks as $chunkContent) {
                $embedding = $geminiService->getEmbedding($chunkContent);

                if ($embedding) {
                    KnowledgeChunk::create([
                        'Knowledge_document_id' => $this->document->id,
                        'company_id' => $this->document->company_id,
                        'content' => $chunkContent,
                        'embedding' => json_encode($embedding), //Convert array to JSON string

                    ]);
                } else {
                    Log::warning("Failed to get embedding for chunk from document");
                }
            }

            //Update document status to processed

            $this->document->update(['status' => 'processed']);
        } catch (\Exception $e) {
            $this->document->update(['status' => 'failed']);
        }
    }

    protected function splitIntoChunks(string $text, int $chunkSize, int $overlap): array {
        $chunks = [];
        $length = mb_strlen($text);
        for ($i=0; $i < $length ; $i +=  ($chunkSize - $overlap)) { 
            $chunk = mb_substr($text, $i, $chunkSize);
            $chunks[] = $chunk;
        }

        return $chunks;
    }
}
