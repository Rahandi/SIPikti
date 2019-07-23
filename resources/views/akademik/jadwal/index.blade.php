<table>
    <thead>
        <tr>
            <th></th>
            <th>Jadwal</th>
            <th>Mata Kuliah</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($data as $datas)
        <tr>
            <td></td>
            <td>{{$datas->jam}}</td>
            <td>{{$datas->mata_kuliah}}</td>
        </tr>
    @endforeach
    </tbody>
</table>