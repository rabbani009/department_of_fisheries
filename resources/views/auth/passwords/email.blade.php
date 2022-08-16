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
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="panel-header text-center mb-3">
                            <h3 class="fs-24">Reset Password</h3>
                        </div>
                            <form class="register-form" method="POST" action="{{ route('password.email') }}">
                                @csrf
                           
                                <div class="form-group">
                                <label style="float: left;">Email Address</label>
                                <input id="email"  type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
 
                            <button type="submit" class="btn btn-success btn-block">Send Password Reset Link</button>
                         
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