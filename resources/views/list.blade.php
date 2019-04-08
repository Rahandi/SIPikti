<table>
    <tr>
        <th>Nomor Pendaftaran</th>
        <th>Nama</th>
        <th>Action</th>
    </tr>
    @foreach ($data as $individu)
    <tr>
        <th>{{ $individu->nomor_pendaftaran }}</th>
        <th>{{ $individu->nama }}</th>
        <th><a href="kwitansi/{{ $individu->id }}">kwitansi</a></th>
        <th><a href="detail/{{ $individu->id }}">detail</a></th>
        <th><a href="edit/{{ $individu->id }}">edit</a></th>
    </tr>
    @endforeach
</table>