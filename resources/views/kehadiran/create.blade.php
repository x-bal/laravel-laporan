@extends('layouts.template')
@section('content')
<title>Data Admin | Kasir</title>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Kehadiran</h6>
                </div>
                <div class="card-body">
                    @if( Session::get('masuk') !="")
                    <div class='alert alert-success'>
                        <center><b>{{Session::get('masuk')}}</b></center>
                    </div>
                    @endif

                    <form action="{{ route('kehadiran.store') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Lakukan Absensi ?')">Absensi</button>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#izinSet">Izin Setengah Hari</button>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#izin">Izin</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<div id="izin" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Izin atau Cuti</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('kehadiran.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="jenis">Pilih Izin</label>
                        <select name="jenis" class="form-control" required>
                            <option disabled selected>-- Pilih Izin --</option>
                            @foreach($jenis as $jns)
                            <option value="{{ $jns->id }}">{{ $jns->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="dari">Dari</label>
                        <input type="date" name="dari" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="sampai">Sampai</label>
                        <input type="date" name="sampai" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" rows="3" class="form-control"></textarea>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Ajukan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="izinSet" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Izin Setengah Hari</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('kehadiran.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="jenis" value="2">

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" rows="3" class="form-control"></textarea>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Ajukan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection