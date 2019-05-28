<a href="{{route('angsuran.create')}}">create new</a>
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
                <form action="{{ route('angsuran.delete') }}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$individu->id}}">
                    <button type="submit">delete</button>
                </form>
                <a href="{{route('angsuran.edit', $individu->id)}}">
                    <button>edit</button>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>