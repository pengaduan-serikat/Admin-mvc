<div class="sidebar" data-color="purple" data-image="{{asset('img/templates/sidebar-5.jpg')}}">

<!--

Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
Tip 2: you can also add an image using data-image tag

-->

<div class="sidebar-wrapper">
    <div class="logo">
        <a href="/" class="simple-text">
            Creative Tim
        </a>
    </div>

    <ul class="nav">
        <li>
            <a href="/divisions">
                {{-- <i class="pe-7s-more"></i> --}}
                <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                <p>Data Divisi</p>
            </a>
        </li>
        <li>
            <a href="/admin/add-cat">
                {{-- <i class="pe-7s-plus"></i> --}}
                <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                <p>Tambah Kucing</p>
            </a>
        </li>
        <li> 
            <a href="/admin/transaction">
                <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                <p>Transaksi</p>
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