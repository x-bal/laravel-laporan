@extends('components.doc', ['title' => 'Laporan Akumulasi Bulan ' . $mulai . ' - ' . $sampai ])

@section('body')
<div class="content">
    <h4 style="text-transform: uppercase; text-align: center;">TOTAL PENGELUARAN BIAYA KARYAWAN PADA BULAN {{ $mulai }} - {{ $sampai }}</h4>
    <div class=" gaji" style="margin-top: 50px;">
        <p>
            <b>GAJI KARYAWAN</b>
        </p>
        <table style="font-size: 14px; text-align: center;" border="1" cellspacing="0">
            <tr>
                <th width="50mm">No.</th>
                <th width="150mm">ID Karyawan</th>
                <th width="300mm">Nama Karyawan</th>
                <th width="150mm">Jabatan</th>
                <th width="150mm">Gaji</th>
                <th width="150mm">BPJS</th>
            </tr>
            @php
            $bpjsKaryawan = 0;
            @endphp
            @foreach($akumulasi as $akm)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $akm->karyawan->id_karyawan }}</td>
                <td>{{ $akm->karyawan->nama }}</td>
                <td>{{ $akm->level == 'U' ? 'Karyawan' : '' }} {{ $akm->level == 'A' ? 'Admin' : '' }} {{ $akm->level == 'B' ? 'Bendahara' : '' }}</td>
                <td>@currency($akm->gaji->gaji)</td>
                <td>@currency($bpjs->nominal)</td>
            </tr>
            @php
            $totalGaji += $akm->gaji->gaji;
            $bpjsKaryawan += $bpjs->nominal;
            @endphp
            @endforeach
        </table>
        <table style="font-size: 14px; margin-top: 20px; margin-bottom: 20px;" cellspacing="0">
            <tr>
                <th width="150mm" style="text-align: left;"><b>TOTAL GAJI</b></th>
                <th width="150mm"> : </th>
                <th width="300mm"></th>
                <th width="150mm"></th>
                <th width="100mm"></th>
                <th width="150mm">@currency($totalGaji - $bpjsKaryawan)</th>
            </tr>
        </table>
    </div>

    <div class="tambahan" style="margin-top: 50px;">
        <p>
            <b>PENDAPATAN KARYAWAN</b>
        </p>
        <table style="font-size: 14px; text-align: center;" border="1" cellspacing="0">
            <tr>
                <th width="50mm">No.</th>
                <th width="150">ID Karyawan</th>
                <th width="300">Nama Karyawan</th>
                <th width="150">Jabatan</th>
                <th width="150">Bonus</th>
                <th width="150">Rp. </th>
            </tr>
            @foreach($pendapatan as $pnd)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pnd->user->karyawan->id_karyawan }}</td>
                <td>{{ $pnd->user->karyawan->nama }}</td>
                <td>{{ $pnd->user->level == 'U' ? 'Karyawan' : '' }} {{ $pnd->user->level == 'A' ? 'Admin' : '' }} {{ $pnd->user->level == 'B' ? 'Bendahara' : '' }}</td>
                <td>{{ $pnd->jenis->name }}</td>
                <td>@currency($pnd->jenis->nominal)</td>
            </tr>
            @php
            $totalPend += $pnd->jenis->nominal

            @endphp
            @endforeach
        </table>
        <table style="font-size: 14px; margin-top: 20px; margin-bottom: 20px;" cellspacing="0">
            <tr>
                <th width="200mm" style="text-align: left;"><b>TOTAL PENDAPATAN</b></th>
                <th width="150mm"> : </th>
                <th width="300mm"></th>
                <th width="150mm"></th>
                <th width="150mm">@currency($totalPend)</th>
            </tr>
        </table>
    </div>

    <div class="pengurangan" style="margin-top: 50px; margin-bottom: 10px;">
        <p>
            <b>PENGURANGAN KARYAWAN</b>
        </p>
        <table style="font-size: 14px; text-align: center;" border="1" cellspacing="0">
            <tr>
                <th width="50mm">No.</th>
                <th width="150mm">ID Karyawan</th>
                <th width="300mm">Nama Karyawan</th>
                <th width="150mm">Jabatan</th>
                <th width="200mm">Alasan</th>
                <th width="150mm">Rp. </th>
            </tr>
            @foreach($pengurangan as $peng)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $peng->user->karyawan->id_karyawan }}</td>
                <td>{{ $peng->user->karyawan->nama }}</td>
                <td>{{ $peng->user->level == 'U' ? 'Karyawan' : '' }} {{ $peng->user->level == 'A' ? 'Admin' : '' }} {{ $peng->user->level == 'B' ? 'Bendahara' : '' }}</td>
                <td>{{ $peng->jenis->name }}</td>
                <td>@currency($peng->jenis->nominal)</td>
            </tr>
            @php
            $totalPeng += $peng->jenis->nominal

            @endphp
            @endforeach
        </table>
        <table style="font-size: 14px; margin-top: 50px; margin-bottom: 20px;" cellspacing="0">
            <tr>
                <th width="200mm" style="text-align: left;"><b>TOTAL PENGURANGAN</b></th>
                <th width="150mm"> : </th>
                <th width="300mm"></th>
                <th width="150mm"></th>
                <th width="150mm">@currency($totalPeng)</th>
            </tr>
            @php
            $totalKaryawan = \App\User::with('karyawan')->where('level', '!=', 'A')->count();
            $totalBpjs = $bpjs->nominal * $totalKaryawan;
            @endphp
            <tr>
                <th width="200mm" style="text-align: left;"><b>TOTAL BPJS</b></th>
                <th width="150mm"> : </th>
                <th width="300mm"></th>
                <th width="150mm"></th>
                <th width="150mm">@currency($totalBpjs)</th>
            </tr>
        </table>
    </div>
</div>
<hr>
<div class="total">
    <table style="font-size: 14px; margin-top: 50px; margin-bottom: 20px;" cellspacing="0">
        <tr>
            <th width="200mm" style="text-align: left;"><b>TOTAL PENGELUARAN</b></th>
            <th width="150mm"> : </th>
            <th width="300mm"></th>
            <th width="150mm"></th>
            <th width="150mm">@currency($totalGaji - $bpjsKaryawan + $totalPend + $totalBpjs - $totalPeng)</th>
        </tr>
    </table>
</div>

<div class="footer" style="text-align: end; margin-top: 100px;">
    <table>
        <tr style="text-align: center;">
            <td width="550px"></td>
            <td><b>BENDAHARA</b><br><br><br><br></td>
        </tr>
        <tr style="text-align: center;">
            <td width="550px"></td>
            <td>
                <b>Iin Ardalina</b>
            </td>
        </tr>
    </table>
</div>
@stop