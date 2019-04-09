<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Pendaftaran PIKTI</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Font-->
	<link rel="stylesheet" type="text/css" href="css/opensans-font.css">
	<link rel="stylesheet" type="text/css" href="css/material-design-iconic-font.min.css">
	<!-- datepicker -->
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css">
	<!-- Main Style Css -->
	<link rel="stylesheet" href="css/style2.css"/>
</head>
<body>
	<div class="page-content">
		<div class="wizard-heading">Form Pendaftaran PIKTI</div>
		<div class="wizard-v6-content">
			<div class="wizard-form">
				<form class="form-register" id="form-register" action="{{route('daftar.store')}}" enctype="multipart/form-data" method="post">
					{{ csrf_field() }}
					<div id="form-total">
						<!-- SECTION 1 -->
						<h2>
							<p class="step-icon"><span>1</span></p>
							<span class="step-text">Data Pribadi</span>
						</h2>
						<section>
							<div class="inner">
								<div class="form-heading">
									<h3>Data Pribadi</h3>
									<span>1/3</span>
								</div>
								<div class="form-row">
									<div class="form-holder">
										<label class="form-row-inner">
											<input type="text" name="nomor_pendaftaran" class="form-control" required>
											<span class="label">Nomor Pendaftaran</span>
										</label>
									</div>
									<div class="form-holder">
										<label class="form-row-inner">
											<input type="text" class="form-control" name="nama" required>
											<span class="label">Nama Lengkap</span>
										</label>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder form-holder-2">
										<label class="form-row-inner">
											<input type="text" class="form-control" name="nama_gelar" required>
											<span class="label">Nama Lengkap dengan Gelar</span>
										</label>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder" style="margin-bottom: 0px;">
										<label class="form-row-inner">
											<input type="text" name="tempat_lahir" class="form-control"  required>
											<span class="label">Tempat Lahir</span>
										</label>
									</div>
									<div class="form-holder">
										<label class="form-row-inner">
											<input type="date" name="tanggal_lahir" class="form-control" required>
											<span class="label" style="margin-left: 30%;">Tanggal Lahir</span>
										</label>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder">
										<label class="form-row-inner">
											<input type="text" name="jenis_kelamin" class="form-control" required>
											<span class="label">Jenis Kelamin</span>
										</label>
									</div>
									<div class="form-holder">
										<label class="form-row-inner">
											<input type="text" class="form-control" name="agama" required>
											<span class="label">Agama / Kepercayaan</span>
										</label>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder">
										<label class="form-row-inner">
											<input type="text" class="form-control" name="status_perkawinan" required>
											<span class="label">Status Perkawinan</span>
										</label>
									</div>
									<div class="form-holder">
										<label class="form-row-inner">
											<input type="text" name="nomor_handphone" class="form-control" required>
											<span class="label">Nomor Handphone</span>
										</label>
									</div>
								</div>
								<div class="form-heading">
									<h3>Alamat Asal</h3>
								</div>
								<div class="form-row">
									<div class="form-holder">
										<label class="form-row-inner">
											<input type="text" class="form-control" name="asal_jalan" required>
											<span class="label">Jalan</span>
										</label>
									</div>
									<div class="form-holder">
										<label class="form-row-inner">
											<input type="text" name="asal_kelurahan" class="form-control" required>
											<span class="label">Kelurahan</span>
										</label>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder">
										<label class="form-row-inner">
											<input type="text" class="form-control" name="asal_kecamatan" required>
											<span class="label">Kecamatan</span>
										</label>
									</div>
									<div class="form-holder">
										<label class="form-row-inner">
											<input type="text" class="form-control" name="asal_kabupaten" required>
											<span class="label">Kabupaten</span>
										</label>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder">
										<label class="form-row-inner">
											<input type="text" name="asal_kode_pos" class="form-control"  required>
											<span class="label">Kode Pos</span>
										</label>
									</div>
									<div class="form-holder">
										<label class="form-row-inner">
											<input type="text" name="asal_telepon" class="form-control" required>
											<span class="label">Telepon</span>
										</label>
									</div>
								</div>
								<div class="form-heading">
									<h3>Alamat Surabaya</h3>
								</div>
								<div class="form-row">
									<div class="form-holder">
										<label class="form-row-inner">
											<input type="text" class="form-control" name="surabaya_jalan" required>
											<span class="label">Jalan</span>
										</label>
									</div>
									<div class="form-holder">
										<label class="form-row-inner">
											<input type="text" name="surabaya_kelurahan" class="form-control" required>
											<span class="label">Kelurahan</span>
										</label>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder">
										<label class="form-row-inner">
											<input type="text" class="form-control" name="surabaya_kecamatan" required>
											<span class="label">Kecamatan</span>
										</label>
									</div>
									<div class="form-holder">
										<label class="form-row-inner">
											<input type="text" class="form-control" name="surabaya_kabupaten" required>
											<span class="label">Kabupaten</span>
										</label>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder">
										<label class="form-row-inner">
											<input type="text" name="surabaya_kode_pos" class="form-control"  required>
											<span class="label">Kode Pos</span>
										</label>
									</div>
									<div class="form-holder">
										<label class="form-row-inner">
											<input type="text" name="surabaya_telepon" class="form-control" required>
											<span class="label">Telepon</span>
										</label>
									</div>
								</div>
							</div>
						</section>
						<!-- SECTION 2 -->
						<h2>
							<p class="step-icon"><span>2</span></p>
							<span class="step-text">Pendidikan</span>
						</h2>
						<section>
							<div class="inner">
								<div class="form-heading">
									<h3>Jenjang Pendidikan</h3>
									<span>2/3</span>
								</div>
								<h3 style="color: white;">SD</h3>
								<div id="sd_pendidikan">
									<div class="form-row">
										<div class="form-holder">
											<label class="form-row-inner">
												<input type="text" class="form-control" name="sd_institusi" required>
												<span class="label">Nama Institusi</span>
											</label>
										</div>
										<div class="form-holder">
											<label class="form-row-inner">
												<input type="text" class="form-control" name="sd_bidang_studi" required>
												<span class="label">Bidang Studi</span>
											</label>
										</div>
									</div>
									<div class="form-row">
										<div class="form-holder">
											<label class="form-row-inner">
												<input type="number" class="form-control" name="sd_tahun_masuk" min="1850" max="2019" required>
												<span class="label">Tahun Masuk</span>
											</label>
										</div>
										<div class="form-holder">
											<label class="form-row-inner">
												<input type="number" class="form-control" name="sd_tahun_lulus" min="1850" max="2019" required>
												<span class="label">Tahun Lulus</span>
											</label>
										</div>
									</div>
								</div>
								<h3 style="color: white;">SLTP</h3>
								<div id="sltp_pendidikan">
									<div class="form-row">
										<div class="form-holder">
											<label class="form-row-inner">
												<input type="text" class="form-control" name="sd_institusi" required>
												<span class="label">Nama Institusi</span>
											</label>
										</div>
										<div class="form-holder">
											<label class="form-row-inner">
												<input type="text" class="form-control" name="sd_bidang_studi" required>
												<span class="label">Bidang Studi</span>
											</label>
										</div>
									</div>
									<div class="form-row">
										<div class="form-holder">
											<label class="form-row-inner">
												<input type="number" class="form-control" name="sd_tahun_masuk" min="1850" max="2019" required>
												<span class="label">Tahun Masuk</span>
											</label>
										</div>
										<div class="form-holder">
											<label class="form-row-inner">
												<input type="number" class="form-control" name="sd_tahun_lulus" min="1850" max="2019" required>
												<span class="label">Tahun Lulus</span>
											</label>
										</div>
									</div>
								</div>
								<h3 style="color: white;">SLTA</h3>
								<div id="slta_pendidikan">
									<div class="form-row">
										<div class="form-holder">
											<label class="form-row-inner">
												<input type="text" class="form-control" name="sd_institusi" required>
												<span class="label">Nama Institusi</span>
											</label>
										</div>
										<div class="form-holder">
											<label class="form-row-inner">
												<input type="text" class="form-control" name="sd_bidang_studi" required>
												<span class="label">Bidang Studi</span>
											</label>
										</div>
									</div>
									<div class="form-row">
										<div class="form-holder">
											<label class="form-row-inner">
												<input type="number" class="form-control" name="sd_tahun_masuk" min="1850" max="2019" required>
												<span class="label">Tahun Masuk</span>
											</label>
										</div>
										<div class="form-holder">
											<label class="form-row-inner">
												<input type="number" class="form-control" name="sd_tahun_lulus" min="1850" max="2019" required>
												<span class="label">Tahun Lulus</span>
											</label>
										</div>
									</div>
								</div>
								<h3 style="color: white;">Diploma</h3>
								<div id="diploma_pendidikan">
									<div class="form-row">
										<div class="form-holder">
											<label class="form-row-inner">
												<input type="text" class="form-control" name="sd_institusi" required>
												<span class="label">Nama Institusi</span>
											</label>
										</div>
										<div class="form-holder">
											<label class="form-row-inner">
												<input type="text" class="form-control" name="sd_bidang_studi" required>
												<span class="label">Bidang Studi</span>
											</label>
										</div>
									</div>
									<div class="form-row">
										<div class="form-holder">
											<label class="form-row-inner">
												<input type="number" class="form-control" name="sd_tahun_masuk" min="1850" max="2019" required>
												<span class="label">Tahun Masuk</span>
											</label>
										</div>
										<div class="form-holder">
											<label class="form-row-inner">
												<input type="number" class="form-control" name="sd_tahun_lulus" min="1850" max="2019" required>
												<span class="label">Tahun Lulus</span>
											</label>
										</div>
									</div>
								</div>
								<h3 style="color: white;">Sarjana</h3>
								<div id="sarjana_pendidikan">
									<div class="form-row">
										<div class="form-holder">
											<label class="form-row-inner">
												<input type="text" class="form-control" name="sd_institusi" required>
												<span class="label">Nama Institusi</span>
											</label>
										</div>
										<div class="form-holder">
											<label class="form-row-inner">
												<input type="text" class="form-control" name="sd_bidang_studi" required>
												<span class="label">Bidang Studi</span>
											</label>
										</div>
									</div>
									<div class="form-row">
										<div class="form-holder">
											<label class="form-row-inner">
												<input type="number" class="form-control" name="sd_tahun_masuk" min="1850" max="2019" required>
												<span class="label">Tahun Masuk</span>
											</label>
										</div>
										<div class="form-holder">
											<label class="form-row-inner">
												<input type="number" class="form-control" name="sd_tahun_lulus" min="1850" max="2019" required>
												<span class="label">Tahun Lulus</span>
											</label>
										</div>
									</div>
								</div>
								<h3 style="color: white;">Lain-lain</h3>
								<div id="lain_pendidikan">
									<div class="form-row">
										<div class="form-holder">
											<label class="form-row-inner">
												<input type="text" class="form-control" name="sd_institusi" required>
												<span class="label">Nama Institusi</span>
											</label>
										</div>
										<div class="form-holder">
											<label class="form-row-inner">
												<input type="text" class="form-control" name="sd_bidang_studi" required>
												<span class="label">Bidang Studi</span>
											</label>
										</div>
									</div>
									<div class="form-row">
										<div class="form-holder">
											<label class="form-row-inner">
												<input type="number" class="form-control" name="sd_tahun_masuk" min="1850" max="2019" required>
												<span class="label">Tahun Masuk</span>
											</label>
										</div>
										<div class="form-holder">
											<label class="form-row-inner">
												<input type="number" class="form-control" name="sd_tahun_lulus" min="1850" max="2019" required>
												<span class="label">Tahun Lulus</span>
											</label>
										</div>
									</div>
								</div>
							</div>
						</section>
						<!-- SECTION 3 -->
						<h2>
							<p class="step-icon"><span>3</span></p>
							<span class="step-text">Informasi</span>
						</h2>
						<section>
							<div class="inner">
								<div class="form-heading">
									<h3>Informasi Tambahan</h3>
									<span>3/3</span>
								</div>
								<h3 style="color: white;">Status pada saat mendaftar:</h3>
								<div class="form-row" style="color: white; width: 100%;">
									<div class="form-check form-check-inline" style="width: 100%;">
										<input class="form-check-input" type="checkbox" id="cb1" name="lulus_sma">
										<label class="form-check-label" for="cb1">Lulus&nbsp;SMA</label>
										<input class="form-check-input" type="checkbox" id="cb2" name="mahasiswa">
										<label class="form-check-label" for="cb2">Mahasiswa</label>
										<input class="form-check-input" type="checkbox" id="cb3" name="bekerja">
										<label class="form-check-label" for="cb3">Bekerja</label>
									</div>
								</div>
								<h3 style="color: white;">Mengetahui program ini dari:</h3>
								<div class="form-row" style="color: white; width: 100%;">
									<div class="form-check form-check-inline" style="width: 100%;">
										<input class="form-check-input" type="checkbox" id="cb4" name="koran">
										<label class="form-check-label" for="cb4">Koran</label>
										<input class="form-check-input" type="checkbox" id="cb5" name="spanduk" style="margin-left: 5%;">
										<label class="form-check-label" for="cb5">Spanduk</label>
										<input class="form-check-input" type="checkbox" id="cb6" name="brosur" style="margin-left: 5%;">
										<label class="form-check-label" for="cb6">Brosur</label>

										<input class="form-check-input" type="checkbox" id="cb7" name="teman_saudara">
										<label class="form-check-label" for="cb7">Teman&nbsp;/&nbsp;Saudara</label>
										<input class="form-check-input" type="checkbox" id="cb8" name="pameran" style="margin-left: 5%;">
										<label class="form-check-label" for="cb8">Pameran</label>
										<input class="form-check-input" type="checkbox" id="cb9" name="lainnya" style="margin-left: 5%;">
										<label class="form-check-label" for="cb9">Lainnya</label>
									</div>
								</div>
							</div>
						</section>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="js/sipikti.js"></script>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/jquery.steps.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/main.js"></script>
	
</body>
</html>