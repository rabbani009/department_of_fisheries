<!doctype html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">

        <title>DOF</title>
    
        <link rel="shortcut icon" href="{{ asset('admin') }}/assets/dist/img/favicon.png">

        <link href="{{ asset('admin') }}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <link href="{{ asset('admin') }}/assets/dist/css/style.css" rel="stylesheet">
    </head>
    <body class="bg-white">
        <div class="d-flex align-items-center justify-content-center text-center h-100vh">
            <div class="form-wrapper m-auto">
                <div class="form-container form-container-2 my-4">
                    <div class="panel bg-light">
                        
                        <div class="panel-header text-center mb-3">
                            <a href="{{route('home')}}" class="logo"><img src="{{ asset('admin') }}/assets/dist/img/logo.png" alt=""
                                style="height: 50px !important;">
                                <h5>জেলেদের নিবন্ধন ও পরিচয় পত্র </h5>
                                <h6> মৎস্য অধিদপ্তর বাংলাদেশ </h6>
                        </a>
                            <h3 class="fs-24">Sign into your account!</h3>
                        </div>
                            <form class="register-form" method="POST" action="{{ route('login') }}">
                                @csrf
                            <div class="form-group">
                                <input id="email" type="email" placeholder="Enter email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="custom-control custom-checkbox mb-3">
                                {{-- <input type="checkbox" class="custom-control-input" id="customCheck1"> --}}
                                <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="remember"  style="float: left;">Remember Me</label>
                            </div>
 
                            <button type="submit" class="btn btn-success btn-block">Login</button>
                            <!-- <p class="text-muted text-center mt-3 mb-0">Don't have an account? <a class="external" href="{{ route('register') }}">Sign Up</a>
                            </p> -->
                            <div class="bottom-text text-center my-3">
                                {{-- Don't have an account? <a href="register.html" class="font-weight-500">Sign Up</a><br> --}}
                                Forgot Your <a href="{{ route('password.request') }}" class="external">Password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
  
        <script src="{{ asset('admin') }}/assets/plugins/jQuery/jquery-3.4.1.min.js"></script>
        <script src="{{ asset('admin') }}/assets/dist/js/popper.min.js"></script>
        <script src="{{ asset('admin') }}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>