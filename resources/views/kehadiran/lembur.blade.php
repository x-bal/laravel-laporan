@extends('layouts.template')
@section('content')
<title>Data Admin | Kasir</title>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Lembur</h6>
                </div>
                <div class="card-body">
                    @if( Session::get('masuk') !="")
                    <div class='alert alert-success'>
                        <center><b>{{Session::get('masuk')}}</b></center>
                    </div>
                    @endif

                    <form action="{{ route('kehadiran.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="jenis" value="5">
                        <div class="form-group">
                            <label for="dari">Dari</label>
                            <input type="time" name="dari" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="sampai">Sampai</label>
                            <input type="time" name="sampai" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" rows="3" class="form-control"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Ajukan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection