<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <img src="{{ asset('assets/img/STP.png') }}" alt="logo" width="50" class="mt-4 mb-3">
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header mt-4 ml-4"><b>
                    PT. Sugih Teknik Perkasa
                </b></li>
            <li class="nav-item mt-5">
                <a href="{{ url('/home') }}" class="nav-link"><i
                        class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
            </li>
            @if (auth()->user()->level == 'direktur')
                <li class="nav-item"><a class="nav-link" href="{{ url('/presensi') }}"><i
                            class="fas fa-columns" class="far fa-calendar-alt"></i><span>Presensi</span></a>
                </li>
            @elseif (auth()->user()->level == 'admin')
                <li class="nav-item"><a class="nav-link" href="{{ url('/presensi') }}"><i
                            class="fas fa-columns" class="far fa-calendar-alt"></i><span>Presensi</span></a>
                </li>
            @endif
            @if (auth()->user()->level == 'admin')
                <li class="nav-item">
                    <a href="{{ url('/user') }}" class="nav-link"><i class="fas fa-user"></i><span>Data
                            Pegawai</span></a>
                </li>
            @endif
    </aside>
</div>
