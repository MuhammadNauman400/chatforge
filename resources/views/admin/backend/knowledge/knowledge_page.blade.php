@extends('admin.admin_dashboard')
@section('admin')

    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
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


            <div class="card">
                <div class="card-header">Uploaded Documents</div>
                <div class="card-body">
                    <div class="loading-spinner" id="documentsLoadingSpinner">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading....</span>
                        </div>
                        <p class="mt-2 text-muted">Loading Documents</p>
                    </div>
                    <div class="deleteMessage" class="mt-3"></div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Document Name</th>
                                <th>Status</th>
                                <th>Uploaded At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="documentsTableBody">
                            <td>file name</td>
                            <td><span class="badge bg-danger">processed</span></td>
                            <td>13/8/26</td>
                            <td>
                                <button class="btn btn-sm btn-danger delete-document-btn">Delete</button>
                            </td>
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const uploadDocumentForm = document.getElementById('uploadDocumentForm');
            const documentsTableBody = document.getElementById('documentsTableBody');
            const documentsLoadingSpinner = document.getElementById('documentsLoadingSpinner');
            const uploadMessage = document.getElementById('uploadMessage');
            const deleteMessage = document.getElementById('deleteMessage');

            function getCsrfToken() {
                const token = document.querySelector('meta[name="csrf-token"]')?.content;

                if (!token) {
                    console.error('CSRF Token not found');
                    return null;         
                }
                return token;
            }

            async function fetchDocuments() {
                
            }

        })
    </script>
    
@endsection
