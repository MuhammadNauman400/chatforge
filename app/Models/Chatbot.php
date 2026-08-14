<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Chatbot extends Model
{
    protected $guarded = [];

    public function company(): BelongsTo {
        return $this->belongsTo(Company::class);
    }

    public function knowledgeDocuments(): BelongsToMany {
        return $this->belongsToMany(KnowledgeDocument::class, 'chatbot_knowledge_documents');
    }
}
