@extends('layouts.template')
@section('content')
<title>Data User | Kasir</title>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Error</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if( Session::get('masuk') !="")
            <div class='alert alert-success'><center><b>{{Session::get('masuk')}}</b></center></div>        
            @endif
            @if( Session::get('update') !="")
            <div class='alert alert-success'><center><b>{{Session::get('update')}}</b></center></div>        
            @endif
            @error('email')
                <strong style="color:red">{{ $message }}</strong>
            @enderror
            <table id="dataTable" class="table table-bordered" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Map</th>
                        <th>Tanggal</th>
                        <th>Gambar</th>
                        <th>Komentar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($error as $i => $u)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$u->workMap->user->name}}</td>
                        <td>{{$u->workMap->map->name}}</td>
                        <td>{{$u->date}}</td>
                        <td><a href="{{asset('image/'.$u->image)}}" target="_blank">Lihat Gambar</a></td>
                        <td>{{$u->comments}}</td>
                        <td>
                            <a href="{{url('/error-map/edit/'.$u->id)}}" class="btn btn-primary btn-sm ml-2">Edit</a>
                            <a href="{{url('/error-map/delete/'.$u->id)}}" class="btn btn-danger btn-sm ml-2" onclick="return confirm('Apakah Anda Yakin ?')">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection