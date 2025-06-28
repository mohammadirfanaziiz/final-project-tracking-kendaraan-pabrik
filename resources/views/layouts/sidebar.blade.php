<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
    <div class="sidebar-brand-text mx-3">PT Cepat Sejahtera</div>
  </a>
  
  <!-- Divider -->
  <hr class="sidebar-divider my-0">
  
  <!-- Nav Item - Dashboard -->

  <li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard') }}">
      <i class="fas fa-fw fa-solid fa-house-user"></i>
      <span>Dashboard</span></a>
  </li>
  
  <li class="nav-item">
    <a class="nav-link" href="/admin/monitoring">
      <i class="fas fa-fw fa-solid fa-map"></i>
      <span>Monitoring</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#manajemenDropdown" aria-expanded="false" aria-controls="manajemenDropdown">
      <i class="fas fa-fw fa-cogs"></i>
      <span>Manajemen</span>
    </a>
    <div id="manajemenDropdown" class="collapse">
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <li class="nav-item">
            <a href="/rute" class="nav-link">
              <i class="fas fa-fw fa-route"></i>
              <span>Rute</span>
            </a>
          </li>
          <a href="/kendaraan" class="nav-link">
            <i class="fas fa-fw fa-location-arrow"></i>
            <span>Kendaraan</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="/pengiriman" class="nav-link">
            <i class="fas fa-fw fa-location-arrow"></i>
            <span>Pengiriman</span>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a href="/gps" class="nav-link">
            <i class="fas fa-fw fa-map-marker-alt"></i>
            <span>GPS</span>
          </a>
        </li> --}}
      </ul>
    </div>
  </li>

  
  <li class="nav-item">
    <a class="nav-link" href="laporan/pengiriman">
      <i class="fas fa-file-alt"></i> <!-- Dokumen atau laporan -->
      <span>laporan</span></a>
  </li>
  


   <li class="nav-item">
      <a class="nav-link" href="{{ route('admin.test-rute') }}">
          <i class="fas fa-fw fa-map-marked-alt"></i>
          <span>Rute Pengiriman</span>
      </a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">
  
  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
  
  
</ul>

<script>

</script>