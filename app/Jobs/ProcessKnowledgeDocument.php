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

            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
