@extends('layouts.template')
@section('content')
<title>Data Admin | Kasir</title>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Data</h6>
    </div>
    <div class="card-body">
        @if( Session::get('masuk') !="")
        <div class='alert alert-success'>
            <center><b>{{Session::get('masuk')}}</b></center>
        </div>
        @endif
        <form action="{{url('/error-map/store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" class="form-control" value="{{Auth::user()->karyawan->nama}}" readonly required>
            </div>
            <div class="form-group">
                <label for="work_map_id">Map</label>
                <select name="work_map_id" class="form-control" required>
                    <option value="" disabled selected>Pilih Map</option>
                    @foreach($workmap as $m)
                    <option value="{{$m->id}}">{{$m->map->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="date">Tanggal</label>
                <input type="date" name="date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="image">Gambar</label>
                <input type="file" name="image" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="comments">Komentar</label>
                <textarea name="comments" id="comments" class="form-control" cols="20" rows="5"></textarea>
            </div>
            <input type="submit" value="Masukan Data Error" class="btn btn-primary">
        </form>
    </div>
</div>


@endsection