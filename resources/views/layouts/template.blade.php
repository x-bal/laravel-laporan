<!DOCTYPE html>
<html lang="en">
@if(Auth::user()->level == 'A')
<title>Admin | Laporan Kerja</title>
@else
<title>User | Laporan Kerja</title>
@endif

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">


  <!-- Custom fonts for this template -->
  <link href="{{url('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{url('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">

  <!-- Custom styles for this page -->

  <link href="{{url('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-book"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Aplikasi Laporan Kerja</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item {{ (request()->is('home*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{url('home')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <div class="sidebar-heading">
        Interface
      </div>
      @if(Auth::user()->level == 'A')
      <li class="nav-item {{ (request()->is('admin*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{url('admin')}}">
          <i class="fas fa-fw fa-user"></i>
          <span>Data Admin</span></a>
      </li>
      <li class="nav-item {{ (request()->is('karyawan*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{url('karyawan')}}">
          <i class="fas fa-fw fa-user-shield"></i>
          <span>Data karyawan</span></a>
      </li>
      <li class="nav-item {{ (request()->is('bendahara*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{url('bendahara')}}">
          <i class="fas fa-fw fa-user-shield"></i>
          <span>Data Bendahara</span></a>
      </li>
      <li class="nav-item {{ (request()->is('user*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{url('user')}}">
          <i class="fas fa-fw fa-users"></i>
          <span>Data User</span></a>
      </li>
      <li class="nav-item {{ (request()->is('map*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{url('map')}}">
          <i class="fas fa-fw fa-map"></i>
          <span>Data Map</span></a>
      </li>
      <li class="nav-item {{ (request()->is('finish-map*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{url('finish-map')}}">
          <i class="fas fa-fw fa-folder"></i>
          <span>Data Map Selesai</span></a>
      </li>
      <li class="nav-item {{ (request()->is('error-map*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{url('error-map')}}">
          <i class="fas fa-fw fa-cog"></i>
          <span>Error Map</span></a>
      </li>
      <li class="nav-item {{ (request()->is('kehadiran*')) ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap" aria-expanded="false" aria-controls="collapseBootstrap">
          <i class="far fa-fw fa-window-maximize"></i>
          <span>Kehadiran</span>
        </a>
        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar" style="">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Kehadiran</h6>
            <a class="collapse-item" href="/kehadiran?jenis=1">Absensi</a>
            <a class="collapse-item" href="/kehadiran?jenis=2">Izin Setengah Hari</a>
            <a class="collapse-item" href="/kehadiran?jenis=3">Izin</a>
            <a class="collapse-item" href="/kehadiran?jenis=4">Cuti</a>
            <a class="collapse-item" href="/kehadiran?jenis=5">Lembur</a>
          </div>
        </div>
      </li>
      <li class="nav-item {{ (request()->is('setting*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('setting.index') }}">
          <i class="fas fa-fw fa-cog"></i>
          <span>Setting Anggaran</span></a>
      </li>
      @endif
      @if(auth()->user()->level != 'U')
      <li class="nav-item {{ (request()->is('gaji*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('gaji.index') }}">
          <i class="fas fa-fw fa-cog"></i>
          <span>Kelola Gaji Karyawan</span></a>
      </li>
      <li class="nav-item {{ (request()->is('report*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{url('report')}}">
          <i class="fas fa-fw fa-building"></i>
          <span>Laporan</span></a>
      </li>
      @endif
      @if(auth()->user()->level == 'U')
      <li class="nav-item {{ (request()->is('work-map*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{url('work-map')}}">
          <i class="fas fa-fw fa-user"></i>
          <span>Work Maps</span></a>
      </li>
      <li class="nav-item {{ (request()->is('error-map*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{url('error-map/create')}}">
          <i class="fas fa-fw fa-cog"></i>
          <span>Error Map</span></a>
      </li>
      <li class="nav-item {{ (request()->is('lapor-email*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{url('lapor-email')}}">
          <i class="fas fa-fw fa-envelope"></i>
          <span>Lapor Email</span></a>
      </li>
      <li class="nav-item {{ (request()->is('kehadiran*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kehadiran.create') }}">
          <i class="fas fa-fw fa-cog"></i>
          <span>Kehadiran</span></a>
      </li>
      <li class="nav-item {{ (request()->is('lembur*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('lembur') }}">
          <i class="fas fa-fw fa-cog"></i>
          <span>Lembur</span></a>
      </li>
      <li class="nav-item {{ (request()->is('gaji*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('gaji.slip') }}">
          <i class="fas fa-fw fa-cog"></i>
          <span>Slip Gaji</span></a>
      </li>
      @endif


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="group">
              <div class="mr-2">
                {{ Carbon\Carbon::now()->format('l, d F Y')}}
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->


            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->karyawan->nama}}</span>

              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{url('change-password')}}">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Change Password
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->

          <!-- DataTales Example -->
          @yield('content')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{url('assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{url('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{url('assets/js/sb-admin-2.min.js')}}"></script>

  <!-- Page level plugins -->
  <script src="{{url('assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{url('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <script src="{{url('assets/js/demo/datatables-demo.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

  @stack('scripts')
</body>

</html>