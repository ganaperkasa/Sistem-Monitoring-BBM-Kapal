<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=5.0">
<meta name="theme-color" content="#0A4D8F">
<meta name="google-signin-client_id" content="502134858195-kbejhd1qdu3v1ojigt2192k69hdam784.apps.googleusercontent.com">
<link rel="shortcut icon" href="//siakad.poltekpel-sby.ac.id/images/logopoltekpel.png" type="image/png">
<title>SSO Politeknik Pelayaran Surabaya</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">


<style>
:root{
  --primary:#0A4D8F;
  --primary-deep:#073A6B;
  --primary-darker:#041F3D;
  --primary-light:#1976D2;
  --accent:#00BCD4;
  --accent-glow:#38E5FF;
  --gold:#FFB300;
  --danger:#FF5252;
  --success:#4CAF50;
  --text:#FFFFFF;
  --text-muted:rgba(255,255,255,0.65);
  --glass-bg:rgba(255,255,255,0.08);
  --glass-border:rgba(255,255,255,0.18);
  --glass-shadow:rgba(7,58,107,0.5);
  --input-bg:rgba(255,255,255,0.06);
}
*{box-sizing:border-box;margin:0;padding:0}
*::selection{background:var(--accent);color:#000}

html,body{height:100%;width:100%;overflow:hidden}
body{
  font-family:'Plus Jakarta Sans',-apple-system,BlinkMacSystemFont,sans-serif;
  color:var(--text);
  position:relative;
  -webkit-font-smoothing:antialiased;
  -moz-osx-font-smoothing:grayscale;
  font-size:14px;
  line-height:1.5;
  background:#041F3D;
}

.bg-photo{
  position:fixed;
  inset:0;
  z-index:0;
  background-image:url('assets/images/backgrounds/sekolahan.jpg');
  background-size:cover;
  background-position:center;
  background-repeat:no-repeat;
  background-attachment:fixed;
  filter:brightness(0.7) saturate(1.15) contrast(1.05);
  transform:scale(1.05);
  animation:bgPan 30s ease-in-out infinite alternate;
}

@keyframes bgPan{
  from{transform:scale(1.05) translate(0,0)}
  to{transform:scale(1.08) translate(-1.5%,-1%)}
}

.bg-gradient{
  position:fixed;
  inset:0;
  z-index:1;
  pointer-events:none;
  background:
    linear-gradient(180deg,
      rgba(7,40,80,0.55) 0%,
      rgba(7,58,107,0.40) 35%,
      rgba(4,31,61,0.60) 75%,
      rgba(4,15,30,0.85) 100%
    ),
    radial-gradient(ellipse at center,transparent 30%,rgba(4,15,30,0.45) 100%);
}

#ocean-canvas{
  position:fixed;
  top:0;left:0;
  width:100%;height:100%;
  z-index:2;
  pointer-events:none;
  opacity:0.35;
  mix-blend-mode:screen;
  -webkit-mask-image:linear-gradient(to bottom,transparent 0%,transparent 35%,rgba(0,0,0,0.6) 65%,#000 100%);
  mask-image:linear-gradient(to bottom,transparent 0%,transparent 35%,rgba(0,0,0,0.6) 65%,#000 100%);
}

.bg-overlay{
  position:fixed;
  inset:0;
  z-index:3;
  pointer-events:none;
  background:
    radial-gradient(circle at 20% 80%,rgba(0,188,212,0.08) 0%,transparent 50%),
    radial-gradient(circle at 80% 20%,rgba(255,179,0,0.05) 0%,transparent 50%);
}

.glow-orb{
  position:fixed;
  border-radius:50%;
  filter:blur(90px);
  z-index:2;
  pointer-events:none;
  animation:orbFloat 20s ease-in-out infinite;
  mix-blend-mode:screen;
}
.glow-orb-1{
  width:380px;height:380px;
  background:rgba(0,188,212,0.18);
  top:-120px;left:-120px;
}
.glow-orb-2{
  width:480px;height:480px;
  background:rgba(255,179,0,0.10);
  bottom:-160px;right:-120px;
  animation-delay:-10s;
}

@keyframes orbFloat{
  0%,100%{transform:translate(0,0)}
  33%{transform:translate(40px,-30px)}
  66%{transform:translate(-30px,40px)}
}

.login-container{
  position:relative;
  z-index:10;
  min-height:100vh;
  display:flex;
  align-items:center;
  justify-content:center;
  padding:24px;
}

.login-card{
  width:100%;
  max-width:440px;
  background:var(--glass-bg);
  backdrop-filter:blur(24px) saturate(180%);
  -webkit-backdrop-filter:blur(24px) saturate(180%);
  border:1px solid var(--glass-border);
  border-radius:24px;
  box-shadow:
    0 25px 70px var(--glass-shadow),
    0 0 0 1px rgba(255,255,255,0.05),
    inset 0 1px 0 rgba(255,255,255,0.18);
  padding:44px 38px 36px;
  position:relative;
  animation:cardEnter .9s cubic-bezier(.4,0,.2,1) both;
}

.login-card::before{
  content:"";
  position:absolute;
  inset:0;
  border-radius:24px;
  padding:1px;
  background:linear-gradient(135deg,rgba(255,255,255,0.4),transparent 50%);
  -webkit-mask:linear-gradient(#000 0 0) content-box,linear-gradient(#000 0 0);
  -webkit-mask-composite:xor;
  mask-composite:exclude;
  pointer-events:none;
}

@keyframes cardEnter{
  from{opacity:0;transform:translateY(30px) scale(.96)}
  to{opacity:1;transform:translateY(0) scale(1)}
}

.logo-wrapper{
  text-align:center;
  margin-bottom:24px;
  position:relative;
}

.logo-wrapper::after{
  content:"";
  position:absolute;
  width:120px;height:120px;
  background:radial-gradient(circle,rgba(0,188,212,0.4) 0%,transparent 70%);
  top:50%;left:50%;
  transform:translate(-50%,-50%);
  z-index:-1;
  filter:blur(20px);
  animation:logoGlow 4s ease-in-out infinite;
}

.logo-wrapper img{
  width:88px;height:88px;
  object-fit:contain;
  filter:drop-shadow(0 6px 16px rgba(0,0,0,0.3));
  animation:logoFloat 5s ease-in-out infinite;
  position:relative;
  z-index:1;
}

@keyframes logoFloat{
  0%,100%{transform:translateY(0) rotate(0)}
  50%{transform:translateY(-8px) rotate(.5deg)}
}
@keyframes logoGlow{
  0%,100%{opacity:.6;transform:translate(-50%,-50%) scale(1)}
  50%{opacity:1;transform:translate(-50%,-50%) scale(1.15)}
}

.blu-badge{
  display:inline-flex;
  align-items:center;
  gap:6px;
  padding:5px 12px;
  background:linear-gradient(135deg,rgba(255,179,0,0.18),rgba(255,179,0,0.08));
  border:1px solid rgba(255,179,0,0.35);
  color:#FFD580;
  font-size:10.5px;
  font-weight:600;
  letter-spacing:0.5px;
  text-transform:uppercase;
  border-radius:20px;
  margin-bottom:14px;
  text-shadow:0 1px 4px rgba(0,0,0,0.3);
}
.blu-badge svg{flex-shrink:0;color:var(--gold)}

.login-header{text-align:center;margin-bottom:32px}
.login-header h1{
  font-size:26px;
  font-weight:700;
  letter-spacing:-.5px;
  margin-bottom:8px;
  background:linear-gradient(135deg,#fff 30%,var(--accent-glow) 100%);
  -webkit-background-clip:text;
  background-clip:text;
  -webkit-text-fill-color:transparent;
}
.maritime-divider{
  width:60px;height:3px;
  background:linear-gradient(90deg,transparent,var(--accent),transparent);
  margin:6px auto 12px;
  border-radius:2px;
  position:relative;
}
.maritime-divider::after{
  content:"⚓";
  position:absolute;
  left:50%;top:50%;
  transform:translate(-50%,-50%);
  background:var(--primary-deep);
  padding:0 8px;
  font-size:12px;
  color:var(--accent);
}
.login-header .subtitle{
  font-size:13px;
  color:var(--text-muted);
  font-weight:400;
  letter-spacing:.3px;
}

.error-banner{
  background:rgba(255,82,82,0.12);
  border:1px solid rgba(255,82,82,0.3);
  color:#ff8a8a;
  padding:10px 14px;
  border-radius:10px;
  font-size:12.5px;
  margin-bottom:20px;
  display:flex;
  align-items:center;
  gap:10px;
  animation:shake .4s ease-in-out;
}
@keyframes shake{
  0%,100%{transform:translateX(0)}
  25%{transform:translateX(-6px)}
  75%{transform:translateX(6px)}
}

.form-group{
  position:relative;
  margin-bottom:16px;
}
.form-group input{
  width:100%;
  background:var(--input-bg);
  border:1.5px solid rgba(255,255,255,0.12);
  border-radius:12px;
  padding:15px 16px 15px 48px;
  color:var(--text);
  font-size:14px;
  font-family:inherit;
  font-weight:500;
  transition:all .25s cubic-bezier(.4,0,.2,1);
  -webkit-appearance:none;
}
.form-group input::placeholder{
  color:rgba(255,255,255,0.45);
  font-weight:400;
}
.form-group input:focus{
  outline:none;
  border-color:var(--accent);
  background:rgba(255,255,255,0.1);
  box-shadow:0 0 0 4px rgba(0,188,212,0.15);
}
.form-group input:hover:not(:focus){
  border-color:rgba(255,255,255,0.22);
}
.form-group input:-webkit-autofill,
.form-group input:-webkit-autofill:hover,
.form-group input:-webkit-autofill:focus{
  -webkit-box-shadow:0 0 0 100px rgba(15,40,80,0.95) inset !important;
  -webkit-text-fill-color:#fff !important;
  caret-color:#fff;
  transition:background-color 5000s ease-in-out 0s;
}
.form-group .icon{
  position:absolute;
  left:16px;top:50%;
  transform:translateY(-50%);
  width:20px;height:20px;
  color:rgba(255,255,255,0.55);
  pointer-events:none;
  transition:color .25s;
}
.form-group input:focus ~ .icon{
  color:var(--accent);
}

.form-group .toggle-pwd{
  position:absolute;
  right:14px;top:50%;
  transform:translateY(-50%);
  background:none;
  border:none;
  color:rgba(255,255,255,0.5);
  cursor:pointer;
  padding:6px;
  border-radius:6px;
  transition:all .2s;
}
.form-group .toggle-pwd:hover{
  color:var(--accent);
  background:rgba(255,255,255,0.05);
}

.form-row{
  display:flex;
  justify-content:space-between;
  align-items:center;
  margin-bottom:20px;
  font-size:13px;
}
.checkbox-wrap{
  display:flex;
  align-items:center;
  gap:8px;
  cursor:pointer;
  color:var(--text-muted);
  user-select:none;
}
.checkbox-wrap input{
  width:16px;height:16px;
  accent-color:var(--accent);
  cursor:pointer;
}

.btn-submit{
  width:100%;
  background:linear-gradient(135deg,var(--accent) 0%,var(--primary-light) 100%);
  color:#fff;
  border:none;
  border-radius:12px;
  padding:15px;
  font-size:14px;
  font-weight:600;
  letter-spacing:.5px;
  cursor:pointer;
  position:relative;
  overflow:hidden;
  transition:all .25s cubic-bezier(.4,0,.2,1);
  font-family:inherit;
  box-shadow:0 4px 16px rgba(0,188,212,0.3);
}
.btn-submit::before{
  content:"";
  position:absolute;
  inset:0;
  background:linear-gradient(135deg,var(--accent-glow) 0%,var(--accent) 100%);
  opacity:0;
  transition:opacity .3s;
}
.btn-submit:hover{
  transform:translateY(-2px);
  box-shadow:0 8px 24px rgba(0,188,212,0.45);
}
.btn-submit:hover::before{opacity:1}
.btn-submit:active{transform:translateY(0)}
.btn-submit span{
  position:relative;z-index:1;
  display:inline-flex;
  align-items:center;
  gap:8px;
}
.btn-submit.loading{pointer-events:none}
.btn-submit.loading span{visibility:hidden}
.btn-submit.loading::after{
  content:"";
  position:absolute;
  width:20px;height:20px;
  top:50%;left:50%;
  margin:-10px 0 0 -10px;
  border:2.5px solid rgba(255,255,255,0.3);
  border-top-color:#fff;
  border-radius:50%;
  animation:spin .7s linear infinite;
}
@keyframes spin{to{transform:rotate(360deg)}}

.divider{
  display:flex;
  align-items:center;
  gap:12px;
  margin:18px 0;
  color:rgba(255,255,255,0.4);
  font-size:11px;
  font-weight:600;
  text-transform:uppercase;
  letter-spacing:1.5px;
}
.divider::before,.divider::after{
  content:"";
  flex:1;
  height:1px;
  background:linear-gradient(90deg,transparent,rgba(255,255,255,0.2),transparent);
}

.btn-google{
  width:100%;
  background:#fff;
  color:#1f1f1f;
  border:none;
  border-radius:12px;
  padding:14px;
  font-size:14px;
  font-weight:500;
  cursor:pointer;
  display:flex;
  align-items:center;
  justify-content:center;
  gap:12px;
  transition:all .2s cubic-bezier(.4,0,.2,1);
  font-family:inherit;
}
.btn-google:hover{
  transform:translateY(-1px);
  box-shadow:0 6px 20px rgba(0,0,0,0.25);
}
.btn-google svg{flex-shrink:0}

.login-footer{
  text-align:center;
  margin-top:28px;
  font-size:11px;
  color:rgba(255,255,255,0.4);
  letter-spacing:.3px;
}
.login-footer a{
  color:var(--accent);
  text-decoration:none;
  transition:color .2s;
}
.login-footer a:hover{color:var(--accent-glow)}

#balikan{display:none}

@media (max-width:520px){
  .login-container{padding:16px}
  .login-card{
    padding:36px 24px 28px;
    border-radius:20px;
    max-width:100%;
  }
  .logo-wrapper img{width:74px;height:74px}
  .login-header h1{font-size:22px}
  .login-header .subtitle{font-size:12.5px}
  .form-group input{padding:14px 14px 14px 44px;font-size:14px}
  .btn-submit,.btn-google{padding:14px}
  .glow-orb-1{width:280px;height:280px}
  .glow-orb-2{width:320px;height:320px}
}

@media (max-width:360px){
  .login-card{padding:28px 20px 24px}
  .logo-wrapper img{width:64px;height:64px}
}

@media (prefers-reduced-motion:reduce){
  *,*::before,*::after{
    animation-duration:.01ms !important;
    transition-duration:.01ms !important;
  }
  #ocean-canvas{display:none}
}

@supports not (backdrop-filter:blur(20px)){
  .login-card{
    background:rgba(15,40,80,0.85);
  }
}
</style>
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
