<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
                <!--ganti link aser-->
                <img src="{{ asset('assets/img\Logo_holena.png') }}" alt="navbar brand" class="navbar-brand"
                    height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                    <li class="nav-item {{ isRouteActive(['Dashboard']) }}">
                        <a href="{{ route('sortiran') }}">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Karyawan Import</h4>
                </li>
                <li class="nav-item {{ isRouteActive(['pelabuhan', 'pelabuhan.create','pelabuhan.edit','pelabuhan.create']) }}">
                    <a href="{{ route('pelabuhan') }}">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Pelabuhan
                        </p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Karyawan Gudang</h4>
                </li>
                <li class="nav-item {{ isRouteActive(['barang-import.masuk.index', 'barang-import.keluar.index', 'barang-import.masuk.create', 'barang-import.keluar.create', 'barang-import.masuk.edit'], 'submenu active') }}">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fas fa-cart-arrow-down"></i>
                        <p>Barang Import</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ isRouteActive(['barang-import.masuk.index', 'barang-import.keluar.index', 'barang-import.masuk.create', 'barang-import.keluar.create', 'barang-import.masuk.edit'], 'show') }}" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('barang-import.masuk.index') }}">
                                    <span class="sub-item">Barang Masuk</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('barang-import.keluar.index') }}">
                                    <span class="sub-item">Barang Keluar</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ isRouteActive(['masuk-lokal', 'keluar-lokal','keluar-lokal.edit','keluar-lokal.detail','masuk-lokal.edit'], 'submenu active') }}">
                    <a data-bs-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-cart-arrow-down"></i>
                        <p>Barang Lokal</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ isRouteActive(['masuk-lokal', 'keluar-lokal','keluar-lokal.edit','keluar-lokal.detail','masuk-lokal.edit'], 'show') }}" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('masuk-lokal') }}">
                                    <span class="sub-item">Barang Masuk</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('keluar-lokal') }}">
                                    <span class="sub-item">Barang keluar</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                    <li class="nav-item {{ isRouteActive(['sortiran', 'sortiran.create', 'sortiran.edit']) }}">
                        <a href="{{ route('sortiran') }}">
                            <i class="fas fa-clipboard-list"></i>
                            <p>Data Sortiran</p>
                        </a>
                    </li>
                    <li class="nav-item {{ isRouteActive(['barang', 'barang.create', 'barang.edit']) }}">
                        <a href="{{ route('barang') }}">
                            <i class="fas fa-file-contract"></i>
                            <p>Data Barang</p>
                        </a>
                    </li>
                    <li class="nav-item {{ isRouteActive(['pemesanan', 'pemesanan.create', 'pemesanan.edit']) }}">
                        <a href="{{ route('pemesanan') }}">
                            <i class="fas fa-pen-square"></i>
                            <p>Pemesanan</p>
                        </a>
                    </li>
                    <li class="nav-item {{ isRouteActive(['supplier']) }}">
                        <a href="{{ route('supplier') }}">
                            <i class="fas fa-folder"></i>
                            <p>Supplier</p>
                        </a>
                    </li>
                    <li class="nav-item {{ isRouteActive(['laporan']) }}">
                        <a href="{{ route('laporan') }}">
                            <i class="fas fa-folder"></i>
                            <p>Laporan</p>
                        </a>
                    </li>
                    <div class="collapse" id="submenu">
                        <ul class="nav nav-collapse">
                            <li>
                                <a data-bs-toggle="collapse" href="#subnav1">
                                    <span class="sub-item">Level 1</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="subnav1">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a data-bs-toggle="collapse" href="#subnav2">
                                    <span class="sub-item">Level 1</span>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="subnav2">
                                    <ul class="nav nav-collapse subnav">
                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Level 2</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Level 1</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>