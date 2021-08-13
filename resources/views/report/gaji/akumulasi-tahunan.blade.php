@extends('components.doc', ['title' => 'Laporan Akumulasi Tahun ' . $tahun])

@section('body')
<div class="content">
    <h4 style="text-transform: uppercase; text-align: center;">TOTAL PENGELUARAN BIAYA KARYAWAN PADA TAHUN {{ $tahun }}</h4>
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
                <td>@currency($akm->gaji->gaji *12)</td>
                <td>@currency($bpjs->nominal *12)</td>
            </tr>
            @php
            $totalGaji += $akm->gaji->gaji;
            $bpjsKaryawan += $bpjs->nominal * 12
            @endphp
            @endforeach
        </table>
        <table style="font-size: 14px; margin-top: 20px; margin-bottom: 20px;" cellspacing="0">
            <tr>
                <th width="100mm" style="text-align: left;"><b>TOTAL GAJI</b></th>
                <th width="150mm"> : </th>
                <th width="300mm"></th>
                <th width="150mm"></th>
                <th width="150mm">@currency($totalGaji * 12 - $bpjsKaryawan) </th>
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

        <table style="font-size: 14px; margin-top:20px; margin-bottom: 20px;" cellspacing="0">
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
                <th width="150mm">@currency(($bpjs->nominal * 12) * $totalKaryawan)</th>
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
            <th width="150mm">@currency( ($totalGaji * 12 - $bpjsKaryawan) + $totalPend + ($bpjs->nominal * 12 * $totalKaryawan) - $totalPeng)</th>
        </tr>
    </table>
</div>

<div class="footer" style="text-align: end; margin-top: 50px;">
    <div>
        <table width="100%">
            <tr>
                <td align="left" width="50%"><strong>BENDAHARA</strong></td>
                <td align="end" width="50%"><strong style="margin-right: 30px;">DIREKTUR</strong></td>
            </tr>
            <tr>
                <td><br><br><br></td>
                <td><br><br><br></td>
            </tr>
            <tr>
                <td align="left">Iin Ardalina</td>
                <td align="end">Azhar Arif, RF S. AB</td>
            </tr>
        </table>
    </div>
</div>
@stop