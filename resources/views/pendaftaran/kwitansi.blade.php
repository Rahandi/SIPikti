<!DOCTYPE html>
<html>
<head>
	<title>Kwitansi</title>
	<link rel="stylesheet" type="text/css" href="../css/style2.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
	<style>@page { size: A4 potrait }</style>
</head>
<body onload="window.print()" class="A4 potrait">
	<div class="container" style="margin: 5% 6% 3% 6%;
	font-family: Tahoma;
	/*font-weight: 1000;*/
	">
		<div class="row" style="text-align: center;">
			<b>PIKTI - ITS</b><br>
			<b>Pendidikan Informatika dan Komputer Terapan</b><br>
			<b>Institut Teknologi Sepuluh Nopember Surabaya</b><br>
			Gedung Teknik Informatika Lt. 1 Jl. Raya ITS, Kampus ITS Sukolilo, Surabaya 60111<br>
		</div>
		<br><hr>
		<div class="row" style="text-align: left; margin-left: 3%;">
			<p>Nomor Reg. {{$data['pendaftar']->nomor_pendaftaran}}</p>
			<table style="margin-top: 5%;">
				<tr>
					<td style="width: 25%;">SUDAH TERIMA</td>
					<td>:</td>
					<td>Atas Nama {{$data['pendaftar']->nama}} dengan No. Pend {{$data['pendaftar']->nomor_pendaftaran}}</td>
				</tr>
				<tr>
					<td>TERBILANG</td>
					<td>:</td>
					<td>Empat Ratus Ribu Rupiah</td>
				</tr>
				<tr>
					<td>GUNA</td>
					<td>:</td>
					<td>Pembayaran Pendaftaran PIKTI tanggal {{$data['date']}}</td>
				</tr>
				<tr>
					<td>UANG RP</td>
					<td>:</td>
					<td>400.000</td>
				</tr>
			</table>
		</div>
		<br>
		<div class="row" style="margin-left: 50%; text-align: center;">
			Surabaya, {{$data['pendaftar']->tanggal_verifikasi}}<br><br><br><br><br><br>
			{{$data['pendaftar']->administrator}}
		</div>
		<br><hr>
		<div class="row">
			Kwitansi ini sah apabila disertai dengan stempel dan tanda tangan dari PIKTI-ITS
		</div>
	</div>
</body>
<script>
	// $(".button-print").click(function(){
	// 	window.print();
	// });
	function clickPrint() {
		window.print();
	}
</script>
</html>