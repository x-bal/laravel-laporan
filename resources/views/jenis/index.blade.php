@extends('layouts.template')
@section('content')
<title>Data Jenis | Kasir</title>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Jenis</h6>
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

            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambah">Tambah</button>

            <table id="dataTable" class="table table-bordered" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis</th>
                        <th>Nominal</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach($jenis as $jns)
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $jns->name }}</td>
                        <td>@currency($jns->nominal)</td>
                        <td class="text-center">
                            <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit{{ $jns->id }}"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>

                    <div id="edit{{ $jns->id }}" class="modal fade" tabindex="-1" role="dialog">
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
                                    <form action="{{ route('setting.update', $jns->id) }}" method="post">
                                        @method('PATCH')
                                        @csrf
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" name="nama" class="form-control" required value="{{ $jns->name }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="nominal">Nominal</label>
                                            <input type="number" name="nominal" class="form-control" required value="{{ $jns->nominal }}">
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
                <form action="{{ route('setting.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="nominal">Nominal</label>
                        <input type="number" name="nominal" class="form-control" required>
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