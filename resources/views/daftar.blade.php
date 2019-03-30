{{ Form::open(array('route' => 'daftar.store')) }}
<input type="text" name="nomor_pendaftaran" placeholder="Nomor Pendaftaran*"><br>
<input type="text" name="nama" placeholder="Nama Lengkap*"><br>
data pribadi<br>
<input type="text" name="nama_gelar" placeholder="Nama Lengkap dengan gelar*"><br>
<input type="text" name="tempat_lahir" placeholder="Tempat Lahir*"><br>
<input type="date" name="tanggal_lahir" placeholder="Tanggal Lahir*"><br>
<input type="text" name="jenis_kelamin" placeholder="Jenis Kelamin*"><br>
<input type="text" name="agama" placeholder="Agama / Kepercayaan*"><br>
<input type="text" name="status_perkawinan" placeholder="Status Perkawinan*"><br>
alamat asal<br>
<input type="text" name="asal_jalan" placeholder="Jalan*"><br>
<input type="text" name="asal_kelurahan" placeholder="Kelurahan*"><br>
<input type="text" name="asal_kecamatan" placeholder="Kecamatan*"><br>
<input type="text" name="asal_kabupaten" placeholder="Kabupaten*"><br>
<input type="text" name="asal_kode_pos" placeholder="Kode Pos*"><br>
<input type="text" name="asal_telepon" placeholder="Telepon*"><br>
alamat surabaya<br>
<input type="text" name="surabaya_jalan" placeholder="Jalan*"><br>
<input type="text" name="surabaya_kelurahan" placeholder="Kelurahan*"><br>
<input type="text" name="surabaya_kecamatan" placeholder="Kecamatan*"><br>
<input type="text" name="surabaya_kabupaten" placeholder="Kabupaten*"><br>
<input type="text" name="surabaya_kode_pos" placeholder="Kode Pos*"><br>
<input type="text" name="surabaya_telepon" placeholder="Telepon*"><br>
<input type="text" name="nomor_handphone" placeholder="Nomor Handphone*"><br>
<table>
    <tr>
        <th>Jenjang Pendidikan</th>
        <th>Nama Institusi</th>
        <th>Bidang Studi</th>
        <th>Tahun Masuk</th>
        <th>Tahun Lulus</th>
    </tr>
    <tr>
        <th>SD</th>
        <th><input type="text" name="sd_institusi"></th>
        <th><input type="text" name="sd_bidang_studi"></th>
        <th><input type="text" name="sd_tahun_masuk"></th>
        <th><input type="text" name="sd_tahun_lulus"></th>
    </tr>
    <tr>
        <th>SLTP</th>
        <th><input type="text" name="sltp_institusi"></th>
        <th><input type="text" name="sltp_bidang_studi"></th>
        <th><input type="text" name="sltp_tahun_masuk"></th>
        <th><input type="text" name="sltp_tahun_lulus"></th>
    </tr>
    <tr>
        <th>SLTA</th>
        <th><input type="text" name="slta_institusi"></th>
        <th><input type="text" name="slta_bidang_studi"></th>
        <th><input type="text" name="slta_tahun_masuk"></th>
        <th><input type="text" name="slta_tahun_lulus"></th>
    </tr>
    <tr>
        <th>Diploma</th>
        <th><input type="text" name="diploma_institusi"></th>
        <th><input type="text" name="diploma_bidang_studi"></th>
        <th><input type="text" name="diploma_tahun_masuk"></th>
        <th><input type="text" name="diploma_tahun_lulus"></th>
    </tr>
    <tr>
        <th>Sarjana</th>
        <th><input type="text" name="sarjana_institusi"></th>
        <th><input type="text" name="sarjana_bidang_studi"></th>
        <th><input type="text" name="sarjana_tahun_masuk"></th>
        <th><input type="text" name="sarjana_tahun_lulus"></th>
    </tr>
    <tr>
        <th>Lain-lain</th>
        <th><input type="text" name="lainnya_institusi"></th>
        <th><input type="text" name="lainnya_bidang_studi"></th>
        <th><input type="text" name="lainnya_tahun_masuk"></th>
        <th><input type="text" name="lainnya_tahun_lulus"></th>
    </tr>
</table>
<input type="checkbox" name="lulus_sma"> Lulus SMA<br>
<input type="checkbox" name="mahasiswa"> Mahasiswa<br>
<input type="checkbox" name="bekerja"> Bekerja<br>
<input type="checkbox" name="koran"> Koran<br>
<input type="checkbox" name="spanduk"> Spanduk<br>
<input type="checkbox" name="brosur"> Brosur<br>
<input type="checkbox" name="teman_saudara"> Teman / Saudara<br>
<input type="checkbox" name="pameran"> Pameran<br>
<input type="checkbox" name="lainnya"> Lainnya<br>
<button>Submit</button>
{{ Form::close() }}