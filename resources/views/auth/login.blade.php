<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login Page </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">

    <!-- Theme Config Js -->
    <script src="{{ asset('backend/assets/js/config.js') }}"></script>

    <!-- Vendor css -->
    <link href="{{ asset('backend/assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
</head>

<body>

    <div class="auth-bg d-flex min-vh-100">
        <div class="row g-0 justify-content-center w-100 m-xxl-5 px-xxl-4 m-3">
            <div class="col-xxl-6 col-lg-5 col-md-6">
                <a href="index.html" class="auth-brand d-flex justify-content-center mb-2">
                    <img src="{{ asset('backend/assets/images/logo-dark.') }}png" alt="dark logo" height="26"
                        class="logo-dark">
                    <img src="{{ asset('backend/assets/images/logo.png') }}" alt="logo light" height="26"
                        class="logo-light">
                </a>

                <p class="fw-semibold mb-4 text-center text-muted fs-15">Chatforge Login</p>

                <div class="card overflow-hidden text-center p-xxl-4 p-3 mb-0">

                    <h4 class="fw-semibold mb-3 fs-18">Log in to your account</h4>

                    <form method="POST" action="{{ route('login') }}" class="text-start mb-3">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Enter your email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Enter your password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="checkbox-signin">
                                <label class="form-check-label" for="checkbox-signin">Remember me</label>
                            </div>

                            <a href="{{ route('password.request') }}"
                                class="text-muted border-bottom border-dashed">Forget
                                Password</a>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-primary fw-semibold" type="submit">Login</button>
                        </div>
                    </form>

                    <p class="text-muted fs-14 mb-0">Don't have an account?
                        <a href="{{ route('register') }}" class="fw-semibold text-danger ms-1">Sign Up !</a>
                    </p>

                </div>
                <p class="mt-4 text-center mb-0">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> © Chatforge - By <span
                        class="fw-bold text-decoration-underline text-uppercase text-reset fs-12">Nauman</span>
                </p>
            </div>
        </div>
    </div>

    <!-- Vendor js -->
    <script src="{{ asset('backend/assets/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>

</body>

</html>
