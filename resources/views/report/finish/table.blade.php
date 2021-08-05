<table class="table table-bordered" id="dataTable">
    <thead>
        <tr>
            <th>No</th>
            <th>ID Map</th>
            <th>ID Karyawan</th>
            <th>Nama</th>
            <th>Map</th>
            <th>Priority</th>
            <th>StartOn</th>
            <th>FinishOn</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($workMap as $i => $u)
        <tr>
            <td>{{++$i}}</td>
            <td>{{$u->map->id_map}}</td>
            <td>{{$u->user->karyawan->id_karyawan}}</td>
            <td>{{$u->user->karyawan->nama}}</td>
            <td>{{$u->map->name}}</td>
            <td>{{$u->map->priority}}</td>
            <td>{{$u->start_on}}</td>
            <td>{{$u->finish_on}}</td>
        </tr>
        @endforeach
    </tbody>
</table>