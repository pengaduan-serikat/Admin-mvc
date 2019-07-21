<div class="sidebar" data-color="purple" data-image="{{asset('img/templates/sidebar-5.jpg')}}">

<!--

Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
Tip 2: you can also add an image using data-image tag

-->

<div class="sidebar-wrapper">
    <div class="logo">
        <a href="/" class="simple-text">
            Pengaduan Serikat
        </a>
    </div>

    <ul class="nav">
        <li class="{{ Request::is('divisions*') ? 'active' : '' }}">
            <a href="/divisions">
                {{-- <i class="pe-7s-more"></i> --}}
                <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                <p>Data Divisi</p>
            </a>
        </li>
        <li class="{{ Request::is('positions*') ? 'active' : '' }}">
            <a href="/positions">
                {{-- <i class="pe-7s-plus"></i> --}}
                <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                <p>Data Jabatan</p>
            </a>
        </li>
        {{-- <li class="{{ Request::is('users*') ? 'active' : '' }}">
            <a href="/users/">
                <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                <p>Data User</p>
            </a>
        </li> --}}
        <li class="{{ Request::is('users*') ? 'active' : '' }}">
            <a href="/users">
                <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                <p>Data Anggota</p>
            </a>
        </li>
        <li class="{{ Request::is('employees*') ? 'active' : '' }}">
            <a href="/employees/">
                <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                <p>Data Anggota Karyawan</p>
            </a>
        </li>
        <li class="{{ Request::is('cases*') ? 'active' : '' }}">
            <a href="/cases">
                <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                <p>Laporan pengaduan</p>
            </a>
        </li>
        <li class="{{ Request::is('event*') ? 'active' : '' }}">
            <a href="#">
                <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                <p>Upload Event Serikat</p>
            </a>
        </li>
        <li class="active-pro">
                <a href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                    {{-- <i class="pe-7s-rocket"></i> --}}
                    <i class="fa fa-power-off" aria-hidden="true"></i>
                    <p>Logout</p>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
    </ul>
</div>
</div>
