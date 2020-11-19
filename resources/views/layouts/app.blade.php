<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('theme::title', config('app.name', 'Devsome'))</title>
    <meta name="description" content="{{ config('app.description', 'Description') }}">
    <!-- Coded by Devsome.com -->
    <meta name="author" content="Alexander Frank">
    <link rel="icon" href="{{ asset('image/favicon/favicon.ico') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{(Session::get('locale') === 'ar') ? mix('/css/app-rtl.css') : mix('/css/app.css')}}" rel="stylesheet">

    <!-- Datatables -->
    <link href="{{ mix('/plugins/datatables/css/dataTables.css') }}" rel="stylesheet">

   <!-- toastr -->
    <link href="{{ asset('plugins/toastr/css/toastr.css') }}" rel="stylesheet">

    <!-- select2 -->
    <link href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet">

    @stack('theme::css')
</head>
<body dir="{{( Session::get('locale') === 'ar' ? 'rtl' : 'ltr' )}}">
<div id="app">
    @include('theme::layouts.navbar')
    <main role="main" class="container">
        <div class="row mt-5">
            @section('theme::sidebar')
                @include('theme::layouts.sidebar')
            @show
            @yield('theme::content')
        </div>
    </main>
    @include('theme::layouts.footer')
</div>
<script>
    const serverTime = new Date({{ \Carbon\Carbon::now()->format('Y, n, j, G, i, s') }});
    const currentTimestamp = {{ \Carbon\Carbon::now()->format('U') }} -Math.round(+new Date() / 1000);
</script>
<script src="{{ mix('/js/app.js') }}"></script>

<!-- Datatables -->
<script src="{{ mix('/plugins/datatables/js/dataTables.js') }}"></script>
<!-- toastr -->
<script src="{{ asset('plugins/toastr/js/toastr.min.js') }}"></script>
<!-- select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- custom -->
<script src="{{ asset('js/custom.js') }}"></script>

@stack('theme::javascript')
</body>
</html>
