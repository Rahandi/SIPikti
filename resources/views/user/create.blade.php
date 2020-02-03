<form action="{{route('user.store')}}" method="post">
    @csrf
    <label for="name">Nama</label>
    <input type="text" name="name">
    <label for="username">Username</label>
    <input type="text" name="username">
    <label for="password">Password</label>
    <input type="text" name="password">
    <button type="submit">Submit</button>
</form>