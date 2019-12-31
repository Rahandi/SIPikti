<!DOCTYPE html>
<html>
<head>
	<title>Download Absensi</title>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style2.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">
	<style type="text/css">
		i.material-icons {
			vertical-align: middle;
		}
		.bordering, .bordering th, .bordering td {
            border-collapse: collapse;
            border: 1px black solid;
        }
	</style>
	<style>@page { size: legal landscape }</style>
</head>
<body onload="window.print()" class="legal landscape">
	<div class="container" style="margin: 5% 6% 3% 6%;font-size: 12px;
	font-family: Tahoma;
	/*font-weight: 1000;*/
	">
		<div class="row" style="text-align: center;">
			<b>PIKTI - ITS</b><br>
			<b>Pendidikan Informatika dan Komputer Terapan</b><br>
			<b>Institut Teknologi Sepuluh Nopember Surabaya</b><br>
			Gedung Teknik Informatika Lt. 1 Jl. Raya ITS, Kampus ITS Sukolilo, Surabaya 60111
		</div><hr>
		<div class="row" style="text-align: left;">
			<table style="margin-top: 1%;">
				<tr>
					<td style="width: 25%;">Kelas</td>
					<td>:</td>
					<td>{{$data->kelas}}</td>
				</tr>
				<tr>
					<td>Mata Kuliah</td>
					<td>:</td>
					<td><strong>{{$data->mata_kuliah}}</strong></td>
				</tr>
				<tr>
					<td>Dosen</td>
					<td>:</td>
					<td>{{$data->dosen}}</td>
				</tr>
				<tr>
					<td>Asisten</td>
					<td>:</td>
					<td>{{$data->asisten->nama}}</td>
				</tr>
			</table>
		</div>
		<br>
		<div class="row" style="text-align: center;width: 100%;">
			<table id="list" class="bordering" style="width: 100%;">
				<thead>
				<tr>
					<th style="width: 3%;">No.</th>
					<th style="width: 15%;">NRP</th>
					<th style="width: 30%;">Nama Mahasiswa</th>
					@for ($i = 1; $i <= 16; $i++)
						<th style="width: 3%;">{{$i}}</th>
					@endfor
				</tr>
				</thead>
				<tbody>
				@foreach ($data->mahasiswa as $individu)
					<tr 
					@if ($individu->urut == 15)
						style="page-break-after: always;"
					@endif>
						<td>{{$individu->urut}}</td>
						<td>{{$individu->nrp}}</td>
						<td style="text-align: left;">{{$individu->nama}}</td>
						@for ($i = 1; $i <= 16; $i++)
						<td></td>
						@endfor
					</tr>
				@endforeach
				<tr>
					<td colspan="3">Jumlah  Mhs  Tidak  Hadir  Kuliah</td>
					@for ($i = 1; $i <= 16; $i++)
						<td></td>
					@endfor
				</tr>
				</tbody>
			</table>
		</div>
	</div>

<link rel="stylesheet" type="text/css" href="{{ URL::asset('js/bootstrap.js') }}">
</body>
</html>