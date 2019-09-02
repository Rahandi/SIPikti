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
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/form.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">

</head>
<body onkeypress="return noEnter()">
	<div class="row" style="align-content: center; margin-top: 3%; margin-bottom: 5%;font-size: 17px;">
		<div class="col-sm-10 col-md-offset-10 mx-auto" style="z-index: 1;">
			<form id="msform" method="POST" action="{{route('daftar.store')}}" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div id="form_1">
				<ul id="progressbar">
					<li class="active">Data Pribadi</li>
					<li>Pendidikan</li>
					<li>Lainnya</li>
				</ul>

				<fieldset>
					<h2 class="fs-title">Data Pribadi</h2>
					<h3 class="fs-subtitle">Isikan data pribadi Anda secara jelas dan benar</h3>
					<label>Nama Lengkap</label><span id="nama_label" style="display: none;"><strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon diisi</strong></span>
					<input type="text" name="nama" id="nama" placeholder="contoh: Fina Yunita" required="required" /><br>
					
					<label>Nama Lengkap dengan gelar</label><span id="nama_gelar_label" style="display: none;"><strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon diisi</strong></span>
					<input type="text" name="nama_gelar" id="nama_gelar" placeholder="contoh: Fina Yunita, S.Kom" ><br>
					
					<div class="row">
						<div class="col-sm-6">
							<label>Tempat Lahir</label><span id="tempat_lahir_label" style="display: none;"><strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon diisi</strong></span>
							<input type="text" name="tempat_lahir" id="tempat_lahir" placeholder="contoh: Kediri">
						</div>
						<div class="col-sm-6">
							<label>Tanggal Lahir</label><span id="tanggal_lahir_label" style="display: none;"><strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon diisi</strong></span>
							<input type="date" name="tanggal_lahir" id="tanggal_lahir" >
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<label>Jenis Kelamin</label>
							<div class="form-group">
								<select class="form-control" name="jenis_kelamin">
									<option value="Laki-laki">Laki-laki</option>
									<option value="Perempuan">Perempuan</option>
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
					<label>Nomor Handphone</label><span id="nomor_handphone_label" style="display: none;"><strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon diisi</strong></span>
					<input type="text" name="nomor_handphone" id="nomor_handphone" placeholder="contoh: 08xxx" ><br>

					<h3 class="fs-subtitle" style="font-size: 17px;">Alamat Asal</h3>
					<label>Jalan</label><span id="asal_jalan_label" style="display: none;"><strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon diisi</strong></span>
					<input type="text" name="asal_jalan" id="asal_jalan" placeholder="contoh: Ahmad Yani 22" ><br>
					<div class="row">
						<div class="col-sm-6">
							<label>Kelurahan</label><span id="asal_kelurahan_label" style="display: none;"><strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon diisi</strong></span>
							<input type="text" name="asal_kelurahan" id="asal_kelurahan" placeholder="contoh: Pare" >
						</div>
						<div class="col-sm-6">
							<label>Desa/Kecamatan</label><span id="asal_kecamatan_label" style="display: none;"><strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon diisi</strong></span>
							<input type="text" name="asal_kecamatan" id="asal_kecamatan" placeholder="contoh: Pare" >
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<label>Kabupaten/Kota</label><span id="asal_kabupaten_label" style="display: none;"><strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon diisi</strong></span>
							<input type="text" name="asal_kabupaten" id="asal_kabupaten" placeholder="contoh: Kediri" >
						</div>
						<div class="col-sm-6">
							<label>Kode Pos</label><span id="asal_kode_pos_label" style="display: none;"><strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon diisi</strong></span>
							<input type="text" name="asal_kode_pos" id="asal_kode_pos" placeholder="contoh: 64210" >
						</div>
					</div>
					<label>Telepon</label><span id="asal_telepon_label" style="display: none;"><strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon diisi</strong></span>
					<input type="text" name="asal_telepon" id="asal_telepon" placeholder="contoh: 08xxx" ><br>

					<h3 class="fs-subtitle" style="font-size: 17px;">Alamat Surabaya</h3>
					<label>Jalan</label><span id="surabaya_jalan_label" style="display: none;"><strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon diisi</strong></span>
					<input type="text" name="surabaya_jalan" id="surabaya_jalan" placeholder="contoh: Kejawan Gebang 23A" ><br>
					<div class="row">
						<div class="col-sm-6">
							<label>Kelurahan</label><span id="surabaya_kelurahan_label" style="display: none;"><strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon diisi</strong></span>
							<input type="text" name="surabaya_kelurahan" id="surabaya_kelurahan" placeholder="contoh: Gebang Putih" >
						</div>
						<div class="col-sm-6">
							<label>Desa/Kecamatan</label><span id="surabaya_kecamatan_label" style="display: none;"><strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon diisi</strong></span>
							<input type="text" name="surabaya_kecamatan" id="surabaya_kecamatan" placeholder="contoh: Sukolilo" >
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6">
							<label>Kabupaten/Kota</label><span id="surabaya_kabupaten_label" style="display: none;"><strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon diisi</strong></span>
							<input type="text" name="surabaya_kabupaten" id="surabaya_kabupaten" placeholder="contoh: Surabaya" >
						</div>
						<div class="col-sm-6">
							<label>Kode Pos</label><span id="surabaya_kode_pos_label" style="display: none;"><strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon diisi</strong></span>
							<input type="text" name="surabaya_kode_pos" id="surabaya_kode_pos" placeholder="contoh: 60111" >
						</div>
					</div>
					<label>Telepon</label><span id="surabaya_telepon_label" style="display: none;"><strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon diisi</strong></span>
					<input type="text" name="surabaya_telepon" id="surabaya_telepon" placeholder="contoh: 08xxx" ><br>
					
					<input type="button" name="next" class="next1 action-button" value="Next" style="text-align: center;"/>
				</fieldset>
				<fieldset>
					<h2 class="fs-title">Jenjang Pendidikan</h2>

					<h3 class="fs-subtitle" style="font-size: 17px;"><strong>SD</strong></h3>
					<label>Nama Institusi</label><span id="sd_institusi_label" style="display: none;"><strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon dilengkapi</strong></span>
					<input type="text" name="sd_institusi" id="sd_institusi" placeholder="contoh: SDN Pare 2" ><br>
					<div class="row">
						<div class="col-sm-6">
							<label>Tahun Masuk</label><span id="sd_tahun_masuk_label" style="display: none;"><strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon dilengkapi</strong></span>
							<input type="text" name="sd_tahun_masuk" id="sd_tahun_masuk" placeholder="contoh: 2004" >
						</div>
						<div class="col-sm-6">
							<label>Tahun Lulus</label><span id="sd_tahun_lulus_label" style="display: none;"><strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon dilengkapi</strong></span>
							<input type="text" name="sd_tahun_lulus" id="sd_tahun_lulus" placeholder="contoh: 2010" >
						</div>
					</div>

					<h3 class="fs-subtitle" style="font-size: 17px;"><strong>SLTP</strong></h3>
					<label>Nama Institusi</label><span id="sltp_institusi_label" style="display: none;"><strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon dilengkapi</strong></span>
					<input type="text" name="sltp_institusi" id="sltp_institusi" placeholder="contoh: SMPN 2 Pare" ><br>
					<div class="row">
						<div class="col-sm-6">
							<label>Tahun Masuk</label><span id="sltp_tahun_masuk_label" style="display: none;"><strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon dilengkapi</strong></span>
							<input type="text" name="sltp_tahun_masuk" id="sltp_tahun_masuk" placeholder="contoh: 2010" >
						</div>
						<div class="col-sm-6">
							<label>Tahun Lulus</label><span id="sltp_tahun_lulus_label" style="display: none;"><strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon dilengkapi</strong></span>
							<input type="text" name="sltp_tahun_lulus" id="sltp_tahun_lulus" placeholder="contoh: 2013" >
						</div>
					</div>

					<h3 class="fs-subtitle" style="font-size: 17px;"><strong>SLTA</strong></h3>
					<label>Nama Institusi</label><span id="slta_institusi_label" style="display: none;"><strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon dilengkapi</strong></span>
					<input type="text" name="slta_institusi" id="slta_institusi" placeholder="contoh: SMAN 2 Pare" ><br>
					<label>Bidang Studi</label><span id="slta_bidang_studi_label" style="display: none;"><strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon dilengkapi</strong></span>
					<input type="text" name="slta_bidang_studi" id="slta_bidang_studi" placeholder="contoh: IPA" ><br>
					<div class="row">
						<div class="col-sm-6">
							<label>Tahun Masuk</label><span id="slta_tahun_masuk_label" style="display: none;"><strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon dilengkapi</strong></span>
							<input type="text" name="slta_tahun_masuk" id="slta_tahun_masuk" placeholder="contoh: 2013" >
						</div>
						<div class="col-sm-6">
							<label>Tahun Lulus</label><span id="slta_tahun_lulus_label" style="display: none;"><strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon dilengkapi</strong></span>
							<input type="text" name="slta_tahun_lulus" id="slta_tahun_lulus" placeholder="contoh: 2016" >
						</div>
					</div>

					<h3 class="fs-subtitle" style="font-size: 17px;"><strong>Diploma</strong></h3> 
					<label>Nama Institusi</label>
					<input type="text" name="diploma_institusi" placeholder="contoh: D3 ITS" ><br>
					<label>Bidang Studi</label>
					<input type="text" name="diploma_bidang_studi" placeholder="contoh: Statistika" ><br>
					<div class="row">
						<div class="col-sm-6">
							<label>Tahun Masuk</label>
							<input type="text" name="diploma_tahun_masuk" placeholder="contoh: 2016" >
						</div>
						<div class="col-sm-6">
							<label>Tahun Lulus</label>
							<input type="text" name="diploma_tahun_lulus" placeholder="contoh: 2019" >
						</div>
					</div>

					<h3 class="fs-subtitle" style="font-size: 17px;"><strong>Sarjana</strong></h3>
					<label>Nama Institusi</label>
					<input type="text" name="sarjana_institusi" placeholder="contoh: S1 ITS" ><br>
					<label>Bidang Studi</label>
					<input type="text" name="sarjana_bidang_studi" placeholder="contoh: Teknik Elektro" ><br>
					<div class="row">
						<div class="col-sm-6">
							<label>Tahun Masuk</label>
							<input type="text" name="sarjana_tahun_masuk" placeholder="contoh: 2016" >
						</div>
						<div class="col-sm-6">
							<label>Tahun Lulus</label>
							<input type="text" name="sarjana_tahun_lulus" placeholder="contoh: 2020" >
						</div>
					</div>

					<h3 class="fs-subtitle" style="font-size: 17px;"><strong>Lain-lain</strong></h3> 
					<label>Nama Institusi</label>
					<input type="text" name="lainnya_institusi" placeholder="contoh: Bukalapak" ><br>
					<label>Bidang Studi</label>
					<input type="text" name="lainnya_bidang_studi" placeholder="contoh: HRD" ><br>
					<div class="row">
						<div class="col-sm-6">
							<label>Tahun Masuk</label>
							<input type="text" name="lainnya_tahun_masuk" placeholder="contoh: 2018" >
						</div>
						<div class="col-sm-6">
							<label>Tahun Lulus</label>
							<input type="text" name="lainnya_tahun_lulus" placeholder="contoh: 2019" >
						</div>
					</div>
					<input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
					<input type="button" name="next" class="next2 action-button" value="Next"/>
				</fieldset>
				<fieldset style="text-align: center;">
					<h2 class="fs-title">Informasi Tambahan</h2>
					<h3 class="fs-subtitle" style="font-size: 17px;">Status pada saat mendaftar</h3>
					<table style="width: 100%;">
						<tr>
							<td style="width: 30%;"><span><input type="radio" name="status" value="lulus_sma" >Lulus SMA</span></td>
							<td style="width: 30%;"><span><input type="radio" name="status" value="mahasiswa" >Mahasiswa</span></td>
							<td style="width: 30%;"><span><input type="radio" name="status" value="bekerja" >Bekerja</span></td>
						</tr>
					</table>
					<h3 class="fs-subtitle" style="font-size: 17px;">Mengetahui program ini dari:</h3>
					<table style="width: 100%;">
						<tr>
							<td style="width: 30%;"><input type="checkbox" name="koran" ><span>Koran</span></td>
							<td style="width: 30%;"><input type="checkbox" name="spanduk" ><span>Spanduk</span></td>
							<td style="width: 30%;"><input type="checkbox" name="brosur" ><span>Brosur</span></td>
						</tr>
						<tr>
							<td style="width: 30%;"><input type="checkbox" name="teman_saudara" ><span>Teman / Saudara</span></td>
							<td style="width: 30%;"><input type="checkbox" name="pameran" ><span>Pameran</span></td>
							<td style="width: 30%;"><input type="checkbox" name="lainnya" ><span>Lainnya</span></td>
						</tr>
					</table><br><br>
					<label>Gelombang:</label><span id="gel_label" style="display: none;"><strong style='color:red;font-size:12px;'>&nbsp;&nbsp;* mohon diisi</strong></span>
					<input style="width: 15%;" type="text" name="gelombang" id="gelombang" placeholder="contoh: 1" required="required" /><br>

					<input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
					<input type="submit" name="submit" class="action-button" value="Submit"/>
				</fieldset>
				</div>
			</form>
			<!-- {{ Form::close() }} -->
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript">
		var input = document.getElementsByTagName("INPUT");
		for (i in input){
			if (i>0){
				input[i].addEventListener("keypress", noEnter);
				// input[i].onkeypress = function(){noEnter()};
			}
		}
		function noEnter(){
			return !(window.event && window.event.keyCode == 13);
		}
		$( document ).ready(function() {
			$('#nama').focusout(function(){
				var from = $('#nama').val();
				console.log("change!");
				// console.log(from);
				$('#nama_gelar').val(from);
			});
		});
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script>
	<script type="text/javascript" src="{{ URL::asset('js/sipikti.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
	
</body>
</html>