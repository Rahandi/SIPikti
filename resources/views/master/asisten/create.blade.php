@extends('layouts.master')

@section('pagetitle')
	Tambah Asisten
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
			<p class="text-muted m-b-30">Tambahkan Asisten</p>
			<form action="{{route('master.asisten.store')}}" method="POST" data-toggle="validator">
				{{csrf_field()}}
				<div class="form-group">
					<label>NRP</label>
					<input style="text-align: left;" type="text" class="form-control" name="nrp" placeholder="05111640000022" required>
				</div>
				<div class="form-group">
					<label>Nama Asisten</label>
					<input style="text-align: left;" type="text" class="form-control" name="nama" placeholder="Yoshima Syach Putri" required>
				</div>
				<div class="form-group">
					<label>No. Handphone</label>
					<input style="text-align: left;" type="text" class="form-control" name="nohp" placeholder="08585xxxxxx" required>
				</div>
				<div class="form-group">
					<label>Email</label>
					<input style="text-align: left;" type="email" class="form-control" name="email" placeholder="rahandinoor@gmail.com" required>
				</div>
				<div style="text-align: center;">
					<a><button type="submit" style="width: 20%;" class="btn btn-info">Submit</button></a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection