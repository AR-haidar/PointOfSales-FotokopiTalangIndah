<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand text-center text-uppercase" href="#">
            <span class="align-middle">Talang Indah</span>
        </a>

        <ul class="sidebar-nav pb-5">

            <li class="sidebar-item {{ Request::is('dashboard*') ? 'active' : '' }}">
                <a class="sidebar-link" href="/dashboard">
                    <i class="align-middle" data-feather="pie-chart"></i>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-header">Data</li>

            <li
                class="sidebar-item {{ Request::is('petugas*') ? 'active' : '' }} @if (auth()->user()->role != 'Admin') d-none @endif">
                <a class="sidebar-link" href="/petugas">
                    <i class="align-middle" data-feather="user"></i>
                    <span class="align-middle">Data Petugas</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::is('barang') || Request::is('barang/*') ? 'active' : '' }} ">
                <a class="sidebar-link" href="/barang">
                    <i class="align-middle" data-feather="box"></i>
                    <span class="align-middle">Data Barang</span>
                </a>
            </li>

            <li class="sidebar-header">Transaksi</li>

            <li class="sidebar-item {{ Request::is('barangMasuk*') ? 'active' : '' }} @if (auth()->user()->role != 'Admin') d-none @endif">
                <a class="sidebar-link" href="/barangMasuk">
                    <i class="align-middle" data-feather="package"></i>
                    <span class="align-middle">Barang Masuk</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::is('kasir*') ? 'active' : '' }}">
                <a class="sidebar-link" href="/kasir">
                    <i class="align-middle" data-feather="shopping-cart"></i>
                    <span class="align-middle">Kasir</span>
                </a>
            </li>

            <li class="sidebar-header">Riwayat Transaksi</li>

            <li class="sidebar-item {{ Request::is('penjualan*') ? 'active' : '' }}">
                <a class="sidebar-link" href="/penjualan">
                    <i class="align-middle" data-feather="list"></i>
                    <span class="align-middle">Riwayat Penjualan</span>
                </a>
            </li>

            <li class="sidebar-item {{ Request::is('pembelian*') ? 'active' : '' }}">
                <a class="sidebar-link" href="/pembelian">
                    <i class="align-middle" data-feather="list"></i>
                    <span class="align-middle">Riwayat Barang Masuk</span>
                </a>
            </li>

            <li class="sidebar-header">Laporan</li>

            <li class="sidebar-item {{ Request::is('laporan-penjualan*') ? 'active' : '' }}">
                <a class="sidebar-link" href="/laporan-penjualan">
                    <i class="align-middle" data-feather="file-text"></i>
                    <span class="align-middle">Laporan Pemasukan</span>
                </a>
            </li>
            <li class="sidebar-item {{ Request::is('laporan-pembelian*') ? 'active' : '' }}">
                <a class="sidebar-link" href="/laporan-pembelian">
                    <i class="align-middle" data-feather="file-text"></i>
                    <span class="align-middle">Laporan Pengeluaran</span>
                </a>
            </li>
            {{-- <li class="sidebar-item {{ Request::is('asdkhsa')beli' ? 'active' : '' }}">
                <a class="sidebar-link" href="/laporan-barangmasuk">
                    <i class="align-middle" data-feather="file-text"></i>
                    <span class="align-middle">Laporan Pembelian</span>
                </a>
            </li>
            
            <li class="sidebar-header">Riwayat</li>
            
            <li class="sidebar-item {{ Request::is('asdkhsa') ? 'active' : '' }}">
                <a class="sidebar-link" href="/pembelian">
                    <i class="align-middle" data-feather="file-minus"></i>
                    <span class="align-middle">Riwayat Barang Masuk</span>
                </a>
            </li>
            <li class="sidebar-item {{ Request::is('asdkhsa') ? 'active' : '' }}">
                <a class="sidebar-link" href="/penjualan">
                    <i class="align-middle" data-feather="file-minus"></i>
                    <span class="align-middle">Riwayat Penjualan</span>
                </a>
            </li> --}}

        </ul>
    </div>
</nav>
