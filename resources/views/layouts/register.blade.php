<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Monitoring BBM Kapal</title>
  <link rel="shortcut icon" type="image/png" href="{{ url('assets/images/logos/logopoltekpel.png') }}" />
  <link rel="stylesheet" href="{{ url('assets/css/styles.min.css') }}" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            @yield('content')
        </div>

    </div>

    <script src="{{ 'assets/libs/jquery/dist/jquery.min.js' }}"></script>
    <script src="{{ 'assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js' }}"></script>

</body>

</html>
