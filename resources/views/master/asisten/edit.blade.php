@extends('layouts.master')

@section('pagetitle')
	Edit Asisten
@endsection

@section('css')
<style type="text/css">
	#tableMK tr th, td{
		padding: 15px;
	}
</style>
@endsection

@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="white-box">
			<h3 class="box-title m-b-0">Form Asisten</h3>
			<p class="text-muted m-b-30">Ubah Data Asisten</p>
			<form action="{{route('master.asisten.update')}}" method="POST" data-toggle="validator">
				{{csrf_field()}}
				<div class="form-group">
					<label>NRP</label>
					<input style="text-align: left;" type="text" class="form-control" name="nrp" placeholder="05111640000022" value="{{$data->nrp}}" required>
				</div>
				<div class="form-group">
					<label>Nama Asisten</label>
					<input style="text-align: left;" type="text" class="form-control" name="nama" placeholder="Yoshima Syach Putri" value="{{$data->nama}}" required>
				</div>
				<div class="form-group">
					<label>No. Handphone</label>
					<input style="text-align: left;" type="text" class="form-control" name="nohp" placeholder="08585xxxxxx" value="{{$data->nohp}}" required>
				</div>
				<div class="form-group">
					<label>Email</label>
					<input style="text-align: left;" type="email" class="form-control" name="email" placeholder="rahandinoor@gmail.com" value="{{$data->email}}" required>
				</div>
				<div style="text-align: center;">
					<input type="hidden" name="id" value="{{$data->id}}">
					<a><button type="submit" style="width: 20%;" class="btn btn-info">Submit</button></a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection