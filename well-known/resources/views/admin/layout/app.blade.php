<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('title')">
    <meta name="author" content="Wabestudio  Digital Solutions">
    <meta name="keywords" content="responsive admin template,bootstrap dashboard theme,simple dashboard template,bootstrap admin dashboard,bootstrap 4 template admin,template admin bootstrap 4,template bootstrap 4 admin,quality dashboard template,bootstrap 4 admin template,premium bootstrap template,bootstrap simple dashboard,simple admin panel template,dashboard admin bootstrap 4,html css dashboard template,admin dashboard bootstrap 4,bootstrap 4 admin dashboard,bootstrap dashboard template">

    <!-- Favicon -->
    <link rel="icon" href="#" type="image/x-icon"/>

    <!-- Title -->
    <title>@yield('title')</title>



    <!-- Bootstrap css-->
    <link href="{{asset('back-assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"/>

    <!-- Icons css-->
    <link href="{{asset('back-assets/css/icons.css')}}" rel="stylesheet"/>

    <!-- Style css-->
    <link href="{{asset('back-assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('back-assets/css/dark-boxed.css')}}" rel="stylesheet">
    <link href="{{asset('back-assets/css/boxed.css" rel="stylesheet')}}">
    <link href="{{asset('back-assets/css/skins.css')}}" rel="stylesheet">
    <link href="{{asset('back-assets/css/dark-style.css')}}" rel="stylesheet">


    <!-- Color css-->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{asset('back-assets/css/colors/color.css')}}">

    <!-- Select2 css -->
    <link href="{{asset('back-assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

    <!-- Internal DataTables css-->
    <link href="{{asset('back-assets/plugins/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('back-assets/plugins/datatable/responsivebootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('back-assets/plugins/datatable/fileexport/buttons.bootstrap4.min.css')}}" rel="stylesheet" />

    <!-- Sidemenu css-->
    <link href="{{asset('back-assets/css/sidemenu/sidemenu.css')}}" rel="stylesheet">

    <!-- Switcher css-->
    <link href="../../assets/switcher/css/switcher.css" rel="stylesheet">
    <link href="../../assets/switcher/demo.css" rel="stylesheet">
    @yield('scripts')

</head>
<body class="main-body leftmenu">

<div class="page">
@include('admin.partials.mainmenu')
@include('admin.partials.sidebar')
        <div id="app">
            @yield('content')
        </div>


@include('admin.partials.footer')



<!-- Back-to-top -->
    <a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>
</body>



<script src="{{asset('back-assets/plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap js-->
<script src="{{asset('back-assets/plugins/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('back-assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- Internal Chart.Bundle js-->
<script src="{{asset('back-assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>


<!-- Peity js-->
<script src="{{asset('back-assets/plugins/peity/jquery.peity.min.js')}}"></script>

<!--Internal Apexchart js-->
<script src="{{asset('back-assets/js/apexcharts.js')}}"></script>

<!-- Internal Data Table js -->
<script src="{{asset('back-assets/plugins/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('back-assets/plugins/datatable/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('back-assets/js/table-data.js')}}"></script>
<script src="{{asset('back-assets/plugins/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('back-assets/plugins/datatable/fileexport/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('back-assets/plugins/datatable/fileexport/buttons.bootstrap4.min.js')}}"></script>

<!-- Perfect-scrollbar js -->
<script src="{{asset('back-assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>

<!-- Select2 js-->
<script src="{{asset('back-assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('back-assets/js/select2.js')}}"></script>

<!-- Sidemenu js -->
<script src="{{asset('back-assets/plugins/sidemenu/sidemenu.js')}}"></script>

<!-- Sidebar js -->
<script src="{{asset('back-assets/plugins/sidebar/sidebar.js')}}"></script>

<!-- INTERNAL INDEX js -->
<script src="{{asset('back-assets/js/index2.js')}}"></script>

<!-- Sticky js -->
<script src="{{asset('back-assets/js/sticky.js')}}"></script>

<!-- Custom js -->
<script src="{{asset('back-assets/js/custom.js')}}"></script>

<!-- Switcher js -->
<script src="{{asset('back-assets/switcher/js/switcher.js')}}"></script>
<!-- Load Vue via app.js    -->
<script src="{{asset('js/app.js')}}"></script>




</html>
