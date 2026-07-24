<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=5.0">
<meta name="theme-color" content="#0A4D8F">
<meta name="google-signin-client_id" content="502134858195-kbejhd1qdu3v1ojigt2192k69hdam784.apps.googleusercontent.com">
 <title>Sistem Monitoring BBM Kapal</title>
  <link rel="shortcut icon" type="image/png" href="{{ url('assets/images/logos/logopoltekpel.png') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/custom-login.css') }}" />

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">


</head>
<body>
<div class="bg-photo" aria-hidden="true"></div>
<div class="bg-gradient" aria-hidden="true"></div>
<canvas id="ocean-canvas" aria-hidden="true"></canvas>
<div class="bg-overlay" aria-hidden="true"></div>
<div class="glow-orb glow-orb-1" aria-hidden="true"></div>
<div class="glow-orb glow-orb-2" aria-hidden="true"></div>
<main class="login-container">
    @yield('content')
</main>

</body>
