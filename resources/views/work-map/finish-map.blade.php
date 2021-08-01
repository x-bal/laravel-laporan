@extends('layouts.template')
@section('content')
<title>Data User | Kasir</title>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Map Selesai</h6>
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
            <table id="dataTable" class="table table-bordered" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Map</th>
                        <th>Status</th>
                        <th>Date Adopted</th>
                        <th>Date Expired</th>
                        <th>Priority</th>
                        <th>ID Pengerja</th>
                        <th>Pengerja</th>
                        <th>Finish On</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mapFinish as $i => $u)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$u->map->name}}</td>
                        <td>{{$u->map->status}}</td>
                        <td>{{$u->map->date_adopted}}</td>
                        <td>{{$u->map->date_expired}}</td>
                        <td>{{$u->map->priority}}</td>
                        <td>{{$u->user->karyawan->id_karyawan}}</td>
                        <td>{{$u->user->karyawan->nama}}</td>
                        <td>{{$u->finish_on}}</td>
                    </tr>
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
                <form action="{{url('/user/store')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <select name="jk" class="form-control" id="jk">
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="L">Laki - laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection