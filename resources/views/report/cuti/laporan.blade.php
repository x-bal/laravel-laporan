<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Cuti Tahun {{ request('tahun') }}</title>
</head>

<body>
    <x-header></x-header>

    <div class="content" style="margin: auto; width: 70%; display: block; justify-content: center;">
        <h4 style="text-transform: uppercase; text-align: center;">laporan cuti tahun {{ request('tahun') }}</h4>
        <div class="cuti" style="margin-top: 20px;">
            <table style="font-size: 12px; text-align: center;" border="1" cellspacing="0">
                <tr>
                    <td width="20px">No.</td>
                    <td width="100px">ID Karyawan</td>
                    <td width="200px">Nama Karyawan</td>
                    <td width="100px">Jabatan</td>
                    <td width="100px">JK</td>
                    <td width="100px">Dari</td>
                    <td width="100px">Sampai</td>
                    <td width="250px">Keterangan</td>
                </tr>
                @foreach($cuti as $ct)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $ct->user->karyawan->id_karyawan }}</td>
                    <td>{{ $ct->user->karyawan->nama }}</td>
                    <td>{{ $ct->user->level == 'U' ? 'Karyawan' : '' }} {{ $ct->user->level == 'A' ? 'Admin' : '' }} {{ $ct->user->level == 'B' ? 'Bendahara' : '' }}</td>
                    <td>{{ $ct->user->karyawan->jk }}</td>
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