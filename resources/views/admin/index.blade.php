@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-container">

        {{-- Page Heading --}}
        <div class="row mb-3">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="mb-1">ChatForge Dashboard</h3>
                        <p class="text-muted mb-0">
                            Overview of your AI chatbot platform.
                        </p>
                    </div>
                </div>
            </div>
        </div>


        {{-- Statistics Cards --}}
        <div class="row row-cols-xxl-4 row-cols-md-2 row-cols-1">

            {{-- Companies --}}
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between">

                            <div>
                                <p class="text-muted mb-1">
                                    Total Companies
                                </p>

                                <h3 class="fw-semibold mb-0">
                                    {{ $totalCompanies }}
                                </h3>
                            </div>

                            <div
                                class="avatar-lg bg-primary-subtle rounded-circle d-flex align-items-center justify-content-center">
                                <i class="ri-building-line fs-28 text-primary"></i>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


            {{-- Chatbots --}}
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between">

                            <div>
                                <p class="text-muted mb-1">
                                    Total Chatbots
                                </p>

                                <h3 class="fw-semibold mb-0">
                                    {{ $totalChatbots }}
                                </h3>
                            </div>

                            <div
                                class="avatar-lg bg-success-subtle rounded-circle d-flex align-items-center justify-content-center">
                                <i class="ri-robot-2-line fs-28 text-success"></i>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


            {{-- Knowledge Documents --}}
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between">

                            <div>
                                <p class="text-muted mb-1">
                                    Knowledge Documents
                                </p>

                                <h3 class="fw-semibold mb-0">
                                    {{ $totalDocuments }}
                                </h3>
                            </div>

                            <div
                                class="avatar-lg bg-warning-subtle rounded-circle d-flex align-items-center justify-content-center">
                                <i class="ri-file-text-line fs-28 text-warning"></i>
                            </div>

                        </div>

                    </div>
                </div>
            </div>


            {{-- AI Blogs --}}
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between">

                            <div>
                                <p class="text-muted mb-1">
                                    AI Generated Blogs
                                </p>

                                <h3 class="fw-semibold mb-0">
                                    {{ $totalBlogs }}
                                </h3>
                            </div>

                            <div
                                class="avatar-lg bg-info-subtle rounded-circle d-flex align-items-center justify-content-center">
                                <i class="ri-quill-pen-line fs-28 text-info"></i>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>


        {{-- Second Row --}}
        <div class="row">

            {{-- Recent Blogs --}}
            <div class="col-xl-6">
                <div class="card">

                    <div class="card-header border-bottom border-dashed">
                        <div class="d-flex align-items-center justify-content-between">

                            <div>
                                <h4 class="header-title mb-0">
                                    Recent AI Blogs
                                </h4>
                            </div>

                            <span class="badge bg-primary-subtle text-primary">
                                Latest 5
                            </span>

                        </div>
                    </div>


                    <div class="card-body">

                        @forelse ($recentBlogs as $blog)
                            <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">

                                <div>
                                    <h5 class="fs-15 mb-1">
                                        {{ Str::limit($blog->title, 45) }}
                                    </h5>

                                    <small class="text-muted">
                                        {{ $blog->created_at->diffForHumans() }}
                                    </small>
                                </div>


                                <div>
                                    @if ($blog->status === 'generated')
                                        <span class="badge bg-success">
                                            Generated
                                        </span>
                                    @elseif ($blog->status === 'generating')
                                        <span class="badge bg-warning text-dark">
                                            Generating
                                        </span>
                                    @elseif ($blog->status === 'failed')
                                        <span class="badge bg-danger">
                                            Failed
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            {{ ucfirst($blog->status) }}
                                        </span>
                                    @endif
                                </div>

                            </div>

                        @empty

                            <div class="text-center py-4">

                                <i class="ri-article-line fs-1 text-muted"></i>

                                <p class="text-muted mt-2 mb-0">
                                    No blogs generated yet.
                                </p>

                            </div>
                        @endforelse

                    </div>

                </div>
            </div>


            {{-- Recent Knowledge Documents --}}
            <div class="col-xl-6">
                <div class="card">

                    <div class="card-header border-bottom border-dashed">
                        <div class="d-flex align-items-center justify-content-between">

                            <div>
                                <h4 class="header-title mb-0">
                                    Recent Knowledge Documents
                                </h4>
                            </div>

                            <span class="badge bg-success-subtle text-success">
                                Latest 5
                            </span>

                        </div>
                    </div>


                    <div class="card-body">

                        @forelse ($recentDocuments as $document)
                            <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">

                                <div class="d-flex align-items-center gap-2">

                                    <div
                                        class="avatar-sm bg-light rounded d-flex align-items-center justify-content-center">
                                        <i class="ri-file-text-line fs-20"></i>
                                    </div>

                                    <div>
                                        <h5 class="fs-15 mb-1">
                                            {{ Str::limit($document->file_name, 40) }}
                                        </h5>

                                        <small class="text-muted">
                                            {{ $document->created_at->diffForHumans() }}
                                        </small>
                                    </div>

                                </div>


                                <div>

                                    @if ($document->status === 'processed')
                                        <span class="badge bg-success">
                                            Processed
                                        </span>
                                    @elseif ($document->status === 'processing')
                                        <span class="badge bg-warning text-dark">
                                            Processing
                                        </span>
                                    @elseif ($document->status === 'pending')
                                        <span class="badge bg-secondary">
                                            Pending
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            Failed
                                        </span>
                                    @endif

                                </div>

                            </div>

                        @empty

                            <div class="text-center py-4">

                                <i class="ri-file-list-3-line fs-1 text-muted"></i>

                                <p class="text-muted mt-2 mb-0">
                                    No knowledge documents uploaded yet.
                                </p>

                            </div>
                        @endforelse

                    </div>

                </div>
            </div>

        </div>

    </div>
@endsection
