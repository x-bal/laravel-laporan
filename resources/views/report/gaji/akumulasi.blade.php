@extends('layouts.template')
@section('content')
<title>Data Admin | Kasir</title>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(auth()->user()->level == 'A')
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Akumulasi Gaji Bulanan</h6>
                </div>
                <div class="card-body">
                    @if( Session::get('masuk') !="")
                    <div class='alert alert-success'>
                        <center><b>{{Session::get('masuk')}}</b></center>
                    </div>
                    @endif

                    <form action="" method="get" class="mb-3">
                        <div class="row">
                            <div class="col">
                                <select name="bulan" id="bulan" class="form-control">
                                    <option disabled selected>-- Pilih Bulan --</option>
                                    <option {{ request('bulan') == '01' ? 'selected' : '' }} value="01">Januari</option>
                                    <option {{ request('bulan') == '02' ? 'selected' : '' }} value="02">Februari</option>
                                    <option {{ request('bulan') == '03' ? 'selected' : '' }} value="03">Maret</option>
                                    <option {{ request('bulan') == '04' ? 'selected' : '' }} value="04">April</option>
                                    <option {{ request('bulan') == '05' ? 'selected' : '' }} value="05">Mai</option>
                                    <option {{ request('bulan') == '06' ? 'selected' : '' }} value="06">Juni</option>
                                    <option {{ request('bulan') == '07' ? 'selected' : '' }} value="07">Juli</option>
                                    <option {{ request('bulan') == '08' ? 'selected' : '' }} value="08">Agustus</option>
                                    <option {{ request('bulan') == '09' ? 'selected' : '' }} value="09">September</option>
                                    <option {{ request('bulan') == '10' ? 'selected' : '' }} value="10">Oktober</option>
                                    <option {{ request('bulan') == '11' ? 'selected' : '' }} value="11">November</option>
                                    <option {{ request('bulan') == '12' ? 'selected' : '' }} value="12">Desember</option>
                                </select>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if(auth()->user()->level == 'A')
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Akumulasi Gaji Tahunan</h6>
                </div>
                <div class="card-body">
                    @if( Session::get('masuk') !="")
                    <div class='alert alert-success'>
                        <center><b>{{Session::get('masuk')}}</b></center>
                    </div>
                    @endif

                    <form action="" method="get" class="mb-3">
                        <div class="row">
                            <div class="col">
                                <select name="tahun" id="tahun" class="form-control">
                                    <option disabled selected>-- Pilih Tahun --</option>
                                    <option {{ request('tahun') == '2021' ? 'selected' : '' }} value="2021">2021</option>
                                    <option {{ request('tahun') == '2022' ? 'selected' : '' }} value="2022">2022</option>
                                    <option {{ request('tahun') == '2023' ? 'selected' : '' }} value="2023">2023</option>
                                </select>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>


@endsection