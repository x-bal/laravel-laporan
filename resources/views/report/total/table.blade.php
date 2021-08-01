<table class="table table-bordered" id="dataTable">
    <thead>
        <tr>
            <th>No</th>
            <th>ID Karyawan</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Map</th>
            <th>Tanggal</th>

        </tr>
    </thead>
    <tbody>
        @if($workMap != null)
        @foreach ($workMap as $i)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{$i->user->karyawan->id_karyawan}}</td>
            <td>{{$i->user->karyawan->nama}}</td>
            <td>{{$i->user->email}}</td>
            <td>{{$i->map->name}}</td>
            <td>{{$i->finish_on}}</td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>