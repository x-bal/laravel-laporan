@extends('layouts.template')
@section('content')
<title>Data Admin | Kasir</title>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Map</h6>
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
            @if( Session::get('gagal') !="")
            <div class='alert alert-danger'>
                <center><b>{{Session::get('gagal')}}</b></center>
            </div>
            @endif
            <br>
            <button class="btn btn-success" data-toggle="modal" data-target="#tambah">Tambah Data</button>
            <br>
            <br>
            <table id="dataTable" class="table table-bordered" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Date Added</th>
                        <th>Date Adopted</th>
                        <th>Date Expired</th>
                        <th>Priority</th>
                        <th>ID Karyawan</th>
                        <th>Karyawan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($map as $i => $u)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$u->name}}</td>
                        <td>{{$u->status}}</td>
                        <td>{{date('Y-m-d',strtotime($u->created_at))}}</td>
                        <td>{{$u->date_adopted}}</td>
                        <td>{{$u->date_expired}}</td>
                        <td>{{$u->priority}}</td>
                        <td>{{$u->user->karyawan->id_karyawan ?? ''}}</td>
                        <td>{{$u->user->karyawan->nama ?? ''}}</td>
                        <td>
                            <a href="{{url('/map/edit/'.$u->id)}}" class="btn btn-primary btn-sm ml-2">Edit</a>
                            <a href="{{url('/map/delete/'.$u->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin ?')">Delete</a>
                        </td>
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
                <form action="{{url('/map/store')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="" disabled selected>Pilih Status</option>
                            <option value="adopted">Adopted</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date_adopted">Date Adopted</label>
                        <input type="date" name="date_adopted" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="date_expired">Date Expired</label>
                        <input type="date" name="date_expired" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="priority">Priority</label>
                        <select name="priority" class="form-control" required>
                            <option value="" disabled selected>Pilih Priority</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
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