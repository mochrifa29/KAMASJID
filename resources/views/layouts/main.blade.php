<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>KAMASJID</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/NiceAdmin/assets/img/masjid.png" rel="icon">
    <link href="/NiceAdmin/assets/img/masjid.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    {{-- jquery --}}
    <script src="/NiceAdmin/assets/js/jquery-3.7.1.js"></script>



    <link href="/NiceAdmin/assets/vendor/datatable/datatables.min.css" rel="stylesheet">

    <script src="/NiceAdmin/assets/vendor/datatable/datatables.min.js"></script>


    <!-- Vendor CSS Files -->
    <link href="/NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/NiceAdmin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="/NiceAdmin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="/NiceAdmin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="/NiceAdmin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/NiceAdmin/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="/NiceAdmin/assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->


</head>

<body>

    @include('partials.header')

    @include('partials.sidebar')

    @yield('content')

    @include('partials.footer')


    {{-- Swall 2 --}}
    <script src="/NiceAdmin/assets/js/sweetalert2@11.js"></script>


    <!-- Vendor JS Files -->
    <script src="/NiceAdmin/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="/NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/NiceAdmin/assets/vendor/chart.js/chart.umd.js"></script>
    <script src="/NiceAdmin/assets/vendor/echarts/echarts.min.js"></script>
    <script src="/NiceAdmin/assets/vendor/quill/quill.js"></script>
    <script src="/NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="/NiceAdmin/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="/NiceAdmin/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="/NiceAdmin/assets/js/main.js"></script>



</body>

</html>
