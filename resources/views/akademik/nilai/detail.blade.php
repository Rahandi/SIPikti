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
		}
	</style>
@endsection

@section('content')
{{dd($header, $data)}}
	<div class="row">
		<div class="col-sm-12">
			<div class="white-box">
				<div style="text-align: left;">
					<h3 class="box-title m-b-0">Detail Penilaian (Mata Kuliah)</h3>
					<p class="text-muted m-b-30"><i>Tahun | semester | kelas | mata kuliah</i></p>
                </div>
                
                <p><b>Mahasiswa</b></p>
                <a><button class="btn btn-info">Tambah Mahasiswa</button></a>
                <a><button class="btn btn-warning">Download Template Penilaian</button></a>
                <a><button class="btn btn-primary">Upload Penilaian</button></a>
                <a><button class="btn btn-success">Download Hasil</button></a>
                
				<table style="width:100%" border="">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kelas</th>
                            <th>NRP</th>
                            <th>Nama</th>
                            {{-- foreach kolom penilaian ada berapa --}}
                            <th>ETS</th>
                            {{-- endforeach --}}
                            <th>Rata-Rata</th>
                            <th>Nilai Huruf</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- foreach mahasiswa --}}
                        <tr>
                            <td></td>
                            <td>8839949</td>
                            <td>Rahandi </td>
                            <td>
                                <input type="number">
                            </td>
                            {{-- generate dari kolom2 nilai --}}
                            <td>84.00</td>
                            {{-- konversi dari rata2 nilai --}}
                            <td>A</td>
                        </tr>
                    </tbody>
                </table>
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
	</script>
@endsection