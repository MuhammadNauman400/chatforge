<?php

namespace App\Services;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\TryCatch;

use function Pest\Laravel\post;

class GeminiApiService
{
    protected Client $httpClient;
    protected string $apiKey;
    protected string $embeddingModel;
    protected string $generationModel;


    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
        $this->embeddingModel = 'embedding-001';
        $this->generationModel = 'gemini-3.6-flash';

        if (empty($this->apiKey)) {
            Log::error('Gemini API key is missing or not set in configuration');
        }

        $this->httpClient = new Client([
            'base_url' => 'https://generativelanguage.googleapis.com/v1beta/',
            'headers' => ['Content-Type' => 'application/json'],
            'timeout' => 30,
            'connect_timeout' => 10,   
        ]);
    }

    /// Generate an embedding for the given text

    public function getEmbedding(string $text): ?array {
    if (empty($this->apiKey)) {
            Log::error('Gemini embedding API key is missing');
        }

    $endpoint = "models/{$this->embeddingModel}:embedContent";
    $finalUrl = $this->httpClient->getConfig('base_url'). $endpoint . "?key={$this->apiKey}";

    Log::debug('About to call gemini', ['url' => $finalUrl]);

    try {
        $response = $this->httpClient->post($endpoint, [
           'query' => ['key' => $this->apiKey],
           'json' => [
            'model' => "models/{$this->embeddingModel}",
            'content' => [
                'parts' => [['text' => $text]],
            ],
           ],
        ]);

    $data = json_decode($response->getBody()->getContents(), true);

    if ($response->getStatusCode() === 200 && isset($data['embedding']['values'])) {
       return $data['embedding']['values'];
    }

    return null;

    } catch (\RequestException $e) {
       Log::error('Gemini embedding api request fails:' .$e->getMessage(), [
        'status_code' => $e->hasResponse() ? $e->getResponse()->getStatusCode() : 'N/A',
       ]);
       return null;
    } catch(\Throwable $e) {
        Log::error('Gemini Embedding api General Error:' .$e->getMessage());
        return null;
    }
}

}
