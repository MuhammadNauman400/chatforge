@extends('admin.admin_dashboard')
@section('admin')

    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <div class="page-container">
        <section id="knowledge-base" class="section-content">
            <h2 class="mb-2">Knowledge Base Management</h2>
            <p class="text-muted mb-4">Upload text documents to train your chatbot. Only .txt and .md files are supported for
                now</p>

            <div class="card mb-4">
                <div class="card-header"> Upload New Document </div>
                <div class="card-body">
                    <form id="uploadDocumentForm">
                        @csrf
                        <div class="mb-3">
                            <label for="documentFile" class="form-label">Select Document (.txt, .md)</label>
                            <input type="file" class="form-control" name="document_file" id="documentFile"
                                accept=".txt,.md" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Upload Document</button>

                        <div id="uploadMessage" class="mt-3"></div>
                    </form>
                </div>
            </div>

        </section>
    </div>
@endsection
