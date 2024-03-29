@extends('layouts.template')
@section('content')
<title>Data Gaji Karyawan | Kasir</title>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Gaji Karyawan</h6>
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
            <form action="" method="get" class="mb-3">
                <div class="row">
                    <div class="col">
                        <select name="divisi" id="divisi" class="form-control">
                            <option disabled selected>-- Pilih Divisi --</option>
                            <option {{ request('divisi') == 'all' ? 'selected' : '' }} value="all">All</option>
                            <option {{ request('divisi') == 'Mapping' ? 'selected' : '' }} value="Mapping">Mapping</option>
                            <option {{ request('divisi') == 'Property Marketing' ? 'selected' : '' }} value="Property Marketing">Property Marketing</option>
                        </select>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-print"></i></button>
                    </div>
                </div>
            </form>
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambah">Tambah</button>

            <table id="dataTable" class="table table-bordered" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Karyawan</th>
                        <th>Nama</th>
                        <th>No Hp</th>
                        <th>Divisi</th>
                        <th>Tgl Masuk</th>
                        <th>Tgl Bayar</th>
                        <th>Nominal</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach($gaji as $gj)
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $gj->user->karyawan->id_karyawan }}</td>
                        <td>{{ $gj->user->karyawan->nama }}</td>
                        <td>{{ $gj->user->karyawan->nohp }}</td>
                        <td style="text-align: center;">{{ $gj->user->karyawan->divisi ?? '-' }}</td>
                        <td>{{ $gj->tgl_masuk }}</td>
                        <td>{{ $gj->tgl_bayar }}</td>
                        <td>@currency($gj->gaji)</td>
                        <td class="text-center">
                            <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit{{ $gj->id }}"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('gaji.destroy', $gj->id) }}" method="post" style="display: inline;" onclick="return confirm('Hapus data?')">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>

                    <div id="edit{{ $gj->id }}" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Update Data</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('gaji.update', $gj->id) }}" method="post">
                                        @method('PATCH')
                                        @csrf

                                        <div class="form-group">
                                            <label for="tgl_masuk">Tanggal Masuk</label>
                                            <input type="date" name="tgl_masuk" class="form-control" required value="{{ $gj->tgl_masuk }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="tgl_bayar">Tanggal Pembayaran</label>
                                            <input type="number" name="tgl_bayar" class="form-control" required value="{{ $gj->tgl_bayar }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="gaji">Nominal Gaji</label>
                                            <input type="number" name="gaji" class="form-control" required value="{{ $gj->gaji }}">
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
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
                <form action="{{ route('gaji.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <select name="user" id="user" class="form-control">
                            <option disabled selected>-- Pilih Karyawan --</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->karyawan->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tgl_masuk">Tanggal Masuk</label>
                        <input type="date" name="tgl_masuk" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="tgl_bayar">Tanggal Pembayaran</label>
                        <input type="number" name="tgl_bayar" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="gaji">Nominal Gaji</label>
                        <input type="number" name="gaji" class="form-control" required>
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