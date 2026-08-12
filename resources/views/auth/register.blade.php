<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Register Page </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('backend/assets/images/favicon.ico')}}">

    <!-- Theme Config Js -->
    <script src="{{asset('backend/assets/js/config.js')}}"></script>

    <!-- Vendor css -->
    <link href="{{asset('backend/assets/css/vendor.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{asset('backend/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{asset('backend/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
</head>

<body>

    <div class="auth-bg d-flex min-vh-100">
        <div class="row g-0 justify-content-center w-100 m-xxl-5 px-xxl-4 m-3">
            <div class="col-xxl-6 col-lg-5 col-md-6">
                <a href="index.html" class="auth-brand d-flex justify-content-center mb-2">
                    <img src="{{asset('backend/assets/images/logo-dark.')}}png" alt="dark logo" height="26" class="logo-dark">
                    <img src="{{asset('backend/assets/images/logo.png')}}" alt="logo light" height="26" class="logo-light">
                </a>

                <p class="fw-semibold mb-4 text-center text-muted fs-15">Chatforge Register</p>

                <div class="card overflow-hidden text-center p-xxl-4 p-3 mb-0">

                    <h4 class="fw-semibold mb-3 fs-18">Register your account</h4>

                    <form method="POST" action="{{ route('register') }}" class="text-start mb-3">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Enter your name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="company_name">Company</label>
                            <input type="text" id="company_name" name="company_name" class="form-control"
                                placeholder="Enter your email">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="Enter your email">
                        </div>


                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Enter your password">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password">Confirm Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                                placeholder="Enter your confirm password">
                        </div>


                        <div class="d-grid">
                            <button class="btn btn-primary fw-semibold" type="submit">Register</button>
                        </div>
                    </form>

                    <p class="text-muted fs-14 mb-0">Already have an account?
                        <a href="{{route('login')}}" class="fw-semibold text-danger ms-1">Sign In !</a>
                    </p>

                </div>
                <p class="mt-4 text-center mb-0">
                    <script>document.write(new Date().getFullYear())</script> © Chatforge - By <span
                        class="fw-bold text-decoration-underline text-uppercase text-reset fs-12">Nauman</span>
                </p>
            </div>
        </div>
    </div>

    <!-- Vendor js -->
    <script src="{{asset('backend/assets/js/vendor.min.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('backend/assets/js/app.js')}}"></script>

</body>

</html>