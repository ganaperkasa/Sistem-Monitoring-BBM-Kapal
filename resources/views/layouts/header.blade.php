<!--  Header Start -->
<style>
    .app-header {
        background: linear-gradient(135deg, #0066cc 0%, #0080ff 50%, #00bfff 100%);
        border: none;
        min-height: 60px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .app-header,
    .app-header .nav-link,
    .app-header span {
        color: #ffffff !important;
    }

    .navbar {
        display: flex;
        align-items: center;
    }

    .navbar-light .navbar-nav .nav-link {
        color: white !important;
    }

    .navbar-light {
        background: transparent;
    }

    .header-welcome {
        display: flex;
        align-items: center;
        height: 100%;
    }

    .header-welcome span {
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
    }

    /* container teks */
    .welcome-container {
        justify-content: center;
    }

    /* teks nama */
    .welcome-text {
        font-weight: 600;
        font-size: 0.9rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* waktu */
    .welcome-time {
        font-size: 0.75rem;
        opacity: 0.85;
        white-space: nowrap;
    }

    /* MOBILE FIX */
    @media (max-width: 768px) {
        .app-header {
            padding-top: 8px;
            padding-bottom: 8px;
        }

        .header-welcome {
            align-items: center;
        }

        .welcome-container {
            justify-content: center;
        }
    }
</style>
<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
            <li class="nav-item me-3 header-welcome flex-grow-1">
                <div class="welcome-container">
                    <span class="welcome-text">
                        Selamat Datang, {{ Auth::user()->name ?? (Auth::user()->username ?? Auth::user()->email) }}
                    </span>
                    <span id="currentDateTime" class="welcome-time"></span>
                </div>
            </li>
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end flex-shrink-0">
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35"
                            class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body">
                            <a href="{{ route('profile') }}" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-user fs-6"></i>
                                <p class="mb-0 fs-3">My Profile</p>
                            </a>
                            {{-- <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a> --}}
                            {{-- <button class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</button> --}}
                            <a href="{{ route('logout') }}" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!--  Header End -->
<script>
    function updateDateTime() {
        const now = new Date();
        const options = {
            weekday: 'long',
            day: '2-digit',
            month: 'long',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false
        };
        const formatted = now.toLocaleString('id-ID', options);
        const el = document.getElementById('currentDateTime');
        if (el) el.textContent = formatted;
    }
    updateDateTime();
    setInterval(updateDateTime, 1000);
</script>
