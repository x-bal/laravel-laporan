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

                    <form action="" method="get">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Mulai Tanggal</label>
                                    <input type="date" name="req1" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Sampai Tanggal</label>
                                    <input type="date" name="req2" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if(auth()->user()->level != 'U')
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