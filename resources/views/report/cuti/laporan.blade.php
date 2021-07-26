<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Cuti Tahun {{ request('tahun') }}</title>
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

    <div class="content" style="margin: auto; width: 70%; display: block; justify-content: center;">
        <h4 style="text-transform: uppercase; text-align: center;">laporan cuti tahun {{ request('tahun') }}</h4>
        <div class="cuti" style="margin-top: 20px;">
            <table style="font-size: 12px; text-align: center;" border="1" cellspacing="0">
                <tr>
                    <td width="20px">No.</td>
                    <td width="200px">Nama Karyawan</td>
                    <td width="100px">Dari</td>
                    <td width="100px">Sampai</td>
                    <td width="250px">Keterangan</td>
                </tr>
                @foreach($cuti as $ct)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $ct->user->karyawan->nama }}</td>
                    <td>{{ \Carbon\Carbon::parse($ct->dari)->format('d F Y') }} </td>
                    <td>{{ \Carbon\Carbon::parse($ct->sampai)->format('d F Y') }} </td>
                    <td>{{ $ct->keterangan}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>


    <script>
        window.load(print())
    </script>
</body>

</html>