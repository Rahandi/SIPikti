@extends('layouts.master')

@section('pagetitle')
	Detail Pembayaran
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">
	<link href="{{ URL::asset('plugins/bower_components/custom-select/custom-select.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ URL::asset('plugins/bower_components/switchery/dist/switchery.min.css') }}" rel="stylesheet" />
	<link href="{{ URL::asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
	<link href="{{ URL::asset('plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}" rel="stylesheet" />
	<link href="{{ URL::asset('plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" />
	<link href="{{ URL::asset('plugins/bower_components/multiselect/css/multi-select.css')}}" rel="stylesheet" type="text/css" />
	<style type="text/css">
		i.material-icons {
			vertical-align: middle;
		}
	</style>
@endsection

@section('content')
	@if (session('status'))
	<div id="modalSuccess" class="w3-modal w3-round-xlarge" style="z-index: 99999;">
		<div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round-large" style="width: 40%;">
			<header class="w3-container w3-light-grey w3-round-large"> 
				<span onclick="document.getElementById('modalSuccess').style.display='none'" 
				class="w3-button w3-display-topright w3-round-large">&times;</span>
				<h2>{{ session('status') }} !</h2>
			</header>
			<div class="w3-container" style="margin-top: 2%;">
				<p>Angsuran telah berhasil dibayarkan.</p>
			</div>
		</div>
	</div>
	@endif
	<div class="row">
		<div class="col-sm-12">
			<div class="white-box">
				<div class="row row-in">
					<table style="width: 90%;">
						<tr>
							<td style="width: 30%;">Nomor Pendaftaran</td>
							<td style="width: 1%;">:</td>
							<td>{{ $data['mahasiswa']->nomor_pendaftaran }}</td>
						</tr>
						<tr>
							<td>Nama Mahasiswa</td>
							<td>:</td>
							<td>{{ $data['mahasiswa']->nama }}</td>
						</tr>
						<tr>
							<td>NRP</td>
							<td>:</td>
							<td>{{ $data['mahasiswa']->nrp }}</td>
						</tr>
						@if ($data['exist'] != 0)
						<tr>
							<td>Kelas</td>
							<td>:</td>
							@if ($data['pembayaran']['data_pembayaran']['Daftar ulang 1']['tanda'] != 1)
							<td></td>
							@elseif ($data['kelas'] != null)
								<td>{{ $data['kelas'] }} &nbsp;&nbsp;&nbsp;<a href="{{ route('jadwal.pilihkelas', $data['mahasiswa']->id) }}"><button class="btn btn-warning">Ubah Kelas</button></a>&nbsp;&nbsp;&nbsp;<a href="{{ route('jadwal.detail', $data['jadwal']->id) }}"><button class="btn btn-primary">Lihat Kelas</button></a></td>
							@else
								<td><a href="{{ route('jadwal.pilihkelas', $data['mahasiswa']->id) }}"><button class="btn btn-primary">Pilih Kelas</button></a></td>
							@endif
						</tr>
						@endif
					</table><br>
					@if ($data['exist'] == 0)
						<form action="{{route('pembayaran.select')}}" method="POST" style="width: 100%;">
							{{csrf_field()}}
							<input type="hidden" name="id_mahasiswa" value="{{$data['mahasiswa']->id}}">
							<select class="selectpicker" data-style="btn-info btn-outline" name="id_angsuran">
								@foreach ($data['angsuran'] as $individu)
								<option data-tokens="{{ $individu->nama }}" value="{{$individu->id}}">{{ $individu->nama }}</option>
								@endforeach
							</select>
						<button type="submit" class="btn btn-info">Pilih</button>
						</form>
					@else
						<table style="width: 90%;">
							<tr>
								<td style="width: 30%;">Nama Angsuran</td>
								<td style="width: 1%;">:</td>
								<td>{{ $data['angsuran']->nama }}</td>
							</tr>
							<tr>
								<td>Gelombang</td>
								<td>:</td>
								<td>{{ $data['angsuran']->gelombang }}</td>
							</tr>
							<tr>
								<td>Kali Angsuran</td>
								<td>:</td>
								<td>{{ $data['angsuran']->kali_angsuran }}</td>
							</tr>
						</table><br>
						<table id="list" class="table table-striped table-hover table-bordered" style="text-align: center; width: 100%;">
							<thead>
								<tr>
									<th style="width: 20%;text-align: center;">Nama Pembayaran</th>
									<th style="width: 17%;text-align: center;">Total Biaya</th>
									<th style="width: 23%;text-align: center;">Tanggal Bayar</th>
									<th style="width: 25%;text-align: center;">Action</th>
								</tr>
							</thead>
							<tbody>
							@foreach ($data['pembayaran']['data_pembayaran'] as $index => $data_bayar)
								<tr>
									<td class="sorting_1" style="text-align: left;">{{ $index }}</td>
									<td>Rp {{ $data_bayar['biaya'] }}</td>
									<td>
										{{ $data_bayar['tanggal_bayar'] }}
										&nbsp;&nbsp;&nbsp;&nbsp;
										<a><button type="button" class="btn btn-basic" data-toggle="modal" data-target="#modalUbah" id="tombolEdit" value="{{$data['pembayaran']->id}}|{{$index}}|{{ $data_bayar['tanggal_asli'] }}"
										@if ($data_bayar['tanda'] != 1)
											style="display: none"
										@endif
										>Ubah Tanggal</button></a>
									</td>
									<td>
										<div class="row" style="width: 100%;">
											<div class="col-md-4">
												<form action="{{route('pembayaran.bayar')}}" method="POST" style="text-align: right;" target="_blank">
												{{csrf_field()}}
												<input type="hidden" name="mahasiswa_angsuran" value="{{$data['pembayaran']->id}}">
												<input type="hidden" name="jenis_bayar" value="{{$index}}">
												<button type="submit" class="btn btn-success"
												@if ($data['kelas'] == null)
													onclick="reloadPlis()"
												@else
													onclick="reloadSaja()"
												@endif

												@if ($data_bayar['tanda'] == 1)
													disabled="disabled"
												@endif
												>Bayar</button>
												</form>
											</div>
											<div class="col-md-4">
												<form action="{{route('pembayaran.batalbayar')}}" method="POST" style="text-align: right;">
												{{csrf_field()}}
												<input type="hidden" name="mahasiswa_angsuran" value="{{$data['pembayaran']->id}}">
												<input type="hidden" name="jenis_bayar" value="{{$index}}">
												<button type="submit" class="btn btn-danger" 
												@if ($data_bayar['tanda'] != 1)
													disabled="disabled"
												@endif
												>Hapus</button>
												</form>
											</div>
											<div class="col-md-4">
												<form action="{{route('pembayaran.kwitansi')}}" method="POST" style="text-align: right;" target="_blank">
												{{csrf_field()}}
												<input type="hidden" name="mahasiswa_angsuran" value="{{$data['pembayaran']->id}}">
												<input type="hidden" name="jenis_bayar" value="{{$index}}">
												<button type="submit" class="btn btn-info" 
												@if ($data_bayar['tanda'] != 1)
													disabled="disabled"
												@endif
												>Kwitansi</button>
												</form>
											</div>
										</div>
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					@endif
					<!-- Modal -->
					<div id="modalUbah" class="w3-modal w3-round-xlarge" style="z-index: 99999;">
						<div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round-large" style="width: 40%;">
							<header class="w3-container w3-light-grey w3-round-large"> 
								<span data-dismiss="modal" class="w3-button w3-display-topright w3-round-large">&times;</span>
								<h2>Ubah Tanggal Bayar</h2>
							</header>
							<div class="w3-container" style="margin-top: 2%;">
								<form action="{{route('pembayaran.ubahtanggal')}}" method="post">
									@csrf
									<input type="date" name="tglbayar" id="tglbayar" value="">
							</div>
							<footer class="w3-container w3-light-grey w3-round-large" style="text-align: right;">
									<input type="hidden" name="mahasiswa_angsuran" id="mhsId" value="">
									<input type="hidden" name="jenis_bayar" id="jenisAng" value="">
									<button type="submit" class="btn btn-success" id="UbahTanggal" style="margin: 1%;">Simpan</button>
								</form>
								<button type="button" class="btn btn-danger" data-dismiss="modal" style="margin: 1%;">Batal</button>
							</footer>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('js/bootstrap.js') }}">

	<script src="{{ URL::asset('plugins/bower_components/switchery/dist/switchery.min.js') }}"></script>
	<script src="{{ URL::asset('plugins/bower_components/custom-select/custom-select.min.js') }}" type="text/javascript"></script>
	<script src="{{ URL::asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>
	<script src="{{ URL::asset('plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
	<script>
		jQuery(document).ready(function () {
			// Switchery
			var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
			$('.js-switch').each(function () {
				new Switchery($(this)[0], $(this).data());
			});
			// For select 2
			$(".select2").select2();
			$('.selectpicker').selectpicker();

		});
		function reloadPlis(){
			setTimeout(function(){
				window.location.href="{{route('jadwal.pilihkelas',$data['mahasiswa']->id)}}"
			},500);
		}
		function reloadSaja(){
			setTimeout(function(){
				window.location.reload()
			},500);
		}
		var mhsId, ang;
		$(document).ready(function(){
			$(document).on('click', '#tombolEdit', function () {
				console.log('id yg passing');
				Id = $(this).val();
				console.log(Id);
				sent = Id.split('|');
				console.log(sent);
				document.getElementById("mhsId").value = sent[0];
				document.getElementById("jenisAng").value = sent[1];
				document.getElementById("tglbayar").value = sent[2];
			});
		});
	</script>
	<script src="{{ URL::asset('plugins/bower_components/styleswitcher/jQuery.style.switcher.js') }}"></script>
@endsection