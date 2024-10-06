<div class="sidebar-wrapper">
  <ul class="nav">
    @if ( request()->url() == url('beranda'))
      <li class="nav-item active">
    @else
      <li class="nav-item">
    @endif
        <a href="{{ url('beranda') }}" class="nav-link">
        <i class="material-icons">dashboard</i>
        <p>Dashboard</p>
      </a>
    </li>


    @if ($user->level == 1)
    <li class="nav-item ">
      <a class="nav-link" href="#">
        <p>MONITORING STUNTING</p>
      </a>
    </li>
     @if ( request()->url() == url('beranda/laporan'))
      <li class="nav-item active">
    @else
      <li class="nav-item">
    @endif
      <a class="nav-link" href="{{ url('beranda/laporan') }}">
        <i class="material-icons">content_paste</i>
        <p>Laporan</p>
      </a>
    </li>
    @if ( request()->url() == url('beranda/map'))
    <li class="nav-item active">
  @else
    <li class="nav-item">
  @endif
      <a class="nav-link" href={{ url('beranda/map') }}>
        
        <i class="material-icons">location_ons</i>
        <p>Map</p>
      </a>
    </li>


    <li class="nav-item ">
      <a class="nav-link" href="#">
        <p>PUSKESMAS</p>
      </a>
    </li>
    @if ( request()->url() == url('beranda/puskesmas'))
    <li class="nav-item active">
  @else
    <li class="nav-item">
  @endif
      <a class="nav-link" href="{{ url('beranda/puskesmas') }}">
        <i class="material-icons">library_books</i>
        <p>Data</p>
      </a>
    </li>
    @if ( request()->url() == url('beranda/puskesmas/create'))
      <li class="nav-item active">
    @else
      <li class="nav-item">
    @endif
      <a class="nav-link" href="{{ url('beranda/puskesmas/create') }}">
        <i class="material-icons">person</i>
        <p>Tambah</p>
      </a>
    </li>
    
    @elseif ($user->level == 2)
    <li class="nav-item ">
      <a class="nav-link" href="#">
        <p>LAPORAN</p>
      </a>
    </li>
    @if ( request()->url() == url('beranda/laporan'))
      <li class="nav-item active">
    @else
      <li class="nav-item">
    @endif
      <a class="nav-link" href="{{ url('beranda/laporan') }}">
        <i class="material-icons">content_paste</i>
        <p>Data</p>
      </a>
    </li>
    @if ( request()->url() == url('beranda/laporan/create'))
      <li class="nav-item active">
    @else
      <li class="nav-item">
    @endif
      <a class="nav-link" href="{{ url('beranda/laporan/create') }}">
        <i class="material-icons">note_add</i>
        <p>Tambah</p>
      </a>
    </li>

    @endif

    
    <li class="nav-item ">
      <a class="nav-link" href="{{ url('logout') }}">
        
        <i class="material-icons">logout</i>
        <p>Logout</p>
      </a>
    </li>
    <!-- <li class="nav-item active-pro ">
          <a class="nav-link" href="./upgrade.html">
              <i class="material-icons">unarchive</i>
              <p>Upgrade to PRO</p>
          </a>
      </li> -->
  </ul>
</div>