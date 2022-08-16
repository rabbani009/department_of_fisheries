<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="description" content="Fisherman registration and id card supply" />
    <meta name="keywords" content="fisherman, registration, id card, supply" />
    <meta name="author" content="Radisson Digital Technology Ltd." />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="shortcut icon" href="{{ asset('frontend') }}/img/favicon.ico" type="image/x-icon" />

    <!-- Bootstrap CSS -->
    <title>মৎস্য অধিদপ্তর-গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    <!-- Vendors styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0-beta1/css/bootstrap.min.css"
        integrity="sha512-o/MhoRPVLExxZjCFVBsm17Pkztkzmh7Dp8k7/3JrtNCHh0AQ489kwpfA3dPSHzKDe8YCuEhxXq3Y71eb/o6amg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Slick slider -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"
        integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"
        integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/main.min.css" />
</head>

<body>
    <!-- Header -->
    <header id="home">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#home">
                    <img class="w-50" src="{{ asset('frontend') }}/img/logo.png" alt="Main logo" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#home">হোম</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about-us">আমাদের সম্পর্কে</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#services">আমাদের সেবাসমূহ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#home">প্রবেশ করুন</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main role="main">
        <!-- Features section -->
        <section class="features">
            <div class="features-section-inner d-flex align-items-center justify-content-center">
                <div class="container">
                    <div class="col-md-8 mx-auto">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="features-content d-flex flex-column justify-content-center">
                                    <h1 class="text-light">জেলেদের নিবন্ধন ও পরিচয়পত্র প্যানেল আপনাকে স্বাগতম</h1>
                                    {{-- <p class="lead text-light">
                                        নিবন্ধিত জেলেদের বিস্তারিত তালিকার জন্য মৎস্য অধিদপ্তরের আইসিটি শাখায় যোগাযোগ করুন।
                                    </p> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-0 features-login-form p-5">
                                    <div class="login-form-header text-center">
                                        <img class="img-fluid w-25" src="{{ asset('frontend') }}/img/dof-logo.png"
                                            alt="" />
                                        <div class="d-flex flex-column py-4">
                                            <span class="pb-2">জেলেদের নিবন্ধন ও পরিচয়পত্র</span>
                                            <small>মৎস্য অধিদপ্তর বাংলাদেশ</small>
                                        </div>
                                    </div>
                                    <form class="mb-2" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="mb-4">
                                            <input type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email') }}" name="email" id="email"
                                                placeholder="ইউজারনেম" required autocomplete="email" autofocus />
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="mb-4">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" id="password" placeholder="পাসওয়ার্ড" required
                                                autocomplete="current-password" />
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="d-grid mb-4">
                                            <button type="submit" class="btn btn-success btn-lg">
                                                লগইন
                                            </button>
                                        </div>
                                        <div class="d-grid mb-4">
                                            <p class="lead text-success text-center">
                                                অনুগ্রহ করে ইউজারনেম ও পাসওয়ার্ড দিয়ে লগইন করুন
                                            </p>
                                        </div>

                                        <div class="d-grid">
                                            <a class="text-decoration-none text-capitalize text-center text-muted"
                                                href="{{ route('password.request') }}">forgot your
                                                <span class="text-success">password?</span></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Emergency hot line section -->
        <section class="emergency-hot-line">
            <div class="emergency-hot-line-inner">
                <div class="container">
                    <div
                        class="emergency-hot-line-content-wrapper bg-light d-flex align-items-center gap-2 py-4 rounded-2 px-4">
                        <div class="hot-line-item text-center">
                            <img class="img-fluid" src="{{ asset('frontend') }}/img/hot-line-icon/106.png"
                                alt="106" />
                        </div>

                        <div class="hot-line-item text-center">
                            <img class="img-fluid" src="{{ asset('frontend') }}/img/hot-line-icon/109.png"
                                alt="109" />
                        </div>

                        <div class="hot-line-item text-center">
                            <img class="img-fluid" src="{{ asset('frontend') }}/img/hot-line-icon/333.png"
                                alt="333" />
                        </div>

                        <div class="hot-line-item text-center">
                            <img class="img-fluid" src="{{ asset('frontend') }}/img/hot-line-icon/999.png"
                                alt="999" />
                        </div>

                        <div class="hot-line-item text-center">
                            <img class="img-fluid" src="{{ asset('frontend') }}/img/hot-line-icon/1090.png"
                                alt="1090" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About us section -->
        <section class="about-us bg-light py-5" id="about-us">
            <div class="about-us-inner">
                <div class="container">
                    <div class="title text-center py-5">
                        <h2>আমাদের সম্পর্কে</h2>
                        <div class="underline"></div>
                    </div>
                </div>
                <div class="container py-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="about-us-img-wrapper">
                                <img class="img-fluid rounded"
                                    src="{{ asset('frontend') }}/img/corporate-office.jpg" alt="Our office" />
                            </div>
                        </div>
                        <div class="col-md-5 offset-md-1">
                            <div class="about-us-content py-4 py-md-0">
                                <p class="lead">
                                    বাংলাদেশের আর্থ-সামাজিক অবস্থার প্রেক্ষাপটে মৎস্য খাতের
                                    গুরুত্ব ও প্রয়োজনীয়তা অপরিসীম। প্রাণীজ আমিষের চাহিদা পূরণ,
                                    কর্মসংস্থান সৃষ্ঠি ও বৈদেশিক মুদ্রা অর্জনে এ খাত জাতীয়
                                    অর্থনীতিতে গুরুত্বপূর্ণ ভূমিকা রেখে চলেছে। সরকারও এ খাতের
                                    উন্নয়নে বিশেষ গুরুত্ব আরোপ করে মৎস্য অধিদপ্তরের বিকাশ
                                    ঘটিয়েছে। মৎস্য ও প্রাণীসম্পদ মন্ত্রণালয়ের প্রশাসনিক
                                    নিয়ন্ত্রণাধীন মৎস্য অধিদপ্তর দেশের মৎস্য খাতের উন্নয়নে
                                    সুদূরপ্রসারী পরিকল্পনা বিবেচনায় নিয়ে বিভিন্ন প্রকল্প
                                    বাস্তবায়ন করছে। মাছচাষ সম্প্রসারণ ও মুক্ত জলাশয়ে মৎস্য
                                    সম্পদের জৈবিক ব্যবস্থাপনা নিশ্চিত করার মাধ্যমে দরিদ্র-বান্ধব
                                    অর্থনৈতিক উন্নয়নের পথকে সুগম করতে বদ্ধপরিকর মৎস্য অধিদপ্তর।
                                    মৎস্য অধিদপ্তরের নেতৃত্বে একজন মহাপরিচালক কাজ করেন। তিনি
                                    চারজন পরিচালক (একজন সংরক্ষিত) এবং ২ জন প্রধান বৈজ্ঞানিক
                                    কর্মকর্তা (পরিচালকের সমতুল্য) এর সহায়তায় কার্যক্রম পরিচালিত
                                    করেন। মৎস্য অধিদপ্তরে বিভিন্ন ধাপে ১৫৫৩ জন কারিগরি কর্মকর্তা
                                    এবং সহায়ক স্টাফ রয়েছে। বিভাগ, জেলা এবং উপজেলা (উপজেলা)
                                    পর্যায়ে যথাক্রমে উপ-পরিচালক, জেলা মৎস্য কর্মকর্তা এবং
                                    সিনিয়র/উপজেলা মৎস্য কর্মকর্তার নেতৃত্বে প্রশাসনিক কাঠামো
                                    রয়েছে। এগুলি ছাড়াও মৎস্য অধিদপ্তরের অধীনে তিনটি মাছ
                                    পরিদর্শন ও মান নিয়ন্ত্রণ কেন্দ্র রয়েছে। উপরন্তু মৎস্য
                                    অধিদপ্তর সামুদ্রিক মৎস্য স্টেশন, মৎস্য প্রশিক্ষণ একাডেমী,
                                    মৎস্য প্রশিক্ষণ এবং সম্প্রসারণ কেন্দ্র, এবং মাছ হ্যাচারি
                                    পরিচালিত করে। প্রতিটি ধাপে মৎস্য অধিদপ্তর আধুনিক প্রযুক্তির
                                    ব্যবহারকে উৎসাহিত করছে। তারই অংশ হিসেবে দেশের মৎস্য
                                    পেশাজীবীদের নিবন্ধনে ডিজিটাল প্রযুক্তির ব্যবহারেও বলিষ্ঠ
                                    পদক্ষেপ নিয়েছে বাংলাদেশ মৎস্য অধিদপ্তর।
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services section -->
        <section class="services py-5" id="services">
            <div class="services-inner">
                <div class="container">
                    <div class="title text-center py-5">
                        <h2>আমাদের সেবাসমূহ</h2>
                        <div class="underline"></div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card bg-light text-center border-0 py-3 my-3 shadow-sm">
                                <img src="{{ asset('frontend') }}/img/services-icon/registration.png" alt="Online registration" class="card-img-top w-25 mx-auto py-3">
                                <div class="card-body card-body-fortext">
                                    <h4>অনলাইন নিবন্ধন</h4>
                                    <p class="lead">মাঠ পর্যায়ের কর্মীদের দ্বারা জেলেদের তথ্য অনলাইনে নিবন্ধন ও সংরক্ষণ।</p>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-md-3">
                            <div class="card bg-light text-center border-0 py-3 my-3 shadow-sm">
                                <img src="{{ asset('frontend') }}/img/services-icon/sms.png" alt="Online registration" class="card-img-top w-25 mx-auto py-3">
                                <div class="card-body card-body-fortext">
                                    <h4>এসএমএস বিজ্ঞপ্তি</h4>
                                    <p class="lead">এসএমএস বিজ্ঞপ্তির দ্বারা জেলেদের তথ্য হালনাগাদ করণ।</p>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-md-3">
                            <div class="card bg-light text-center border-0 py-3 my-3 shadow-sm">
                                <img src="{{ asset('frontend') }}/img/services-icon/id-card.png" alt="Online registration" class="card-img-top w-25 mx-auto py-3">
                                <div class="card-body card-body-fortext">
                                    <h4>জেলেদের আইডি কার্ড বিতরণ</h4>
                                    <p class="lead">অনলাইনে নিবন্ধিত জেলেদের তথ্য দ্বারা একক স্মার্ট আইডি কার্ড তৈরি ও বিতরণ।</p>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-md-3">
                            <div class="card bg-light text-center border-0 py-3 my-3 shadow-sm">
                                <img src="{{ asset('frontend') }}/img/services-icon/monitoring.png" alt="Online registration" class="card-img-top w-25 mx-auto py-3">
                                <div class="card-body card-body-fortext">
                                    <h4>সফটওয়্যার ট্রেনিং</h4>
                                    <p class="lead">কর্মীদের সফটওয়্যার ব্যবহারের প্রয়োজনীয় ট্রেনিং প্রধান।</p>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-md-3">
                            <div class="card bg-light text-center border-0 py-3 my-3 shadow-sm">
                                <img src="{{ asset('frontend') }}/img/services-icon/booking.png" alt="Online registration" class="card-img-top w-25 mx-auto py-3">
                                <div class="card-body card-body-fortext">
                                    <h4>অ্যাপ্লিকেশন সেবা</h4>
                                    <p class="lead">মোবাইল অ্যাপের মাধ্যমে মাঠ পর্যায়ের কর্মী দ্বারা জেলেদের আইডি কার্ডের প্রয়োজনীয় তথ্য গ্রহণ ও সেবা প্রদান।</p>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-md-3">
                            <div class="card bg-light text-center border-0 py-3 my-3 shadow-sm">
                                <img src="{{ asset('frontend') }}/img/services-icon/support.png" alt="Online registration" class="card-img-top w-25 mx-auto py-3">
                                <div class="card-body card-body-fortext">
                                    <h4>গ্রাহক সমর্থন</h4>
                                    <p class="lead">মাঠ পর্যায়ের কর্মীদের কাস্টমার সাপোর্ট সেবা প্রদান।</p>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-md-3">
                            <div class="card bg-light text-center border-0 py-3 my-3 shadow-sm">
                                <img src="{{ asset('frontend') }}/img/services-icon/data-processing.png" alt="Online registration" class="card-img-top w-25 mx-auto py-3">
                                <div class="card-body card-body-fortext">
                                    <h4>নিবন্ধনের তথ্য যাচাই</h4>
                                    <p class="lead">জেলেদের নিবন্ধিত তথ্য যাচাই বাছাইকরন এবং অপ্রয়োজনীয় তথ্য বর্জন।</p>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-md-3">
                            <div class="card bg-light text-center border-0 py-3 my-3 shadow-sm">
                                <img src="{{ asset('frontend') }}/img/services-icon/search.png" alt="Online registration" class="card-img-top mx-auto w-25 py-3">
                                <div class="card-body card-body-fortext">
                                    <h4>তথ্য হালনাগাদ</h4>
                                    <p class="lead">প্রয়োজনীয় তথ্য হালনাগাদ সেবা।</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Helping partners -->

    </main>

    <!-- Footer section -->
    <footer>
        <div class="footer-inner py-5 bg-success">
            <div class="container">
                <div>
                    <p class="lead text-center text-light mb-0">&copy; Design and Develop by <a class="text-light text-bold h3 text-decoration-none" href="https://www.radissonbd.com/">Radisson Digital Technologies Ltd
                    </a></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Vendors scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Fonts -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0-beta1/js/bootstrap.bundle.min.js"
        integrity="sha512-ndrrR94PW3ckaAvvWrAzRi5JWjF71/Pw7TlSo6judANOFCmz0d+0YE+qIGamRRSnVzSvIyGs4BTtyFMm3MT/cg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Slick slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
        integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Main script -->
    <script src="{{ asset('frontend') }}/js/index.js"></script>
</body>

</html>
