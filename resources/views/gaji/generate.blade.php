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
    <header style="border-bottom: 3px solid black; justify-content: center;">
        <div class="logo">
            <img src="https://i.postimg.cc/GpJD05R7/logo-pen.png" alt="" width="100px" style="margin-left: 50px;">
        </div>
        <p style="text-align: center; margin-top: -100px;">
            <b style="font-size: 14px;">CV. PENINSULA ABADI</b><br>
        </p>
        <p style="text-align: center; font-size: 11px;">
            Jl. H Anang Adenansi No 4 RT 01 RW 001, Kel. Teluk Dalam, Kec. Banjarmasin Tengah,<br> Kota Banjarmasin, Prov. Kalimantan Selatan. <br>
            Telp. (085) 696338649 Fax. (025) 1231212312 <br>
            Email : peninsula.abadi@gmail.com.
        </p>
    </header>

    <div class="content" style="width: 90%; margin-left: 100px; margin-right: 100px; margin-top: 40px; ">
        <table>
            <tr>
                <td>Hal</td>
                <td> : </td>
                <td>SLIP GAJI</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Gaji Bulan</td>
                <td> : </td>
                <td width="300px">{{ \Carbon\Carbon::parse(request('tanggal'))->format('M') }}</td>
                <td style="margin-left: 20px;">Tanggal</td>
                <td> : </td>
                <td>{{ \Carbon\Carbon::parse(request('tanggal'))->format('d') }}</td>
            </tr>
            <tr>
                <td>Nama Karyawan</td>
                <td> : </td>
                <td width="300px">
                    @if(auth()->user()->level == 'U')
                    {{ auth()->user()->karyawan->nama }}
                    @else
                    {{ $user->karyawan->nama }}
                    @endif
                </td>
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
        <p style="margin-top: 30px;"><u>PENDAPATAN</u></p>
        <table>
            <tr>
                <td>Gaji Pokok</td>
                <td> : </td>
                <td>Rp. {{ $gaji }}</td>
            </tr>
            <tr>
                <td>Lembur</td>
                <td> : </td>
                <td>Rp. {{ $totalLem }}</td>
            </tr>
            <tr>
                <td>Total Pendapatan</td>
                <td> : </td>
                <td>Rp. {{ $gaji + $totalPend }}</td>
            </tr>
        </table>

        @foreach($pengurangan as $pnr)

        @php
        $totalPeng += $pnr->jenis->nominal
        @endphp
        @endforeach
        <p style="margin-top: 30px;"><u>PENGURANGAN</u></p>
        <table>
            <tr>
                <td>Ijin/Sakit</td>
                <td> : </td>
                <td>Rp. {{ $totalPeng }} </td>
            </tr>
            <tr>
                <td>BPJS</td>
                <td> : </td>
                <td>Rp. {{ $bpjs->nominal }}</td>
            </tr>
            <tr>
                <td>Total Pengurangan</td>
                <td> : </td>
                @php
                $totpeng = $totalPeng + $bpjs->nominal
                @endphp
                <td>Rp. {{ $totalPeng }}</td>
            </tr>
        </table>

        <p style="margin-top: 30px;"><u>TOTAL DITERIMA KARYAWAN</u> Rp. {{ ($gaji + $totalPend) - ($totalPeng + $bpjs->nominal) }}</p>

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