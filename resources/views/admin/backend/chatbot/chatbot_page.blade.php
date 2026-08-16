@extends('admin.admin_dashboard')
@section('admin')

    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
    </head>
    <style>
        .loading-spinner {
            display: none;
            text-align: center;
            margin-top: 20px;
        }

        .loading-spinner.active {
            display: block;
        }
    </style>

    <div class="page-container">
        <section id="knowledge-base" class="section-content">
            <h2 class="mb-2">Your Chatbots</h2>
            <p class="text-muted mb-4">Create and manage your AI chatbots. Each chatbot can be trained on specific knowledge
                base.</p>

            <div class="card mb-4">
                <div class="card-header"> Create New Chatbot </div>
                <div class="card-body">
                    <form id="createChatbotForm">
                        @csrf
                        <div class="mb-3">
                            <label for="chatbotName" class="form-label">Chatbot Name</label>
                            <input type="text" class="form-control" name="name" id="chatbotName"
                                placeholder="e.g, Web Host Support Bot" required>
                        </div>

                        <div class="mb-3">
                            <label for="chatbotPersona" class="form-label">Initial Greeting / Persona</label>
                            <textarea class="form-control" name="persona" id="chatbotPersona" rows="3"
                                placeholder="e.g, 'Hello! how can i assist you with your website ?'" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="knowledgeDocumentIds" class="form-label">Knowledge Documents (Optional)</label>
                            <select class="form-control" name="knowledge_document_ids[]" id="knowledgeDocumentIds"
                                multiple></select>
                        </div>

                        <button type="submit" class="btn btn-primary">Create Chatbot</button>

                        <div id="createChatbotMessage" class="mt-3"></div>
                    </form>
                </div>
            </div>


            <div class="card">
                <div class="card-header">Existing Chatbots</div>
                <div class="card-body">
                    <div class="loading-spinner" id="chatbotsLoadingSpinner">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading....</span>
                        </div>
                        <p class="mt-2 text-muted">Loading Chatbots...</p>
                    </div>
                    
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Chatbot Name</th>
                                <th>Status</th>
                                <th>Knowledge Base</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="documentsTableBody">
                            <tr>
                                <td>name</td>
                                <td><span class="badge bg-success">active</span></td>
                                <td>knowledge information</td>
                                <td>
                                    <button class="btn btn-sm btn-info text-white me-2">Embed Code</button>

                                    <button class="btn btn-sm btn-danger delete-chatbot-btn">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
@endsection
