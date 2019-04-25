@extends('layouts.app')

@section('content')
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
