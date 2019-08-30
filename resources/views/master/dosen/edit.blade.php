@extends('layouts.master')

@section('pagetitle')
	Edit Dosen
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
			<h3 class="box-title m-b-0">Form Dosen</h3>
			<p class="text-muted m-b-30">Ubah Data Dosen</p>
			<form action="{{route('master.dosen.update')}}" method="POST" data-toggle="validator">
				{{csrf_field()}}
				<table style="width: 100%;">
					<tr>
						<th style="width: 50%;">Nama Dosen</th>
						<th rowspan="2" style="width: 15%;">
							<input type="hidden" name="id" value="{{$data->id}}">
							<a><button type="submit" style="width: 100%;" class="btn btn-info">Submit</button></a>
						</th>
					</tr>
					<tr>
						<td>
							<div class="form-group">
								<input style="text-align: left;" type="text" class="form-control" id="inp1" name="nama" placeholder="Dini Adni Navastara" value="{{$data->nama}}" required>
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