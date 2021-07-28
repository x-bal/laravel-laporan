<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if(auth()->user()->level == 'U')
    <title>Laporan Slip Gaji - {{ auth()->user()->karyawan->nama }}</title>
    @else
    <title>Laporan Slip Gaji - {{ $user->karyawan->nama }}</title>
    @endif
</head>

<body>

    <x-header></x-header>

    <div class="content" style="width: 90%; margin-left: 100px; margin-right: 100px; margin-top: 40px; ">
        <table>
            <tr>
                <td width="200px">Hal</td>
                <td> : </td>
                <td><b>SLIP GAJI</b></td>
            </tr>
            <tr>
                <td width="200px">Gaji Bulan Tanggal</td>
                <td> : </td>
                <td width="300px">{{ \Carbon\Carbon::parse(request('tanggal'))->format('d F Y') }}</td>
            </tr>
            <tr>
                <td style="margin-left: 20px;" width="100px">ID Karyawan</td>
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
                <td width="200px">Nama Karyawan</td>
                <td> : </td>
                <td width="300px">
                    @if(auth()->user()->level == 'U')
                    {{ auth()->user()->karyawan->nama }}
                    @else
                    {{ $user->karyawan->nama }}
                    @endif
                </td>
            </tr>
            <tr>
                <td width="200px">Jabatan</td>
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
                <td width="200px">Gaji Pokok</td>
                <td> : </td>
                <td>@currency($gaji)</td>
            </tr>
            <tr>
                <td width="200px">Lembur</td>
                <td> : </td>
                <td>@currency($totalLem)</td>
            </tr>
            <tr>
                <td width="200px">Total Pendapatan</td>
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
                <td width="200px">Ijin/Sakit</td>
                <td> : </td>
                <td>@currency($totalPeng) </td>
            </tr>
            <tr>
                <td width="200px">BPJS</td>
                <td> : </td>
                <td>@currency($bpjs->nominal)</td>
            </tr>
            <tr>
                <td width="200px">Total Pengurangan</td>
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
                <td width="200px">Total diterima</td>
                <td> : </td>
                @php
                $totpeng = $totalPeng + $bpjs->nominal
                @endphp
                <td>@currency(($gaji + $totalPend) - ($totalPeng + $bpjs->nominal))</td>
            </tr>
        </table>

        <div class="footer" style="margin-top: 150px; position: absolute; display: inline;">
            <table>
                <tr style="text-align: center;">
                    <td><b>PENERIMA</b><br><br><br><br></td>
                    <td width="300px"></td>
                    <td><b>BENDAHARA</b><br><br><br><br></td>
                </tr>
                <tr style="text-align: center;">
                    <td>
                        <b>
                            @if(auth()->user()->level == 'U')
                            {{ auth()->user()->karyawan->nama }}
                            @else
                            {{ $user->karyawan->nama }}
                            @endif
                        </b>
                    </td>
                    <td width="300px"></td>
                    <td>
                        <b>Iin Ardalina</b>
                    </td>
                </tr>
            </table>
        </div>
    </div>


    <script>
        window.load(print())
    </script>
</body>

</html>