@extends('client.client_dashboard')
@section('client')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h1 class="mb-0 text-white">Bank Tranfer Details</h1>
                        <p class="mb-0 text-white">Complete your plan Upgrade</p>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('plans.processPayment', $transaction->id) }}" method="POST">
                            @csrf

                            <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                            <div class="mb-4">
                                <p class="text-white">Please transfer ${{ number_format($transaction->amount, 2) }} to the
                                    following account:</p>
                                <p class="text-white">
                                    Bank: Example Bank<br>
                                    Account Name: xAI Services<br>
                                    Account Number: 1234567890<br>
                                    SWIFT Code: EXMBUS33
                                </p>
                                <input type="text" name="user_transaction_id" class="form-control mt-2"
                                    placeholder="Enter your transaction ID/Refence Number" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Payment Details</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
