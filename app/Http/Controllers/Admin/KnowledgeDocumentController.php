<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KnowledgeDocumentController extends Controller
{
    public function KnowledgePage() {
        return view('admin.backend.knowledge.knowledge_page');
    }
}
