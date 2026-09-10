@extends('admin.admin_dashboard')

@section('admin')

    <div class="page-container">

        {{-- Page Heading --}}
        <div class="row mb-3">
            <div class="col-12">

                <div class="d-flex align-items-center justify-content-between">

                    <div>
                        <h3 class="mb-1">
                            ChatForge Admin Dashboard
                        </h3>

                        <p class="text-muted mb-0">
                            Manage companies, plans, orders and AI generated blogs.
                        </p>
                    </div>

                </div>

            </div>
        </div>


        {{-- Statistics Cards --}}
        <div class="row row-cols-xxl-4 row-cols-md-2 row-cols-1">

            {{-- Total Companies --}}
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


            {{-- Total Plans --}}
            <div class="col">

                <div class="card">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between">

                            <div>
                                <p class="text-muted mb-1">
                                    Total Plans
                                </p>

                                <h3 class="fw-semibold mb-0">
                                    {{ $totalPlans }}
                                </h3>
                            </div>

                            <div
                                class="avatar-lg bg-success-subtle rounded-circle d-flex align-items-center justify-content-center">

                                <i class="ri-vip-crown-line fs-28 text-success"></i>

                            </div>

                        </div>

                    </div>
                </div>

            </div>


            {{-- Total Orders --}}
            <div class="col">

                <div class="card">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between">

                            <div>
                                <p class="text-muted mb-1">
                                    Total Orders
                                </p>

                                <h3 class="fw-semibold mb-0">
                                    {{ $totalOrders }}
                                </h3>
                            </div>

                            <div
                                class="avatar-lg bg-warning-subtle rounded-circle d-flex align-items-center justify-content-center">

                                <i class="ri-shopping-cart-line fs-28 text-warning"></i>

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


        {{-- Recent Data --}}
        <div class="row">

            {{-- Recent Orders --}}
            <div class="col-xl-6">

                <div class="card">

                    <div class="card-header border-bottom border-dashed">

                        <div class="d-flex align-items-center justify-content-between">

                            <h4 class="header-title mb-0">
                                Recent Orders
                            </h4>

                            <span class="badge bg-warning-subtle text-warning">
                                Latest 5
                            </span>

                        </div>

                    </div>


                    <div class="card-body">

                        @forelse ($recentOrders as $order)

                            <div
                                class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">

                                <div>

                                    <h5 class="fs-15 mb-1">
                                        {{ $order->transaction_id }}
                                    </h5>

                                    <small class="text-muted">
                                        ${{ number_format($order->amount, 2) }}
                                        •
                                        {{ $order->created_at->diffForHumans() }}
                                    </small>

                                </div>


                                <div>

                                    @if ($order->status === 'approved')

                                        <span class="badge bg-success">
                                            Approved
                                        </span>

                                    @elseif ($order->status === 'pending')

                                        <span class="badge bg-warning text-dark">
                                            Pending
                                        </span>

                                    @elseif ($order->status === 'rejected')

                                        <span class="badge bg-danger">
                                            Rejected
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            {{ ucfirst($order->status) }}
                                        </span>

                                    @endif

                                </div>

                            </div>

                        @empty

                            <div class="text-center py-4">

                                <i class="ri-shopping-cart-line fs-1 text-muted"></i>

                                <p class="text-muted mt-2 mb-0">
                                    No orders found yet.
                                </p>

                            </div>

                        @endforelse

                    </div>

                </div>

            </div>


            {{-- Recent AI Blogs --}}
            <div class="col-xl-6">

                <div class="card">

                    <div class="card-header border-bottom border-dashed">

                        <div class="d-flex align-items-center justify-content-between">

                            <h4 class="header-title mb-0">
                                Recent AI Blogs
                            </h4>

                            <span class="badge bg-primary-subtle text-primary">
                                Latest 5
                            </span>

                        </div>

                    </div>


                    <div class="card-body">

                        @forelse ($recentBlogs as $blog)

                            <div
                                class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">

                                <div>

                                    <h5 class="fs-15 mb-1">
                                        {{ \Illuminate\Support\Str::limit($blog->title, 45) }}
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

        </div>

    </div>

@endsection