<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('template-admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Appointment System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('template-admin/dist/img/avatar4.png') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info text-white">
                {{ auth()->user()->nama_pengguna ?? $dokter->nama }}
            </div>
            @if (!auth()->check() && isset($dokter) && $dokter->id)
            &nbsp;
            <a href="{{ route('profil') }}" class="text-primary" style="font-size: 14px">
                <i class="ion-edit"></i> Ubah
            </a>
            @endif
        </div>

        <!-- Sidebar Menu -->
        @if (!auth()->check() && isset($dokter) && $dokter->id)
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('dokter.dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('jadwalpraktik') }}" class="nav-link">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>
                                Jadwal Praktik
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('periksapasien') }}" class="nav-link">
                            <i class="nav-icon fas fa-user-alt"></i>
                            <p>
                                Periksa Pasien
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('riwayatpasien') }}" class="nav-link">
                            <i class="nav-icon fas fa-user-alt"></i>
                            <p>
                                Riwayat Pasien
                            </p>
                        </a>
                    </li>
                    <li class="mt-5 nav-item">
                        <form action="/dokter/logout" method="POST">
                            @csrf
                            <button class="logout-style btn btn-danger btn-block" data-toggle="tooltip" data-placement="top"
                                title="Logout" type="submit">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        @elseif (auth()->check() && auth()->user()->username)
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="nav-icon fa fa-th-list"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('dokter') }}" class="nav-link">
                            <i class="nav-icon fa fa-user-md"></i>
                            <p>
                                Dokter
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pasien') }}" class="nav-link">
                            <i class="nav-icon fa fa-user"></i>
                            <p>
                                Pasien
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('poli') }}" class="nav-link">
                            <i class="nav-icon fa fa-hospital"></i>
                            <p>
                                Poli
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('obat') }}" class="nav-link">
                            <i class="nav-icon fa fa-medkit"></i>
                            <p>
                                Obat
                            </p>
                        </a>
                    </li>
                    <li class="mt-5 nav-item">
                        <form action="/admin/logout" method="POST">
                            @csrf
                            <button class="logout-style btn btn-danger btn-block" data-toggle="tooltip" data-placement="top"
                                title="Logout" type="submit">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        @endif
    </div>
    <!-- /.sidebar -->
</aside>

{{-- <div class="sidebar-footer hidden-small logout-style2">
    <form action="/logout" method="POST">
    @csrf
        <button class="logout-style btn btn-danger" data-toggle="tooltip" data-placement="top" title="Logout" type="submit">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span> Logout
        </button>
    </form>
</div> --}}
