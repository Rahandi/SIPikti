@extends('layouts.app')

@section('title')
	Dashboard
@endsection

@section('css')
	<!-- <link rel="stylesheet" type="text/css" href="../css/bootstrap.css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="css/form.css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="../css/style.css"> -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">List Pendaftar</div>

				<div class="card-body">
					@if (session('status'))
						<div class="alert alert-success" role="alert">
							{{ session('status') }}
						</div>
					@endif
					<div id="example_wrapper" class="dataTables_wrapper">
						<div class="dataTables_length" id="example_length">
							<label>Show 
								<select name="example_length" aria-controls="example" class="">
									<option value="10">10</option>
									<option value="25">25</option>
									<option value="50">50</option>
									<option value="100">100</option>
								</select> entries
							</label>
						</div>
						<div id="example_filter" class="dataTables_filter">
							<label>Search:
								<input type="search" class="" placeholder="" aria-controls="example">
							</label>
						</div>
						<table id="example" class="display dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">
							<thead>
								<tr role="row">
									<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 2%;" aria-label=""></th>
									<th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 30%;" aria-label="Name: activate to sort column descending" aria-sort="ascending">Nama</th>
									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 15%;" aria-label="Position: activate to sort column ascending">Tanggal Daftar</th>
									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 15%;" aria-label="Office: activate to sort column ascending">Tanggal Lahir</th>
									<th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 30%;" aria-label="Age: activate to sort column ascending">Action</th>
								</tr>
							</thead>
							<tbody>
								</tr role="row" class="odd">
								@foreach ($data as $individu)
								<tr>
									<td></td>
									<td class="sorting_1">{{ $individu->nama }}</td>
									<td>{{ $individu->created_at }}</td>
									<td>{{ $individu->tanggal_lahir }}</td>
									<td><a href="kwitansi/{{ $individu->id }}">kwitansi</a>
									<a href="detail/{{ $individu->id }}">detail</a>
									<input type="hidden" name="">
									<a href="edit/{{ $individu->id }}">edit</a></td>
								</tr>
								@endforeach
							</tbody>
						</table>
						<div class="dataTables_info" id="example_info" role="status" aria-live="polite">Showing 21 to 30 of 57 entries</div>
						<div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
							<a class="paginate_button previous" aria-controls="example" data-dt-idx="0" tabindex="0" id="example_previous">Previous</a>
							<span>
								<a class="paginate_button " aria-controls="example" data-dt-idx="1" tabindex="0">1</a><a class="paginate_button " aria-controls="example" data-dt-idx="2" tabindex="0">2</a><a class="paginate_button current" aria-controls="example" data-dt-idx="3" tabindex="0">3</a>
								<a class="paginate_button " aria-controls="example" data-dt-idx="4" tabindex="0">4</a><a class="paginate_button " aria-controls="example" data-dt-idx="5" tabindex="0">5</a><a class="paginate_button " aria-controls="example" data-dt-idx="6" tabindex="0">6</a>
							</span>
							<a class="paginate_button next" aria-controls="example" data-dt-idx="7" tabindex="0" id="example_next">Next</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
	<script>
		$(document).ready(function() {
			var t = $('#example').DataTable( {
				"columnDefs": [ {
					"searchable": false,
					"orderable": false,
					"targets": 0
				} ],
				"order": [[ 1, 'asc' ]]
			} );
		 
			t.on( 'order.dt search.dt', function () {
				t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
					cell.innerHTML = i+1;
				} );
			} ).draw();
		} );
	</script>
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script> -->
	<!-- <script type="text/javascript" src="../js/sipikti.js"></script> -->
	<!-- <script type="text/javascript" src="../js/bootstrap.min.js"></script> -->
@endsection