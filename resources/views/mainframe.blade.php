<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="Description"
    content="Application: Tasks Todo Application, Author: Md. Nazmus Saqib Khan, Md. Maruf Hossain">
  <meta name="robots" content="noindex" />
  <!--favicon-->
  <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png" />
  <!--plugins-->
  <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
  <!-- loader-->
  <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
  <script data-pace-options='{ "ajax": true }' src="{{ asset('assets/js/pace.min.js') }}"></script>
  <!-- Bootstrap CSS -->
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
  <title>TODO Tasks - @yield('page-title')</title>
  @yield('styles')
  @yield('head-scripts')
</head>

<body class="bg-theme bg-theme1">
  <!--wrapper-->
  <div class="wrapper">
    <!--sidebar wrapper -->
    <div class="sidebar-wrapper" data-simplebar="true">
      <div class="sidebar-header">
        <div>
          <img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
          <h4 class="logo-text">Dashtrans</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
      </div>
      @includeIf('includes.navigation_bars.navigation')
    </div>
    <!--end sidebar wrapper -->
    @includeIf('includes.app_top_header')
    <!--start page wrapper -->
    <div class="page-wrapper">
      <div class="page-content">
        @yield("page-content")
        @includeIf("includes.form_modal")
        @includeIf("includes.delete_confirmation")
        @includeIf("includes.toastr")
      </div>
    </div>
    <!--end page wrapper -->
    @includeIf("includes.overlay")
    @includeIf('includes.back_to_top_btn')
    @includeIf("includes.footer")
  </div>
  <!--end wrapper-->
  @includeIf('includes.switcher')
  <!-- Bootstrap JS -->
  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
  <!--plugins-->
  <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

  <!--app JS-->
  <script src="{{ asset('assets/js/app.js') }}"></script>
  <script src="{{ asset('assets/js/switcher.js') }}"></script>

  @yield('bottom-scripts')

</body>

</html>