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
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ $company->name }}">
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
                                    <img src="{{ asset($company->company_logo) }}" alt="slider" class="mt-2"
                                        style="max-width: 150px;">
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="header_content" class="form-label">Header Content </label>
                                <textarea class="form-control" name="header_content" id="header_content" rows="3">{{ $company->header_content }}</textarea>
                                <small class="form-text text-muted">This content will be appear in the main hero
                                    section.</small>
                                @error('header_content')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="about_us_content" class="form-label">About Us Content </label>
                                <textarea class="form-control" name="about_us_content" id="about_us_content" rows="3">{{ $company->about_us_content }}</textarea>
                                <small class="form-text text-muted">This content will be appear in the About Us
                                    section.</small>
                                @error('about_us_content')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="services_content" class="form-label">Services Content </label>
                                <textarea class="form-control" name="services_content" id="services_content" rows="3">{{ $company->services_content }}</textarea>
                                <small class="form-text text-muted">This content will be appear in the Services
                                    section.</small>
                                @error('services_content')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="my-4">
                            <h4>Contact Information </h4>

                            <div class="mb-3">
                                <label for="contact_info" class="form-label">Company Address </label>
                                <input type="text" name="contact_info" id="contact_info" class="form-control"
                                    value="{{ $company->contact_info }}">
                                @error('contact_info')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="social_email" class="form-label">Company Email </label>
                                <input type="text" name="social_email" id="social_email" class="form-control"
                                    value="{{ $company->social_email }}">
                                @error('social_email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="social_phone" class="form-label">Company Phone </label>
                                <input type="text" name="social_phone" id="social_phone" class="form-control"
                                    value="{{ $company->social_phone }}">
                                @error('social_phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="my-4">
                            <h4>Chatbot Embed Code </h4>

                            <div class="mb-3">
                                <label for="chatbot_embed_code" class="form-label">Select Chatbot For Public Page</label>
                                <select class="form-control" name="chatbot_embed_code" id="chatbot_embed_code">
                                    <option value="">-- No Chatbot --</option>
                                    @foreach ($company->chatbots as $chatbotOption)
                                        <option value="{{ $chatbotOption->id }}"
                                            @if ($company->getChatbotIdFromEmbedCode() == $chatbotOption->id) selected @endif>{{ $chatbotOption->name }}
                                            (ID: {{ $chatbotOption->id }}) </option>
                                    @endforeach
                                </select>
                                <small>Choose which chatbot will apper on your public company website</small>
                            </div>

                            <button type="submit" class="btn btn-primary">Save Settings</button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
