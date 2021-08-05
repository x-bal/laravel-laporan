@extends('layouts.template')
@section('content')
<title>Data Admin | Kasir</title>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Data</h6>
    </div>
    <div class="card-body">
        <form action="{{url('/map/update')}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$map->id}}">
            <div class="form-group">
                <label for="id_map">ID Map</label>
                <input type="text" name="id_map" class="form-control" value="{{$map->id_map}}" required>

                @error('id_map')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="name" class="form-control" value="{{$map->name}}" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control" required>
                    @if($map->status == 'adopted')
                    <option value="adopted" selected>Adopted</option>
                    <option value="draft">Draft</option>
                    @else
                    <option value="adopted">Adopted</option>
                    <option value="draft" selected>Draft</option>
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label for="date_adopted">Date Adopted</label>
                <input type="date" name="date_adopted" class="form-control" value="{{$map->date_adopted}}" required>
            </div>
            <div class="form-group">
                <label for="date_expired">Date Expired</label>
                <input type="date" name="date_expired" class="form-control" value="{{$map->date_expired}}" required>
            </div>
            <div class="form-group">
                <label for="priority">Priority</label>
                <select name="priority" class="form-control" required>
                    @if($map->priority == 'yes')
                    <option value="yes" selected>YES</option>
                    <option value="no">NO</option>
                    @else
                    <option value="yes">YES</option>
                    <option value="no" selected>NO</option>
                    @endif
                </select>
            </div>
            <input type="submit" value="Update" class="btn btn-warning">
        </form>
    </div>
</div>


@endsection