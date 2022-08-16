<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
    <meta name="author" content="">
    <title>DOF</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin') }}/assets/dist/img/favicon.png">
    <!--Global Styles(used by all pages)-->
    <link href="{{ asset('admin') }}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/assets/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/assets/plugins/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/assets/plugins/typicons/src/typicons.min.css" rel="stylesheet">
    <link href="{{ asset('admin') }}/assets/plugins/themify-icons/themify-icons.min.css" rel="stylesheet">
    <!--Third party Styles(used by this page)-->
    <link href="{{ asset('admin') }}/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!--Start Your Custom Style Now-->
    <link href="{{ asset('admin') }}/assets/dist/css/style.css" rel="stylesheet">
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
    <!--Global script(used by all pages)-->
    <script data-cfasync="false" src="cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/jQuery/jquery-3.4.1.min.js"></script>
    <script src="{{ asset('admin') }}/assets/dist/js/popper.min.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/metisMenu/metisMenu.min.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
    <!-- Third Party Scripts(used by this page)-->
    <script src="{{ asset('admin') }}/assets/plugins/chartJs/Chart.min.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/sparkline/sparkline.min.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/datatables/dataTables.min.js"></script>
    {{-- <script src="{{ asset('admin') }}/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script> --}}
    <!--Page Active Scripts(used by this page)-->
    <script src="{{ asset('admin') }}/assets/dist/js/pages/dashboard.js"></script>
    <!--Page Scripts(used by all page)-->
    <script src="{{ asset('admin') }}/assets/dist/js/sidebar.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/modals/classie.js"></script>
    <script src="{{ asset('admin') }}/assets/plugins/modals/modalEffects.js"></script>
</body>
<!-- abc -->
</html>
