@extends('layouts.template')
@section('content')
<title>Data Admin | Kasir</title>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Data</h6>
    </div>
    <div class="card-body">
        @if( Session::get('masuk') !="")
            <div class='alert alert-success'><center><b>{{Session::get('masuk')}}</b></center></div>        
        @endif
        <form action="{{url('/error-map/update')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="hidden" name="id" value="{{$error->id}}">
                <input type="text" name="name" class="form-control" readonly value="{{$error->workMap->user->name}}" readonly required>
            </div>
            <div class="form-group">
                <label for="work_map_id">Map</label>
                <input type="text" name="map" class="form-control" readonly value="{{$error->workMap->map->name}}" required>
            </div>
            <div class="form-group">
                <label for="date">Tanggal</label>
                <input type="date" name="date" class="form-control" readonly required>
            </div>
            <div class="form-group">
                <label for="image">Gambar</label>
                <br>
                <img src="{{url('image/'.$error->image)}}" alt="" class="w-50">
            </div>
            <div class="form-group">
                <label for="comments">Komentar</label>
                <textarea name="comments" id="comments" class="form-control" cols="20" rows="5">{{$error->comments}}</textarea>
            </div>
            <input type="submit" value="Update" class="btn btn-success">
        </form>
    </div>
</div>


@endsection