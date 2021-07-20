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
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Konfirmasi {{ $jenis->name }}</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if($kehadiran != null)
            <table id="dataTable" class="table table-bordered" cellspacing="0">
                <thead>
                    <tr>
                        @if(request('jenis') == 1)
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th class="text-center">Konfirmasi</th>
                        @else
                        <th>No</th>
                        <th>Nama</th>
                        <th>Dari</th>
                        <th>Sampai</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th class="text-center">Konfirmasi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kehadiran as $hadir)
                    <tr>
                        @if(request('jenis') == 1)
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $hadir->user->karyawan->nama }}</td>
                        <td>{{ $hadir->tanggal }}</td>
                        <td>{{ $hadir->keterangan }}</td>
                        <td>{{ $hadir->status }}</td>
                        @else
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $hadir->user->karyawan->nama }}</td>
                        <td>{{ $hadir->dari }}</td>
                        <td>{{ $hadir->sampai }}</td>
                        <td>{{ $hadir->keterangan }}</td>
                        <td>{{ $hadir->status }}</td>
                        @endif
                        <td class="text-center">
                            <a href="{{ route('accept', $hadir->id) }}" class="btn btn-success btn-sm" onclick="return confirm('Setujui ?')"><i class="fas fa-check"></i></a>
                            <a href="{{ route('reject', $hadir->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Tolak ?')"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data {{ $jenis->name }} Disetujui</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if($kehadiran != null)
            <table id="dataTable" class="table table-bordered" cellspacing="0">
                <thead>
                    <tr>
                        @if(request('jenis') == 1)
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                        @else
                        <th>No</th>
                        <th>Nama</th>
                        <th>Dari</th>
                        <th>Sampai</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accept as $acc)
                    <tr>
                        @if(request('jenis') == 1)
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $acc->user->karyawan->nama }}</td>
                        <td>{{ $acc->tanggal }}</td>
                        <td>{{ $acc->keterangan }}</td>
                        <td>{{ $acc->status }}</td>
                        @else
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $acc->user->karyawan->nama }}</td>
                        <td>{{ $acc->dari }}</td>
                        <td>{{ $acc->sampai }}</td>
                        <td>{{ $acc->keterangan }}</td>
                        <td>{{ $acc->status }}</td>
                        @endif
                        <td class="text-center">
                            @if(request('jenis') == 4)
                            <a href="{{ route('kehadiran.show', $acc->id) }}" class="btn btn-info btn-sm"><i class="fas fa-file"></i></a>
                            @endif
                            <a href="{{ route('reject', $acc->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Tolak ?')"><i class="fas fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data {{ $jenis->name }} Ditolak</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if($kehadiran != null)
            <table id="dataTable" class="table table-bordered" cellspacing="0">
                <thead>
                    <tr>
                        @if(request('jenis') == 1)
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                        @else
                        <th>No</th>
                        <th>Nama</th>
                        <th>Dari</th>
                        <th>Sampai</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reject as $rjc)
                    <tr>
                        @if(request('jenis') == 1)
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rjc->user->karyawan->nama }}</td>
                        <td>{{ $rjc->tanggal }}</td>
                        <td>{{ $rjc->keterangan }}</td>
                        <td>{{ $rjc->status }}</td>
                        @else
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rjc->user->karyawan->nama }}</td>
                        <td>{{ $rjc->dari }}</td>
                        <td>{{ $rjc->sampai }}</td>
                        <td>{{ $rjc->keterangan }}</td>
                        <td>{{ $rjc->status }}</td>
                        @endif
                        <td class="text-center">
                            @if(request('jenis') == 4)
                            <a href="{{ route('kehadiran.show', $rjc->id) }}" class="btn btn-info btn-sm"><i class="fas fa-file"></i></a>
                            @endif
                            <a href="{{ route('accept', $rjc->id) }}" class="btn btn-success btn-sm" onclick="return confirm('Setujui ?')"><i class="fas fa-check"></i></a>
                            <form action="{{ route('kehadiran.destroy', $rjc->id) }}" method="post" style="display: inline;">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin ?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>

<div id="tambah" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Masukan Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('kehadiran.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="user">Pilih User</label>
                        <select name="user" class="form-control" required>
                            <option disabled selected>-- Pilih User --</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->karyawan->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jenis">Pilih Izin</label>
                        <select name="jenis" class="form-control" required>
                            <option disabled selected>-- Pilih Izin --</option>
                            @foreach($jeniss as $jns)
                            <option value="{{ $jns->id }}">{{ $jns->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="dari">Dari</label>
                        <input type="date" name="dari" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="sampai">Sampai</label>
                        <input type="date" name="sampai" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" rows="3" class="form-control"></textarea>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection