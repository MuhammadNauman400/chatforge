@extends('client.client_dashboard')
@section('client')
    <div class="page-container">

        <div class="row justify-content-center">
            <div class="col-xxl-11">


                <div class="row mt-sm-4 align-items-end justify-content-center my-3">

                    @foreach ($plans as $plan)
                        <div class="col-lg-3">
                            <div class="card h-100 overflow-hidden">
                                <div class="card-header border-bottom border-dashed p-3 text-center">
                                    <h4 class="fw-bold fs-18">{{ $plan->name }} Plan</h4>
                                    <p class="mt-2 mb-0 text-muted">
                                        @if ($plan->name === 'Free')
                                            Try it out and start business before you pay.
                                        @elseif ($plan->name === 'Pro')
                                            The foundational tools and support you need to build your business.
                                        @else
                                            Advanced tools and more support to help you scale.
                                        @endif
                                    </p>
                                </div>
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center gap-1">
                                        <span class="text-muted fs-3 fw-semibold">$</span>
                                        <h1 class="display-5 fw-semibold mb-0">{{ $plan->price }}</h1>
                                        {{-- <div class="d-block">
                                            <p class=" fw-semibold mb-0">One-time payment</p>
                                        </div> --}}
                                    </div>
                                    <ul class="d-flex flex-column gap-2 mt-3 list-unstyled">
                                        <li>
                                            <i class="ti ti-point text-primary fs-4 align-middle me-1"></i>
                                            Knowledge Base: {{ $plan->knowledge_base }}
                                        </li>
                                        <li>
                                            <i class="ti ti-point text-primary fs-4 align-middle me-1"></i>
                                            Chatbots : {{ $plan->chat_bot }}
                                        </li>
                                        <li>
                                            <i class="ti ti-point text-primary fs-4 align-middle me-1"></i>
                                            AI-powered responses
                                        </li>

                                        <li>
                                            <i class="ti ti-point text-primary fs-4 align-middle me-1"></i>
                                            Document-based knowledge
                                        </li>

                                        <li>
                                            <i class="ti ti-point text-primary fs-4 align-middle me-1"></i>
                                            Website chatbot integration
                                        </li>

                                    </ul>
                                </div>
                                <div class="card-footer">
                                    @if ($plan->name === Auth::user()->plan->name)
                                        <button class="btn btn-secondary fw-semibold w-100" disabled>Current Plan</button>
                                    @else
                                        <a href="{{route('plans.subscribe', $plan->id)}}"
                                            class="btn {{ $plan->name === 'Pro' ? 'btn-danger' : 'btn-primary' }} fw-semibold w-100">Buy
                                            Now</a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div> <!-- end col-->
        </div>
        <!-- end row -->

    </div>
@endsection
