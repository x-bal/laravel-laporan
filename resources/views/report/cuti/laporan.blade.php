@extends('components.doc', ['title' => 'Laporan Cuti Tahun ' . request('tahun')])

@section('body')
<div class="content">
    <h4 style="text-transform: uppercase; text-align: center;">laporan cuti tahun {{ request('tahun') }}</h4>
    <div class="cuti" style="margin-top: 50px;">
        <table style="font-size: 14px; text-align: center;" border="1" cellspacing="0" width="100%">
            <tr>
                <th width="50mm">No.</th>
                <th width="150mm">ID Karyawan</th>
                <th width="250mm">Nama Karyawan</th>
                <th width="100mm">Jabatan</th>
                <th width="100mm">JK</th>
                <th width="100mm">Dari</th>
                <th width="100mm">Sampai</th>
                <th width="200mm">Keterangan</th>
            </tr>
            @foreach($cuti as $ct)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $ct->user->karyawan->id_karyawan }}</td>
                <td>{{ $ct->user->karyawan->nama }}</td>
                <td>{{ $ct->user->level == 'U' ? 'Karyawan' : '' }} {{ $ct->user->level == 'A' ? 'Admin' : '' }} {{ $ct->user->level == 'B' ? 'Bendahara' : '' }}</td>
                <td>{{ $ct->user->karyawan->jk }}</td>
                <td>{{ \Carbon\Carbon::parse($ct->dari)->format('d/m/Y') }} </td>
                <td>{{ \Carbon\Carbon::parse($ct->sampai)->format('d/m/Y') }} </td>
                <td>{{ $ct->keterangan}}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@stop