<header class="navbar sticky-top bg-dark z-2">
    <a href="/" class="navbar-brand fs-6 ps-3 text-white">App Kasir</a>

    @auth
        <ul class="navbar-nav flex-row">
            <li class="nav-items d-flex align-items-center">
                <span class="text-white d-none d-sm-inline">{{ Auth::user()->username }}</span>
                <img src="" alt="" class="rounded-circle mx-2" style="width: 2em; height: 2em;">
            </li>
            <li class="nav-items">
                <button type="button" class="btn btn-transparent d-md-none" data-bs-toggle="offcanvas"
                    data-bs-target="#sidebarMenu" aria-expanded="false" aria-label="Sidebar Menu Label"
                    aria-controls="sidebarMenu">
                    <i class="bi bi-list"></i>
                </button>
            </li>
        </ul>
    @endauth
</header>
