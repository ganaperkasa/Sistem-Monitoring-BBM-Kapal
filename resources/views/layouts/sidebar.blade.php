<!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-img">
            {{-- <img src="{{ asset('assets/images/logos/logopoltekpel.png') }}" class="dark-logo" width="180" alt="" /> --}}
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            {{-- <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('dashboard') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li> --}}
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ route('dashboard.create') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('history') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-anchor"></i>
                </span>
                <span class="hide-menu">History</span>
              </a>
            </li>
            <li class="sidebar-item">
  <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
    <span>
      <i class="ti ti-info-circle"></i>
    </span>
    <span class="hide-menu"> Wilayah ECA & Non ECA</span>
  </a>

  <ul aria-expanded="false" class="collapse first-level">
    <li class="sidebar-item">
      <span class="sidebar-link small"
      style="
        display: block;
        max-width: 220px;
        max-height: 250px;
        overflow-y: auto;
        white-space: normal;
        line-height: 1.4;
        cursor: default;
      ">

  <strong>ECA:</strong> Laut Baltik, Laut Utara, Perairan sekitar United States, Laut Mediterania <br>
  <strong>Non ECA:</strong> Perairan Indo, Laut Cina Selatan, Samudra Hindia, Timur Tengah, Afrika, Sebagian Besar Asia Tenggara


</span>
    </li>
  </ul>
</li>

<li class="sidebar-item">
  <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
    <span>
      <i class="ti ti-info-circle"></i>
    </span>
    <span class="hide-menu">Tier IMO</span>
  </a>

  <ul aria-expanded="false" class="collapse first-level">
    <li class="sidebar-item">
      <span class="sidebar-link small"
      style="
        display: block;
        max-width: 220px;
        max-height: 350px;
        overflow-y: auto;
        white-space: normal;
        line-height: 1.4;
        cursor: default;
      ">
{{--
  <strong>ECA:</strong> Baltic, North, US Coast, Caribbean, Mediterranean, Arctic<br>
  <strong>Non ECA:</strong> Semua laut di luar ECA<br> --}}
  <strong>Tier I:</strong> (dibangun &lt; 1 Januari 2000) Standar awal<br>
  <strong>Tier II:</strong> (dibangun 1 Januari 2000–2015) Penurunan NOx 20%<br>
  <strong>Tier III:</strong> (dibangun &gt;2016 ) Penurunan NOx 80% (hanya berlaku di ECA) <br>
  <strong>Penting:</strong> Diluar area ECA, Kapal Tier III tetap harus memenuhi standar Tier II<br>

</span>
    </li>
  </ul>
</li>
            {{-- <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('history') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-anchor"></i>
                </span>
                <span class="hide-menu">History</span>
              </a>
            </li> --}}
            {{-- <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Master</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('konsumsi-bbm') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-anchor"></i>
                </span>
                <span class="hide-menu">Konsumsi BBM</span>
              </a>
            </li> --}}
            @if(Auth::user()->role_id == 1)
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{ url('jenis-bbm') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-anchor"></i>
                </span>
                <span class="hide-menu">Jenis BBM</span>
              </a>
            </li>
            @endif

            {{-- <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">UI COMPONENTS</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-buttons.html" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Buttons</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-alerts.html" aria-expanded="false">
                <span>
                  <i class="ti ti-alert-circle"></i>
                </span>
                <span class="hide-menu">Alerts</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-card.html" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Card</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-forms.html" aria-expanded="false">
                <span>
                  <i class="ti ti-file-description"></i>
                </span>
                <span class="hide-menu">Forms</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
                <span>
                  <i class="ti ti-typography"></i>
                </span>
                <span class="hide-menu">Typography</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">AUTH</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./authentication-login.html" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Login</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./authentication-register.html" aria-expanded="false">
                <span>
                  <i class="ti ti-user-plus"></i>
                </span>
                <span class="hide-menu">Register</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">EXTRA</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./icon-tabler.html" aria-expanded="false">
                <span>
                  <i class="ti ti-mood-happy"></i>
                </span>
                <span class="hide-menu">Icons</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
                <span>
                  <i class="ti ti-aperture"></i>
                </span>
                <span class="hide-menu">Sample Page</span>
              </a>
            </li> --}}

          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
