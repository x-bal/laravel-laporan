@extends('layouts.template')
@section('content')
<title>Data User | Kasir</title>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Update Data</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('karyawan.update', $user->id) }}" method="post">
            @method('PATCH')
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ $user->karyawan->nama }}">

                        @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="id_karyawan">ID Karyawan</label>
                        <input type="text" name="id_karyawan" class="form-control" value="{{ $user->karyawan->id_karyawan }}">

                        @error('id_karyawan')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" value="{{ $user->email }}">

                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <select name="jk" id="jk" class="form-control">
                            <option {{ $user->karyawan->jk == 'Perempuan' ? 'selected' : '' }} value="Perempuan">Perempuan</option>
                            <option {{ $user->karyawan->jk == 'Laki-Laki' ? 'selected' : '' }} value="Laki-Laki">Laki - laki</option>
                        </select>

                        @error('jk')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nohp">No Hp</label>
                        <input type="number" name="nohp" class="form-control" value="{{ $user->karyawan->nohp }}">

                        @error('nohp')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="divisi">Divisi</label>
                        <select name="divisi" id="divisi" class="form-control">
                            <option disabled selected>-- Pilih Divisi --</option>
                            <option {{ $user->karyawan->divisi == 'Mapping' ? 'selected' : '' }} value="Mapping">Mapping</option>
                            <option {{ $user->karyawan->divisi == 'Property Marketing' ? 'selected' : '' }} value="Property Marketing">Property Marketing</option>
                        </select>

                        @error('divisi')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="pendidikan">Pendidikan Terakhir</label>
                        <input type="text" name="pendidikan" class="form-control" value="{{ $user->karyawan->pendidikan }}">

                        @error('pendidikan')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="5" class="form-control">{{ $user->karyawan->alamat }}</textarea>

                        @error('alamat')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>


@endsection