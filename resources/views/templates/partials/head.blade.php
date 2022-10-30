<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon" />
    <title>SIE Penjualan Daging | @yield('title')</title>

    <link rel="stylesheet" href="{{asset('assets/css/luno-style.css')}}" />

    <script src="{{asset('assets/js/plugins.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('css')
  </head>