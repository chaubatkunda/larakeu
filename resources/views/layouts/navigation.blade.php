<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" aria-current="page"
                    href="{{ route('dashboard') }}">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            @if (auth()->user()->role == 'MEMBER')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('pemasukan*') ? 'active' : '' }}"
                        href="{{ route('pemasukan.index') }}">
                        <span data-feather="book-open"></span>
                        Pemasukan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('pengeluaran*') ? 'active' : '' }}"
                        href="{{ route('pengeluaran.index') }}">
                        <span data-feather="book"></span>
                        Pengeluaran
                    </a>
                </li>
            @endif
            @can('admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/member*') ? 'active' : '' }}"
                        href="{{ route('member.index') }}">
                        <span data-feather="user"></span>
                        Member
                    </a>
                </li>
            @endcan
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Laporan Keuangan</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
                <span data-feather="book-open"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            @can('admin')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/laporan/masuk') ? 'active' : '' }}"
                        href="{{ route('laporan.masuk') }}">
                        <span data-feather="file-text"></span>
                        Pemasukan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/laporan/keluar*') ? 'active' : '' }}"
                        href="{{ route('laporan.keluar') }}">
                        <span data-feather="file-text"></span>
                        Pengeluaran
                    </a>
                </li>
                <hr>
            @endcan
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="post" id="form" class="form">
                    @csrf
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <span data-feather="log-out"></span>
                        Logout
                    </a>
                </form>
            </li>
        </ul>
    </div>
</nav>
