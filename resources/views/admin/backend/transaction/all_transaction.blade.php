@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-container">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom justify-content-between d-flex flex-wrap align-items-center gap-2">
                        <div class="flex-shrink-0 d-flex align-items-center gap-2">
                            <div class="position-relative">
                                <h4>All Orders </h4>
                            </div>
                        </div>

                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover text-nowrap mb-0">
                            <thead class="bg-light-subtle">
                                <tr>
                                    <th class="fs-12 text-uppercase text-muted py-1">Sl</th>
                                    <th class="fs-12 text-uppercase text-muted py-1">User Name </th>
                                    <th class="fs-12 text-uppercase text-muted py-1">Plan Name </th>
                                    <th class="fs-12 text-uppercase text-muted py-1">Transaction Id</th>
                                    <th class="fs-12 text-uppercase text-muted py-1">Amount</th>
                                    <th class="fs-12 text-uppercase text-muted py-1">Status</th>
                                    <th class="text-center  py-1 fs-12 text-uppercase text-muted" style="width: 120px;">
                                        Action</th>
                                </tr>
                            </thead>
                            <!-- end table-head -->

                            <tbody>

                                @foreach ($orders as $key => $item)
                                    <tr>
                                        <td><span class="fw-semibold"><a href="apps-invoice-details.html"
                                                    class="text-reset">#{{ $key + 1 }}</a></span></td>
                                        <td>{{ $item->user->name }}</td>
                                        <td><span class="text-muted">{{ $item->plan->name }}</span></td>

                                        <td>{{ $item->transaction_id }}</td>
                                        <td><span class="text-muted">{{ $item->amount }}</span></td>
                                        <td><span class="text-muted">{{ $item->status }}</span></td>

                                        <td class="pe-3">
                                            <div class="hstack gap-1 justify-content-end">
                                                <form action="">

                                                    <select name="status" class="form-control form-control-sm">
                                                        <option value="" disabled
                                                            {{ $item->status ? 'selected' : '' }}>Select Status</option>
                                                        <option value="pending"
                                                            {{ $item->status === 'pending' ? 'selected' : '' }}>Pending
                                                        </option>
                                                        <option value="approved"
                                                            {{ $item->status === 'approved' ? 'selected' : '' }}>Approved
                                                        </option>
                                                        <option value="rejected"
                                                            {{ $item->status === 'rejected' ? 'selected' : '' }}>Rejected
                                                        </option>
                                                    </select>
                                                    <button type="submit"
                                                        class="btn btn-ghost-success rounded-pill btn-sm">Update</button>
                                                </form>

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
