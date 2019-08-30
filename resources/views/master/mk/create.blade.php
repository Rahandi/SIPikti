@extends('layouts.master')

@section('pagetitle')
	Tambah Mata Kuliah
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
			<p class="text-muted m-b-30">Tambahkan Mata Kuliah</p>
			<form action="{{route('master.mk.store')}}" method="POST" data-toggle="validator">
				{{csrf_field()}}
				<table style="width: 100%;">
					<tr>
						<th style="width: 20%; text-align: center;">Termin</th>
						<th style="width: 65%; text-align: center;">Nama Mata Kuliah</th>
						<th rowspan="2" style="width: 15%;">
							<a><button type="submit" style="width: 100%;" class="btn btn-info">Submit</button></a>
						</th>
					</tr>
					<tr>
						<td>
							<div class="form-group">
								<input style="text-align: center;" type="text" class="form-control" id="inp1" name="semester" placeholder="1" required>
							</div>
						</td>
						<td>
							<div class="form-group">
								<input style="text-align: center;" type="text" class="form-control" id="inp2" name="nama" placeholder="Pemrograman Java" required>
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