nomor_pendaftaran: {{ $data->nomor_pendaftaran }}<br>
nama: {{ $data->nama }}<br>
nama_gelar: {{ $data->nama_gelar }}<br>
tempat_lahir: {{ $data->tempat_lahir }}<br>
tanggal_lahir: {{ $data->tanggal_lahir }}<br>
jenis_kelamin: {{ $data->jenis_kelamin }}<br>
agama: {{ $data->agama }}<br>
status_perkawinan: {{ $data->status_perkawinan }}<br>
nomor_handphone: {{ $data->nomor_handphone }}<br>
<table>
    <tr>
        <th>Jenjang Pendidikan</th>
        <th>Nama Institusi</th>
        <th>Bidang Studi</th>
        <th>Tahun Masuk</th>
        <th>Tahun Lulus</th>
    </tr>
    @foreach ($data->pendidikan as $pend)
        <tr>
            <th>{{ $pend->jenjang_pendidikan }}</th>
            <th>{{ $pend->institusi }}</th>
            <th>{{ $pend->bidang_studi }}</th>
            <th>{{ $pend->tahun_masuk }}</th>
            <th>{{ $pend->tahun_lulus }}</th>
        </tr>
    @endforeach
</table>
Status saat mendaftar: {{ $data->status_saat_mendaftar }}<br>
Mengetahui Program ini dari: {{ $data->sumber_informasi }}