@extends('layouts.template')
@section('content')

@if( Session::get('berhasil') !="")
<div class='alert alert-success'>
  <center><b>{{Session::get('berhasil')}}</b></center>
</div>
@endif
@if(Auth::user()->level == 'A')
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Map</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{DB::table('maps')->count()}}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-map fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-dark shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Map Selesai</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{DB::table('work_maps')->where('finish_on','!=',null)->count()}}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-building fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Map Priority</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{DB::table('maps')->where('priority', 'yes')->count()}}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-folder fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Work Progress</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{DB::table('work_maps')->where('finish_on',null)->count()}}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-folder fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Pending Requests Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Error Map</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{DB::table('errors')->count()}}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-cog fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Karyawan</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\User::where('level', 'U')->count() }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-users fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@else

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Dashboard</h6>
  </div>
  <div class="card-body">
    <h5>Selamat Datang, {{auth()->user()->karyawan->nama}}</h5>

  </div>
</div>
@endif

@endsection