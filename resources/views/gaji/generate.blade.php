@extends('components.doc', ['title' => auth()->user()->level != 'U' ? 'Laporan Slip Gaji - '.$user->karyawan->nama : auth()->user()->karyawan->nama ])

@section('body')
<div class="content" style="margin-top: 20px;">
    <table>
        <tr>
            <td width="150mm">Hal</td>
            <td width="350mm"> : </td>
            <td><b>SLIP GAJI</b></td>
        </tr>
        <tr>
            <td>Gaji Bulan Tanggal</td>
            <td> : </td>
            <td>{{ \Carbon\Carbon::parse(request('tanggal'))->format('d F Y') }}</td>
        </tr>
        <tr>
            <td style="margin-left: 20px;">ID Karyawan</td>
            <td> : </td>
            <td>
                @if(auth()->user()->level == 'U')
                {{ auth()->user()->karyawan->id_karyawan }}
                @else
                {{ $user->karyawan->id_karyawan }}
                @endif
            </td>
        </tr>
        <tr>
            <td>Nama Karyawan</td>
            <td> : </td>
            <td>
                @if(auth()->user()->level == 'U')
                {{ auth()->user()->karyawan->nama }}
                @else
                {{ $user->karyawan->nama }}
                @endif
            </td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td> : </td>
            <td>
                @if(auth()->user()->level == 'U')
                {{ auth()->user()->level == 'U' ? 'Karyawan' : 'Admin' }}
                @else
                {{ $user->level == 'U' ? 'Karyawan' : 'Admin' }}
                @endif
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>


    @foreach($pendapatan as $pnd)
    @if(auth()->user()->level == 'U')
    @php
    $totalPend += $pnd->jenis->nominal;
    $gaji = auth()->user()->gaji->gaji;
    @endphp
    @else
    @php
    $totalPend += $pnd->jenis->nominal;
    $gaji = $user->gaji->gaji;
    @endphp
    @endif
    @endforeach

    @foreach($lembur as $lem)
    @if(auth()->user()->level == 'U')
    @php
    $totalLem += $lem->jenis->nominal;
    @endphp
    @else
    @php
    $totalLem += $lem->jenis->nominal;
    @endphp
    @endif
    @endforeach
    <p style="margin-top: 30px;"><u><b>PENDAPATAN</b> </u></p>
    <table>
        <tr>
            <td width="150mm">Gaji Pokok</td>
            <td width="350mm"> : </td>
            <td>@currency($gaji)</td>
        </tr>
        <tr>
            <td>Lembur</td>
            <td> : </td>
            <td>@currency($totalLem)</td>
        </tr>
        <tr>
            <td>Total Pendapatan</td>
            <td> : </td>
            <td>@currency($gaji + $totalPend)</td>
        </tr>
    </table>

    @foreach($pengurangan as $pnr)

    @php
    $totalPeng += $pnr->jenis->nominal
    @endphp
    @endforeach
    <p style="margin-top: 30px;"><u><b>PENGURANGAN</b></u></p>
    <table>
        <tr>
            <td width="150mm">Ijin/Sakit</td>
            <td width="350mm"> : </td>
            <td>@currency($totalPeng) </td>
        </tr>
        <tr>
            <td>BPJS</td>
            <td> : </td>
            <td>@currency($bpjs->nominal)</td>
        </tr>
        <tr>
            <td>Total Pengurangan</td>
            <td> : </td>
            @php
            $totpeng = $totalPeng + $bpjs->nominal
            @endphp
            <td>@currency($totalPeng)</td>
        </tr>
    </table>

    <p style="margin-top: 30px;"><u><b>TOTAL DITERIMA KARYAWAN</b></u></p>
    <table>
        <tr>
            <td width="150mm">Total diterima</td>
            <td width="350mm"> : </td>
            @php
            $totpeng = $totalPeng + $bpjs->nominal
            @endphp
            <td>@currency(($gaji + $totalPend) - ($totalPeng + $bpjs->nominal))</td>
        </tr>
    </table>

    <div class="footer" style="display: flex; margin-top: 250px; text-align: center;">
        <div class="penerima" style="margin-right: auto;">
            <b>PENERIMA</b><br><br><br><br>
            <b>
                @if(auth()->user()->level == 'U')
                {{ auth()->user()->karyawan->nama }}
                @else
                {{ $user->karyawan->nama }}
                @endif
            </b>
        </div>
        <div class="bendahara">
            <b style="margin-right:5px">BENDAHARA</b><br><br><br><br>
            <b>Iin Ardalina</b>
        </div>
    </div>
</div>
@stop