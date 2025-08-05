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
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Kelola Barang</h4>
                </li>
                @hasanyrole('karyawan-pelabuhan|owner')
                    <li
                        class="nav-item {{ isRouteActive(['pelabuhan', 'pelabuhan.create', 'pelabuhan.edit', 'pelabuhan.create']) }}">
                        <a href="{{ route('pelabuhan') }}">
                            <i class="fas fa-sign-out-alt"></i>
                            <p>Pelabuhan
                            </p>
                        </a>
                    </li>
                @endhasanyrole
                @hasanyrole('karyawan-gudang|owner')
                    <li
                        class="nav-item {{ isRouteActive(['barang-masuk.index', 'barang-masuk.create', 'barang-keluar.index', 'barang-keluar.create', 'konfirmasi.index'], 'submenu active') }}">
                        <a data-bs-toggle="collapse" href="#base">
                            <i class="fas fa-cart-arrow-down"></i>
                            <p>Transaksi</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse {{ isRouteActive(['barang-masuk.index', 'barang-masuk.create', 'barang-keluar.index', 'barang-keluar.create', 'konfirmasi.index'], 'show') }}"
                            id="base">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('konfirmasi.index') }}">
                                        <span class="sub-item">Konfirmasi Barang</span>
                                    </a>
                                <li>
                                    <a href="{{ route('barang-masuk.index') }}">
                                        <span class="sub-item">Barang Masuk</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('barang-keluar.index') }}">
                                        <span class="sub-item">Barang Keluar</span>
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
                @endhasanyrole

                @hasanyrole('karyawan-pelabuhan|karyawan-gudang|owner')
                    <li class="nav-item {{ isRouteActive(['barang', 'barang.create', 'barang.edit']) }}">
                        <a href="{{ route('barang') }}">
                            <i class="fas fa-file-contract"></i>
                            <p>Data Barang</p>
                        </a>
                    </li>
                @endhasanyrole

                @hasanyrole('karyawan-gudang|owner')
                    <li class="nav-item {{ isRouteActive(['supplier']) }}">
                        <a href="{{ route('supplier') }}">
                            <i class="fas fa-clipboard-list"></i>
                            <p>Data Supplier</p>
                        </a>
                    </li>
                @endhasanyrole()

                @hasanyrole('karyawan-gudang|owner')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('mitra.index') }}">
                        <i class="fas fa-user-friends"></i>
                        <span>Data Mitra</span>
                    </a>
                </li>
                @endhasanyrole()

                @hasanyrole('karyawan-gudang|owner')
                    <li class="nav-item {{ isRouteActive(['laporan']) }}">
                        <a href="{{ route('laporan') }}">
                            <i class="fas fa-folder"></i>
                            <p>Laporan</p>
                        </a>
                    </li>
                @endhasanyrole

                @hasanyrole('owner')
                    <li class="nav-item {{ isRouteActive(['user']) }}">
                        <a href="{{ route('user.index') }}">
                            <i class="fas fa-folder"></i>
                            <p>Data Karyawan</p>
                        </a>
                    </li>
                @endhasanyrole()
                </li>
            </ul>
        </div>
    </div>
</div>
