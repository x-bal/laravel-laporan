<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akumulasi Gaji Tahunan</title>
</head>

<body>
    <x-header></x-header>

    <div class="content" style="margin: auto; width: 70%; display: block; justify-content: center; border-bottom: 1px solid black;">
        <h4 style="text-transform: uppercase; text-align: center;">TOTAL PENGELUARAN BIAYA KARYAWAN PADA TAHUN {{ $tahun }}</h4>
        <div class=" gaji" style="margin-top: 20px;">
            <p>
                <b>GAJI KARYAWAN</b>
            </p>
            <table style="font-size: 12px;" border="1" cellspacing="0">
                <tr>
                    <td width="20px" style="text-align: center;">No.</td>
                    <td width="100px">ID Karyawan</td>
                    <td width="380px">Nama Karyawan</td>
                    <td width="100px">Jabatan</td>
                    <td width="150px" style="text-align: center;">Gaji</td>
                </tr>
                @foreach($akumulasi as $akm)
                <tr>
                    <td width="20px" style="text-align: center;">{{ $loop->iteration }}</td>
                    <td width="200px">{{ $akm->karyawan->id_karyawan }}</td>
                    <td width="200px">{{ $akm->karyawan->nama }}</td>
                    <td>{{ $akm->level == 'U' ? 'Karyawan' : '' }} {{ $akm->level == 'A' ? 'Admin' : '' }} {{ $akm->level == 'B' ? 'Bendahara' : '' }}</td>
                    <td width="180px" style="text-align: center;">@currency($akm->gaji->gaji)</td>
                </tr>
                @php
                $gaji = 0;
                $gaji += $akm->gaji->gaji
                @endphp
                @endforeach
            </table>
            <table style="font-size: 12px; margin-top: 20px; margin-bottom: 20px;" cellspacing="0">
                <tr>
                    <td width="200px">
                        <b>TOTAL GAJI</b>
                    </td>
                    <td width="350px"> : </td>
                    <td width="200px" style="text-align: center;">@currency($gaji * 12)</td>
                </tr>
            </table>
        </div>

        <div class="tambahan" style="margin-top: 20px;">
            <p>
                <b>PENDAPATAN KARYAWAN</b>
            </p>
            <table style="font-size: 12px;" border="1" cellspacing="0">
                <tr>
                    <td width="20px" style="text-align: center;">No.</td>
                    <td width="300px">ID Karyawan</td>
                    <td width="300px">Nama Karyawan</td>
                    <td width="100px">Jabatan</td>
                    <td width="100px" style="text-align: center;">Bonus</td>
                    <td width="150px" style="text-align: center;">Rp. </td>
                </tr>
                @foreach($pendapatan as $pnd)
                <tr>
                    <td width="20px" style="text-align: center;">{{ $loop->iteration }}</td>
                    <td width="200px">{{ $pnd->user->karyawan->id_karyawan }}</td>
                    <td width="200px">{{ $pnd->user->karyawan->nama }}</td>
                    <td>{{ $pnd->user->level == 'U' ? 'Karyawan' : '' }} {{ $pnd->user->level == 'A' ? 'Admin' : '' }} {{ $pnd->user->level == 'B' ? 'Bendahara' : '' }}</td>
                    <td style="text-align: center;">{{ $pnd->jenis->name }}</td>
                    <td width="100px" style="text-align: center;">@currency($pnd->jenis->nominal)</td>
                </tr>
                @php
                $totalPend += $pnd->jenis->nominal

                @endphp
                @endforeach
            </table>
            <table style="font-size: 12px; margin-top: 20px; margin-bottom: 20px;" cellspacing="0">
                <tr>
                    <td width="200px">
                        <b>TOTAL PENDAPATAN</b>
                    </td>
                    <td width="250px"> : </td>
                    <td width="150px" style="text-align: center;">@currency($totalPend * 12)</td>
                </tr>
            </table>
        </div>

        <div class="pengurangan" style="margin-top: 20px; margin-bottom: 10px;">
            <p>
                <b>PENGURANGAN KARYAWAN</b>
            </p>
            <table style="font-size: 12px;" border="1" cellspacing="0">
                <tr>
                    <td width="20px" style="text-align: center;">No.</td>
                    <td width="100px">ID Karyawan</td>
                    <td width="270px">Nama Karyawan</td>
                    <td width="100px">Jabatan</td>
                    <td width="150px" style="text-align: center;">Alasan</td>
                    <td width="150px" style="text-align: center;">Rp. </td>
                </tr>
                @foreach($pengurangan as $peng)
                <tr>
                    <td width="20px" style="text-align: center;">{{ $loop->iteration }}</td>
                    <td width="200px">{{ $peng->user->karyawan->id_karyawan }}</td>
                    <td width="200px">{{ $peng->user->karyawan->nama }}</td>
                    <td>{{ $peng->user->level == 'U' ? 'Karyawan' : '' }} {{ $peng->user->level == 'A' ? 'Admin' : '' }} {{ $peng->user->level == 'B' ? 'Bendahara' : '' }}</td>
                    <td style="text-align: center;">{{ $peng->jenis->name }}</td>
                    <td width="100px" style="text-align: center;">Rp. {{ $peng->jenis->nominal }}</td>
                </tr>
                @php
                $totalPeng += $peng->jenis->nominal

                @endphp
                @endforeach
            </table>
            <table style="font-size: 12px; margin-top: 20px; margin-bottom: 20px;" cellspacing="0">
                <tr>
                    <td width="200px">
                        <b>TOTAL PENGURANGAN</b>
                    </td>
                    <td width="280px"> : </td>
                    <td width="150px" style="text-align: center;">@currency($totalPeng * 12)</td>
                </tr>
            </table>
            <table style="font-size: 12px; margin-top: 20px; margin-bottom: 20px;" cellspacing="0">
                @php
                $totalKaryawan = \App\User::with('karyawan')->where('level', '!=', 'A')->count()
                @endphp
                <tr>
                    <td width="200px">
                        <b>BPJS</b>
                    </td>
                    <td width="360px"> : </td>
                    <td width="150px" style="text-align: center;">@currency(($bpjs->nominal * 12) * $totalKaryawan)</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="total" style="margin: auto; width: 70%; display: block; justify-content: center; border-bottom: 1px solid black;">
        <table style="font-size: 12px; margin-top: 20px; margin-bottom: 20px;" cellspacing="0">
            <tr>
                <td width="200px">
                    <b>TOTAL PENGELUARAN</b>
                </td>
                <td width="300px"> : </td>
                <td width="150px" style="text-align: center;">@currency( ($gaji * 12) + ($totalPend * 12) -($bpjs->nominal * 12) - ($totalPeng * 12))</td>
            </tr>
        </table>
    </div>

    <div class="footer" style="text-align: end; margin-top: 50px;">
        <table style="margin-left: 120px;">
            <tr style="text-align: center;">
                <td><b>BENDAHARA</b><br><br><br><br></td>
                <td width="300px"></td>
                <td><b>DIREKTUR</b><br><br><br><br></td>
            </tr>
            <tr style="text-align: center;">
                <td>
                    <b>Iin Ardalina</b>
                </td>
                <td width="300px"></td>
                <td>
                    <b>Azhar Arif, RF S. AB</b>
                </td>
            </tr>
        </table>
    </div>


    <script>
        window.load(print())
    </script>
</body>

</html>