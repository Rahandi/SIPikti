@extends('layouts.app')

@section('content')
<div class="row" style="text-align: center;">
	@if (session('status'))
	<div id="modalSuccess" class="modal fade" role="dialog" style="z-index: 9999;">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">{{ session('status') }} !</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body" style="text-align: left;">
					<p>Data pendaftar berhasil ditambahkan.</p>
				</div>
			</div>
		</div>
	</div>
	@endif
</div>
<div class="row" style="text-align: center;">
	<div class="col-sm-6 col-md-offset-6 mx-auto" style="z-index: 1;width: 100%; border-radius: 10px;">
	<div class="card">
		<div class="card-header" style="font-size: 20px; text-align: center;">Melakukan Pendaftaran</div>
		<div class="card-body">
			<a href="{{ route('daftar') }}"><button type="button" class="btn btn-success" style="font-size: 25px;">Daftar</button></a>
		</div>
	</div>
	</div>
</div>
@endsection

@section('js')
	<script>
		$(document).ready(function() {
			$("#modalSuccess").modal({
				fadeDuration: 100
			});
		});
	</script>
@endsection