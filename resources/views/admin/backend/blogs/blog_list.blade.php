@extends('admin.admin_dashboard')
@section('admin')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-item-center">
                        Ai Generated Blog Posts
                        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm">Generate New Blog</a> 
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if ($blogs->isEmpty())
                            <p class="text-center">No blog Posts generated yet</p>
                        @else
                            <div class="list-group">
                                @foreach ($blogs as $blog)
                                    <div
                                        class="list-group-item list-group-item-action d-flex align-items-center mb-3 p-3 rounded shadow-sm">
                                        <div class="flex-grow-1">
                                            <h5 class="mb-1">{{ $blog->title }}</h5>
                                            <p class="mb-1 text-muted text-sm">Status:
                                                <span
                                                    class="badge {{ $blog->status === 'generated' ? 'bg-success' : ($blog->status === 'pending' || $blog->status === 'generated' ? 'bg-warning' : 'bg-danger') }}">
                                                    {{ ucfirst($blog->status) }}
                                                </span>
                                                @if ($blog->status !== 'generated')
                                                    <small class="ms-2">Please refresh in a moment.</small>
                                                @endif
                                            </p>
                                            <p class="text-sm text-muted">
                                                {{ \Illuminate\Support\Str::limit(strip_tags($blog->content), 100) }}</p>
                                        </div>

                                        <div class="ms-auto d-flex flex-column align-items-end">
                                            <a href="" class="btn btn-info btn-sm mb-2">View</a>
                                            <form action="">
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
