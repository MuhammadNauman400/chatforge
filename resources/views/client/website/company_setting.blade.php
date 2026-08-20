@extends('client.client_dashboard')
@section('client')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Company Page Setting</div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
         @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

    <form action="">

    <div class="mb-3">
        <label for="name" class="form-label">Company Name </label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $company->name }}">
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror 
    </div>


     <div class="mb-3">
        <label for="company_logo" class="form-label">Slider Image </label>
        <input type="file" name="company_logo" id="company_logo" class="form-control">
        @error('company_logo')
            <div class="text-danger">{{ $message }}</div>
        @enderror  
        @if ($company->company_logo)
            <img src="{{ asset($company->company_logo) }}" alt="slider" class="mt-2" style="max-width: 150px;">
        @endif  
    </div>

     <div class="mb-3">
        <label for="header_content" class="form-label">Header Content </label>
        <textarea class="form-control" name="header_content" id="header_content" rows="3">{{ $company->header_content }}</textarea>
        <small class="form-text text-muted">This content will be appear in the main hero section.</small> 
        @error('header_content')
            <div class="text-danger">{{ $message }}</div>
        @enderror 
    </div>


    <div class="mb-3">
        <label for="about_us_content" class="form-label">About Us Content </label>
        <textarea class="form-control" name="about_us_content" id="about_us_content" rows="3">{{ $company->about_us_content }}</textarea>
        <small class="form-text text-muted">This content will be appear in the About Us section.</small> 
        @error('about_us_content')
            <div class="text-danger">{{ $message }}</div>
        @enderror 
    </div>


    <div class="mb-3">
        <label for="services_content" class="form-label">Services Content </label>
        <textarea class="form-control" name="services_content" id="services_content" rows="3">{{ $company->services_content }}</textarea>
        <small class="form-text text-muted">This content will be appear in the Services section.</small> 
        @error('services_content')
            <div class="text-danger">{{ $message }}</div>
        @enderror 
    </div>



    </form>




    </div>

            </div>

        </div>

    </div>

</div>

@endsection