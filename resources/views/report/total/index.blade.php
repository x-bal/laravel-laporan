@extends('layouts.template')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark">Laporan Map Total Pengerjaan Karyawan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <a href="{{url('report/total/export')}}" class="btn btn-warning mb-4">Export Excel</a>
            @include('report.total.table', $workMap)
        </div>
    </div>
</div>

  
@endsection