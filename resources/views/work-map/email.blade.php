<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Laporan Map Selesai</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Laporan Map Selesai</h2>
                    </div>
                    <div class="card-body">
                        <table class="table" border="1" cellspacing="0" cellspacing="10" style="text-align: center; font-size: 14px;">
                            <thead style="background-color: rgba(0, 0, 0, 0.05);">
                                <tr>
                                    <th>ID Map</th>
                                    <th>ID Pengerja</th>
                                    <th>Nama Map</th>
                                    <th>Status</th>
                                    <th>Date Adopted</th>
                                    <th>Date Expired</th>
                                    <th>Priority</th>
                                    <th>Pengerja</th>
                                    <th>Finish On</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>{{$content->map->id_map}}</td>
                                    <td>{{$content->user->karyawan->id_karyawan}}</td>
                                    <td>{{$content->map->name}}</td>
                                    <td>{{$content->map->status}}</td>
                                    <td>{{$content->map->date_adopted}}</td>
                                    <td>{{$content->map->date_expired}}</td>
                                    <td>{{$content->map->priority}}</td>
                                    <td>{{$content->user->karyawan->nama}}</td>
                                    <td>{{$content->finish_on}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>