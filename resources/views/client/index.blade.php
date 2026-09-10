@extends('client.client_dashboard')

@section('client')

    <div class="page-container">

        {{-- Page Heading --}}
        <div class="row mb-3">
            <div class="col-12">
                <h3 class="mb-1">
                    Welcome back, {{ $user->name }} 👋
                </h3>

                <p class="text-muted mb-0">
                    Manage your ChatForge chatbot platform and company settings.
                </p>
            </div>
        </div>


        {{-- Statistics Cards --}}
        <div class="row row-cols-xxl-4 row-cols-md-2 row-cols-1">

            {{-- My Chatbots --}}
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between">

                            <div>
                                <p class="text-muted mb-1">
                                    My Chatbots
                                </p>

                                <h3 class="fw-semibold mb-0">
                                    {{ $totalChatbots }}
                                </h3>
                            </div>

                            <div
                                class="avatar-lg bg-primary-subtle rounded-circle d-flex align-items-center justify-content-center">
                                <i class="ri-robot-2-line fs-28 text-primary"></i>
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


            {{-- Current Plan --}}
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between">

                            <div>
                                <p class="text-muted mb-1">
                                    Current Plan
                                </p>

                                <h3 class="fw-semibold mb-0">
                                    {{ $plan ? $plan->name : 'No Plan' }}
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


            {{-- Plan Price --}}
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between">

                            <div>
                                <p class="text-muted mb-1">
                                    Plan Price
                                </p>

                                <h3 class="fw-semibold mb-0">
                                    {{ $plan ? '$' . number_format($plan->price, 2) : '$0.00' }}
                                </h3>
                            </div>

                            <div
                                class="avatar-lg bg-info-subtle rounded-circle d-flex align-items-center justify-content-center">
                                <i class="ri-bank-card-line fs-28 text-info"></i>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>


        {{-- Recent Activity --}}
        <div class="row">

            {{-- Recent Chatbots --}}
            <div class="col-xl-6">

                <div class="card">

                    <div class="card-header border-bottom border-dashed">

                        <div class="d-flex align-items-center justify-content-between">

                            <h4 class="header-title mb-0">
                                My Recent Chatbots
                            </h4>

                            <span class="badge bg-primary-subtle text-primary">
                                Latest 5
                            </span>

                        </div>

                    </div>


                    <div class="card-body">

                        @forelse ($recentChatbots as $chatbot)
                            <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">

                                <div class="d-flex align-items-center gap-2">

                                    <div
                                        class="avatar-sm bg-primary-subtle rounded d-flex align-items-center justify-content-center">
                                        <i class="ri-robot-2-line fs-20 text-primary"></i>
                                    </div>

                                    <div>
                                        <h5 class="fs-15 mb-1">
                                            {{ $chatbot->name }}
                                        </h5>

                                        <small class="text-muted">
                                            {{ $chatbot->created_at->diffForHumans() }}
                                        </small>
                                    </div>

                                </div>

                            </div>

                        @empty

                            <div class="text-center py-4">

                                <i class="ri-robot-2-line fs-1 text-muted"></i>

                                <p class="text-muted mt-2 mb-0">
                                    No chatbots created yet.
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

                            <h4 class="header-title mb-0">
                                Recent Knowledge Documents
                            </h4>

                            <span class="badge bg-warning-subtle text-warning">
                                Latest 5
                            </span>

                        </div>

                    </div>


                    <div class="card-body">

                        @forelse ($recentDocuments as $document)
                            <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">

                                <div class="d-flex align-items-center gap-2">

                                    <div
                                        class="avatar-sm bg-warning-subtle rounded d-flex align-items-center justify-content-center">
                                        <i class="ri-file-text-line fs-20 text-warning"></i>
                                    </div>

                                    <div>

                                        <h5 class="fs-15 mb-1">
                                            {{ $document->file_name }}
                                        </h5>

                                        <small class="text-muted">
                                            {{ $document->created_at->diffForHumans() }}
                                        </small>

                                    </div>

                                </div>


                                {{-- Document Status --}}
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


        {{-- Current Plan Information --}}
        <div class="row">

            <div class="col-12">

                <div class="card">

                    <div class="card-header border-bottom border-dashed">

                        <h4 class="header-title mb-0">
                            Current Subscription
                        </h4>

                    </div>


                    <div class="card-body">

                        @if ($plan)
                            <div class="row align-items-center">

                                <div class="col-md-4">

                                    <p class="text-muted mb-1">
                                        Plan
                                    </p>

                                    <h4 class="mb-0">
                                        {{ $plan->name }}
                                    </h4>

                                </div>


                                <div class="col-md-4">

                                    <p class="text-muted mb-1">
                                        Price
                                    </p>

                                    <h4 class="mb-0">
                                        ${{ number_format($plan->price, 2) }}
                                    </h4>

                                </div>


                                <div class="col-md-4 text-md-end mt-3 mt-md-0">

                                    <a href="{{ route('billing.upgrade') }}" class="btn btn-primary">

                                        View Plans
                                        <i class="ri-arrow-right-line ms-1"></i>

                                    </a>

                                </div>

                            </div>
                        @else
                            <div class="text-center py-3">

                                <p class="text-muted mb-3">
                                    You don't have an active plan yet.
                                </p>

                                <a href="{{ route('billing.upgrade') }}" class="btn btn-primary">

                                    Choose a Plan

                                </a>

                            </div>
                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>
    ```
@endsection
