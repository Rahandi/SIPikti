<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" style="background-image: url(../images/bg5.png);	background-repeat: no-repeat; background-attachment: fixed; background-position: center; background-size: cover;">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pendaftaran PIKTI</title>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/form.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<!-- <link href="../magic/stylesheets/magic.13.5.17.css" rel="stylesheet">
	<script type="text/javascript" src="../magic/magic.14.7.24.js" charset="UTF-8"></script>
	<script type="text/javascript">
		$m.construct({
			 lang : "en_us"
			,create_html5 : true
			,global_debug : false
			,animations : { use : true }
			,ajax : { debug : false, visual : true, timeout : 15 }
			,geo : { use : false, debug : false, visual : true }
			,send_timezone_to : false
		});
	</script>
	<script type="text/javascript" src="../magic/wand.14.7.14.js" charset="UTF-8"></script> -->
</head>
<body>
	<div class="row" style="align-content: center; margin-top: 3%; margin-bottom: 5%;">
		<div class="col-sm-10 col-md-offset-10 mx-auto" style="z-index: 1;">
			<!-- {{ Form::open(array('route' => 'daftar.store')) }} -->
			<form id="msform" method="POST" action="{{route('edit.update')}}" enctype="multipart/form-data" data-mjf="form_required" name="daftarin" id="daftarin">
				{{ csrf_field() }}
				<ul id="progressbar">
					<li class="active">Data Pribadi</li>
					<li>Pendidikan</li>
					<li>Lainnya</li>
				</ul>
				<fieldset>
					<input type="hidden" name="id" value="{{$data->id}}">
					<h2 class="fs-title">Data Pribadi</h2>
					<h3 class="fs-subtitle">Isikan data pribadi Anda secara jelas dan benar</h3>
					<label>Nama Lengkap</label>
					<!-- <span class="field_error_msg_off" id="0_required_msg"><br>This field is required</span> -->
					<input type="text" name="nama" value="{{$data->nama}}" data-mjf="field_required" id="0"/><br>
					<!-- <input type="text" name="nama" value="" data-mjf="copy_fields" data-mjf_cf_on="keyup" data-mjf_cf_slaves="copy_onkeyup" id="copy_from_keyup"> -->
					
					<label>Nama Lengkap dengan gelar</label>
					<input type="text" name="nama_gelar" value="{{$data->nama_gelar}}"><br>
					<!-- <input type="text" name="nama_gelar" value="" data-mjf_cf_slaves="copy_onkeyup" id="copy_to_keyup" data-mjf_cf_only_empty="true"> -->
					<div class="row">
						<div class="col-sm-6">
							<label>Tempat Lahir</label>
							<input type="text" name="tempat_lahir" value="{{ $data->tempat_lahir }}">
						</div>
						<div class="col-sm-6">
							<label>Tanggal Lahir</label>
							<input type="date" name="tanggal_lahir" value="{{$data->tanggal_lahir}}">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<label>Jenis Kelamin</label>
							<!-- {{$data->jenis_kelamin}} -->
							<div class="form-group">
								<select class="form-control" name="jenis_kelamin">
									<option value="Laki-laki">Laki-laki</option>
									<option value="Perempuan" selected="selected">Perempuan</option>
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<label>Agama / Kepercayaan</label>
							<div class="form-group">
								<select class="form-control" name="agama">
									<option value="Islam">Islam</option>
									<option value="Kristen Protestan">Kristen Protestan</option>
									<option value="Kristen Katolik">Kristen Katolik</option>
									<option value="Hindu">Hindu</option>
									<option value="Buddha">Buddha</option>
									<option value="Khonghucu">Khonghucu</option>
								</select>
							</div>
						</div>
					</div>
					<label>Status Perkawinan</label>
					<div class="form-group">
						<select class="form-control" name="status_perkawinan">
							<option value="Belum Kawin">Belum Kawin</option>
							<option value="Kawin">Kawin</option>
						</select>
					</div>
					<label>Nomor Handphone</label>
					<input type="text" name="nomor_handphone" placeholder="contoh: 08xxx" value="{{$data->nomor_handphone}}"><br>
					<!-- <input type="text" name="jenis_kelamin" placeholder="Jenis Kelamin*"><br>
					<input type="text" name="status_perkawinan" placeholder="Status Perkawinan*"><br> -->

					<!-- <h2 class="fs-title">Alamat</h2> -->
					<h3 class="fs-subtitle">Alamat Asal</h3>
					<label>Jalan</label>
					<input type="text" name="asal_jalan" placeholder="contoh: Ahmad Yani 22" value="{{$data->alamat_asal->jalan}}"><br>
					<div class="row">
						<div class="col-sm-6">
							<label>Kelurahan</label>
							<input type="text" name="asal_kelurahan" placeholder="contoh: Pare" value="{{$data->alamat_asal->kelurahan}}">
						</div>
						<div class="col-sm-6">
							<label>Desa/Kecamatan</label>
							<input type="text" name="asal_kecamatan" placeholder="contoh: Pare" value="{{$data->alamat_asal->kecamatan}}">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<label>Kabupaten/Kota</label>
							<input type="text" name="asal_kabupaten" placeholder="contoh: Kediri" value="{{$data->alamat_asal->kabupaten}}">
						</div>
						<div class="col-sm-6">
							<label>Kode Pos</label>
							<input type="text" name="asal_kode_pos" placeholder="contoh: 64210" value="{{$data->alamat_asal->kode_pos}}">
						</div>
					</div>
					<label>Telepon</label>
					<input type="text" name="asal_telepon" placeholder="contoh: 08xxx" value="{{$data->alamat_asal->telepon}}"><br>

					<h3 class="fs-subtitle">Alamat Surabaya</h3>
					<label>Jalan</label>
					<input type="text" name="surabaya_jalan" placeholder="contoh: Kejawan Gebang 23A" value="{{$data->alamat_surabaya->jalan}}"><br>
					<div class="row">
						<div class="col-sm-6">
							<label>Kelurahan</label>
							<input type="text" name="surabaya_kelurahan" placeholder="contoh: Gebang Putih" value="{{$data->alamat_surabaya->kelurahan}}">
						</div>
						<div class="col-sm-6">
							<label>Desa/Kecamatan</label>
							<input type="text" name="surabaya_kecamatan" placeholder="contoh: Sukolilo" value="{{$data->alamat_surabaya->kecamatan}}">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<label>Kabupaten/Kota</label>
							<input type="text" name="surabaya_kabupaten" placeholder="contoh: Surabaya" value="{{$data->alamat_surabaya->kabupaten}}">
						</div>
						<div class="col-sm-6">
							<label>Kode Pos</label>
							<input type="text" name="surabaya_kode_pos" placeholder="contoh: 60111" value="{{$data->alamat_surabaya->kode_pos}}">
						</div>
					</div>
					<label>Telepon</label>
					<input type="text" name="surabaya_telepon" placeholder="contoh: 08xxx" value="{{$data->alamat_surabaya->telepon}}"><br>

					<input type="button" name="next" class="next action-button" value="Next" style="text-align: center;"/>
				</fieldset>
				<fieldset>
					<h2 class="fs-title">Jenjang Pendidikan</h2>

					<h3 class="fs-subtitle" style="text-align: left;">SD</h3> 
					<input type="text" name="sd_institusi" placeholder="contoh: SDN Pare 2" value="{{$data->pendidikan->sd->institusi}}"><br>
					<input type="text" name="sd_bidang_studi" placeholder="contoh: -" value="{{$data->pendidikan->sd->bidang_studi}}"><br>
					<div class="row">
						<div class="col-sm-6">
							<input type="text" name="sd_tahun_masuk" placeholder="contoh: 2004" value="{{$data->pendidikan->sd->tahun_masuk}}">
						</div>
						<div class="col-sm-6">
							<input type="text" name="sd_tahun_lulus" placeholder="contoh: 2010" value="{{$data->pendidikan->sd->tahun_lulus}}">
						</div>
					</div>

					<h3 class="fs-subtitle" style="text-align: left;">SLTP</h3> 
					<input type="text" name="sltp_institusi" placeholder="contoh: SMPN 2 Pare" value="{{$data->sltp_institusi}}"><br>
					<input type="text" name="sltp_bidang_studi" placeholder="contoh: -" value="{{$data->sltp_bidang_studi}}"><br>
					<div class="row">
						<div class="col-sm-6">
							<input type="text" name="sltp_tahun_masuk" placeholder="contoh: 2010" value="{{$data->sltp_tahun_masuk}}">
						</div>
						<div class="col-sm-6">
							<input type="text" name="sltp_tahun_lulus" placeholder="contoh: 2013" value="{{$data->sltp_tahun_lulus}}">
						</div>
					</div>

					<h3 class="fs-subtitle" style="text-align: left;">SLTA</h3> 
					<input type="text" name="slta_institusi" placeholder="contoh: SMAN 2 Pare" value="{{$data->slta_institusi}}"><br>
					<input type="text" name="slta_bidang_studi" placeholder="contoh: IPA" value="{{$data->slta_bidang_studi}}"><br>
					<div class="row">
						<div class="col-sm-6">
							<input type="text" name="slta_tahun_masuk" placeholder="contoh: 2013" value="{{$data->slta_tahun_masuk}}">
						</div>
						<div class="col-sm-6">
							<input type="text" name="slta_tahun_lulus" placeholder="contoh: 2016" value="{{$data->slta_tahun_lulus}}">
						</div>
					</div>

					<h3 class="fs-subtitle" style="text-align: left;">Diploma</h3> 
					<input type="text" name="diploma_institusi" placeholder="contoh: D3 ITS" value="{{$data->diploma_institusi}}"><br>
					<input type="text" name="diploma_bidang_studi" placeholder="contoh: Statistika" value="{{$data->diploma_bidang_studi}}"><br>
					<div class="row">
						<div class="col-sm-6">
							<input type="text" name="diploma_tahun_masuk" placeholder="contoh: 2016" value="{{$data->diploma_tahun_masuk}}">
						</div>
						<div class="col-sm-6">
							<input type="text" name="diploma_tahun_lulus" placeholder="contoh: 2019" value="{{$data->diploma_tahun_lulus}}">
						</div>
					</div>

					<h3 class="fs-subtitle" style="text-align: left;">Sarjana</h3> 
					<input type="text" name="sarjana_institusi" placeholder="contoh: S1 ITS" value="{{$data->sarjana_institusi}}"><br>
					<input type="text" name="sarjana_bidang_studi" placeholder="contoh: Teknik Elektro" value="{{$data->sarjana_bidang_studi}}"><br>
					<div class="row">
						<div class="col-sm-6">
							<input type="text" name="sarjana_tahun_masuk" placeholder="contoh: 2016" value="{{$data->sarjana_tahun_masuk}}">
						</div>
						<div class="col-sm-6">
							<input type="text" name="sarjana_tahun_lulus" placeholder="contoh: 2020" value="{{$data->sarjana_tahun_lulus}}">
						</div>
					</div>

					<h3 class="fs-subtitle" style="text-align: left;">Lain-lain</h3> 
					<input type="text" name="lainnya_institusi" placeholder="contoh: Bukalapak" value="{{$data->lainnya_institusi}}"><br>
					<input type="text" name="lainnya_bidang_studi" placeholder="contoh: HRD" value="{{$data->lainnya_bidang_studi}}"><br>
					<div class="row">
						<div class="col-sm-6">
							<input type="text" name="lainnya_tahun_masuk" placeholder="contoh: 2018" value="{{$data->lainnya_tahun_masuk}}">
						</div>
						<div class="col-sm-6">
							<input type="text" name="lainnya_tahun_lulus" placeholder="contoh: 2019" value="{{$data->lainnya_tahun_lulus}}">
						</div>
					</div>
					<input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
					<input type="button" name="next" class="next action-button" value="Next"/>
				</fieldset>
				<fieldset style="text-align: center;">
					<h2 class="fs-title">Informasi Tambahan</h2>
					<h3 class="fs-subtitle">Status pada saat mendaftar</h3>
					<div class="form-check form-check-inline" style="font-size: 14px;">
						<input class="form-check-input" type="radio" id="cb1" name="lulus_sma">
						<label class="form-check-label" for="cb1">Lulus&nbsp;SMA</label>
						<input class="form-check-input" type="radio" id="cb2" name="mahasiswa" style="margin-left: 5%;">
						<label class="form-check-label" for="cb2">Mahasiswa</label>
						<input class="form-check-input" type="radio" id="cb3" name="bekerja" style="margin-left: 5%;">
						<label class="form-check-label" for="cb3">Bekerja</label>
					</div>
					<br><br>
					<h3 class="fs-subtitle">Mengetahui program ini dari:</h3>
					<div style="width: 100%;">
						<div class="form-check form-check-inline" style="font-size: 14px;">
							<input class="form-check-input" type="checkbox" id="cb4" name="koran">
							<label class="form-check-label" for="cb4">Koran</label>
							<input class="form-check-input" type="checkbox" id="cb5" name="spanduk" style="margin-left: 5%;">
							<label class="form-check-label" for="cb5">Spanduk</label>
							<input class="form-check-input" type="checkbox" id="cb6" name="brosur" style="margin-left: 5%;">
							<label class="form-check-label" for="cb6">Brosur</label>
						</div>
						<div class="form-check form-check-inline" style="font-size: 14px;">
							<input class="form-check-input" type="checkbox" id="cb7" name="teman_saudara" style="margin-left: 5%;">
							<label class="form-check-label" for="cb7">Teman&nbsp;/&nbsp;Saudara</label>
							<input class="form-check-input" type="checkbox" id="cb8" name="pameran" style="margin-left: 5%;">
							<label class="form-check-label" for="cb8">Pameran</label>
							<input class="form-check-input" type="checkbox" id="cb9" name="lainnya" style="margin-left: 5%;">
							<label class="form-check-label" for="cb9">Lainnya</label>
						</div>
					</div>
					<br><br>
					<input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
					<input type="submit" name="submit" class="action-button" value="Submit"/>
				</fieldset>
				</div>
			</form>
			<!-- {{ Form::close() }} -->
		</div>
	</div>
	<!-- <script type="text/javascript">$m.wand.copy_fields = true;</script> -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../js/sipikti.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<!-- <script type="text/javascript">$m.wand.form_required = true;</script> -->
</body>
</html>