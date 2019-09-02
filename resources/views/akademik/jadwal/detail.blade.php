@extends('layouts.master')

@section('pagetitle')
	Detail Jadwal
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
				<h3 class="box-title m-b-0">Kelas - {{ $data->kelas }}</h3>
				<p class="text-muted m-b-30">Termin {{ $data->termin }}</p>
				<div class="row row-in">
					
						<table id="list" class="table table-striped table-hover table-bordered" style="text-align: center; width: 100%;">
							<thead>
								<tr>
									<th style="width: 10%;text-align: center;">Hari</th>
									<th style="width: 25%;text-align: center;">Mata Kuliah</th>
									<th style="width: 25%;text-align: center;">Dosen</th>
									<th style="width: 25%;text-align: center;">Asisten</th>
								</tr>
							</thead>
							<tbody>
							<?php $hari = array('SENIN','SELASA','RABU','KAMIS','JUMAT') ?>
							@for ($i = 0; $i < 5; $i++)
								<tr>
									<td class="sorting_1"><label class="control-label">{{$hari[$i]}}</label></td>
									<td style="text-align: left;">{{$data->matkul[$i]}}</td>
									<td style="text-align: left;">{{$data->dosen[$i]}}</td>
									<td style="text-align: left;">{{$data->asisten[$i]}}</td>
								</tr>
							@endfor
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
	<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
@endsection