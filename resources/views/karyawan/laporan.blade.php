<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Karyawan {{ request('divisi') != 'all' ? 'Divisi '.request('divisi') : '' }}</title>
</head>

<body>
    <x-header></x-header>

    <div class="content" style="margin: auto; width: 70%; display: block; justify-content: center;">
        <h4 style="text-transform: uppercase; text-align: center;">Laporan Karyawan {{ request('divisi') != 'all' ? 'Divisi '.request('divisi') : '' }}</h4>
        <div class="cuti" style="margin-top: 20px;">
            <table style="font-size: 12px; text-align: center;" border="1" cellspacing="0">
                <tr>
                    <td width="20px">No.</td>
                    <td width="100px">ID Karyawan</td>
                    <td width="200px">Nama Karyawan</td>
                    <td width="140px">No Hp</td>
                    <td width="80px">JK</td>
                    <td width="150px">Divisi</td>
                </tr>

                @foreach($karyawan as $kar)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kar->id_karyawan }}</td>
                    <td>{{ $kar->nama }}</td>
                    <td>{{ $kar->nohp }}</td>
                    <td>{{ $kar->jk }}</td>
                    <td>{{ $kar->divisi }}</td>
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