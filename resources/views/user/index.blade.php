<table>
    <tr>
        <th>Nama</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    @foreach ($data as $item)
        <tr>
            <td>{{$item->name}}</td>
            <td>{{$item->email}}</td>
            <td>
                <form action="{{route('user.edit')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$item->id}}">
                    <button type="submit">Edit</button>
                </form>
                <form action="{{route('user.editPassword')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$item->id}}">
                    <button type="submit">Edit Password</button>
                </form>
                <form action="{{route('user.delete')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$item->id}}">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>