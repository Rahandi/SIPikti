@extends('layouts.master')

@section('pagetitle')
	Nilai
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
				<div style="text-align: left;">
					<h3 class="box-title m-b-0">Buat Penilaian</h3>
					<p class="text-muted m-b-30"><i>Generate Excel</i></p>
				</div>
				<form action="{{route('nilai.store')}}" method="POST" data-toggle="validator">
					{{csrf_field()}}
					<div class="form-group">
						<label>Kelas</label>
						<select class="form-control selectpicker" data-style="btn-info btn-outline" name="kelas" id="kelas" required="">
							<option value="">Select Here</option>
							@foreach ($data as $kls)
							@for ($i = 0; $i< count($kls->mk); $i++)
							<option value="{{$kls->termin}},{{$kls->id}},{{$i}}">{{$kls->termin}}&nbsp;&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;&nbsp;{{$kls->kelas}}&nbsp;&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;&nbsp;{{$kls->mk[$i]}}</option>
							@endfor
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label>Jumlah Kolom Penilaian</label>
						<input type="text" class="form-control" name="jml" id="jml" placeholder="4" required style="width: 10%;">
					</div>
					<label>Detail Penilaian</label>
					<table style="width: 100%;text-align: center;" id="tableMK" border="">
						<thead>
						<tr>
							<th style="text-align: center; width: 10%;">No</th>
							<th style="text-align: center; width: 35%;">Prosentase (%)</th>
							<th style="text-align: center; width: 55%;">Nama Penilaian</th>
						</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
					<div style="text-align: center; margin-top: 2%;">
						<a><button type="submit" style="width: 20%;" class="btn btn-info">Submit</button></a>
					</div>
				</form><br><br>
				<h4 class="box-title m-b-0">List Penilaian</h4><br>
				<div>
					<table id="list2" class="table table-striped table-hover table-bordered" style="text-align: center; width: 100%;">
						<thead>
							<tr>
								<th style="width: 5%;">No</th>
								<th style="width: 10%;text-align: center;">Termin</th>
								<th style="width: 10%;text-align: center;">Kelas</th>
								<th style="width: 30%;text-align: center;">Mata Kuliah</th>
								<th style="width: 20%;text-align: center;">Jumlah Penilaian</th>
								<th style="width: 25%;text-align: center;">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($list as $row)
							<tr>
								<td></td>
								<td>{{$row->termin}}</td>
								<td>{{$row->kelas}}</td>
								<td style="text-align: left;">{{$row->mata_kuliah}}</td>
								<td>{{$row->jml}}</td>
								<td>
									<div>
										<div class="col-md-6">
										<form action="{{ route('nilai.download') }}" method="POST">
											@csrf
											<input type="hidden" name="id" value="{{$row->id}}">
											<a data-toggle="tooltip" data-placement="top" title="Download Template Penilaian"><button type="submit" class="btn btn-primary">Download</button></a>
										</form>
										</div>
										<a class="col-md-6" data-toggle="tooltip" data-placement="top" title="Upload Penilaian"><button type="button" id="tombolUp" data-toggle="modal" class="btn btn-danger" data-target="#modalUpload">Upload</button></a>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<!-- Modal -->
				<div id="modalUpload" class="w3-modal w3-round-xlarge" style="z-index: 99999;">
					<div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round-large" style="width: 40%;">
						<header class="w3-container w3-light-grey w3-round-large"> 
							<span data-dismiss="modal" 
							class="w3-button w3-display-topright w3-round-large">&times;</span>
							<h2>Upload</h2>
						</header>
						<form action="" method="POST">
						{{ csrf_field() }}
						<div class="w3-container" style="margin-top: 2%;">
							<input type="file" name="nilai">
						</div>
						<footer class="w3-container w3-light-grey w3-round-large" style="text-align: right;">
							<input type="hidden" name="id" id="valueId" value="">
							<button type="submit" class="btn btn-success" id="DeleteButton" style="margin: 1%;">Submit</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal" style="margin: 1%;">Batal</button>
						</footer>
						</form>
					</div>
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
			$(document).on('click', '#tombolUp', function () {
				console.log('open modal');
			});
		});
		$( document ).ready(function() {
			$('#jml').focusout(function(){
				var from = $('#jml').val();
				console.log("change!");
				// console.log(from);
				$('#tableMK tbody').empty();
				for (var i = 1; i <= from; i++) {
					$('#tableMK tbody').append("<tr><td>"+i+"</td><td><input type='number' class='form-control' name='prosentase[]' required='' placeholder='25'></td><td><input type='text' name='nama_penilaian[]' required='' placeholder='Evaluasi Tengah Semester' class='form-control'></td></tr>");
				}
			});
		});
	</script>
@endsection