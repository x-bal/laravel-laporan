<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akumulasi Gaji Bulanan</title>
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

    <div class="content" style="margin: auto; width: 70%; display: block; justify-content: center; border-bottom: 1px solid black;">
        <h4 style="text-transform: uppercase;">TOTAL PENGELUARAN BIAYA KARYAWAN PADA TAHUN {{ $tahun }}</h4>
        <div class=" gaji" style="margin-top: 20px;">
            <p>
                GAJI KARYAWAN
            </p>
            <table style="font-size: 12px;" border="1" cellspacing="0">
                <tr>
                    <td width="20px" style="text-align: center;">No.</td>
                    <td width="320px">Nama Karyawan</td>
                    <td width="150px" style="text-align: center;">Gaji</td>
                </tr>
                @foreach($akumulasi as $akm)
                <tr>
                    <td width="20px" style="text-align: center;">{{ $loop->iteration }}</td>
                    <td width="200px">{{ $akm->karyawan->nama }}</td>
                    <td width="180px" style="text-align: center;">Rp. {{ $akm->gaji->gaji }}</td>
                </tr>
                @php
                $gaji = 0;
                $gaji += $akm->gaji->gaji
                @endphp
                @endforeach
            </table>
            <table style="font-size: 12px; margin-top: 20px; margin-bottom: 20px;" cellspacing="0">
                <tr>
                    <td style="text-align: center;">
                        Total Gaji
                    </td>
                    <td width="340px"> : </td>
                    <td width="150px" style="text-align: center;">Rp. {{ $gaji }}</td>
                </tr>
            </table>
        </div>

        <div class="tambahan" style="margin-top: 20px;">
            <p>
                PENDAPATAN KARYAWAN
            </p>
            <table style="font-size: 12px;" border="1" cellspacing="0">
                <tr>
                    <td width="20px" style="text-align: center;">No.</td>
                    <td width="300px">Nama Karyawan</td>
                    <td width="50px" style="text-align: center;">Bonus</td>
                    <td width="150px" style="text-align: center;">Gaji</td>
                </tr>
                @foreach($pendapatan as $pnd)
                <tr>
                    <td width="20px" style="text-align: center;">{{ $loop->iteration }}</td>
                    <td width="200px">{{ $pnd->user->karyawan->nama }}</td>
                    <td style="text-align: center;">{{ $pnd->jenis->name }}</td>
                    <td width="100px" style="text-align: center;">Rp. {{ $pnd->jenis->nominal }}</td>
                </tr>
                @php
                $totalPend += $pnd->jenis->nominal

                @endphp
                @endforeach
            </table>
            <table style="font-size: 12px; margin-top: 20px; margin-bottom: 20px;" cellspacing="0">
                <tr>
                    <td style="text-align: center;">
                        Total Pendapatan Karyawan
                    </td>
                    <td width="300px"> : </td>
                    <td width="150px" style="text-align: center;">Rp. {{ $totalPend  }}</td>
                </tr>
            </table>
        </div>

        <div class="pengurangan" style="margin-top: 20px; margin-bottom: 10px;">
            <p>
                PENGURANGAN KARYAWAN
            </p>
            <table style="font-size: 12px;" border="1" cellspacing="0">
                <tr>
                    <td width="20px" style="text-align: center;">No.</td>
                    <td width="300px">Nama Karyawan</td>
                    <td width="50px" style="text-align: center;">Bonus</td>
                    <td width="150px" style="text-align: center;">Gaji</td>
                </tr>
                @foreach($pengurangan as $peng)
                <tr>
                    <td width="20px" style="text-align: center;">{{ $loop->iteration }}</td>
                    <td width="200px">{{ $peng->user->karyawan->nama }}</td>
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
                    <td style="text-align: center;">
                        Total Pengurangan
                    </td>
                    <td width="300px"> : </td>
                    <td width="150px" style="text-align: center;">Rp. {{ $totalPeng }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="total" style="margin: auto; width: 70%; display: block; justify-content: center; border-bottom: 1px solid black;">
        <table style="font-size: 12px; margin-top: 20px; margin-bottom: 20px;" cellspacing="0">
            <tr>
                <td style="text-align: center;">
                    Total Pengeluaran
                </td>
                <td width="300px"> : </td>
                <td width="150px" style="text-align: center;">Rp. {{ $gaji + $totalPend - $totalPeng }}</td>
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
        // window.load(print())
    </script>
</body>

</html>