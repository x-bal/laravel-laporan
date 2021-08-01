@extends('layouts.template')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark">Masukan Tanggal</h6>
    </div>
    <div class="card-body">
        <form action="" method="get">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tanggal Map Masuk</label>
                        <input type="date" name="req1" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Hingga Tanggal</label>
                        <input type="date" name="req2" class="form-control" required>
                    </div>
                </div>
            </div>
            <center><input type="submit" class="btn btn-success"></center>
        </form>
        <br>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark">Laporan Map Total Pengerjaan Karyawan</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <a href="/report/total/export?req1={{ request('req1') }}&req2={{ request('req2') }}" class="btn btn-warning mb-4">Export Excel</a>
            @include('report.total.table', $workMap)
        </div>
    </div>
</div>


@endsection