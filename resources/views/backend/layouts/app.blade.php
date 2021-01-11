<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Alexander Frank">

    <title>{{ config('app.name', 'Admin') }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('image/sdl.png') }}">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="{{ mix('/css/backend/app.css') }}" rel="stylesheet">

    <!-- Datatables -->
    <link href="{{ asset('plugins/datatables/css/datatables.css') }}" rel="stylesheet">

    <!-- toastr -->
    <link href="{{ asset('plugins/toastr/css/toastr.css') }}" rel="stylesheet">

    <!-- select2 -->
    <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    @stack('theme::css')
</head>

<body id="page-top">

<div id="wrapper">
    @include('theme::backend.layouts.menu')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            @yield('theme::backend-content')
        </div>
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; {{ config('app.name', 'Backend') }} {{ date('Y') }}</span>
                </div>
            </div>
        </footer>
    </div>
</div>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script src="{{ asset('js/backend/app.js') }}"></script>

<!-- Datatables -->
<script src="{{ asset('plugins/datatables/js/dataTables.js') }}"></script>

<!-- toastr -->
<script src="{{ asset('plugins/toastr/js/toastr.min.js') }}"></script>
<!-- select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- custom -->
<script src="{{ asset('js/custom.js') }}"></script>
@stack('theme::javascript')
</body>
</html>
