<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>
    {{-- <div class="ms-2 d-flex ">
        <h5 id="jam">00.00.00</h5>
    </div> --}}
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="bell"></i>
                        @php
                            $notif = DB::table('barang')
                                ->where('stok', '<', 20)
                                ->count();
                        @endphp
                        @if ($notif != 0)
                            <span class="indicator">{{ $notif }}</span>
                        @endif
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
                    <div class="dropdown-menu-header"><b>{{ $notif }}</b>
                        Barang dengan Stok yang Menipis</div>
                    <div class="list-group">

                        @forelse (DB::table('barang')->where('stok', '<', 20)->limit(5)->get() as $item)
                            <a href="{{ url('/barang') }}" class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <div class="col-2">
                                        <i class="text-danger" data-feather="alert-circle"></i>
                                    </div>
                                    <div class="col-10">

                                        <div class="text-dark">{{ $item->nama_barang }}</div>
                                        <div class="text-muted small mt-1">
                                            Stok {{ $item->nama_barang }} tersisa {{ $item->stok }}
                                        </div>
                                        {{-- <div class="text-muted small mt-1">30m ago</div> --}}
                                    </div>
                                </div>
                            </a>
                        @empty
                            <a href="#" class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    <center>
                                        <b>-</b>
                                    </center>
                                </div>
                            </a>
                        @endforelse

                    </div>
                    <div class="dropdown-menu-footer">
                        <a href="#" class="text-muted"></a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown @if (auth()->user()->role != 'Admin') d-none @endif">
                <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="message-square"></i>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
                    <div class="dropdown-menu-header">
                        <div class="position-relative">Histori Login</div>
                    </div>
                    <div class="list-group">

                        @foreach (DB::table('login_histories')->join('users', 'users.id', '=', 'login_histories.user_id')->select('users.name', 'users.pic', 'login_histories.*')->latest()->limit(5)->get() as $item)
                            <a href="#" class="list-group-item">
                                <div class="row g-0 align-items-center">
                                    @if ($item->pic)
                                        <div class="col-2">
                                            <img src="{{ asset('storage/' . $item->pic) }}"
                                                class="avatar img-fluid rounded-circle" alt="{{ $item->name }}" />
                                        </div>
                                    @else
                                        <div class="col-2">
                                            <img src="{{ asset('img/profile_default.png') }}"
                                                class="avatar img-fluid rounded-circle" alt="{{ $item->name }}"/>
                                        </div>
                                    @endif
                                    <div class="col-10 ps-2">
                                        <div class="text-dark">{{ Str::title($item->name) }}</div>
                                        <div class="text-muted small mt-1">
                                            Login pada
                                        </div>
                                        <div class="text-muted small mt-1">{{ $item->login_at }}</div>
                                    </div>
                                </div>
                            </a>
                        @endforeach

                    </div>
                    <div class="dropdown-menu-footer">
                        <a href="{{ url('/historiLogin') }}" class="text-muted">Lihat Histori Login</a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    @if (auth()->user()->pic)
                        <img src="{{ asset('storage/' . auth()->user()->pic) }}"
                            class="avatar img-fluid rounded me-1 border border-2" alt="{{ auth()->user()->name }}"
                            style="background-size: cover" />
                    @else
                        <img src="{{ asset('img/profile_default.png') }}" class="avatar img-fluid rounded me-1"
                            alt="{{ auth()->user()->name }}"/>
                    @endif
                    <span class="text-dark">{{ Str::title(auth()->user()->name) }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('profil') }}"><i class="align-middle me-1"
                            data-feather="user"></i>
                        Profil</a>
                    <a class="dropdown-item" href="{{ url('/dashboard') }}"><i class="align-middle me-1"
                            data-feather="pie-chart"></i>
                        Analisis</a>
                    {{-- <a class="dropdown-item" href="index.html"><i class="align-middle me-1" data-feather="settings"></i>
                        Pengaturan</a> --}}
                    <div class="dropdown-divider"></div>
                    <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#logout">
                        <i class="align-middle me-1" data-feather="log-out"></i>
                        Keluar</button>
                </div>
            </li>
        </ul>
    </div>
</nav>

<div class="modal modal-alert fade" data-bs-backdrop="static" tabindex="-1" role="dialog" id="logout"
    style="margin-top: 100px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-3 shadow w-75 m-auto" style="border-top:5px solid #17A2B8">
            <div class="modal-body p-4 text-center">
                <div class="text-info">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                        class="bi bi-question-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                        <path
                            d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94" />
                    </svg>
                </div>
                <h4 class="mb-3 fw-bold mt-3">Keluar?</h4>
                <p class="mb-0">
                    Anda yakin ingin Keluar?
                </p>
            </div>
            <form action="{{ url('/logout') }}" method="post">
                @csrf
                <div class="modal-footer flex-nowrap p-0">
                    <div class="col-6 m-0 rounded-0 d-flex justify-content-center p-2">
                        <button type="button"
                            class="btn fs-6 text-decoration-none col-6 m-0 w-100 border-1 border-secondary border-opacity-25 shadow-lg "
                            data-bs-dismiss="modal">
                            <strong>Batal</strong>
                        </button>
                    </div>
                    <div class="col-6 m-0 rounded-0 d-flex justify-content-center p-2">
                        <button type="submit" class="btn btn-info fs-6 text-decoration-none col-6 m-0 w-100">
                            <strong>Ya</strong>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
