@extends('layouts.master')

@section('pagetitle')
	Nilai PA - KP
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">
	<style type="text/css">
		i.material-icons {
			vertical-align: middle;
		}
		#tableMK tr th, td{
			padding: 8px;
		}
	</style>
@endsection

@section('content')
	<div class="row">
		<div class="col-sm-12">
			<div class="white-box">
				<h4 class="box-title m-b-0">List Penilaian PA - KP</h4><br>
				<div>
					<table id="list2" class="table table-striped table-hover table-bordered" style="text-align: center; width: 100%;">
						<thead>
							<tr>
								<th style="width: 5%;">No</th>
								<th style="width: 10%;text-align: center;">Tahun</th>
                                <th style="width: 25%;text-align: center;">Kategori</th>
                                <th style="width: 15%;text-align: center;">Jumlah Mahasiswa</th>
								<th style="width: 15%;text-align: center;">Action</th>
							</tr>
						</thead>
						<tbody style="width:100%;">
							<tr style="width:100%;">
								<td></td>
								<td>2019</td>
								<td><b>Proyek Akhir (PA)</b></td>
								<td>20</td>
								<td>
									<a href="{{route('takp.detail')}}"><button class="btn btn-info">Detail</button></a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
	<script type="text/javascript" src="{{ URL::asset('js/sipikti.js') }}"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('js/bootstrap.js') }}">
	<script>
		$(document).ready(function() {
			$("#modalSuccess").modal({
				fadeDuration: 100
			});
		});
		$(document).ready(function(){
			var t = $('#list2').DataTable( {
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