<table class="table table-bordered" id="dataTable">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Map</th>
            <th>Status</th>
            <th>Date Adopted</th>
            <th>Date Expired</th>
            <th>Priority</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($in as $i => $u)
        <tr>
            <td>{{++$i}}</td>
            <td>{{$u->name}}</td>
            <td>{{$u->status}}</td>
            <td>{{$u->date_adopted}}</td>
            <td>{{$u->date_expired}}</td>
            <td>{{$u->priority}}</td>
        </tr>
        @endforeach
    </tbody>
</table>