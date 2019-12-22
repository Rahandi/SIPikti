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
				<h3 class="box-title m-b-0">Kelas - {{ $data->kelas->nama }}</h3> <!-- tambahi count disini.. /30 -->
				<p class="text-muted m-b-30">Semester {{ $data->jadwal->termin }}</p>
				<div class="row row-in">
					<form method="POST" action="{{route('jadwal.tambah')}}" id="forms">
					{{ csrf_field() }}
					<div>
						<table id="list2" class="table table-striped table-hover table-bordered" style="text-align: center; width: 100%;">
							<thead>
								<tr>
									<th style="width: 5%;"></th>
									<th style="width: 25%;text-align: center;">NRP</th>
									<th style="width: 45%;text-align: center;">Nama</th>
									<th style="width: 25%;text-align: center;">Action</th>
								</tr>
							</thead>
							<tbody>
							@foreach ($data->mahasiswa as $individu)
								<tr>
									<td></td>
									<td class="sorting_1"><label class="control-label">{{$individu->nrp}}</label></td>
									<td style="text-align: left;">{{$individu->nama}}</td>
									<td style="text-align: center;">
										<input type="checkbox" name="picked[]" value="{{$individu->id}}" onclick="cekbok({{$individu->id}})">
									</td>
								</tr>
							@endforeach
							</tbody>
						</table>
						<input type="hidden" name="jadwal" value="{{$data->jadwal->id}}">
						<input type="hidden" name="cekboks" value="">
						<a style="text-align: right;"><button type="submit" class="btn btn-info">Submit</button></a>
					</div>
					</form>
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
		var checked = []
		var cekboks = document.getElementById("forms")

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
		var Id;
		$(document).ready(function(){
			$(document).on('click', '#tombolDel', function () {
				console.log('id yg passing');
				Id = $(this).val();
				console.log(Id);
				document.getElementById("valueId").value = Id;
			});
		});

		Array.prototype.remove = function() {
			var what, a = arguments, L = a.length, ax;
			while (L && this.length) {
				what = a[--L];
				while ((ax = this.indexOf(what)) !== -1) {
					this.splice(ax, 1);
				}
			}
			return this;
		};

		function cekbok(id)
		{
			if (checked.includes(id))
			{
				checked.remove(id)
			}
			else
			{
				checked.push(id)
			}
			cekboks.cekboks.value = checked
		}
	</script>
@endsection