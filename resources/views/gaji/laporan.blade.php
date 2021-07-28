@extends('layouts.template')
@section('content')
<title>Data Admin | Kasir</title>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(auth()->user()->level != 'U')
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Laporan Gaji</h6>
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
                                <select name="user" id="user" class="form-control">
                                    <option disabled selected>-- Pilih User --</option>
                                    @foreach($users as $user)
                                    <option {{ request('user') == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->karyawan->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
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

            @if($gaji != null)
            <div class="card">
                <div class="card-header">Laporan Pendapatan</div>

                <div class="card-body">
                    <table id="dataTable" class="table table-bordered" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Bonus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($pendapatan as $pnd)
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pnd->user->karyawan->nama }}</td>
                                <td>{{ $pnd->tanggal }}</td>
                                <td>{{ $pnd->keterangan }}</td>
                                <td>@currency($pnd->jenis->nominal)</td>
                            </tr>
                            @php
                            $totalPend += $pnd->jenis->nominal
                            @endphp
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr class="text-right">
                                <td colspan="5">Total Bonus : @currency($totalPend)</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">Laporan Pengurangan</div>

                <div class="card-body">
                    <table id="dataTable" class="table table-bordered" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Pengurangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach($pengurangan as $pnr)
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pnr->user->karyawan->nama }}</td>
                                <td>{{ $pnr->tanggal }}</td>
                                <td>{{ $pnr->keterangan }}</td>
                                <td>@currency($pnr->jenis->nominal)</td>
                            </tr>

                            @php
                            $totalPeng += $pnr->jenis->nominal
                            @endphp
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr class="text-right">
                                <td colspan="5">Total Pengurangan : @currency($totalPeng)</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            @php
            $totalPem = $gaji->gaji + $totalPend - $totalPeng
            @endphp

            <button class="btn btn-info mt-3">Gaji Karyawan : @currency($gaji->gaji)</button>
            <button class="btn btn-danger mt-3">BPJS : @currency($bpjs->nominal)</button>
            @if(auth()->user()->level == 'U')
            <a href="/gaji/generate/{{ request('tanggal') }}" class="btn btn-primary mt-3"><i class="fas fa-download"></i> Generate Laporan</a>
            @else
            <a href="/gaji/generate/{{ request('user') }}/{{ request('bulan') }}" class="btn btn-primary mt-3"><i class="fas fa-download"></i> Generate Laporan</a>
            @endif
            <div class="alert alert-success mt-3">Total Yang Harus Dibayar : @currency($totalPem - $bpjs->nominal)</div>
            @endif
        </div>
    </div>
</div>


@endsection