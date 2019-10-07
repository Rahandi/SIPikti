@extends('layouts.master')

@section('pagetitle')
	Ubah Gelombang
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
			<h3 class="box-title m-b-0">Form Gelombang</h3>
			<p class="text-muted m-b-30">Ubah Gelombang</p>
			<form action="{{route('master.gelombang.update')}}" method="POST" data-toggle="validator">
				{{csrf_field()}}
				<div class="col-md-12">
					<div class="form-group" style="width: 25%;">
						<label for="inp1" class="control-label">Nama Gelombang</label>
						<input type="text" class="form-control" id="inp1" name="nama" placeholder="1" value="{{$data->nama}}" required>
					</div>
				</div>
				<div>
					<div class="col-md-5">
						<div class="form-group">
							<label for="inp2" class="control-label">Periode Mulai</label>
							<input type="date" class="form-control" id="inp2" name="mulai" value="{{$data->mulai}}" required>
						</div>
					</div>
					<div class="col-md-1" style="margin-top: 3%;text-align: center;">
						s/d
					</div>
					<div class="col-md-5">
						<div class="form-group">
							<label for="inp3" class="control-label">Periode Berakhir</label>
							<input type="date" class="form-control" id="inp3" name="berakhir" value="{{$data->berakhir}}" required>
						</div>
					</div>
				</div>
				<div style="text-align: center;">
				<input type="hidden" name="id" value="{{$data->id}}">
				<a><button type="submit" style="width: 15%;" class="btn btn-info">Submit</button></a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection