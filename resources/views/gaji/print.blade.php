@extends('components.doc', ['title' => request('divisi') != 'all' ? 'Laporan Gaji Karyawan Divisi '.request('divisi') : '' ])

@section('body')
<div class="content">
    <h4 style="text-transform: uppercase; text-align: center;">Laporan Gaji Karyawan {{ request('divisi') != 'all' ? 'Divisi '.request('divisi') : '' }}</h4>
    <div class="cuti" style="margin-top: 20px;">
        <table style="font-size: 12px; text-align: center;" border="1" cellspacing="0">
            <tr>
                <th width="20px">No.</th>
                <th width="100px">ID Karyawan</th>
                <th width="200px">Nama Karyawan</th>
                <th width="150px">Divisi</th>
                <th width="140px">No Hp</th>
                <th width="150px">Gaji</th>
            </tr>

            @foreach($gaji as $gj)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $gj->karyawan->id_karyawan }}</td>
                <td>{{ $gj->karyawan->nama }}</td>
                <td style="text-align: center;">{{ $gj->karyawan->divisi ?? '-' }}</td>
                <td>{{ $gj->karyawan->nohp }}</td>
                <td>@currency($gj->gaji->gaji)</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@stop