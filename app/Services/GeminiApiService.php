<?php

namespace App\Services;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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
}
