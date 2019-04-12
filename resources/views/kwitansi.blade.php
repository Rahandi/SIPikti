<!DOCTYPE html>
<html>
<head>
	<title>Kwitansi</title>
	<link rel="stylesheet" type="text/css" href="css/style2.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div class="container" style="margin: 2% 6% 3% 6%;">
		<div id="overlay">
			<button><i class="fa fa-print" style="font-size: 20px;"></i></button>
		</div>
		<div class="row" style="text-align: center;">
			<b>PIKTI - ITS</b><br>
			<b>Pendidikan Informatika dan Komputer Terapan</b><br>
			<b>Institut Teknologi Sepuluh Nopember Surabaya</b><br>
			Gedung Teknik Informatika Lt. 1 Jl. Raya ITS, Kampus ITS Sukolilo, Surabaya 60111<br>
		</div>
		<br><hr>
		<div class="row" style="text-align: left; margin-left: 3%;">
			<p>Nomor Reg. {{$data->nomor_pendaftaran}}</p>
			<table style="margin-top: 5%;">
				<tr>
					<td style="width: 25%;">SUDAH TERIMA</td>
					<td>:</td>
					<td>Atas Nama {{$data->nama}} dengan No. Pend {{$data->nomor_pendaftaran}}</td>
				</tr>
				<tr>
					<td>TERBILANG RP</td>
					<td>:</td>
					<td>400.000</td>
				</tr>
				<tr>
					<td>GUNA</td>
					<td>:</td>
					<td>Pembayaran Pendaftaran PIKTI tanggal {{date("d F Y")}}</td>
				</tr>
				<tr>
					<td>UANG</td>
					<td>:</td>
					<td>Empat Ratus Ribu Rupiah</td>
				</tr>
			</table>
		</div>
		<br>
		<div class="row" style="margin-left: 50%; text-align: center;">
			Surabaya, {{date("d F Y")}}<br><br><br><br><br><br>
			{{$data->administrator}}
		</div>
		<br><br><hr>
		<div class="row">
			Kwitansi ini sah apabila disertai dengan stempel dan tanda tangan dari PIKTI-ITS
		</div>
	</div>
</body>
</html>