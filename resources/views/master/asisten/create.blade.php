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
				<table style="width: 100%;">
					<tr>
						<th style="width: 25%;">NRP</th>
						<th style="width: 60%;">Nama Asisten</th>
						<th rowspan="2" style="width: 15%;">
							<a><button type="submit" style="width: 100%;" class="btn btn-info">Submit</button></a>
						</th>
					</tr>
					<tr>
						<td>
							<div class="form-group">
								<input style="text-align: left;" type="text" class="form-control" name="nrp" placeholder="05111640000022" required>
							</div>
						</td>
						<td>
							<div class="form-group">
								<input style="text-align: left;" type="text" class="form-control" name="nama" placeholder="Rahandi Noor Pasha" required>
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