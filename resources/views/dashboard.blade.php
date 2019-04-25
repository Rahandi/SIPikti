@extends('layouts.app')

@section('title')
	Dashboard
@endsection

@section('css')
	<link rel="stylesheet" href="../css/AdminLTE.min.css">
	<link rel="stylesheet" href="../css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
	<style type="text/css">
		i.material-icons {
			vertical-align: middle;
		}
	</style>
	<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
@endsection

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header" style="font-size: 20px; text-align: center;">List Pendaftar</div>
				
				<div class="card-body table-responsive">
					@if (session('status'))
						<div class="alert alert-success" role="alert">
							{{ session('status') }}
						</div>
					@endif
					<table id="list" class="table table-striped table-hover table-bordered" style="text-align: center;">
						<thead>
							<tr>
								<th style="width: 5%;"></th>
								<th style="width: 25%;">Nama</th>
								<th style="width: 20%;">Tanggal Daftar</th>
								<th style="width: 20%;">Tanggal Lahir</th>
								<th style="width: 20%;">Action</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($data as $individu)
							<tr>
								<td></td>
								<td class="sorting_1" style="text-align: left;">{{ $individu->nama }}</td>
								<td>{{ $individu->created_at }}</td>
								<td>{{ $individu->tanggal_lahir }}</td>
								<td>
									<div class="row" style="margin: 0px;">
										<a 
										@if ($individu->administrator)
											href="kwitansi/{{ $individu->id }}"
										@endif
										style="margin-right: 2%;"><button type="button" class="btn btn-success"
										@if (!$individu->administrator)
											disabled=""
										@endif
										>Print <i class="material-icons" style="font-size: 18px;">print</i></button></a>
										<a href="detail/{{ $individu->id }}"><button type="button" class="btn btn-primary">Detail <i class="material-icons" style="font-size: 18px;">format_list_bulleted</i></button></a>
									</div>
									<div class="row" style="margin: 0px;margin-top: 1%;">
										<a href="edit/{{ $individu->id }}" style="margin-right: 2%;"><button type="button" class="btn btn-warning">Edit <i class="material-icons" style="font-size: 18px;">mode_edit</i></button></a>
										<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete">Delete <i class="material-icons" style="font-size: 18px;">delete</i></button>
									</div>
								</td>
							</tr>
							<!-- Modal -->
							<div id="modalDelete" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Konfirmasi</h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>
										<div class="modal-body" style="text-align: left;">
											<p>Apakah Anda yakin akan menghapus data ini?</p>
										</div>
										<div class="modal-footer">
											<form action="{{route('delete')}}" method="POST">
												{{ csrf_field() }}
												<input type="hidden" name="id" value="{{$individu->id}}">
												<button type="submit" class="btn btn-danger">Ya</button>
											</form>
											<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
										</div>
									</div>
								</div>
							</div>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
</div>
@endsection

@section('js')
    
    
	<script>
		$(document).ready(function(){
			var t = $('#list').DataTable( {
				"columnDefs": [ {
					"searchable": false,
					"orderable": false,
					"targets": 0,

				} ],
				"order": [[ 2, 'asc' ]],
			} );

			t.on( 'order.dt search.dt', function () {
				t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
					cell.innerHTML = i+1;
				} );
			} ).draw();
		});
	</script>
@endsection