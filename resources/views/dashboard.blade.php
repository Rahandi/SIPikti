@extends('layouts.app')

@section('title')
	Dashboard
@endsection

@section('css')
	<!-- <link rel="stylesheet" type="text/css" href="css/form.css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="../css/style.css"> -->
	<link rel="stylesheet" href="../css/AdminLTE.min.css">
	<link rel="stylesheet" href="../css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
	<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
@endsection

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">List Pendaftar</div>

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
										<div class="col-md-3">
										<a href="kwitansi/{{ $individu->id }}"><button type="button" class="btn btn-success"><i class="material-icons" style="font-size: 18px;">insert_drive_file</i></button></a>
										</div>
										<div class="col-md-3">
										<a href="detail/{{ $individu->id }}"><button type="button" class="btn btn-primary"><i class="material-icons" style="font-size: 18px;">format_list_bulleted</i></button></a>
										</div>
										<div class="col-md-3">
										<input type="hidden" name="">
										<a href="edit/{{ $individu->id }}"><button type="button" class="btn btn-warning"><i class="material-icons" style="font-size: 18px;">mode_edit</i></button></a>
										</div>
										<div class="col-md-3">
										<form action="{{route('delete')}}" method="POST">
										{{ csrf_field() }}
										<input type="hidden" name="id" value="{{$individu->id}}">
										<button type="submit" class="btn btn-danger"><i class="material-icons" style="font-size: 18px;">delete</i></button>
										</form>
										</div>
									</div>
								</td>
							</tr>
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