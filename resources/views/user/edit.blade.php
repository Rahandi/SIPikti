<form action="{{route('user.update')}}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{$data->id}}">
    <input type="text" name="name" value="{{$data->name}}">
    <input type="text" name="username" value="{{$data->email}}">
    <button type="submit">Submit</button>
</form>