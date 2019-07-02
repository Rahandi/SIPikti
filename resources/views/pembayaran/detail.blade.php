@extends('layouts.master')

@section('pagetitle')
	Detail Pembayaran
@endsection

@section('css')
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
						@foreach ($data['pembayaran']['data_pembayaran'] as $index => $data_bayar)
							<form action="{{route('pembayaran.bayar')}}" method="POST" style="width: 100%;text-align: center;" target="_blank">
								{{csrf_field()}}
								<input type="hidden" name="mahasiswa_angsuran" value="{{$data['pembayaran']->id}}">
								<input type="hidden" name="jenis_bayar" value="{{$index}}">
								<button type="submit" class="btn btn-success" onclick="reloadPlis()" style="width: 20%;" 
								@if ($data_bayar['tanda'] == 1)
									disabled="disabled"
								@endif
								>Pembayaran {{$index}}</button>
							</form><br>
						@endforeach
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
	<script type="text/javascript" src="{{ URL::asset('js/sipikti.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
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
			setTimeout(function(){location.reload()},500);
		}
	</script>
	<script src="{{ URL::asset('plugins/bower_components/styleswitcher/jQuery.style.switcher.js') }}"></script>
@endsection