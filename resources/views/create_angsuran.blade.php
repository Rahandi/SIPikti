<form action="{{route('angsuran.store')}}" method="POST">
    {{csrf_field()}}
    <input type="text" name="nama"><br>
    <input type="text" name="gelombang"><br>
    <input type="text" name="detail"><br>
    <input type="number" name="kali_pembayaran"><br>
    <button type="submit">submit</button>
</form>