
<nav class="navbar navbar-expand-lg " style="background-color: #003b6d">
    <div class="container">
        <img src="img/logo.png" alt="" width="50px">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            @guest
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('showMovies') }}">List Film</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('showMovies') }}">List Film</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('history') }}">Riwayat Transaksi</a>
                </li>
            @endguest
        </ul>

        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            @if (!auth()->user())
                <a href="{{ route('login') }}" class="btn btn-success">Login</a>
            @endif
            @if (auth()->user())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->username }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="userDropdown">
                        <a href="{{ route('logout') }}" class="dropdown-item">Logout</a>
                    </div>
                </li>
            @endif

            @if (auth()->user() && auth()->user()->role == 'admin')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="adminDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Admin Views
                    </a>
                    <div class="dropdown-menu" aria-labelledby="adminDropdown">
                        <a href="{{ route('homeAdmin') }}" class="dropdown-item">Beranda Admin</a>
                        <a href="{{ route('kelolaUser') }}" class="dropdown-item">Tambah User</a>
                        <a href="{{ route('upComing') }}" class="dropdown-item">Up Coming</a>
                        <a href="{{ route('trash') }}" class="dropdown-item">Archived</a>
                    </div>
                </li>
            @endif
            @if (auth()->user() && auth()->user()->role == 'owner')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="adminDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Owner Tampilan
                    </a>
                    <div class="dropdown-menu" aria-labelledby="adminDropdown">
                        <a href="#" class="dropdown-item">Beranda Owner</a>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</nav>