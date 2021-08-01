@extends('layouts.template')
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Work Map</h6>
    </div>
    <div class="card-body">
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
        @if($workMap == '')
        <h5>Belum ada pekerjaan ...</h5>
        <a href="#" class="stretched-link" data-toggle="modal" data-target="#tambah">Buat laman kerja</a>
        @else
        <div class="card w-50 mx-auto">
            <div class="card-body">
                <form action="{{url('work-map/update')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$workMap->id}}">
                    <table class="text-dark">
                        <tr>
                            <td>Nama</td>
                            <td>: &nbsp;</td>
                            <td>{{Auth::user()->karyawan->nama}}</td>
                        </tr>
                        <tr>
                            <td>Nama Map</td>
                            <td>:</td>
                            <td>{{$workMap->map->name}}</td>
                        </tr>
                        <tr>
                            <td>Total map</td>
                            <td>:</td>
                            <td>{{$workMap->total_map}}</td>
                        </tr>
                        <tr>
                            <td>Total Key</td>
                            <td>:</td>
                            <td>{{$workMap->total_key}}</td>
                        </tr>
                        <tr>
                            <td>Start on</td>
                            <td>:</td>
                            <td>{{$workMap->start_on}}</td>
                        </tr>
                        <tr>
                            <td>Progress</td>
                            <td>:</td>
                            <td>
                                <input type="number" name="progress" id="progress" value="{{$workMap->progress}}" class="form-control" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Finish On</td>
                            <td>:</td>
                            <td><input type="date" name="finish_on" id="finish_on" onchange="finish();" class="form-control"></td>
                        </tr>
                    </table>
                    <div class="mt-2 text-left">
                        <button class="btn btn-primary btn-sm" type="submit">Update</button>
                </form>
                <form action="{{url('work-map/finish')}}" class="d-inline" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$workMap->id}}">
                    <input type="hidden" name="finish_on" id="finish_on2">
                    <button class="btn btn-success btn-sm" type="submit">Selesai</button>
                </form>
            </div>
        </div>
    </div>
    @endif
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
                <form action="{{url('/work-map/store')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="hidden" name="id" class="form-control" value="{{Auth::user()->id}}" required>
                        <input type="text" name="name" class="form-control" readonly value="{{Auth::user()->karyawan->nama}}" required>
                    </div>
                    <div class="form-group">
                        <label for="map">Map</label>
                        <select name="map_id" class="form-control" id="map_id" required>
                            <option value="" disabled selected>Pilih Map</option>
                            @foreach ($map as $m)
                            <option value="{{$m->id}}">{{$m->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date_adopted">Priority</label>
                        <input type="text" name="priority" id="priority" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="total_map">Total Map</label>
                        <input type="number" name="total_map" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="total_key">Total Key</label>
                        <input type="number" name="total_key" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="start_on">Start On</label>
                        <input type="date" name="start_on" class="form-control" required>
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

@push('scripts')
<script type="text/javascript">
    $('#map_id').change(function() {
        var mapID = $(this).val();
        if (mapID) {
            $.ajax({
                type: "GET",
                url: "{{url('ambil_priority')}}?map_id=" + mapID,
                success: function(res) {
                    if (res) {
                        $("#priority").empty();
                        $.each(res, function(key, value) {
                            $("#priority").val(value);
                        });

                    } else {
                        $("#priority").empty();
                    }
                }
            });
        } else {
            $("#priority").empty();

        }
    });


    function finish() {
        var a = $("#finish_on").val();
        $("#finish_on2").val(a);
    }
</script>
@endpush