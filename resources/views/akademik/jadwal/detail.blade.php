@extends('layouts.master')

@section('pagetitle')
	Detail Jadwal
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
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
				<div>
					<div class="col-md-6" style="text-align: left;">
						<h3 class="box-title m-b-0">Kelas - {{ $data->kelas->nama }}&nbsp;&nbsp;&nbsp;<span class="label label-danger">{{ $data->hitung }}/30</span></h3>
						<p class="text-muted m-b-30">Semester {{ $data->termin }}</p>
					</div>
					<div class="col-md-6" style="text-align: right;">
						<a data-toggle="tooltip" data-placement="top" title="Edit Kelas" href="{{route('jadwal.edit', $data->id)}}">
							<button class="btn btn-warning"><i class="material-icons" style="font-size: 18px;">mode_edit</i></button>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="Hapus Kelas">
							<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete" id="tombolDel" value="{{$data->id}}"><i class="material-icons" style="font-size: 18px;">delete</i></button>
						</a>
					</div>
				</div>
				<!-- Modal -->
				<div id="modalDelete" class="w3-modal w3-round-xlarge" style="z-index: 99999;">
					<div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round-large" style="width: 40%;">
						<header class="w3-container w3-light-grey w3-round-large"> 
							<span data-dismiss="modal" 
							class="w3-button w3-display-topright w3-round-large">&times;</span>
							<h2>Konfirmasi</h2>
						</header>
						<div class="w3-container" style="margin-top: 2%;">
							<p>Apakah Anda yakin akan menghapus data jadwal ini?</p>
						</div>
						<footer class="w3-container w3-light-grey w3-round-large" style="text-align: right;">
							<form action="{{route('jadwal.delete')}}" method="POST">
								{{ csrf_field() }}
								<input type="hidden" name="id" id="valueId" value="">
								<button type="submit" class="btn btn-success" id="DeleteButton" style="margin: 1%;">Ya</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal" style="margin: 1%;">Tidak</button>
							</form>
						</footer>
					</div>
				</div>
				<div class="row row-in">
					<table id="list" class="table table-striped table-hover table-bordered" style="text-align: center; width: 100%;">
						<thead>
							<tr>
								@if ($data->kelas->nama == 's' || $data->kelas->nama == 'S')
								<th style="width: 20%;text-align: center;">Tanggal</th>
								<th style="width: 25%;text-align: center;">Mata Kuliah</th>
								<th style="width: 30%;text-align: center;">Dosen</th>
								<th style="width: 25%;text-align: center;">Asisten</th>
								@else
								<th style="width: 10%;text-align: center;">Hari</th>
								<th style="width: 25%;text-align: center;">Mata Kuliah</th>
								<th style="width: 25%;text-align: center;">Dosen</th>
								<th style="width: 25%;text-align: center;">Asisten</th>
								<th style="width: 15%;text-align: center;">Absensi</th>
								@endif
							</tr>
						</thead>
						<tbody>
						@if ($data->kelas->nama == 's' || $data->kelas->nama == 'S')
							@for ($i = 0; $i < count($data->matkul); $i++)
								<tr>
									<td class="sorting_1"><label class="control-label">{{$data->tanggal[$i]}}</label></td>
									<td style="text-align: left;">{{$data->matkul[$i]->nama}}</td>
									<td style="text-align: left;">{{$data->dosen[$i]}}</td>
									<td style="text-align: left;">{{$data->asisten[$i]}}</td>
								</tr>
							@endfor
						@else
							<?php $hari = array('SENIN','SELASA','RABU','KAMIS','JUMAT') ?>
							@for ($i = 0; $i < 5; $i++)
								<tr>
									<td class="sorting_1"><label class="control-label">{{$hari[$i]}}</label></td>
									<td style="text-align: left;">{{$data->matkul[$i]->nama}}</td>
									<td style="text-align: left;">{{$data->dosen[$i]}}</td>
									<td style="text-align: left;">{{$data->asisten[$i]}}</td>
									<td style="text-align: center;">
										<a href="{{route('jadwal.download', ['id_jadwal' => $data->id, 'id_mk' => $data->matkul[$i]->id])}}" target="_blank"><button type="button" class="btn btn-primary">Download</button></a>
									</td>
								</tr>
							@endfor
						@endif
						</tbody>
					</table>
				</div>
				<div class="row row-in" style="text-align: center; width: 100%">
					@if ($data->kelas->nama == 's' || $data->kelas->nama == 'S')
						<a href="{{route('jadwal.download', ['id_jadwal' => $data->id, 'id_mk' => 0])}}" target="_blank"><button type="button" class="btn btn-primary">Download Absensi</button></a>
						<a><button type="button" id="BA" class="btn btn-success" data-toggle="modal" data-target="#modalBA" value="">Berita Acara</button></a>
					@else
						<a><button type="button" id="BA" class="btn btn-success" data-toggle="modal" data-target="#modalBA" value="" style="width: 20%;">Berita Acara</button></a>
					@endif
				</div>
				<!-- Modal -->
				<div id="modalBA" class="w3-modal w3-round-xlarge" style="z-index: 99999;">
					<div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round-large" style="width: 40%;">
						<header class="w3-container w3-light-grey w3-round-large"> 
							<span 
							class="w3-button w3-display-topright w3-round-large" data-dismiss="modal">&times;</span>
							<h2>Berita Acara Evaluasi</h2>
						</header>
						<form action="{{route('akademik.jadwal.beritaacara')}}" method="POST">
						{{ csrf_field() }}
						<div class="w3-container" style="margin-top: 2%;">
							<p style="text-align: center">Kelas <b>{{ $data->kelas->nama }}</b> - Semester <b>{{ $data->termin }}</b></p>
							<input type="hidden" name="id_jadwal" value="{{$data->id}}">
							<label for="jenis">Jenis Evaluasi:</label>
							<select name="jenis" id="jenis" class="form-group form-control">
								<option value="ets">Evaluasi Tengah Semester</option>
								<option value="eas">Evaluasi Akhir Semester</option>
							</select>
							<label for="id_mk">Mata Kuliah:</label>
							<select name="id_mk" id="id_mk" class="form-group form-control">
								@if ($data->kelas->nama == 's' || $data->kelas->nama == 'S')
									@for ($i = 0; $i < count($data->matkul); $i++)
										<option value="{{$i}}">{{$data->matkul[$i]->nama}}</option>
									@endfor
								@else
									@for ($i = 0; $i < count($data->matkul); $i++)
										<option value="{{$data->matkul[$i]->id}}">{{$data->matkul[$i]->nama}}</option>
									@endfor
								@endif
							</select>
							<label for="tanggal">Tanggal Evaluasi:</label>
							<input type="date" name="tanggal" id="tanggal" class="form-control"><br>
							<label>Waktu Evaluasi:</label>
							<table style="width:100%; text-align: center">
								<tr>
									<td><input type="time" name="waktu_start" id="waktu_start" class="form-control" style="text-align: center"></td>
									<td ><b>-</b></td>
									<td><input type="time" name="waktu_end" id="waktu_end" class="form-control" style="text-align: center"></td>
								</tr>
							</table>
							<br>
						</div>
						<footer class="w3-container w3-light-grey w3-round-large" style="text-align: right;">
								<button type="submit" id="DeleteButton" class="btn btn-success" style="margin: 1%;">Submit</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal" style="margin: 1%;">Batal</button>	
						</footer>
						</form>
					</div>
				</div>
				<br>
				<h4 class="box-title m-b-0">List Mahasiswa</h4><br>
				<div class="row row-in">
					<div>
						<div class="col-md-12" style="text-align: left;">
							<a href="{{route('jadwal.pilihmhs', $data->id)}}"><button type="button" class="btn btn-info">Tambah Mahasiswa</button></a>
						</div>
					</div>
					<div style="margin-top: 5%;">
						<table id="list2" class="table table-striped table-hover table-bordered" style="text-align: center; width: 100%;">
							<thead>
								<tr>
									<th style="width: 5%;">No</th>
									<th style="width: 25%;text-align: center;">NRP</th>
									<th style="width: 45%;text-align: center;">Nama</th>
									<th style="width: 25%;text-align: center;">Action</th>
								</tr>
							</thead>
							<tbody>
							@foreach ($data->mahasiswa as $individu)
								<tr>
									<td></td>
									<td class="sorting_1"><label class="control-label">{{$individu->nrp}}</label></td>
									<td style="text-align: left;">{{$individu->nama}}</td>
									<td style="text-align: center;">
										<div class="row" style="margin: 0px;">
											<a data-toggle="tooltip" data-placement="top" title="Hapus"><button type="button" id="tombolDel" class="btn btn-danger" data-toggle="modal" data-target="#modalCancel" value="{{$individu->id}}"><i class="material-icons" style="font-size: 18px;">delete</i></button></a>
										</div>
									</td>
								</tr>
								<!-- Modal -->
								<div id="modalCancel" class="w3-modal w3-round-xlarge" style="z-index: 99999;">
									<div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round-large" style="width: 40%;">
										<header class="w3-container w3-light-grey w3-round-large"> 
											<span 
											class="w3-button w3-display-topright w3-round-large" data-dismiss="modal">&times;</span>
											<h2>Konfirmasi</h2>
										</header>
										<div class="w3-container" style="margin-top: 2%;">
											<p>Apakah Anda yakin akan menghapus data mahasiswa ini di kelas {{$data->kelas->nama}}?</p>
										</div>
										<footer class="w3-container w3-light-grey w3-round-large" style="text-align: right;">
											<form action="{{route('jadwal.cancel')}}" method="POST">
												{{ csrf_field() }}
												<input type="hidden" name="mhs" id="valuemhs" value="{{$individu->id}}">
												<input type="hidden" name="jdw" value="{{$data->id}}">
												<button type="submit" id="DeleteButton" class="btn btn-success" style="margin: 1%;">Ya</button>
												<button type="button" class="btn btn-danger" data-dismiss="modal" style="margin: 1%;">Tidak</button>
											</form>
										</footer>
									</div>
								</div>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
	<script type="text/javascript" src="{{ URL::asset('js/sipikti.js') }}"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('js/bootstrap.js') }}">
	<script>
		$(document).ready(function(){
			var t = $('#list2').DataTable( {
				"columnDefs": [ {
					"searchable": false,
					"orderable": false,
					"targets": 0,

				} ],
				"order": [[ 1, 'asc' ]],
			} );

			t.on( 'order.dt search.dt', function () {
				t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
					cell.innerHTML = i+1;
				} );
			} ).draw();
		});
		var Id;
		$(document).ready(function(){
			$(document).on('click', '#tombolDel', function () {
				console.log('id yg passing');
				Id = $(this).val();
				console.log(Id);
				document.getElementById("valuemhs").value = Id;
			});
		});
	</script>
@endsection