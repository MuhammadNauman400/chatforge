@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-container">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header border-bottom justify-content-between d-flex flex-wrap align-items-center gap-2">
                                <div class="flex-shrink-0 d-flex align-items-center gap-2">
                                    <div class="position-relative">
                                        <h4>All Plans</h4>
                                    </div>
                                </div>

                                <a href="{{route('add.plans')}}" class="btn btn-primary"><i class="ti ti-plus me-1"></i>Add Plan</a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover text-nowrap mb-0">
                                    <thead class="bg-light-subtle">
                                        <tr>
                                            <th class="fs-12 text-uppercase text-muted py-1">SR</th>
                                            <th class="fs-12 text-uppercase text-muted py-1">Name </th>
                                            <th class="fs-12 text-uppercase text-muted py-1">Knowledge Base</th>
                                            <th class="fs-12 text-uppercase text-muted py-1">Chat Bot</th>
                                            <th class="fs-12 text-uppercase text-muted py-1">Price</th>
                                            <th class="text-center  py-1 fs-12 text-uppercase text-muted" style="width: 120px;">Action</th>
                                        </tr>
                                    </thead>
                                    <!-- end table-head -->

                                    <tbody>
                                        @foreach ( $plan as $key => $item )
                                                                                
                                        <tr>
                                            <td><span class="fw-semibold"><a href="apps-invoice-details.html" class="text-reset">#{{$key+1}} </a></span></td>
                                            <td>{{$item->name}}</td>
                                            <td><span class="text-muted">{{$item->knowledge_base}}</span></td>
                                            <td>{{$item->chat_bot}}</td>
                                            <td><span class="text-muted">{{$item->price}}</span></td>
                                            <td class="pe-3">
                                                <div class="hstack gap-1 justify-content-end">
                                                    <a href="{{route('edit.plans', $item->id)}}" class="btn btn-soft-success btn-icon btn-sm rounded-circle"> <i class="ti ti-edit fs-16"></i></a>
                                                    <a href="javascript:void(0);" class="btn btn-soft-danger btn-icon btn-sm rounded-circle"> <i class="ti ti-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr><!-- end table-row -->

                                        @endforeach
                                        
                                    </tbody><!-- end table-body -->
                                </table><!-- end table -->
                            </div>

                        </div> <!-- end card-->
                    </div> <!-- end col -->
                </div>

            </div>
@endsection
