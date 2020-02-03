<form action="{{route('user.updatePassword')}}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{$data->id}}">
    <input type="text" name="password">
    <button type="submit">Submit</button>
</form>