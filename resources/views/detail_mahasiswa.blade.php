@extends('layouts.master')

@section('pagetitle')
	Detail Mahasiswa
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
					</table>
					<table style="width: 100%; margin-top: 2%;">
						<tr>
							<td style="width: 50%; text-align: right;">
								<a href="{{ route('mahasiswa.edit',$data->id) }}" style="margin-right: 2%;"><button type="button" class="btn btn-warning">Edit <i class="material-icons" style="font-size: 18px;">mode_edit</i></button></a>
							</td>
							<td style="width: 50%;text-align: left;">
								<button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#modalDel" style="margin: 2%;">Delete <i class="material-icons" style="font-size: 18px;">delete</i></button>
							</td>
						</tr>

					</table>
				</div>
			</div>
		</div>
	</div>
	<div id="modalDel" class="modal fade" role="dialog" style="z-index: 9999;">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Konfirmasi</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body" style="text-align: left;">
					<p>Apakah Anda yakin akan menghapus data ini?</p>
				</div>
				<div class="modal-footer" style="width: 100%;">
					<form action="{{route('mahasiswa.delete')}}" method="POST">
						{{ csrf_field() }}
						<input type="hidden" name="id" value="{{$data->id}}">
						<button type="submit" class="btn btn-danger">Ya</button>
					</form>
					<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script>
	<script type="text/javascript" src="{{ URL::asset('js/sipikti.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
@endsection