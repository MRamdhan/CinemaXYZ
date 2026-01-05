<nav class="navbar navbar-expand-lg" style="background-color: #003b6d">
    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand text-light" href="#">
            <img src="{{ asset('img/logo.png') }}" width="50">
        </a>

        <!-- HAMBURGER BUTTON -->
        <button class="navbar-toggler text-light" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- NAVBAR CONTENT -->
        <div class="collapse navbar-collapse" id="navbarContent">

            <!-- LEFT MENU -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                @guest
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{ route('showMovies') }}">
                            List Film
                        </a>
                    </li>
                @endguest

                @auth
                    @if(auth()->user()->role === 'kasir')
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('showMovies') }}">
                                List Film
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('history') }}">
                                Riwayat Transaksi
                            </a>
                        </li>
                    @endif

                    @if(auth()->user()->role === 'owner')
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('homeOwner') }}">
                                Home Owner
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('history') }}">
                                Riwayat Transaksi
                            </a>
                        </li>
                    @endif
                @endauth

            </ul>

            <!-- RIGHT MENU -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-success">
                            Login
                        </a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->username }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">

                            @if(auth()->user()->role === 'admin')
                                <li><a class="dropdown-item" href="{{ route('homeAdmin') }}">Beranda Admin</a></li>
                                <li><a class="dropdown-item" href="{{ route('kelolaUser') }}">Tambah User</a></li>
                                <li><a class="dropdown-item" href="{{ route('upComing') }}">Up Coming</a></li>
                                <li><a class="dropdown-item" href="{{ route('trash') }}">Archived</a></li>
                                <li><hr class="dropdown-divider"></li>
                            @endif

                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="return confirm('Yakin ingin logout?')">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>
