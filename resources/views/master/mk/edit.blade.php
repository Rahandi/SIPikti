@extends('layouts.master')

@section('pagetitle')
	Edit Mata Kuliah
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
			<h3 class="box-title m-b-0">Form Mata Kuliah</h3>
			<p class="text-muted m-b-30">Ubah Mata Kuliah</p>
			<form action="{{route('master.mk.update')}}" method="POST" data-toggle="validator">
				{{csrf_field()}}
				<table style="width: 100%;">
					<tr>
						<th style="width: 10%; text-align: center;">Termin</th>
						<th style="width: 60%; text-align: center;">Nama Mata Kuliah</th>
						<th style="width: 15%; text-align: center;">Jumlah SKS</th>
						<th rowspan="2" style="width: 15%;">
							<input type="hidden" name="id" value="{{$data->id}}">
							<a><button type="submit" style="width: 100%;" class="btn btn-info">Submit</button></a>
						</th>
					</tr>
					<tr>
						<td>
							<div class="form-group">
								<input style="text-align: center;" type="text" class="form-control" id="inp1" name="semester" placeholder="1" value="{{$data->semester}}" required>
							</div>
						</td>
						<td>
							<div class="form-group">
								<input style="text-align: center;" type="text" class="form-control" id="inp2" name="nama" placeholder="Pemrograman Java" value="{{$data->nama}}" required>
							</div>
						</td>
						<td>
							<div class="form-group">
								<input style="text-align: center;" type="number" class="form-control" id="inp2" name="sks" placeholder="2" required>
							</div>
						</td>
						<td></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
@endsection