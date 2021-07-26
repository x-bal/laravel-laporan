@extends('layouts.template')
@section('content')
@if(auth()->user()->level == 'A')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Laporan</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <a href="{{url('report/in')}}" class="btn btn-primary form-control">Map Masuk</a>
                <a href="{{url('report/finish')}}" class="btn btn-primary form-control mt-2">Map Selesai</a>
                <a href="{{url('report/error')}}" class="btn btn-primary form-control mt-2">Map Error</a>
            </div>
            <div class="col-md-6">
                <a href="{{url('report/progress')}}" class="btn btn-primary form-control">Map Progress</a>
                <a href="{{url('report/total')}}" class="btn btn-primary form-control mt-2">Total Map Karyawan</a>
            </div>
        </div>
    </div>
</div>
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Laporan Karyawan</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <a href="{{url('report/akumulasi')}}" class="btn btn-primary form-control mt-2">Laporan Akumulasi</a>
                <a href="{{url('report/cuti')}}" class="btn btn-primary form-control mt-2">Laporan Cuti Tahunan</a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('gaji.laporan') }}" class="btn btn-primary form-control mt-2">Laporan Gaji Karyawan</a>
            </div>
        </div>
    </div>
</div>

@endsection