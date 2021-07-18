<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Permohonan Cuti</title>
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


    <div class="content" style="margin: auto; width: 80%; display: block; justify-content: center;">
        <h4 style="text-transform: uppercase; text-align: center;">Surat Permohonan Cuti Karyawan</h4>

        <div class="right">
            <p>Jakarta, {{ \Carbon\Carbon::parse($kehadiran->created_at)->format('d F Y') }}</p>

            <p>
            <table>
                <tr>
                    <td>Kepada Yth,</td>
                </tr>
                <tr>
                    <td>Pimpinan HRD CV.Peninsula Abadi</td>
                </tr>
                <tr>
                    <td>Jl. H Anang Adenansi No 4 Banjarmasin</td>
                </tr>
                <tr>
                    <td>di</td>
                </tr>
                <tr>
                    <td>Tempat</td>
                </tr>
            </table>
            </p>

            <p>
            <table>
                <tr>
                    <td>Dengan Hormat,</td>
                </tr>
                <tr>
                    <td>Saya yang bertanda tangan di bawah ini :</td>
                </tr>
            </table>
            </p>

            <p>
            <table>
                <tr>
                    <td width="200px">Nama Karyawan</td>
                    <td>:</td>
                    <td>{{ $kehadiran->user->karyawan->nama }}</td>
                </tr>
                <tr>
                    <td width="200px">ID Karyawan</td>
                    <td>:</td>
                    <td>{{ $kehadiran->user->karyawan->id }}</td>
                </tr>
                <tr>
                    <td width="200px">Divisi</td>
                    <td>:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td width="200px">Jabatan</td>
                    <td>:</td>
                    <td>
                        {{ $kehadiran->user->level == 'U' ? 'Karyawan' : 'Admin' }}
                    </td>
                </tr>
            </table>
            </p>

            <p style="margin-top: 40px;">
                Dengan surat ini saya mengajukan permintaan cuti untuk, {{ $kehadiran->keterangan }} terhitung mulai tanggal {{ \Carbon\Carbon::parse($kehadiran->dari)->format('d F Y') }} sampai dengan tanggal {{ \Carbon\Carbon::parse($kehadiran->sampai)->format('d F Y') }} .
            </p>
            <p>
                Demikianlah surat permintaan ini saya buat untuk dapat dipertimbangkan sebagaimana mestinya. Atas izin yang diberikan saya ucapkan terima kasih.
            </p>
        </div>
    </div>

    <div class="footer" style="text-align: end; margin-top: 50px;">
        <table>
            <tr style="text-align: center;">
                <td width="550px"></td>
                <td><b>Hormat Saya, </b><br><br><br><br></td>
            </tr>
            <tr style="text-align: center;">
                <td width="550px"></td>
                <td>
                    <b>{{ $kehadiran->user->karyawan->nama }}</b>
                </td>
            </tr>
        </table>
    </div>


    <script>
        window.load(print())
    </script>
</body>

</html>