@extends('components.doc', ['title' => 'Laporan Data Karyawan'])

@section('body')
<div class="content">
    <h4 style="text-transform: uppercase; text-align: center;">Laporan Data Karyawan {{ request('divisi') != 'all' ? 'Divisi '.request('divisi') : '' }}</h4>
    <div class="cuti" style="margin-top: 50px;">
        <table style="font-size: 14px; text-align: center;" border="1" cellspacing="0">
            <tr>
                <th width="20px">No.</th>
                <th width="100px">ID Karyawan</th>
                <th width="200px">Nama Karyawan</th>
                <th width="150px">Divisi</th>
                <th width="80px">JK</th>
                <th width="140px">No Hp</th>
            </tr>

            @foreach($karyawan as $kar)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $kar->id_karyawan }}</td>
                <td>{{ $kar->nama }}</td>
                <td>{{ $kar->divisi ?? '-'}}</td>
                <td>{{ $kar->jk }}</td>
                <td>{{ $kar->nohp }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@stop