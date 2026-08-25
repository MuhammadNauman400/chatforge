<?php

namespace App\Jobs;

use App\Models\Blog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\GeminiApiService;

class GenerateBlogPostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Blog $blog;

    /**
     * Create a new job instance.
     */
    public function __construct(Blog  $blog)
    {
        $this->blog = $blog;
    }

    /**
     * Execute the job.
     */
    public function handle(GeminiApiService $geminiService): void
    {
        try {

            $this->blog->update(['status' => 'generating']);

            // Generate blog post content 
            $blogContentPrompt = "Write a comprehensive and engaging blog post about: '{$this->blog->title}'. " .
                "Structure the content as follows:\n" .
                "- Start with an engaging introduction\n" .
                "- Include 3-4 main sections with clear subheadings\n" .
                "- Each section should have detailed explanations and examples\n" .
                "- End with a compelling conclusion\n" .
                "- Use markdown formatting for headings\n" .
                "- Make it informative, engaging, and at least 600 words\n" .
                "- Include practical tips or insights where relevant";
            $blogContent = $geminiService->generateText($blogContentPrompt);
            if (!$blogContent || trim($blogContent) === '' || strlen(trim($blogContent)) < 100) {
                throw new \Exception('Failed to generate sufficient blog content from Gemini API');
            }


            $updateData = [
                'content' =>  $blogContent,
                'status' => 'generated'
            ];
            $this->blog->update($updateData);
        } catch (\Exception $e) {
            $this->blog->update([
                'status' => 'failed',
                'error_message' => $e->getMessage(),
                'failed_at' => now()
            ]);

            throw $e;
        }
    }
}
