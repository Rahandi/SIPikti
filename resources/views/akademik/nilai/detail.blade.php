@extends('layouts.master')

@section('pagetitle')
	Detail Penilaian
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">
	<style type="text/css">
		i.material-icons {
			vertical-align: middle;
		}
		table tr th, td{
			padding: 8px;
			text-align: center;
		}
	</style>
@endsection

@section('content')
	<div class="row">
		<div class="col-sm-12">
			<div class="white-box">
				<div style="text-align: left;">
					<h3 class="box-title m-b-0">{{$info->matkul}}</h3>
					<p class="text-muted m-b-30">{{$info->tahun}} - Semester {{$info->semester}} - Kelas {{$info->kelas}}</p>
                </div>
                
                <div class="row" style="width: 100%">
                    <div class="col-md-6">
                        <a><button class="btn btn-info">Download Template Penilaian</button></a>
                    </div>
                    <div class="col-md-6" style="text-align: right">
                        <a><button class="btn btn-warning">Upload Penilaian</button></a>
                        <a><button class="btn btn-primary">Download Hasil</button></a>
                    </div>
                </div><br>
                
				<table style="width:100%" id="list">
                    <thead>
                        <tr>
                            <th style="width: 5%">No.</th>
                            <th style="width: 10%">NRP</th>
							<th style="width: 30%">Nama</th>
							@foreach ($header as $item)
								<th style="width: 10%">{{$item}}</th>
							@endforeach
                            <th style="width: 10%">Rata-Rata</th>
                            <th style="width: 10%">Nilai Huruf</th>
                        </tr>
                    </thead>
                    <tbody>
						@foreach ($data as $mhs)
						<tr>
                            <td></td>
							<td>{{$mhs->mahasiswa['nrp']}}</td>
							<td style="text-align: left">{{$mhs->mahasiswa['nama']}}</td>
							@for ($i = 0; $i < count($header); $i++)
								<td>
									<input style="width:100%; text-align: center" type="number" value="{{$mhs->terpisah[$i]}}">
								</td>
							@endfor
							<td>{{$mhs->total}}</td>
                            <td>{{$mhs->nilai_huruf}}</td>
                        </tr>
						@endforeach
                    </tbody>
				</table>
				
				<div style="text-align: center" id="save">
                    <a><button type="submit" style="width: 15%" class="btn btn-success">Simpan</button></a>
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