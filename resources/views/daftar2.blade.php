<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" style="background-image: url(images/bg5.png);	background-repeat: no-repeat; background-attachment: fixed; background-position: center; background-size: cover;">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pendaftaran PIKTI</title>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/form.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
	<div class="row" style="align-content: center; margin-top: 3%; margin-bottom: 5%;">
		<div class="col-sm-10 col-md-offset-10 mx-auto" style="z-index: 1;">
			<!-- {{ Form::open(array('route' => 'daftar.store')) }} -->
			<form id="msform" method="POST" action="{{route('daftar.store')}}" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="myModal" style="margin-top: 15%; text-align: center;">
					<h2 class="fs-title" style="color: white;">Administrator</h2>
					<input type="text" name="administrator" style="width: 70%;"><br>
					<input type="button" name="next" class="nextMyModal action-button" value="Next" id="nextMyModal" />
				</div>
				<div id="form_1" style="display: none;">
				<ul id="progressbar">
					<li class="active">Data Pribadi</li>
					<li>Pendidikan</li>
					<li>Lainnya</li>
				</ul>
			<!-- fieldsets -->
				
				<fieldset>
					<h2 class="fs-title">Data Pribadi</h2>
					<h3 class="fs-subtitle">Isikan data pribadi Anda secara jelas dan benar</h3>
					<label>Nama Lengkap</label>
					<input type="text" name="nama"/><br>
					<label>Nama Lengkap dengan gelar</label>
					<input type="text" name="nama_gelar"><br>
					<div class="row">
						<div class="col-sm-6">
							<label>Tempat Lahir</label>
							<input type="text" name="tempat_lahir">
						</div>
						<div class="col-sm-6">
							<label>Tanggal Lahir</label>
							<input type="date" name="tanggal_lahir">
						</div>
					</div>
					<label>Jenis Kelamin</label>
					<div class="form-group">
						<select class="form-control" name="jenis_kelamin">
							<option value="laki_laki">Laki-laki</option>
							<option value="perempuan">Perempuan</option>
						</select>
					</div>
					<label>Agama / Kepercayaan</label>
					<input type="text" name="agama"><br>
					<label>Status Perkawinan</label>
					<div class="form-group">
						<select class="form-control" name="status_perkawinan">
							<option value="belum_kawin">Belum Kawin</option>
							<option value="kawin">Kawin</option>
						</select>
					</div>
					<!-- <input type="text" name="jenis_kelamin" placeholder="Jenis Kelamin*"><br>
					<input type="text" name="status_perkawinan" placeholder="Status Perkawinan*"><br> -->

					<!-- <h2 class="fs-title">Alamat</h2> -->
					<h3 class="fs-subtitle">Alamat Asal</h3>
					<label>Jalan</label>
					<input type="text" name="asal_jalan"><br>
					<div class="row">
						<div class="col-sm-6">
							<label>Kelurahan</label>
							<input type="text" name="asal_kelurahan">
						</div>
						<div class="col-sm-6">
							<label>Kecamatan</label>
							<input type="text" name="asal_kecamatan">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<label>Kabupaten</label>
							<input type="text" name="asal_kabupaten">
						</div>
						<div class="col-sm-6">
							<label>Kode Pos</label>
							<input type="text" name="asal_kode_pos">
						</div>
					</div>
					<label>Telepon</label>
					<input type="text" name="asal_telepon"><br>

					<h3 class="fs-subtitle">Alamat Surabaya</h3>
					<label>Jalan</label>
					<input type="text" name="surabaya_jalan"><br>
					<div class="row">
						<div class="col-sm-6">
							<label>Kelurahan</label>
							<input type="text" name="surabaya_kelurahan">
						</div>
						<div class="col-sm-6">
							<label>Kecamatan</label>
							<input type="text" name="surabaya_kecamatan">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<label>Kabupaten</label>
							<input type="text" name="surabaya_kabupaten">
						</div>
						<div class="col-sm-6">
							<label>Kode Pos</label>
							<input type="text" name="surabaya_kode_pos">
						</div>
					</div>
					<label>Telepon</label>
					<input type="text" name="surabaya_telepon"><br>
					<label>Nomor Handphone</label>
					<input type="text" name="nomor_handphone"><br>

					<input type="button" name="next" class="next action-button" value="Next" style="text-align: center;"/>
				</fieldset>
				<fieldset>
					<h2 class="fs-title">Jenjang Pendidikan</h2>

					<h3 class="fs-subtitle" style="text-align: left;">SD</h3> 
					<input type="text" name="sd_institusi" placeholder="Nama Institusi*"><br>
					<input type="text" name="sd_bidang_studi" placeholder="Bidang Studi*"><br>
					<div class="row">
						<div class="col-sm-6">
							<input type="text" name="sd_tahun_masuk" placeholder="Tahun Masuk*">
						</div>
						<div class="col-sm-6">
							<input type="text" name="sd_tahun_lulus" placeholder="Tahun Lulus*">
						</div>
					</div>

					<h3 class="fs-subtitle" style="text-align: left;">SLTP</h3> 
					<input type="text" name="sltp_institusi" placeholder="Nama Institusi*"><br>
					<input type="text" name="sltp_bidang_studi" placeholder="Bidang Studi*"><br>
					<div class="row">
						<div class="col-sm-6">
							<input type="text" name="sltp_tahun_masuk" placeholder="Tahun Masuk*">
						</div>
						<div class="col-sm-6">
							<input type="text" name="sltp_tahun_lulus" placeholder="Tahun Lulus*">
						</div>
					</div>

					<h3 class="fs-subtitle" style="text-align: left;">SLTA</h3> 
					<input type="text" name="slta_institusi" placeholder="Nama Institusi*"><br>
					<input type="text" name="slta_bidang_studi" placeholder="Bidang Studi*"><br>
					<div class="row">
						<div class="col-sm-6">
							<input type="text" name="slta_tahun_masuk" placeholder="Tahun Masuk*">
						</div>
						<div class="col-sm-6">
							<input type="text" name="slta_tahun_lulus" placeholder="Tahun Lulus*">
						</div>
					</div>

					<h3 class="fs-subtitle" style="text-align: left;">Diploma</h3> 
					<input type="text" name="diploma_institusi" placeholder="Nama Institusi*"><br>
					<input type="text" name="diploma_bidang_studi" placeholder="Bidang Studi*"><br>
					<div class="row">
						<div class="col-sm-6">
							<input type="text" name="diploma_tahun_masuk" placeholder="Tahun Masuk*">
						</div>
						<div class="col-sm-6">
							<input type="text" name="diploma_tahun_lulus" placeholder="Tahun Lulus*">
						</div>
					</div>

					<h3 class="fs-subtitle" style="text-align: left;">Sarjana</h3> 
					<input type="text" name="sarjana_institusi" placeholder="Nama Institusi*"><br>
					<input type="text" name="sarjana_bidang_studi" placeholder="Bidang Studi*"><br>
					<div class="row">
						<div class="col-sm-6">
							<input type="text" name="sarjana_tahun_masuk" placeholder="Tahun Masuk*">
						</div>
						<div class="col-sm-6">
							<input type="text" name="sarjana_tahun_lulus" placeholder="Tahun Lulus*">
						</div>
					</div>

					<h3 class="fs-subtitle" style="text-align: left;">Lain-lain</h3> 
					<input type="text" name="lainnya_institusi" placeholder="Nama Institusi*"><br>
					<input type="text" name="lainnya_bidang_studi" placeholder="Bidang Studi*"><br>
					<div class="row">
						<div class="col-sm-6">
							<input type="text" name="lainnya_tahun_masuk" placeholder="Tahun Masuk*">
						</div>
						<div class="col-sm-6">
							<input type="text" name="lainnya_tahun_lulus" placeholder="Tahun Lulus*">
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
	<script type="text/javascript">
		$('#nextMyModal').click(function(){
			$('.myModal').hide();
			$('#form_1').show();
		});
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'></script>
	<script type="text/javascript" src="js/sipikti.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	
</body>
</html>