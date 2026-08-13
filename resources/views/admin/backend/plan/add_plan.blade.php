@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="page-container">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom border-dashed d-flex align-items-center">
                        <h4 class="header-title">Add Plan</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{route('store.plans')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label for="inputEmail4" class="form-label">Plan Name</label>
                                    <input type="text" name="name" class="form-control" id="inputEmail4">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="inputPassword4" class="form-label">Knowledge Base</label>
                                    <input type="text" name="knowledge_base" class="form-control">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="inputAddress" class="form-label">Chat Bot</label>
                                    <input type="text" name="chat_bot" class="form-control">
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="inputAddress2" class="form-label">Price</label>
                                    <input type="text" name="price" class="form-control">
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>

    </div>

@endsection
