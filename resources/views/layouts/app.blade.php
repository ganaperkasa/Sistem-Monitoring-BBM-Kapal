<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Monitoring BBM Kapal</title>
  <link rel="shortcut icon" type="image/png" href="{{ url('assets/images/logos/logopoltekpel.png') }}" />
  <link rel="stylesheet" href="{{ url('assets/css/styles.min.css') }}" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    @include('layouts.sidebar')
    <div class="body-wrapper">
      @include('layouts.header')
      <div class="container-fluid">
        @yield('content')
      </div>
    </div>
</div>
<script src="{{ url('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ url('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('assets/js/sidebarmenu.js') }}"></script>
<script src="{{ url('assets/js/app.min.js') }}"></script>
<script src="{{ url('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="{{ url('assets/libs/simplebar/dist/simplebar.js') }}"></script>
<script src="{{ url('assets/js/dashboard.js') }}"></script>
</body>

</html>
