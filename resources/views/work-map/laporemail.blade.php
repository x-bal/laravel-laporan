@extends('layouts.template')
@section('content')
<title>Data User | Kasir</title>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Map Selesai</h6>
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
        </div>

        <form action="{{ route('sendemail') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="map">Map</label>
                    <select name="map" id="map" class="form-control">
                        <option disabled selected>-- Pilih Map --</option>
                        @foreach($mapFinish as $finish)
                        <option value="{{ $finish->id }}">{{ $finish->map->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="email">Email</label>
                    <select name="email" id="email" class="form-control">
                        <option disabled selected>-- Pilih Email --</option>
                        @foreach($emails as $email)
                        <option value="{{ $email->email }}">{{ $email->email }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection