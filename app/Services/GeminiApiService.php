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
        $this->embeddingModel = 'gemini-embedding-2';
        $this->generationModel = 'gemini-3.6-flash';

        if (empty($this->apiKey)) {
            Log::error('Gemini API key is missing or not set in configuration');
        }

        $this->httpClient = new Client([
            'base_uri' => 'https://generativelanguage.googleapis.com/v1beta/',
            'headers' => ['Content-Type' => 'application/json'],
            'timeout' => 30,
            'connect_timeout' => 10,
        ]);
    }

    /// Generate an embedding for the given text

    public function getEmbedding(string $text): ?array
    {
        if (empty($this->apiKey)) {
            Log::error('Gemini embedding API key is missing');
        }

        $endpoint = "models/{$this->embeddingModel}:embedContent";
        $finalUrl = $this->httpClient->getConfig('base_uri') . $endpoint . "?key={$this->apiKey}";

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
        } catch (RequestException $e) {
            Log::error('Gemini embedding api request fails:' . $e->getMessage(), [
                'status_code' => $e->hasResponse() ? $e->getResponse()->getStatusCode() : 'N/A',
            ]);
            return null;
        } catch (\Throwable $e) {
            Log::error('Gemini Embedding api General Error:' . $e->getMessage());
            return null;
        }
    }

    //Generate text from a prompt
    public function generateText(string $prompt): ?string
    {
        if (empty($this->apiKey)) {
            Log::error('Gemini Text Generation API key is missing');
            return 'API key is not configured';
        }

        $endpoint = "models/{$this->generationModel}:generateContent";

        try {
            $response = $this->httpClient->post($endpoint, [
                'query' => ['key' => $this->apiKey],
                'json' => [
                    'contents' => [
                        'parts' => [['text' => $prompt]],
                    ],
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            if ($response->getStatusCode() === 200 && isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                $text = $data['candidates'][0]['content']['parts'][0]['text'];
                return $text;
            }

            return 'I could not generate a response';
        } catch (RequestException $e) {
            Log::error('Gemini Text Generation api request fails:' . $e->getMessage(), [
                'status_code' => $e->hasResponse() ? $e->getResponse()->getStatusCode() : 'N/A',
            ]);
            return 'An error occured while generating text';
        } catch (\Throwable $e) {
            Log::error('Gemini Embedding api General Error:' . $e->getMessage());
            return 'Unexpected error';
        }
    }

    public function calculateCosineSimilarity(array $vectorA, array $vectorB): float
    {
        if (count($vectorA) !== count($vectorB)) {
            Log::error("Cosine similarity: vectors must have the same dimensions.");
            return 0.0;
        }

        $dotProduct = 0.0;
        $magnitudeA = 0.0;
        $magnitudeB = 0.0;

        for ($i=0; $i < count($vectorA); $i++) { 
            $dotProduct += $vectorA[$i] * $vectorB[$i];
            $magnitudeA += $vectorA[$i] * $vectorA[$i];
            $magnitudeB += $vectorB[$i] * $vectorB[$i];
        }

        $magnitudeA = sqrt($magnitudeA);
        $magnitudeB = sqrt($magnitudeB);

        if ($magnitudeA == 0 || $magnitudeB == 0) {
            return 0.0; //Avoid division by zero
        }

        return $dotProduct / ($magnitudeA * $magnitudeB);
    }
}
