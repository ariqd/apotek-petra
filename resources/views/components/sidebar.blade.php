<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand sidebar-gone-show"><a href="index.html">Apotek Petra</a></div>
        <ul class="sidebar-menu">
            <li class="{{ request()->is('/') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/') }}">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="{{ request()->is('dashboard*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ request()->is('obat*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('obat') }}">
                    <i class="fas fa-vial"></i>
                    <span>Obat</span>
                </a>
            </li>
            {{-- <li class="{{ request()->is('kriteria*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('kriteria') }}">
                    <i class="fas fa-cogs"></i>
                    <span>Kriteria</span>
                </a>
            </li> --}}
            {{-- <li class="{{ request()->is('supplier*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('supplier') }}">
                    <i class="fas fa-users"></i>
                    <span>Supplier</span>
                </a>
            </li> --}}
            <li class="{{ request()->is('transaksi/create*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('transaksi/create') }}">
                    <i class="fas fa-calculator"></i>
                    <span>Transaksi Baru</span>
                </a>
            </li>
            <li class="{{ request()->is('transaksi') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('transaksi') }}">
                    <i class="fas fa-list-ol"></i>
                    <span>Riwayat Transaksi</span>
                </a>
            </li>
            <li class="{{ request()->is('supplier') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('supplier') }}">
                    <i class="fas fa-users"></i>
                    <span>Supplier</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
