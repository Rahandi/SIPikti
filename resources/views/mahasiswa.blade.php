<table>
    <thead>
        <th>Nama</th>
        <th>Action</th>
    </thead>
    <tbody>
    @foreach ($data as $individu)
        <tr>
            <td>{{ $individu->nama }}</td>
            <td>
                <form action="{{ route('mahasiswa.delete') }}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$individu->id}}">
                    <button type="submit">delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>