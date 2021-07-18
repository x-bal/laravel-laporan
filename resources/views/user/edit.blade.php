@extends('layouts.template')
@section('content')
<title>Data User | Kasir</title>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Data</h6>
    </div>
    <div class="card-body">
        <form action="{{url('/user/update')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Nama Admin</label>
                <input type="hidden" name="id" value="{{$user->id}}">
                <input type="text" name="nama" class="form-control" value="{{$user->karyawan->nama}}">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="email" class="form-control" value="{{$user->email}}">
            </div>
            <div class="form-group">
                <label for="">Jenis Kelamin</label>
                <select name="jk" id="jk" class="form-control">
                    @if($user->karyawan->jk == 'P')
                    <option value="P" selected>Perempuan</option>
                    <option value="L">Laki - laki</option>
                    @else
                    <option value="P">Perempuan</option>
                    <option value="L" selected>Laki - laki</option>
                    @endif
                </select>
            </div>
            @error('email')
            <strong style="color:red">{{ $message }}</strong>
            @enderror
            <input type="submit" value="Update" class="btn btn-warning">
        </form>
    </div>
</div>


@endsection