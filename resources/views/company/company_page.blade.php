<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$company->name ?? 'Company Page'}}</title>
    <link rel="shortcut icon" type="images/x-icon" href="{{asset('frontend/images/favicon.ico')}}">
    <!-- remix icon  -->
    <link rel="stylesheet" href="{{asset('frontend/css/remixicon.css')}}">
    <!-- swiper -->
    <link rel="stylesheet" href="{{asset('frontend/css/swiper-bundle.min.css')}}" />
    <!-- bootstrap  -->
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/style.min.css')}}">
</head>

<body data-bs-spy="scroll" data-bs-target="#navbarCollapse">

    <!-- nav-bar start  -->
    <header>
        <nav class="navbar navbar-expand-lg fixed-top navbar-custom sticky sticky-light" id="navbar">
            <div class="container">
                <div class="navbar-brand logo">
                    <a class="navbar-caption fs-4 text-primary ls-1 fw-bold" href="{{url('/')}}"><i
                            class="ri-gps-fill text-orange fs-3 me-1"></i>{{$company->name}}
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fw-bold fs-4"><i class="ri-menu-5-line"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mx-auto" id="navbar-navlist">
                        <li class="nav-item">
                            <a class="nav-link" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#services">Services</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#contacts">Contacts</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav nav-btn">
                        @auth
                        <li class="nav-item">
                            <a class="btn btn-orange text-light" href="{{route('dashboard')}}">Dashboard</a>
                        </li>
                            @else
                            <li class="nav-item">
                            <a class="btn btn-orange text-light" href="{{route('login')}}">Login</a>
                        </li>
                        @endauth
                        
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- nav-bar end  -->
    <section class="hero-section bg-img-1 bg-home-1  pb-0" id="home">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-lg-10">
                    <h1 class="display-3 fw-semibold lh-base text-primary">Welcome to  <span class="text-orange text-line">
                            {{$company->name}}</span></h1>
                    <p class="mt-4">{{$company->header_content}}
                    </p>
                    <div class="main-btn my-5">
                        <a href="javascript:void(0);" class="btn btn-primary my-2">Try
                            30-Days Trial</a>
                        <a href="javascript:void(0);" class="btn btn-outline-primary ms-2">Schedule
                            a Call</a>
                    </div>
                    <img src="{{asset($company->company_logo)}}" alt class="img-fluid mt-5 rounded-4">
                </div>
            </div>
        </div>
        <!-- <img src="images/Meteor.svg" alt="" class="img-fluid position-absolute top-0 w-100 z-n1 opacity-25"> -->
    </section>
    <div class="position-relative">
        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                width="1440" height="150" preserveAspectRatio="none" viewBox="0 0 1440 150">
                <g mask="url(&quot;#SvgjsMask1022&quot;)" fill="none">
                    <path d="M 0,58 C 144,73 432,131.8 720,133 C 1008,134.2 1296,77.8 1440,64L1440 250L0 250z"
                        fill="rgba(255, 255, 255, 1)"></path>
                </g>
                <defs>
                    <mask id="SvgjsMask1022">
                        <rect width="1440" height="250" fill="#ffffff"></rect>
                    </mask>
                </defs>
            </svg>
        </div>
    </div>
    <section class="section brand-section">
        <div class="container">
            <div class="brand">
                <div class="row align-items-center justify-content-center text-center g-4">
                    <div class="col-lg-2 col-6">
                        <a href="#">
                            <img src="{{asset('frontend/images/logo/amazon.svg')}}" alt class="img-fluid brand-logo">
                        </a>
                    </div>
                    <div class="col-lg-2 col-6">
                        <a href="#">
                            <img src="{{asset('frontend/images/logo/google.svg')}}" alt class="img-fluid brand-logo">
                        </a>
                    </div>
                    <div class="col-lg-2 col-6">
                        <a href="#">
                            <img src="{{asset('frontend/images/logo/lenovo.svg')}}" alt class="img-fluid brand-logo">
                        </a>
                    </div>
                    <div class="col-lg-2 col-6">
                        <a href="#">
                            <img src="{{asset('frontend/images/logo/paypal.svg')}}" alt class="img-fluid brand-logo">
                        </a>
                    </div>
                    <div class="col-lg-2 col-6">
                        <a href="#">
                            <img src="{{asset('frontend/images/logo/shopify.svg')}}" alt class="img-fluid brand-logo">
                        </a>
                    </div>
                    <div class="col-lg-2 col-6">
                        <a href="#">
                            <img src="{{asset('frontend/images/logo/spotify.svg')}}" alt class="img-fluid brand-logo">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section about-section pt-5 z-1" id="about">
        <div class="container">
            <div class="row align-items-center justify-content-start g-lg-4 g-3">
                <div class="col-xl-5">
                    <div class="title-sm">
                        <span>
                            EASY HANDLING
                        </span>
                    </div>
                    <div class="about-title main-title mt-3">
                        <h2 class="text-primary">Discover Powerful Features To Boost <span class="text-orange text-line p-0">
                                Productivity</span>
                        </h2>
                    </div>
                </div>
                <div class="col-xl-6 offset-xl-1">
                    <div class="row g-lg-4 g-3 ">
                        <div class="col-lg-6 col-md-6">
                            <div class="about-style-two">
                                <div class="icon">
                                    <img src="{{asset('frontend/images/appoinment.png')}}" alt="Icon">
                                </div>
                                <h3><a href="javascript:void(0);">Advanced online
                                        appointment</a>
                                </h3>
                                <div class="bottom">
                                    <span>Appoinment</span>
                                    <a href="javascript:void(0);" class="angle-btn">
                                        <img src="{{asset('frontend/images/arrow-1.png')}}" alt="Arrow Icon">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="about-style-two">
                                <div class="icon">
                                    <img src="{{asset('frontend/images/team.png')}}" alt="Icon">
                                </div>
                                <h3><a href="javascript:void(0);">Advanced online
                                        appointment</a>
                                </h3>
                                <div class="bottom">
                                    <span>Management</span>
                                    <a href="javascript:void(0);" class="angle-btn">
                                        <img src="{{asset('frontend/images/arrow-1.png')}}" alt="Arrow Icon">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="row g-lg-4 g-3">
                        <div class="col-xl-4 col-lg-6 col-md-6 ">
                            <div class="about-style-two">
                                <div class="icon">
                                    <img src="{{asset('frontend/images/users.png')}}" alt="Icon">
                                </div>
                                <h3><a href="javascript:void(0);">Multiple user &
                                        management</a>
                                </h3>
                                <div class="bottom">
                                    <span>Multi User</span>
                                    <a href="javascript:void(0);" class="angle-btn">
                                        <img src="{{asset('frontend/images/arrow-1.png')}}" alt="Arrow Icon">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 ">
                            <div class="about-style-two">
                                <div class="icon">
                                    <img src="{{asset('frontend/images/creativity.png')}}" alt="Icon">
                                </div>
                                <h3><a href="javascript:void(0);">Editable & highly
                                        customizable</a>
                                </h3>
                                <div class="bottom">
                                    <span>Customization</span>
                                    <a href="javascript:void(0);" class="angle-btn">
                                        <img src="{{asset('frontend/images/arrow-1.png')}}" alt="Arrow Icon">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6 col-md-6 ">
                            <div class="about-style-two">
                                <div class="icon">
                                    <img src="{{asset('frontend/images/cloud-lock.png')}}" alt="Icon">
                                </div>
                                <h3><a href="javascript:void(0);">Superfast cloud data
                                        saved</a>
                                </h3>
                                <div class="bottom">
                                    <span>Cloud Server</span>
                                    <a href="javascript:void(0);" class="angle-btn">
                                        <img src="{{asset('frontend/images/arrow-1.png')}}" alt="Arrow Icon">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="about-style-two">
                        <div class="icon">
                            <img src="{{asset('frontend/images/appoinment.png')}}" alt="Icon">
                        </div>
                        <h3><a href="javascript:void(0);">User Next Level Interface Site</a>
                        </h3>
                        <div class="bottom">
                            <span>Website</span>
                            <a href="javascript:void(0);" class="angle-btn">
                                <img src="{{asset('frontend/images/arrow-1.png')}}" alt="Arrow Icon">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section feature-section bg-light">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-5">
                    <div class="title-sm">
                        <span>
                            STRUCTURE
                        </span>
                    </div>
                    <div class="feature-title main-title mt-3">
                        <h2 class="text-primary">Discover All <span class="text-orange text-line">Our
                                Features</span>
                        </h2>
                        <p class="my-3">{{$company->about_us_content}}</p>
                    </div>
                    <div class="row mt-4 g-lg-4 g-3">
                        <div class="col-lg-6">
                            <h6 class="text-primary fw-semibold"><i
                                    class="ri-checkbox-blank-circle-fill text-orange me-3"></i> Trends
                                Tracking</h6>
                        </div>
                        <div class="col-lg-6">
                            <h6 class="text-primary fw-semibold"><i
                                    class="ri-checkbox-blank-circle-fill text-orange me-3"></i>
                                Loyalty Programs</h6>
                        </div>
                        <div class="col-lg-6">
                            <h6 class="text-primary fw-semibold"><i
                                    class="ri-checkbox-blank-circle-fill text-orange me-3"></i>Vendor
                                Management</h6>
                        </div>
                        <div class="col-lg-6">
                            <h6 class="text-primary fw-semibold"><i
                                    class="ri-checkbox-blank-circle-fill text-orange me-3"></i>Billing</h6>
                        </div>
                    </div>
                    <div class="feature-link mt-5">
                        <a href="javascript:void(0);" class="btn btn-primary">All
                            categories</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="{{asset('frontend/images/dashbord-3.png')}}" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </section>
    <section class="section services-section" id="services">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6">
                    <img src="{{asset('frontend/images/dashbord-4.png')}}" alt="" class="img-fluid">
                </div>
                <div class="col-lg-5">
                    <div class="title-sm">
                        <span>
                            PERFORMANCE METRICS
                        </span>
                    </div>
                    <div class="feature-title main-title mt-3">
                        <h2 class="text-primary">Grow Up Your Business With In
                            <span class="text-orange text-line">5 Minutes</span>
                        </h2>
                        <p class="my-3">{{$company->services_content}}</p>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-6">
                            <div class="counter">
                                <h3 class="text-primary fw-bold">200K</h3>
                                <h6 class="text-muted">Active user from the
                                    community</h6>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="counter">
                                <h3 class="text-primary fw-bold">90% <span class="fs-6 text-muted">(Positive
                                        Reating)</span></h3>
                                <ul class="d-flex text-orange">
                                    <li>
                                        <i class="ri-star-fill"></i>
                                    </li>
                                    <li>
                                        <i class="ri-star-fill"></i>
                                    </li>
                                    <li>
                                        <i class="ri-star-fill"></i>
                                    </li>
                                    <li>
                                        <i class="ri-star-fill"></i>
                                    </li>
                                    <li>
                                        <i class="ri-star-half-fill"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="services-detail mt-4">
                        <li>
                            <i class="ri-checkbox-blank-circle-fill"></i>
                            <h6 class="text-dark">Get Overview at a glance.
                            </h6>
                        </li>
                        <li class="my-3">
                            <i class="ri-checkbox-blank-circle-fill"></i>
                            <h6 class="text-dark">Deposite funds easily,
                                security. </h6>
                        </li>
                        <li>
                            <i class="ri-checkbox-blank-circle-fill"></i>
                            <h6 class="text-dark">First Working Process.
                            </h6>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="counter-part pt-0 bg-primary">
        <div class="container">
            <!-- row start  -->
            <div class="row align-items-center">
                <div class="col-lg-3">
                    <div class="counter-no mt-5 text-center p-4">
                        <div class="icon mb-5">
                            <i class="ri-team-line fs-1 p-3 bg-success-subtle rounded-3 text-primary"></i>
                        </div>
                        <div class="number">
                            <h2 class="text-white fw-bold">100,000+</h2>
                        </div>
                        <div class="content">
                            <p class="text-white-50">No. of People Join</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="counter-no mt-5 text-center shadow-none">
                        <div class="icon mb-5">
                            <i class="ri-checkbox-line fs-1 p-3 bg-success-subtle rounded-3 text-primary"></i>
                        </div>
                        <div class="number">
                            <h2 class="text-white fw-bold">120+</h2>
                        </div>
                        <div class="content">
                            <p class="text-white-50">Countries Reached</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="counter-no mt-5 text-center p-4">
                        <div class="icon mb-5">
                            <i class="ri-vidicon-line fs-1 p-3 bg-success-subtle rounded-3 text-primary"></i>
                        </div>
                        <div class="number">
                            <h2 class="text-white fw-bold">425,000+</h2>
                        </div>
                        <div class="content">
                            <p class="text-white-50">No. of Sessions Given</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="counter-no mt-5 text-center p-4">
                        <div class="icon mb-5">
                            <i class="ri-hourglass-fill fs-1 p-3 bg-success-subtle rounded-3 text-primary"></i>
                        </div>
                        <div class="number">
                            <h2 class="text-white fw-bold">500K</h2>
                        </div>
                        <div class="content">
                            <p class="text-white-50">Hour of work</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row end  -->
        </div>
    </section>

    <section class="section faq-section">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-lg-7">
                    <div class="title-sm">
                        <span>
                            NEED SUPPORT
                        </span>
                    </div>
                    <div class="price-title main-title mt-3">
                        <h2 class="text-primary">Frequently asked <span class="text-orange text-line">Questions</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-between mt-5">
                <div class="col-lg-5 mt-5">
                    <div class="faq-all">
                        <h5 class="lh-base">
                            <i
                                class="ri-number-1 me-3 p-2 bg-success-subtle text-primary rounded-circle align-middle"></i>
                            How Benefit That I Got When Choose Basic Plan
                        </h5>
                        <p class="ms-5">Contrary to this, individuals above this
                            tax
                            bracket of
                            30% can benefit from low basic pay. This
                            is because the or retirement benefits
                            have to be approximately 27% of the basic pay.</p>
                    </div>
                    <div class="faq-all">
                        <h5 class="mt-5">
                            <i
                                class="ri-number-2 me-3 p-2 bg-success-subtle text-primary rounded-circle align-middle"></i>
                            How Do I Organize My Notes?
                        </h5>
                        <p class="ms-5">Try using coloured paper so that all
                            related
                            notes are made on sheets of the same colour. Some
                            notebooks have different colours and
                            have
                            the advantage of keeping all your notes in one
                            place.</p>
                    </div>
                    <div class="faq-all">
                        <h5 class="mt-5">
                            <i
                                class="ri-number-3 me-3 p-2 bg-success-subtle text-primary rounded-circle align-middle"></i>
                            How Long For A Standard Project
                        </h5>
                        <p class="ms-5">Typically, an average project will take
                            in the region of three four months. Some of our
                            projects
                            are small, fully specified and are completed in four
                            six weeks. Others can take six months or much
                            longer.</p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="faq-all">
                        <h5 class="lh-base">
                            <i
                                class="ri-number-4 me-3 p-2 bg-success-subtle text-primary rounded-circle align-middle"></i>
                            How Do I Change My Email or Password?
                        </h5>
                        <p class="ms-5">You can change your Webmail password in
                            the one.com control panel under Email if you have
                            forgotten it. Here you can manage all email accounts
                            on your domain.</p>
                    </div>
                    <div class="faq-all">
                        <h5 class="mt-5">
                            <i
                                class="ri-number-5 me-3 p-2 bg-success-subtle text-primary rounded-circle align-middle"></i>
                            Can I Lock My Note App?
                        </h5>
                        <p class="ms-5">Through the collaboration with customers
                            in discussing needs and demand,
                            we're able to attain
                            mutual understanding, gain customer trust to offer
                            appropriate advice.</p>
                    </div>
                    <div class="faq-all">
                        <h5 class="mt-5 lh-base">
                            <i
                                class="ri-number-6 me-3 p-2 bg-success-subtle text-primary rounded-circle align-middle"></i>
                            Can My Premium License Be Used For All Devices?
                        </h5>
                        <p class="ms-5">The Remote Access License is an
                            endpoint-based license designated for a single user.
                            It allows
                            to the user remotely connect to a maximum of 3
                            devices from an unlimited number of devices.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="faq-back">
            <h1 class="fw-bold">
                FaQ's
            </h1>
        </div>
    </section>



    <section class="section cta-section bg-light" id="contacts">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-4">
                    <div class="d-flex bg-white p-3 shadow-sm">
                        <lord-icon src="https://cdn.lordicon.com/tdtlrbly.json" trigger="loop"
                            colors="primary:#121331,secondary:#ee8f66" style="width:80px;height:80px">
                        </lord-icon>
                        <div class="d-block align-self-center ms-4">
                            <h4 class="fw-semibold text-primary">Office address</h4>
                            <span>{{$company->contact_info}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="d-flex bg-white p-3 shadow-sm">
                        <lord-icon src="https://cdn.lordicon.com/mhhpoybt.json" trigger="loop"
                            colors="primary:#121331,secondary:#ee8f66,tertiary:#ebe6ef"
                            style="width:80px;height:80px">
                        </lord-icon>
                        <div class="d-block align-self-center ms-4">
                            <h4 class="fw-semibold text-primary">Telephone number</h4>
                            <span>{{$company->social_phone}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="d-flex bg-white p-3 shadow-sm">
                        <lord-icon src="https://cdn.lordicon.com/nqisoomz.json" trigger="loop"
                            colors="primary:#121331,secondary:#ebe6ef,tertiary:#ee8f66,    quaternary:#3a3347"
                            style="width:80px;height:80px">
                        </lord-icon>
                        <div class="d-block ms-4 align-self-center">
                            <h4 class="fw-semibold text-primary">
                                Mail address</h4>
                            <span>{{$company->social_email}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <footer class="section footer-part-3 py-5 footer-part">
        <div class="container">
            <div class="row my-5 justify-content-between">
                <div class="col-lg-4 align-self-start">
                    <div class="footer-about">
                        <div class="logo">
                            <a class="navbar-caption fs-4 text-light ls-1 fw-bold" href="javascript:void(0);"><i
                                    class="ri-gps-fill text-orange fs-3 me-1"></i>{{$company->name}}
                            </a>
                        </div>
                        <div class="d-flex mt-4">
                            <i class="ri-twitter-fill fs-5 me-3 text-orange"></i>
                            <p class="text-white-50">Greater pleasures el
                                esndures pains avoid welcomed avoided pariatu.
                            </p>
                        </div>
                        <h5 class="text-white mt-3">Subscribe to our Site :
                        </h5>
                        <div class="form-button mt-4">
                            <form action="" class="d-flex align-items-center ">
                                <input type="email" class="form-control" placeholder="Enter email">
                                <a href="javascript:void(0);" class="me-2"><i class="ri-send-plane-2-line"></i></a>
                            </form>
                        </div>
                        <div class="copy-info text-white-50 mt-4">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script> {{$company->name}} - Created By <a href="#"
                                class="text-white text-decoration-underline">Nauman
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-12">
                    <h5 class="text-light">Company : </h5>
                    <ul class="list-unstyled mt-4">
                        <li><a href="javascript:void(0);" class="text-white-50">Company
                                Profile</a></li>
                        <li><a href="javascript:void(0);" class="text-white-50">Help Center</a>
                        </li>
                        <li><a href="javascript:void(0);" class="text-white-50">Services</a></li>
                        <li><a href="javascript:void(0);" class="text-white-50">Plans &
                                Pricing</a></li>
                        <li><a href="javascript:void(0);" class="text-white-50">Team Members </a>
                        </li>
                        <li><a href="javascript:void(0);" class="text-white-50">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 col-12">
                    <h5 class="text-light fs-5">Community :</h5>
                    <ul class="list-unstyled mt-4">
                        <li><a href="javascript:void(0);" class="text-white-50">Career</a></li>
                        <li><a href="javascript:void(0);" class="text-white-50">Leadership</a>
                        </li>
                        <li><a href="javascript:void(0);" class="text-white-50">Press & Media</a>
                        </li>
                        <li><a href="javascript:void(0);" class="text-white-50">
                                Projects</a></li>
                        <li><a href="javascript:void(0);" class="text-white-50">Marketing
                                Services
                            </a>
                        </li>
                        <li><a href="javascript:void(0);" class="text-white-50">Challenge Of
                                Project
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 col-12">
                    <h5 class="text-light fs-5">Solution :</h5>
                    <ul class="list-unstyled mt-4">
                        <li><a href="javascript:void(0);" class="text-white-50">Small Business</a></li>
                        <li><a href="javascript:void(0);" class="text-white-50">Ebook Library</a>
                        </li>
                        <li><a href="javascript:void(0);" class="text-white-50">Free Theme</a>
                        </li>
                        <li><a href="javascript:void(0);" class="text-white-50">
                                Affiliates</a></li>
                        <li><a href="javascript:void(0);" class="text-white-50">
                                Testimonial
                            </a>
                        </li>
                        <li><a href="javascript:void(0);" class="text-white-50">
                                Themes
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
    <script src="{{asset('frontend/js/app.js')}}"></script>
</body>

</html>
