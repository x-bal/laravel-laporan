@extends('layouts.template')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark">Laporan Map Progress</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <a href="{{url('report/progress/export')}}" class="btn btn-warning mb-4">Export Excel</a>
            @include('report.progress.table', $workMap)
        </div>
    </div>
</div>


@endsection