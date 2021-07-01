<table class="table table-bordered"  id="dataTable">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Map</th>
            <th>StartOn</th>
            <th>Progress</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($workMap as $i => $u)
        <tr>
            <td>{{++$i}}</td>
            <td>{{$u->user->name}}</td>
            <td>{{$u->map->name}}</td>
            <td>{{$u->start_on}}</td>
            <td>{{$u->progress}} %</td>
        </tr>
        @endforeach
    </tbody>
</table>