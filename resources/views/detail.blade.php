@extends('layouts.app')

@section('title')
	Detail Pendaftar
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/form.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endsection

@section('content')
	<div class="row" style="align-content: center; margin-top: 2%; margin-bottom: 5%; width: 100%;">
		<div class="col-sm-10 col-md-offset-10 mx-auto" style="z-index: 1;width: 100%; border-radius: 10px;">
			<h4 style="text-align: center;">Detail Pendaftar</h4>
			<div class="row" style="margin: 2%; width: 90%;">
				<table style="width: 90%;">
					<tr>
						<td style="width: 30%;">Nomor Pendaftaran</td>
						<td style="width: 1%;">:</td>
						<td>{{ $data->nomor_pendaftaran }}</td>
					</tr>
					<tr>
						<td>Nama</td>
						<td>:</td>
						<td>{{ $data->nama }}</td>
					</tr>
					<tr>
						<td>Nama dengan Gelar</td>
						<td>:</td>
						<td>{{ $data->nama_gelar }}</td>
					</tr>
					<tr>
						<td>Tempat Lahir</td>
						<td>:</td>
						<td>{{ $data->tempat_lahir }}</td>
					</tr>
					<tr>
						<td>Tanggal Lahir</td>
						<td>:</td>
						<td>{{ $data->tanggal_lahir }}</td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>:</td>
						<td>{{ $data->jenis_kelamin }}</td>
					</tr>
					<tr>
						<td>Agama</td>
						<td>:</td>
						<td>{{ $data->agama }}</td>
					</tr>
					<tr>
						<td>Status Perkawinan</td>
						<td>:</td>
						<td>{{ $data->status_perkawinan }}</td>
					</tr>
					<tr>
						<td>No. Handphone</td>
						<td>:</td>
						<td>{{ $data->nomor_handphone }}</td>
					</tr>
				</table>
				<table class="table table-bordered" style="margin-top: 2%;width: 90%;">
					<thead class="thead-dark">
					<tr style="text-align: center;">
						<th>Jenjang Pendidikan</th>
						<th>Nama Institusi</th>
						<th>Bidang Studi</th>
						<th>Tahun Masuk</th>
						<th>Tahun Lulus</th>
					</tr>
					</thead>
					<tbody>
					@foreach ($data->pendidikan as $pend)
						<tr>
							<th>{{ $pend->jenjang_pendidikan }}</th>
							<th>{{ $pend->institusi }}</th>
							<th>{{ $pend->bidang_studi }}</th>
							<th>{{ $pend->tahun_masuk }}</th>
							<th>{{ $pend->tahun_lulus }}</th>
						</tr>
					@endforeach
					</tbody>
				</table>
				<table style="width: 90%;">
					<tr>
						<td style="width: 30%;">Status saat mendaftar</td>
						<td style="width: 1%;">:</td>
						<td>{{ $data->status_saat_mendaftar }}</td>
					</tr>
					<tr>
						<td>Mengetahui Program ini dari</td>
						<td>:</td>
						<td>{{ $data->sumber_informasi }}</td>
					</tr>
				</table>
			</div>
			<div class="row" style="margin-right: 0px;">
				<table>
					<tr style="margin-right: 0px;">
						<form action="{{route('verif')}}" method="POST" style="margin-right: 0px;">
						{{ csrf_field() }}
						<input type="hidden" name="id" value="{{$data->id}}">
						<button type="submit" class="btn btn-success"><i class="material-icons" style="font-size: 18px;">check</i></button>
						</form>
					</tr>
					<tr>
						<form action="{{route('delete')}}" method="POST">
						{{ csrf_field() }}
						<input type="hidden" name="id" value="{{$data->id}}">
						<button type="submit" class="btn btn-danger"><i class="material-icons" style="font-size: 18px;">delete</i></button>
						</form>
					</tr>
				</table>
			</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../js/sipikti.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
@endsection