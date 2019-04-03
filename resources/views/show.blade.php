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
        <th>No.</th>
        <th>Jenjang Pendidikan</th>
        <th>Nama Institusi</th>
        <th>Bidang Studi</th>
        <th>Tahun Masuk</th>
        <th>Tahun Lulus</th>
    </tr>
    <tr>
        <th>1</th>
        <th>SD</th>
        <th>{{ $data->pendidikan->sd->institusi }}</th>
        <th>{{ $data->pendidikan->sd->bidang_studi }}</th>
        <th>{{ $data->pendidikan->sd->tahun_masuk }}</th>
        <th>{{ $data->pendidikan->sd->tahun_lulus }}</th>
    </tr>
    <tr>
        <th>2</th>
        <th>SLTP</th>
        <th>{{ $data->pendidikan->sltp->institusi }}</th>
        <th>{{ $data->pendidikan->sltp->bidang_studi }}</th>
        <th>{{ $data->pendidikan->sltp->tahun_masuk }}</th>
        <th>{{ $data->pendidikan->sltp->tahun_lulus }}</th>
    </tr>
    <tr>
        <th>3</th>
        <th>SLTA</th>
        <th>{{ $data->pendidikan->slta->institusi }}</th>
        <th>{{ $data->pendidikan->slta->bidang_studi }}</th>
        <th>{{ $data->pendidikan->slta->tahun_masuk }}</th>
        <th>{{ $data->pendidikan->slta->tahun_lulus }}</th>
    </tr>
    <tr>
        <th>4</th>
        <th>Diploma</th>
        <th>{{ $data->pendidikan->diploma->institusi }}</th>
        <th>{{ $data->pendidikan->diploma->bidang_studi }}</th>
        <th>{{ $data->pendidikan->diploma->tahun_masuk }}</th>
        <th>{{ $data->pendidikan->diploma->tahun_lulus }}</th>
    </tr>
    <tr>
        <th>5</th>
        <th>Sarjana</th>
        <th>{{ $data->pendidikan->sarjana->institusi }}</th>
        <th>{{ $data->pendidikan->sarjana->bidang_studi }}</th>
        <th>{{ $data->pendidikan->sarjana->tahun_masuk }}</th>
        <th>{{ $data->pendidikan->sarjana->tahun_lulus }}</th>
    </tr>
    <tr>
        <th>6</th>
        <th>Lainnya</th>
        <th>{{ $data->pendidikan->lainnya->institusi }}</th>
        <th>{{ $data->pendidikan->lainnya->bidang_studi }}</th>
        <th>{{ $data->pendidikan->lainnya->tahun_masuk }}</th>
        <th>{{ $data->pendidikan->lainnya->tahun_lulus }}</th>
    </tr>
</table>
Status saat mendaftar: {{ $data->status_saat_mendaftar }}<br>
Mengetahui Program ini dari: {{ $data->sumber_informasi }}