@extends('layouts.template')
@section('content')
<title>Data Admin | Kasir</title>
<div class="row">
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Slip Gaji Karyawan</h6>
            </div>
            <div class="card-body">
                @if( Session::get('masuk') !="")
                <div class='alert alert-success'>
                    <center><b>{{Session::get('masuk')}}</b></center>
                </div>
                @endif

                @foreach($months as $month)
                <a href="{{ route('gaji.laporanKaryawan', $month->tanggal) }}" class="btn btn-primary">{{ $month->tanggal }}</a>
                @endforeach

            </div>
        </div>
    </div>
</div>


@endsection