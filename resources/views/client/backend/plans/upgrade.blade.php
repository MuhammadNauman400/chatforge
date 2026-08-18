@extends('client.client_dashboard')
@section('client')
    <div class="page-container">

        <div class="row justify-content-center">
            <div class="col-xxl-11">


                <div class="row mt-sm-4 align-items-end justify-content-center my-3">
                    <div class="col-lg-3">
                        <div class="card h-100 overflow-hidden">
                            <div class="card-header border-bottom border-dashed p-3 text-center">
                                <h4 class="fw-bold fs-18">Free Plan</h4>
                                <p class="mt-2 mb-0 text-muted">Tailored for
                                    individual professionals and
                                    hobbyists.</p>
                            </div>
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center gap-1">
                                    <span class="text-muted fs-3 fw-semibold">$</span>
                                    <h1 class="display-5 fw-semibold mb-0">0</h1>
                                    <div class="d-block">
                                        <p class=" fw-semibold mb-0">One-time payment</p>
                                        <p class="text-muted mb-0">+plus local taxes</p>
                                    </div>
                                </div>
                                <ul class="d-flex flex-column gap-2 mt-3 list-unstyled">
                                    <li>
                                        <i class="ti ti-point text-primary fs-4 align-middle me-1"></i>
                                        Single user license
                                    </li>
                                    <li>
                                        <i class="ti ti-point text-primary fs-4 align-middle me-1"></i>
                                        Access to some components
                                    </li>
                                    <li>
                                        <i class="ti ti-point text-primary fs-4 align-middle me-1"></i>
                                        Lifetime access
                                    </li>
                                    <li>
                                        <i class="ti ti-point text-primary fs-4 align-middle me-1"></i>
                                        Single project
                                    </li>
                                    <li>
                                        <i class="ti ti-point text-muted fs-4 align-middle me-1"></i>
                                        No support
                                    </li>
                                    <li>
                                        <i class="ti ti-point text-muted fs-4 align-middle me-1"></i>
                                        No updates
                                    </li>

                                </ul>
                            </div>
                            <div class="card-footer">
                                <a href="#!" class="btn btn-primary fw-semibold w-100">Buy
                                    Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->
        </div>
        <!-- end row -->

    </div>
@endsection
