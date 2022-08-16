<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
    <meta name="author" content="">
    <title>Department of Fisheries (DOF)</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin') }}/assets/dist/img/favicon.png">
    <link href="{{ asset('admin') }}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/assets/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/assets/plugins/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/assets/plugins/typicons/src/typicons.min.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/assets/plugins/themify-icons/themify-icons.min.css" rel="stylesheet">
    <!--Third party Styles(used by this page)-->
    <link href="{{ asset('admin') }}/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!--Start Your Custom Style Now-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <link href="{{ asset('admin') }}/assets/dist/css/style.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body class="fixed">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <div class="wrapper">
        <!-- Sidebar  -->
        @include('admin.partials.sidebar')
        <!-- Page Content  -->
        <div class="content-wrapper">
            <div class="main-content">
                @include('admin.partials.header')
                @yield('content')
            </div>
            <!--/.main content-->
            <footer class="footer-content">
                <div class="footer-text d-flex align-items-center justify-content-center">
                    <div class="copy">© 2018 Responsive Bootstrap 4 Dashboard Template</div>
                </div>
            </footer>
            <!--/.footer content-->
            <div class="overlay"></div>
        </div>
        <!--/.wrapper-->
    </div>

    {{-- <script data-cfasync="false" src="cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> --}}
    <script src="{{ asset('admin') }}/assets/plugins/jQuery/jquery-3.4.1.min.js"></script>
    <script src="{{ asset('admin') }}/assets/dist/js/popper.min.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/metisMenu/metisMenu.min.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
    <!-- Third Party Scripts(used by this page)-->
    <script src="{{ asset('admin') }}/assets/plugins/datatables/dataTables.min.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <!--Page Active Scripts(used by this page)-->
    <script src="{{ asset('admin') }}/assets/plugins/datatables/data-basic.active.js"></script>
    <!--Page Scripts(used by all page)-->
    <script src="{{ asset('admin') }}/assets/dist/js/sidebar.js"></script>

    <script>
        $('div.alert').not('.alert-important').delay(10000).fadeOut(350);
    </script>
    @stack('js')
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.bangla@1/dist/jquery.bangla.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script>
        // $(document).ready(function() {
        //     $('#division-bangla').on('change', function() {
        //         alert('ok');
        //     })
        // });
        $('#input-area').bangla('enable', true);
        $('#input-area-two').bangla('enable', true);
        $('#input-area-three').bangla('enable', true);
        $('#source-of-money').bangla('enable', true);
        $('#input-department-bangla').bangla('enable', true);
        $('#input-division-bangla').bangla('enable', true); 
        $('#main-profession-input-area').bangla('enable', true);
        $('#sub-profession-input-area').bangla('enable', true);
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
    <script>
        $("select").on("select2:close", function(e) {
            $(this).valid();
        });
    </script>
</body>

</html>
