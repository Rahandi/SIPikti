@extends('layouts.master')

@section('pagetitle')
	Detail Pendaftar
@endsection

@section('css')
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">
	<style type="text/css">
		i.material-icons {
			vertical-align: middle;
		}
	</style>
@endsection

@section('content')
	<div class="row">
		<div class="col-sm-12">
			<div class="white-box">
				<div class="row row-in">
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
						<tr>
							<td>Verifikator</td>
							<td>:</td>
							<td>{{ $data->administrator }}</td>
						</tr>
						<tr>
							<td>Tanggal Verifikasi</td>
							<td>:</td>
							<td>{{ $data->tanggal_verifikasi }}</td>
						</tr>
					</table>
					<table style="width: 100%; margin-top: 2%;">
						<tr>
							<td style="width: 30%;text-align: right;">
								<a 
								@if ($data->administrator)
									href="{{ route('kwitansi',$data->id) }}"
								@endif
								target="_blank" style="margin-right: 2%;"><button type="button" class="btn btn-info"
								@if (!$data->administrator)
									disabled=""
								@endif
								>Print <i class="material-icons" style="font-size: 18px;">print</i></button></a>
							</td>
							<td style="width: 10%;text-align: center;">
								<button type="submit" class="btn btn-success" style="margin: 2%;" onclick="document.getElementById('modalVerif').style.display='block'"
								@if($data->nomor_pendaftaran)
									disabled="disabled"
								@endif
								>Verifikasi <i class="material-icons" style="font-size: 18px;">check</i></button>
							</td>
							<td style="width: 5%; text-align: center;">
								<a href="{{ route('edit',$data->id) }}" style="margin-right: 2%;"><button type="button" class="btn btn-warning">Edit <i class="material-icons" style="font-size: 18px;">mode_edit</i></button></a>
							</td>
							<td style="width: 5%;text-align: center;">
								<button type="submit" class="btn btn-danger" onclick="document.getElementById('modalDelete').style.display='block'" style="margin: 2%;">Delete <i class="material-icons" style="font-size: 18px;">delete</i></button>
							</td>
							<td style="width: 30%;text-align: left;">
								<form action="{{ route('accept_mahasiswa') }}" method="POST">
								{{csrf_field()}}
								<input type="hidden" name="id" value="{{$data->id}}">
								<button type="submit" class="btn btn-success" style="margin: 2%;" 
								@if (!$data->administrator or $data->status == 1)
									disabled=""
								@endif
								>Terima <i class="material-icons" style="font-size: 18px;">person_add</i></button>
								</form>
							</td>
						</tr>

					</table>
				</div>
			</div>
		</div>
	</div>
	<div id="modalDelete" class="w3-modal w3-round-xlarge" style="z-index: 99999;">
		<div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round-large" style="width: 40%;">
			<header class="w3-container w3-light-grey w3-round-large"> 
				<span onclick="document.getElementById('modalDelete').style.display='none'" 
				class="w3-button w3-display-topright w3-round-large">&times;</span>
				<h2>Konfirmasi</h2>
			</header>
			<div class="w3-container" style="margin-top: 2%;">
				<p>Apakah Anda yakin akan menghapus data ini?</p>
			</div>
			<footer class="w3-container w3-light-grey w3-round-large" style="text-align: right;">
				<form action="{{route('delete')}}" method="POST">
					{{ csrf_field() }}
					<input type="hidden" name="id" value="{{$data->id}}">
					<button type="submit" class="btn btn-success" style="margin: 1%;">Ya</button>
					<button type="button" class="btn btn-danger" onclick="document.getElementById('modalDelete').style.display='none'" style="margin: 1%;">Tidak</button>
				</form>
			</footer>
		</div>
	</div>
	<div id="modalVerif" class="w3-modal w3-round-xlarge" style="z-index: 99999;">
		<div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round-large" style="width: 40%;">
			<header class="w3-container w3-light-grey w3-round-large"> 
				<span onclick="document.getElementById('modalVerif').style.display='none'" 
				class="w3-button w3-display-topright w3-round-large">&times;</span>
				<h2>Konfirmasi</h2>
			</header>
			<form 
			@if(!$data->nomor_pendaftaran)
				action="{{route('verif')}}" 
			@endif
			method="POST">
			{{ csrf_field() }}
			<div class="w3-container" style="margin-top: 2%;">
				<p>Verifikasi Pendaftar menggunakan:</p>
				<input type="radio" name="toolVerif" value="Ijazah">&nbsp;Ijazah<br>
				<input type="radio" name="toolVerif" value="SKL">&nbsp;SKL<br>
				<input type="radio" name="toolVerif" value="Lainnya">&nbsp;Lainnya: <input type="text" name="lainnya">
			</div>
			<footer class="w3-container w3-light-grey w3-round-large" style="text-align: right;">
					<input type="hidden" name="id" value="{{$data->id}}">
					<button type="submit" class="btn btn-success" style="margin: 1%;">Ya</button>
					<button type="button" class="btn btn-danger" onclick="document.getElementById('modalVerif').style.display='none'" style="margin: 1%;">Tidak</button>
			</footer>
			</form>
		</div>
	</div>
@endsection

@section('js')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../js/sipikti.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
@endsection