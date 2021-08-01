<table class="table table-bordered" id="dataTable">
    <thead>
        <tr>
            <th>No</th>
            <th>ID Karyawan</th>
            <th>Nama</th>
            <th>Map</th>
            <th>Tanggal</th>
            <th>Gambar</th>
            <th>Komentar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($error as $i => $u)
        <tr>
            <td>{{++$i}}</td>
            <td>{{$u->workMap->user->karyawan->id_karyawan}}</td>
            <td>{{$u->workMap->user->karyawan->nama}}</td>
            <td>{{$u->workMap->map->name}}</td>
            <td>{{$u->date}}</td>
            <td>{{$u->image}}</td>
            <td>{{$u->comments}}</td>
        </tr>
        @endforeach
    </tbody>
</table>