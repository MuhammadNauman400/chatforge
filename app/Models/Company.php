<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $guarded = [];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function chatbots()
    {
        return $this->hasMany(Chatbot::class);
    }

    public function knowledgeDocuments()
    {
        return $this->hasMany(KnowledgeDocument::class);
    }

    public function knowledgeChunnks()
    {
        return $this->hasMany(KnowledgeChunk::class);
    }

    public function getChatbotIdFromEmbedCode(): ?int
    {
        if (!$this->chatbot_embed_code) {
            return null;
        }
        /// Use a regular expression to get data-chatbot-id="4"
        preg_match('/data-chatbot-id="(\d+)"/', $this->chatbot_embed_code, $matches);
        return isset($matches[1]) ? (int) $matches[1] : null;
    }
}
