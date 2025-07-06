<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 card-glass shadow-sm" id="sidenav-main">
    <div class="sidenav-header px-3 py-2">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
            <img src="{{ asset('temp/file/assets/img/ukur sumur.jpg') }}" class="navbar-brand-img" alt="Logo" style="height: 40px; border-radius: 0.375rem;">
            <span class="fw-bold text-white fs-6">ReservoirGambut.id</span>
        </a>
    </div>

    <hr class="horizontal light mt-2 mb-2">

    <div class="collapse navbar-collapse w-auto px-2" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <!-- DASHBOARD -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
                   href="{{ route('dashboard') }}"
                   style="{{ request()->routeIs('dashboard') ? 'background: rgba(34, 211, 238, 0.15); border-radius: 0.5rem;' : '' }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-white text-sm"></i>
                    </div>
                    <span class="nav-link-text text-white">Dashboard</span>
                </a>
            </li>

            <!-- RIWAYAT DATA -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('table') ? 'active' : '' }}" 
                   href="{{ route('table') }}"
                   style="{{ request()->routeIs('table') ? 'background: rgba(34, 211, 238, 0.15); border-radius: 0.5rem;' : '' }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-calendar-grid-58 text-white text-sm"></i>
                    </div>
                    <span class="nav-link-text text-white">Riwayat Data</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
