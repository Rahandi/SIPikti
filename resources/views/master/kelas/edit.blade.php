@extends('layouts.master')

@section('pagetitle')
	Edit Kelas
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
			<h3 class="box-title m-b-0">Form Kelas</h3>
			<p class="text-muted m-b-30">Ubah Kelas</p>
			<form action="{{route('master.kelas.update')}}" method="POST" data-toggle="validator">
				{{csrf_field()}}
				<table style="width: 100%;">
					<tr>
						<th style="width: 30%; text-align: center;border-right: 1px solid black;">Kelas</th>
						<th colspan="3" style="width: 35%; text-align: center;border-right: 1px solid black;">Senin-Kamis</th>
						<th colspan="3" style="width: 35%; text-align: center;">Jumat</th>
					</tr>
					<tr>
						<td style="border-right: 1px solid black;">
							<div style="vertical-align: middle;" class="form-group">
								<input style="text-align: center;" type="text" class="form-control" name="nama" placeholder="A" value="{{$data->nama}}" required>
							</div>
						</td>
						<td>
							<div class="form-group" style="width: 100%;">
								<input type="time" class="form-control" name="start_SK" value="{{$data->start_SK}}">
							</div>
						</td>
						<td style="vertical-align: top;">s/d</td>
						<td style="border-right: 1px solid black;">
							<div class="form-group">
								<input type="time" class="form-control" name="end_SK" value="{{$data->end_SK}}">
							</div>
						</td>
						<td>
							<div class="form-group">
								<input type="time" class="form-control" name="start_J" value="{{$data->start_J}}" required>
							</div>
						</td>
						<td style="vertical-align: top;">s/d</td>
						<td>
							<div class="form-group">
								<input type="time" class="form-control" name="end_J" value="{{$data->end_J}}" required>
							</div>
						</td>
					</tr>
				</table>
				<div style="text-align: center; width: 100%;">
					<input type="hidden" name="id" value="{{$data->id}}">
					<a><button type="submit" style="width: 15%;margin-top: 2%;" class="btn btn-info">Submit</button></a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection