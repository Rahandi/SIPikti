<form action="{{route('angsuran.update')}}" method="POST">
    {{csrf_field()}}
    <input type="hidden" name="id" value="{{$data->id}}">
    <input type="text" name="nama" value="{{$data->nama}}"><br>
    <input type="text" name="gelombang" value="{{$data->gelombang}}"><br>
    <input type="text" name="detail" value="{{$data->detail}}"><br>
    <input type="number" name="kali_pembayaran" value="{{$data->kali_pembayaran}}"><br>
    <button type="submit">submit</button>
</form>