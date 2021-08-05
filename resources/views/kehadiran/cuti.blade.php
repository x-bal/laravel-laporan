@extends('layouts.template')
@section('content')
<title>Data Kehadiran | Kasir</title>
@if( Session::get('masuk') !="")
<div class='alert alert-success'>
    <center><b>{{Session::get('masuk')}}</b></center>
</div>
@endif
@if( Session::get('update') !="")
<div class='alert alert-success'>
    <center><b>{{Session::get('update')}}</b></center>
</div>
@endif
@error('email')
<strong style="color:red">{{ $message }}</strong>
@enderror
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex">
        <h6 class="font-weight-bold text-primary mr-auto">Data Cuti Tahunan Karyawan / {{ $karyawan->nama }}</h6>
        <a href="/kehadiran?jenis=4" class="btn btn-sm btn-danger">Back</a>
    </div>
    <div class="card-body">
        <form action="" method="get">
            <div class="row">
                <div class="col-md">
                    <select name="tahun" id="tahun" class="form-control">
                        <option disabled selected>-- Pilih Tahun --</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                    </select>
                </div>

                <div class="col-md">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </div>
        </form>

        <div class="table-responsive mt-3">
            <table id="dataTable" class="table table-bordered" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Karyawan</th>
                        <th>Nama</th>
                        <th>Waktu</th>
                        <th>Keterangan</th>
                        <th>Total Hari</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                @php
                $totalCuti = 0;
                @endphp
                <tbody>
                    @foreach ($cuti as $ct)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $ct->user->karyawan->id_karyawan }}</td>
                        <td>{{ $ct->user->karyawan->nama }}</td>
                        <td>{{ $ct->dari }} s.d {{ $ct->sampai }}</td>
                        <td>{{ $ct->keterangan }}</td>
                        @php
                        $dari = \Carbon\Carbon::createFromFormat('Y-m-d', $ct->dari);
                        $sampai = \Carbon\Carbon::createFromFormat('Y-m-d', $ct->sampai);
                        $hari = $sampai->diffInDays($dari);
                        $totalCuti += $hari;
                        @endphp
                        <td>{{ $hari }} Hari</td>
                        <td>{{ $ct->status }}</td>
                        <td class="text-center">
                            <a href="{{ route('kehadiran.show', $ct->id) }}" class="btn btn-info btn-sm"><i class="fas fa-file"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">Total Cuti : </td>
                        <td colspan="2"><strong>{{ $totalCuti }} hari</strong></td>
                    </tr>
                    <tr>
                        <td colspan="6">Sisa Cuti : </td>
                        <td colspan="2"><strong>{{ $limit - $totalCuti }} hari</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

@endsection