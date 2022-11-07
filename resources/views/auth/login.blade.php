<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
    <title>SIE Penjualan Daging | Sign In</title>


    <link rel="stylesheet" href="{{asset('assets/css/luno-style.css')}}" />

    <script src="{{asset('assets/js/plugins.js')}}"></script>
</head>

<body id="layout-1" data-luno="theme-blue">

    <div class="wrapper">


        <div class="page-body auth px-xl-4 px-sm-2 px-0 py-lg-2 py-1">
            <div class="container-fluid">
                <div class="row g-0">
                    <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center">
                        <div style="max-width: 25rem;">
                            <div class="mb-4">
                                <img src="{{asset('assets/logo/logo.png')}}">
                            </div>
                            <div class="mb-5">
                                <h2 class="color-900">Sistem Informasi Eksekutif Penjualan Daging Pada UD Rahayu</h2>
                            </div>

                            <ul class="list-unstyled mb-5">
                                <li class="mb-4">
                                    <span class="d-block mb-1 fs-4 fw-light">All-in-one tool</span>
                                    <span class="color-600">Amazing Features to make your life easier & work
                                        efficient</span>
                                </li>
                                <li>
                                    <span class="d-block mb-1 fs-4 fw-light">Easily add &amp; manage your
                                        services</span>
                                    <span class="color-600">It brings together your tasks, projects, timelines, files
                                        and more</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 d-flex justify-content-center align-items-center">
                        <div class="card shadow-sm w-100 p-4 p-md-5" style="max-width: 32rem;">

                            <form class="row g-3" action="{{route('login')}}" method="POST">
                                @csrf
                                <div class="col-12 text-center mb-1">
                                    <h1>Sign in</h1>
                                    <img src="{{asset('assets/logo/logo.png')}}">
                                </div>
                                <div class="col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Username</label>
                                        <input type="text"
                                            class="form-control form-control-lg @error('username') is-invalid @enderror"
                                            placeholder="username" name="username" value="{{ old('username') }}">
                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-2">
                                        <input id="password"
                                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                                            type="password" name="password" maxlength="10" placeholder="password">
                                    </div>
                                </div>
                                <div class="col-12 text-center mt-4">
                                    <button type="submit" class="btn btn-lg btn-block btn-dark lift text-uppercase">Sign
                                        in</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{asset('assets/vendors/bootstrap-show-password%401.2.1/dist/bootstrap-show-password.min.js')}}"></script>
        <script>
            $(function () {
        $('#password').password()
      })
        </script>
    </div>


    <script src="{{asset('assets/js/theme.js')}}"></script>


</body>

<!-- Mirrored from www.wrraptheme.com/templates/luno/auth-signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 23 Oct 2022 09:17:04 GMT -->

</html>