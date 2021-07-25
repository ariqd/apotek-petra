<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand sidebar-gone-show"><a href="{{ url('/') }}">Apotek Petra</a></div>
        <ul class="sidebar-menu">
            @if(Auth::user()->role == 'Pemilik')
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
            @endif
            <li class="{{ request()->is('obat*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('obat') }}">
                    <i class="fas fa-vial"></i>
                    <span>Obat</span>
                </a>
            </li>
            <li class="{{ request()->is('transaksi/create') ? 'active' : '' }}">
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
            @if(Auth::user()->role == 'Pemilik')
                <li class="{{ request()->is('supplier') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('supplier') }}">
                        <i class="fas fa-users"></i>
                        <span>Supplier</span>
                    </a>
                </li>
                <li class="{{ request()->is('restock') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('restock') }}">
                        <i class="fas fa-plus"></i>
                        <span>Pemesanan ke Supplier</span>
                    </a>
                </li>
                <li class="{{ request()->is('users*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('users') }}">
                        <i class="fas fa-user"></i>
                        <span>User</span>
                    </a>
                </li>
            @endif
        </ul>
    </aside>
</div>
