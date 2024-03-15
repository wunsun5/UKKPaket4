<div class="sidebar col-lg-3 col-xl-2 bg-body-tertiary border-right px-0">
    <div class="offcanvas-end offcanvas-md bg-body-tertiary h-100" id="sidebarMenu" data-bs-toggle="offcanvas">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">App Kasir</h5>
            <button class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"></button>
        </div>
        <div class="offcanvas-body flex-column ps-2">
            <ul class="nav flex-column pt-md-3 px-0">
                <li class="nav-items">
                    <a href="/" class="nav-link text-dark fw-medium d-flex align-items-center gap-3">
                        <i class="bi bi-house-fill text-dark"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-items">
                    <a href="/user" class="nav-link text-dark fw-medium d-flex align-items-center gap-3">
                        <i class="bi bi-person-fill text-dark"></i>
                        Pengguna
                    </a>
                </li>
                @can('admin')
                    <li class="nav-items">
                        <a href="/register" class="nav-link text-dark fw-medium d-flex align-items-center gap-3">
                            <i class="bi bi-person-plus-fill text-dark"></i>
                            Registrasi
                        </a>
                    </li>
                @endcan
                <li class="nav-items">
                    <a href="/product/create" class="nav-link text-dark fw-medium d-flex align-items-center gap-3">
                        <i class="bi bi-cart-fill text-dark"></i>
                        Produk
                    </a>
                </li>
                <li class="nav-items">
                    <a href="/customer/create" class="nav-link text-dark fw-medium d-flex align-items-center gap-3">
                        <i class="bi bi-people-fill text-dark"></i>
                        Pelanggan
                    </a>
                </li>
                <li class="nav-items">
                    <a href="/transaction/create" class="nav-link text-dark fw-medium d-flex align-items-center gap-3">
                        <i class="bi bi-bag-fill text-dark"></i>
                        Penjualan
                    </a>
                </li>
                <li class="nav-items">
                    <a href="/transaction" class="nav-link text-dark fw-medium d-flex align-items-center gap-3">
                        <i class="bi bi-journal-album text-dark"></i>
                        Laporan Penjualan
                    </a>
                </li>
                <li class="nav-items">
                    <a href="#" class="nav-link d-flex align-items-center gap-3 fw-medium text-dark" data-bs-target="#modalLogout" data-bs-toggle="modal">
                        <i class="bi bi-box-arrow-right text-dark"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
