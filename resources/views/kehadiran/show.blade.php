<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Permohonan Cuti</title>
</head>

<body>
    <x-header></x-header>


    <div class="content" style="margin: auto; width: 80%; display: block; justify-content: center;">
        <h4 style="text-transform: uppercase; text-align: center;">Surat Permohonan Cuti Karyawan</h4>

        <div class="right">
            <p>Banjarmasin, {{ \Carbon\Carbon::parse($kehadiran->created_at)->format('d F Y') }}</p>

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
                    <td>{{ $kehadiran->user->karyawan->id_karyawan }}</td>
                </tr>
                <tr>
                    <td width="200px">Divisi</td>
                    <td>:</td>
                    <td>{{ $kehadiran->user->karyawan->divisi }}</td>
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