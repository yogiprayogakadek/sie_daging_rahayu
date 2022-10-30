<!DOCTYPE html>
<html lang="en">
@include('templates.partials.head')

<body class="layout-1" data-luno="theme-blue">
  @include('templates.partials.sidebar')

  <div class="wrapper">
    @include('templates.partials.header')

    <div class="page-toolbar px-xl-4 px-sm-2 px-0 py-3">
      <div class="container-fluid">
        <div class="row g-3 mb-3 align-items-center">
          <div class="col">
            <ol class="breadcrumb bg-transparent mb-0">
              <li class="breadcrumb-item">
                <a class="text-secondary" href="index.html">@yield('pwd')</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                @yield('sub-pwd')
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0 mt-lg-3">
      <div class="container-fluid">
        @yield('content')
      </div>
    </div>

    {{-- @include('templates.partials.footer') --}}

  </div>

  @include('templates.partials.script')
</body>

</html>