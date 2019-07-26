@extends('layouts.master')

@section('pagetitle')
	Tambah Mahasiswa
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">
	<style type="text/css">
		i.material-icons {
			vertical-align: middle;
		}
	</style>
@endsection
@section('content')
<div class="row">
		<div class="col-sm-12">
			<div class="white-box">
				<div class="row row-in" style="margin-bottom: 2%;width: 100%;">
					<h3 class="box-title m-b-0">Detail Jadwal</h3>
					<table>
						<tr>
							<td style="width: 12%;">Kelas</td>
							<td style="width: 1%;">:</td>
							<td>{{$data['jadwal']->kelas}}</td>
						</tr>
						<tr>
							<td>Termin</td>
							<td>:</td>
							<td>{{$data['jadwal']->termin}}</td>
						</tr>
						<tr>
							<td>Jam</td>
							<td>:</td>
							<td>{{$data['jadwal']->jam}}</td>
						</tr>
						<tr>
							<td>Mata Kuliah</td>
							<td>:</td>
							<td>{{$data['jadwal']->mata_kuliah}}</td>
						</tr>
					</table>
				</div>
				<div class="row row-in">
					<h3 class="box-title m-b-0" style="text-align: center;">Pilih Mahasiswa</h3>
					<form action="{{route('jadwal.select')}}" method="POST" style="text-align: right;">
					{{ csrf_field() }}
					<table id="list" class="table table-striped table-hover table-bordered" style="text-align: left; width: 100%;">
						<thead>
							<tr>
								<th style="width: 10%;"></th>
								<th style="width: 25%;text-align: center;">NRP</th>
								<th style="width: 40%;text-align: center;">Nama Mahasiswa</th>
								<th style="width: 25%;text-align: center;">Tandai</th>
							</tr>
						</thead>
						<tbody>	
							@foreach ($data['mahasiswa'] as $datas)
								<tr>
									<td></td>
									<td class="sorting_1">{{$datas->nrp}}</td>
									<td>{{$datas->nama}}</td>
									<td style="text-align: center;">
										<input type="checkbox" name="mhs[]" value="{{$datas->id}}">
									</td>
								</tr>
							@endforeach		
						</tbody>
					</table>
					<input type="hidden" name="jadwal_id" id="jadwal_id" value="{{$data['jadwal']->id}}">
					<button type="submit" class="btn btn-info" id="selectMhs" style="margin-top: 1%;">Pilih Mahasiswa</button>
					</form>
				</div>
		</div>
	</div>
</div>
@endsection

@section('js')
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('js/bootstrap.js') }}">
	<script>
		$(document).ready(function(){
			var t = $('#list').DataTable( {
				"columnDefs": [ {
					"searchable": false,
					"orderable": false,
					"targets": 0,
				} ],
				"order": [[ 1, 'asc' ]],
			} );

			t.on( 'order.dt search.dt', function () {
				t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
					cell.innerHTML = i+1;
				} );
			} ).draw();
		});
	</script>
@endsection