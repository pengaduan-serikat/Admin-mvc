<div class="sidebar" data-color="purple" data-image="/img/sidebar-5.jpg">

<!--

Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
Tip 2: you can also add an image using data-image tag

-->

<div class="sidebar-wrapper">
    <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text">
            Creative Tim
        </a>
    </div>

    <ul class="nav">
        <li >
            <a href="/admin">
                <i class="pe-7s-graph"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li>
            <a href="/admin/all-cat">
                <i class="pe-7s-more"></i>
                <p>Data Kucing</p>
            </a>
        </li>
        <li>
            <a href="/admin/add-cat">
                <i class="pe-7s-plus"></i>
                <p>Tambah Kucing</p>
            </a>
        </li>
        <li> 
            <a href="/admin/transaction">
                <i class="pe-7s-shopbag"></i>
                <p>Transaksi</p>
            </a>
        </li>
        <li class="active-pro">
                <a href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                    <i class="pe-7s-rocket"></i>
                    <p>Logout</p>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
    </ul>
</div>
</div>