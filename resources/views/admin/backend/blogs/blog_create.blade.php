@extends('admin.admin_dashboard')
@section('admin')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Generate New AI Blog Post</div>
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

                        <form action="{{ route('admin.blogs.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="title">Blog Post Title</label>
                                <input type="text" class="form-control" name="title" id="title">
                                <div class="form-text text-muted">Enter a clear and descriptive title for your AI-Generated
                                    blog post
                                </div>
                                <button type="submit" class="btn btn-primary">Generate Blog Post</button>

                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
