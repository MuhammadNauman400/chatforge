<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KnowledgeChunk extends Model
{
    protected $guarded = [];

    public function company(): BelongsTo {
        return $this->belongsTo(Company::class);
    }

    public function knowledgeDocument(): BelongsTo {
        return $this->belongsTo(KnowledgeDocument::class);
    }

}
