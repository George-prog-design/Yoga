<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Template</title>
    <meta content="Themesdesign" name="author">

    <link rel="shortcut icon" href="{{asset('Backend Theme/assets/images/favicon.ico')}}">

    <link href="{{asset('Backend Theme/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('Backend Theme/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('Backend Theme/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('Backend Theme/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css">
    <link href="{{asset('Backend Theme/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('Backend Theme/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

</head>

    <body data-topbar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">


            @include('body.header')

            <!-- ========== Left Sidebar Start ========== -->
            @include('body.sidebar')
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                @yield('admin')
                <!-- End Page-content -->

                @include('body.footer')

            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->

        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
    <script src="{{asset('Backend Theme/assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('Backend Theme/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('Backend Theme/assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('Backend Theme/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('Backend Theme/assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('Backend Theme/assets/libs/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('Backend Theme/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{asset('Backend Theme/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js')}}"></script>
    <script src="{{asset('Backend Theme/assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('Backend Theme/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('Backend Theme/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('Backend Theme/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('Backend Theme/assets/js/pages/dashboard.init.js')}}"></script>
    <script src="{{asset('Backend Theme/assets/js/app.js')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
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
===============================================




    </body>

</html>

