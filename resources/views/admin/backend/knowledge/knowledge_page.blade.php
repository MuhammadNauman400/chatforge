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
                    <div id="deleteMessage" class="mt-3"></div>
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
                            {{-- load all data --}}
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

            //// fetch documents method
            async function fetchDocuments() {
                documentsLoadingSpinner.classList.add('active')
                documentsTableBody.innerHTML = '';

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

                    documents.forEach(doc => {
                        const row = documentsTableBody.insertRow();
                        row.innerHTML = `<td>${doc.file_name}</td>
                            <td><span class="badge ${doc.status === 'processed' ? 'bg-success' : doc.status === 'pending' ? 'bg-warning text-dark' : 'bg-danger'} ">${doc.status}</span></td>
                            <td>${new Date(doc.created_at).toLocaleDateString()}</td>
                            <td>
                                <button class="btn btn-sm btn-danger delete-document-btn" data-id="${doc.id}" ${doc.status === 'processing' ? 'disabled' : ''}>Delete</button>
                            </td>`;
                    });

                    ////For delete data
                    document.querySelectorAll('.delete-document-btn').forEach(button => {
                        button.addEventListener('click', function() {
                            const documentId = this.getAttribute('data-id');
                            deleteDocument(documentId);
                        });
                    });
                    ///End For delete data

                } catch (error) {
                    console.error('Error fetching documents', error);
                    documentsTableBody.innerHTML =
                        `<tr><td colspan="4" class="text-center text-danger">Failed to load documents</td> </tr>`;

                } finally {
                    documentsLoadingSpinner.classList.remove('active')
                }

            }
            //End method

            //Submit Form Data method
            uploadDocumentForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                uploadMessage.innerHTML = '';
                const formData = new FormData(this);
                const csrfToken = getCsrfToken();

                if (!csrfToken) {
                    uploadMessage.innerHTML =
                        `<div class="alert alert-danger">CSRF token not found. Please refresh the page</div>`;
                    return;
                }

                try {
                    const response = await fetch('/knowledge-documents', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })

                    const data = await response.json();

                    if (response.ok) {
                        uploadMessage.innerHTML =
                            `<div class="alert alert-success">${data.message}</div>`;
                        this.reset();
                        fetchDocuments();
                    } else {
                        let errorMessage = 'An error occurred';
                        if (data.message) {
                            errorMessage = data.message
                        } else if (data.errors) {
                            errorMessage = Object.values(data.errors).flat().join('<br>');
                        }
                        uploadMessage.innerHTML =
                            `<div class="alert alert-danger">${errorMessage}</div>`;
                    }

                } catch (error) {
                    console.error('Error uploading documents', error);
                    uploadMessage.innerHTML =
                        `<div class="alert alert-danger">Failed to upload document. Please try again </div>`;
                }
            });


            ///Delete method
            async function deleteDocument(documentId) {
                if (!confirm('Are you sure you want to delete this document ?')) return;

                const csrfToken = getCsrfToken();

                if (!csrfToken) {
                    uploadMessage.innerHTML =
                        `<div class="alert alert-danger">CSRF token not found. Please refresh the page</div>`;
                    return;
                }

                try {
                    const response = await fetch(`/knowledge-documents/${documentId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    const data = await response.json();

                    if (response.ok) {
                        deleteMessage.innerHTML =
                            `<div class="alert alert-success">${data.message}</div>`;
                        fetchDocuments();
                    } else {
                        console.error('Delete Failed', response.status, data);
                        deleteMessage.innerHTML = `<div class="alert alert-danger">${data.message}</div>`
                    }

                } catch (error) {
                    console.error('Error deleting documents', error);
                    deleteMessage.innerHTML =
                        `<div class="alert alert-danger">Failed to delete document. ${error.message} Please try again </div>`;
                }
            }

            //Initial load
            fetchDocuments();

        });
    </script>
@endsection
