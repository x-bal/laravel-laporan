@extends('layouts.template')
@section('content')
<title>Data Kehadiran | Kasir</title>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Kehadiran</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
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
            <div class="form mb-3">
                <form action="" method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <select name="jenis" id="jenis" class="form-control">
                                <option disabled selected>-- Pilih Jenis --</option>
                                @foreach($jenis as $jns)
                                <option {{ request("jenis") == $jns->id ? 'selected' : '' }} value="{{ $jns->id }}">{{ $jns->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">Input Kehadiran</button>
                        </div>
                    </div>
                </form>
            </div>
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
                        <th class="text-center">Aksi</th>
                        @else
                        <th>No</th>
                        <th>Nama</th>
                        <th>Dari</th>
                        <th>Sampai</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th class="text-center">Konfirmasi</th>
                        <th class="text-center">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kehadiran as $hadir)
                    <tr>
                        @if(request('jenis') == 1)
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $hadir->user->name }}</td>
                        <td>{{ $hadir->tanggal }}</td>
                        <td>{{ $hadir->keterangan }}</td>
                        <td>{{ $hadir->status }}</td>
                        @else
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $hadir->user->name }}</td>
                        <td>{{ $hadir->dari }}</td>
                        <td>{{ $hadir->sampai }}</td>
                        <td>{{ $hadir->keterangan }}</td>
                        <td>{{ $hadir->status }}</td>
                        @endif
                        <td class="text-center">
                            <a href="{{ route('accept', $hadir->id) }}" class="btn btn-success btn-sm" onclick="return confirm('Setujui ?')"><i class="fas fa-check"></i></a>
                            <a href="{{ route('reject', $hadir->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Tolak ?')"><i class="fas fa-times"></i></a>
                        </td>
                        <td class="text-center">
                            <a href="" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin ?')"><i class="fas fa-trash"></i></a>
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
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jenis">Pilih Izin</label>
                        <select name="jenis" class="form-control" required>
                            <option disabled selected>-- Pilih Izin --</option>
                            @foreach($jenis as $jns)
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