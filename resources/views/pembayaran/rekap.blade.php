@extends('layouts.master')

@section('pagetitle')
	Rekap Pembayaran
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
				<div class="row row-in">
					@if (session('status'))
						<div class="alert alert-success" role="alert">
							{{ session('status') }}
						</div>
					@endif
					<table id="list" class="table table-striped table-hover table-bordered" style="text-align: center; width: 100%;">
						<thead>
							<tr>
								<th style="width: 1%;"></th>
								<th style="width: 15%;text-align: center;">NRP</th>
								<th style="width: 25%;text-align: center;">Nama</th>
								<th style="width: 20%;text-align: center;">Jenis Angsuran</th>
								<th style="width: 5%;text-align: center;">DU1</th>
								<th style="width: 5%;text-align: center;">DU2</th>
								<th style="width: 5%;text-align: center;">A1</th>
								<th style="width: 5%;text-align: center;">A2</th>
								<th style="width: 5%;text-align: center;">A3</th>
								<th style="width: 5%;text-align: center;">A4</th>
								<th style="width: 5%;text-align: center;">A5</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($data as $rekap)
							<tr>
								<td></td>
								<td class="sorting_1" style="text-align: left;">{{ $rekap->nrp }}</td>
								<td>{{ $rekap->nama }}</td>
								<td>{{ $rekap->angsuran_nama }}</td>
								@if ($rekap->data_pembayaran['Daftar ulang 1'] == '0')
									<td><i class="material-icons" style="font-size: 22px;">remove</i></td>
									@elseif ($rekap->data_pembayaran['Daftar ulang 1'] == '1')
									<td><i class="material-icons" style="font-size: 22px;">done</i></td>
									@else
									<td style="background-color: #cccccc;"></td>
								@endif
								@if ($rekap->data_pembayaran['Daftar ulang 2'] == '0')
									<td><i class="material-icons" style="font-size: 22px;">remove</i></td>
									@elseif ($rekap->data_pembayaran['Daftar ulang 2'] == '1')
									<td><i class="material-icons" style="font-size: 22px;">done</i></td>
									@else
									<td style="background-color: #cccccc;"></td>
								@endif
								@if ($rekap->data_pembayaran['Angsuran 1'] == '0')
									<td><i class="material-icons" style="font-size: 22px;">remove</i></td>
									@elseif ($rekap->data_pembayaran['Angsuran 1'] == '1')
									<td><i class="material-icons" style="font-size: 22px;">done</i></td>
									@else
									<td style="background-color: #cccccc;"></td>
								@endif
								@if ($rekap->data_pembayaran['Angsuran 2'] == '0')
									<td><i class="material-icons" style="font-size: 22px;">remove</i></td>
									@elseif ($rekap->data_pembayaran['Angsuran 2'] == '1')
									<td><i class="material-icons" style="font-size: 22px;">done</i></td>
									@else
									<td style="background-color: #cccccc;"></td>
								@endif
								@if ($rekap->data_pembayaran['Angsuran 3'] == '0')
									<td><i class="material-icons" style="font-size: 22px;">remove</i></td>
									@elseif ($rekap->data_pembayaran['Angsuran 3'] == '1')
									<td><i class="material-icons" style="font-size: 22px;">done</i></td>
									@else
									<td style="background-color: #cccccc;"></td>
								@endif
								@if ($rekap->data_pembayaran['Angsuran 4'] == '0')
									<td><i class="material-icons" style="font-size: 22px;">remove</i></td>
									@elseif ($rekap->data_pembayaran['Angsuran 4'] == '1')
									<td><i class="material-icons" style="font-size: 22px;">done</i></td>
									@else
									<td style="background-color: #cccccc;"></td>
								@endif
								@if ($rekap->data_pembayaran['Angsuran 5'] == '0')
									<td><i class="material-icons" style="font-size: 22px;">remove</i></td>
									@elseif ($rekap->data_pembayaran['Angsuran 5'] == '1')
									<td><i class="material-icons" style="font-size: 22px;">done</i></td>
									@else
									<td style="background-color: #cccccc;"></td>
								@endif
							</tr>
						@endforeach
						</tbody>
					</table>
				
				</div>
		</div>
	</div>
</div>
@endsection

@section('js')
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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