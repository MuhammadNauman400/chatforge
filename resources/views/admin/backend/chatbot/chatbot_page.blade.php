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
                        <tbody id="chatbotsTableBody">
                            <tr>
                                <td>name</td>
                                <td><span class="badge bg-success">active</span></td>
                                <td>knowledge information</td>
                                <td>
                                    <button class="btn btn-sm btn-info text-white me-2" data-bs-toggle="modal"
                                        data-bs-target="#embedCodeModal" data-chatbot-id="">Embed Code</button>

                                    <button class="btn btn-sm btn-danger delete-chatbot-btn">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>

    <!-- Embed Code Modal -->
    <div class="modal fade" id="embedCodeModal" tabindex="-1" aria-labelledby="embedCodeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="embedCodeModalLabel">Embed Chatbot Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Copy the following code and paste it into your website's HTML, just before the closing
                        <code>&lt;/body&gt;</code> tag. Replace <code>[YOUR_CHATBOT_ID_HERE]</code> with your actual chatbot
                        ID.
                    </p>
                    <div class="bg-light p-3 rounded mb-3">
                        <pre><code id="chatbotEmbedCode" class="language-html">&lt;div id="my-chatbot-widget" data-chatbot-id="[YOUR_CHATBOT_ID_HERE]"&gt;&lt;/div&gt;
&lt;script src="http://127.0.0.1:8000/js/chatbot-widget.js"&gt;&lt;/script&gt;</code></pre>
                    </div>
                    <button class="btn btn-outline-primary" onclick="copyEmbedCode()">Copy Code</button>
                    <div id="copyMessage" class="mt-2 text-success" style="display:none;">Copied!</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--End Embed Code Modal -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            try {
                $('#knowledgeDocumentIds').select2({
                    placeholder: 'Select Knowledge documents',
                    allowClear: true
                });
            } catch (error) {
                console.error('Error initializing Select2', error)
            }


            const sections = document.querySelectorAll('.section-content');
            const createChatbotForm = document.getElementById('createChatbotForm');
            const chatbotsTableBody = document.getElementById('chatbotsTableBody');

            const chatbotsLoadingSpinner = document.getElementById('chatbotsLoadingSpinner');
            const createChatbotMessage = document.getElementById('createChatbotMessage');

            function getCsrfToken() {
                const token = document.querySelector('meta[name="csrf-token"]')?.content;
                if (!token) {
                    console.error('CSRF Totken not found');
                    return null;
                }
                return token;
            }

            //Populate Knowledge document
            async function populateKnowledgeDocuments() {
                const select = document.getElementById('knowledgeDocumentIds');
                if (!select) {
                    console.error('Knowlede docuemnt select element not found');
                    return;
                }

                try {
                    const response = await fetch('/knowledge-documents', {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (!response.ok) {
                        throw new Error('HTTP ERRORS');
                    }

                    const documents = await response.json();
                    // console.log('Knowledge document:' , documents);
                    select.innerHTML = documents.length ?
                        documents.map(doc => `<option value="${doc.id}">${doc.file_name} </option>`).join('') :
                        `<option value="">No document available</option>`;

                } catch (error) {
                    console.error('Error fetching knowledge document', error);
                }

            }
            /// End Method populateKnowledgeDocuments





            // Initial Load
            populateKnowledgeDocuments();



        })
    </script>
@endsection
