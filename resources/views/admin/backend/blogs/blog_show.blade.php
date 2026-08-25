@extends('admin.admin_dashboard')
@section('admin')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{ $blog->title }}
                        <a href="{{ route('blog.list') }}">Back Page</a>
                    </div>

                    <div class="card-body">
                        @if ($blog->status !== 'generated')
                            <div class="alert alert-warning text-center">
                                This blog post is currently <strong>{{ ucfirst($blog->status) }}. Content will be appear
                                    here once its generated.
                                </strong>
                            </div>
                        @endif

                        <h1 class="mb-3">{{ $blog->title }}</h1>
                        <p class="text-muted text-sm mb-4">
                            Generated on {{ $blog->updated_at->format('M d, Y H:i') }}
                        </p>

                        <div class="blog-content">
                            {!! nl2br(e($blog->content)) !!}
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
