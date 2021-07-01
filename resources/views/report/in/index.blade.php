@extends('layouts.template')
@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark">Masukan Tanggal</h6>
    </div>
    <div class="card-body">
        <form action="{{url('report/in/store')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Tanggal Map Masuk</label>
                        <input type="date" name="req1" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Hingga Tanggal</label>
                        <input type="date" name="req2" class="form-control" required>
                    </div>
                </div>
            </div>
            <center><input type="submit" class="btn btn-success"></center>
      </form>
<br>
    </div>
</div>
<div class="card shadow mb-4">
<div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-dark">Laporan Map Masuk</h6>
</div>
<div class="card-body">
  <div class="table-responsive">
     @if ($hitung == 0)
        
    @else
    
    <form action="{{url('report/in/export')}}" method="POST">
    @csrf
        <input type="hidden" name="req1" value="{{$req1}}">
        <input type="hidden" name="req2" value="{{$req2}}">
       <input type="submit" class="btn btn-warning" value="EXPORT EXCEL">
       
       </form>
    @endif
       <br>
    @include('report.in.table', $in)
  </div>
</div>

  
@endsection