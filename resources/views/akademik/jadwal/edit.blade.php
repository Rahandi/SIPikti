@extends('layouts.master')

@section('pagetitle')
	Edit Jadwal
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">
	<link href="{{ URL::asset('plugins/bower_components/custom-select/custom-select.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ URL::asset('plugins/bower_components/switchery/dist/switchery.min.css') }}" rel="stylesheet" />
	<link href="{{ URL::asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />
	<link href="{{ URL::asset('plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')}}" rel="stylesheet" />
	<link href="{{ URL::asset('plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" />
	<link href="{{ URL::asset('plugins/bower_components/multiselect/css/multi-select.css')}}" rel="stylesheet" type="text/css" />
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
			<h3 class="box-title m-b-0">Form Jadwal</h3>
			<p class="text-muted m-b-30">Ubah Jadwal</p>
			<form action="{{route('jadwal.update')}}" method="POST" data-toggle="validator">
				{{csrf_field()}}
				<div class="form-group" style="width: 100%;">
					<div class="col-md-3">
						<label for="inp1" class="control-label">Tahun</label>
						<input type="text" class="form-control text" data-style="btn-info btn-outline" id="inp1" name="tahun" placeholder="2019" required>
					</div>
					<div class="col-md-3">
						<label for="inp1" class="control-label">Semester</label>
						<input type="text" class="form-control text" data-style="btn-info btn-outline" id="inp1" name="termin" placeholder="1" value="{{ $data->termin }}" required>
					</div>
					<div class="col-md-6">
						<label for="kelas" class="control-label">Kelas</label>
						<select class="form-control selectpicker" name="kelas" id="kelas" required="" onchange="getKelas()">
							<option value="0">Select Here</option>
							@foreach ($data->masterKelas as $mkelas)
							<option value="{{$mkelas->nama}}"
								@if ($mkelas->nama == $data->kelas)
									selected=""
								@endif
							>{{$mkelas->nama}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<br><br>
				<table style="width: 100%; text-align: center; margin-top: 5%;">
					<tr>
						<th style="text-align: center;">Senin-Kamis (Jam)</th>
						<th style="text-align: center;">Jumat (Jam)</th>
					</tr>
					<tr>
						<td id="jam_SK">--:-- s/d --:--</td>
						<td id="jam_J">--:-- s/d --:--</td>
					</tr>
				</table>

				<div id="mkperday">
				<h4 class="box-title m-b-0" style="margin-top: 2%;">Pilih Mata Kuliah</h4>
				<p class="text-muted m-b-30">Tambahkan Mata Kuliah</p>

				<table style="width: 100%;text-align: center;" id="tableMK" border="">
					<tr>
						<th style="text-align: center; width: 10%;">Hari</th>
						<th style="text-align: center; width: 35%;">Mata Kuliah</th>
						<th style="text-align: center; width: 30%;">Dosen (Optional)</th>
						<th style="text-align: center; width: 25%;">Asisten (Optional)</th>
					</tr>
					<tr>
						<td><label class="control-label">SENIN</label></td>
						<td>
							<select class="form-control selectpicker" data-style="btn-info btn-outline" name="matkul[]" id="matkul" required="">
								<option value="">Select Here</option>
								@foreach ($data->masterMK as $mmk)
								<option value="{{$mmk->id}}"
								@if ($mmk->id == $data->matkul[0])
									selected=""
								@endif
								>{{$mmk->nama}}</option>
								@endforeach
							</select>
						</td>
						<td>
							<select class="form-control selectpicker" data-style="btn-primary btn-outline" name="dosen[]" id="dosen">
								<option value="">Select Here</option>
								@foreach ($data->masterDosen as $mdosen)
								<option value="{{$mdosen->id}}"
								@if ($mdosen->id == $data->dosen[0])
									selected=""
								@endif
								>{{$mdosen->nama}}</option>
								@endforeach
							</select>
						</td>
						<td>
							<select class="form-control selectpicker" data-style="btn-danger btn-outline" name="asisten[]" id="asisten">
								<option value="">Select Here</option>
								@foreach ($data->masterAsisten as $masist)
								<option value="{{$masist->id}}"
								@if ($masist->id == $data->asisten[0])
									selected=""
								@endif
								>{{$masist->nama}}</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<td><label class="control-label">SELASA</label></td>
						<td>
							<select class="form-control selectpicker" data-style="btn-info btn-outline" name="matkul[]" id="matkul" required="">
								<option value="">Select Here</option>
								@foreach ($data->masterMK as $mmk)
								<option value="{{$mmk->id}}"
								@if ($mmk->id == $data->matkul[1])
									selected=""
								@endif
								>{{$mmk->nama}}</option>
								@endforeach
							</select>
						</td>
						<td>
							<select class="form-control selectpicker" data-style="btn-primary btn-outline" name="dosen[]" id="dosen">
								<option value="">Select Here</option>
								@foreach ($data->masterDosen as $mdosen)
								<option value="{{$mdosen->id}}"
								@if ($mdosen->id == $data->dosen[1])
									selected=""
								@endif
								>{{$mdosen->nama}}</option>
								@endforeach
							</select>
						</td>
						<td>
							<select class="form-control selectpicker" data-style="btn-danger btn-outline" name="asisten[]" id="asisten">
								<option value="">Select Here</option>
								@foreach ($data->masterAsisten as $masist)
								<option value="{{$masist->id}}"
								@if ($masist->id == $data->asisten[1])
									selected=""
								@endif
								>{{$masist->nama}}</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<td><label class="control-label">RABU</label></td>
						<td>
							<select class="form-control selectpicker" data-style="btn-info btn-outline" name="matkul[]" id="matkul" required="">
								<option value="">Select Here</option>
								@foreach ($data->masterMK as $mmk)
								<option value="{{$mmk->id}}"
								@if ($mmk->id == $data->matkul[2])
									selected=""
								@endif
								>{{$mmk->nama}}</option>
								@endforeach
							</select>
						</td>
						<td>
							<select class="form-control selectpicker" data-style="btn-primary btn-outline" name="dosen[]" id="dosen">
								<option value="">Select Here</option>
								@foreach ($data->masterDosen as $mdosen)
								<option value="{{$mdosen->id}}"
								@if ($mdosen->id == $data->dosen[2])
									selected=""
								@endif
								>{{$mdosen->nama}}</option>
								@endforeach
							</select>
						</td>
						<td>
							<select class="form-control selectpicker" data-style="btn-danger btn-outline" name="asisten[]" id="asisten">
								<option value="">Select Here</option>
								@foreach ($data->masterAsisten as $masist)
								<option value="{{$masist->id}}"
								@if ($masist->id == $data->asisten[2])
									selected=""
								@endif
								>{{$masist->nama}}</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<td><label class="control-label">KAMIS</label></td>
						<td>
							<select class="form-control selectpicker" data-style="btn-info btn-outline" name="matkul[]" id="matkul" required="">
								<option value="">Select Here</option>
								@foreach ($data->masterMK as $mmk)
								<option value="{{$mmk->id}}"
								@if ($mmk->id == $data->matkul[3])
									selected=""
								@endif
								>{{$mmk->nama}}</option>
								@endforeach
							</select>
						</td>
						<td>
							<select class="form-control selectpicker" data-style="btn-primary btn-outline" name="dosen[]" id="dosen">
								<option value="">Select Here</option>
								@foreach ($data->masterDosen as $mdosen)
								<option value="{{$mdosen->id}}"
								@if ($mdosen->id == $data->dosen[3])
									selected=""
								@endif
								>{{$mdosen->nama}}</option>
								@endforeach
							</select>
						</td>
						<td>
							<select class="form-control selectpicker" data-style="btn-danger btn-outline" name="asisten[]" id="asisten">
								<option value="">Select Here</option>
								@foreach ($data->masterAsisten as $masist)
								<option value="{{$masist->id}}"
								@if ($masist->id == $data->asisten[3])
									selected=""
								@endif
								>{{$masist->nama}}</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr>
						<td><label class="control-label">JUMAT</label></td>
						<td>
							<select class="form-control selectpicker" data-style="btn-info btn-outline" name="matkul[]" id="matkul" required="">
								<option value="">Select Here</option>
								@foreach ($data->masterMK as $mmk)
								<option value="{{$mmk->id}}"
								@if ($mmk->id == $data->matkul[4])
									selected=""
								@endif
								>{{$mmk->nama}}</option>
								@endforeach
							</select>
						</td>
						<td>
							<select class="form-control selectpicker" data-style="btn-primary btn-outline" name="dosen[]" id="dosen">
								<option value="">Select Here</option>
								@foreach ($data->masterDosen as $mdosen)
								<option value="{{$mdosen->id}}"
								@if ($mdosen->id == $data->dosen[4])
									selected=""
								@endif
								>{{$mdosen->nama}}</option>
								@endforeach
							</select>
						</td>
						<td>
							<select class="form-control selectpicker" data-style="btn-danger btn-outline" name="asisten[]" id="asisten">
								<option value="">Select Here</option>
								@foreach ($data->masterAsisten as $masist)
								<option value="{{$masist->id}}"
								@if ($masist->id == $data->asisten[4])
									selected=""
								@endif
								>{{$masist->nama}}</option>
								@endforeach
							</select>
						</td>
					</tr>
				</table>
				</div>

				<div style="margin-top: 3%; width: 100%; text-align: center;">
					<input type="hidden" name="id" value="{{$data->id}}">
					<button type="submit" style="width: 15%;" class="btn btn-success">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ URL::asset('js/sipikti.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="{{ URL::asset('plugins/bower_components/switchery/dist/switchery.min.js') }}"></script>
<script src="{{ URL::asset('plugins/bower_components/custom-select/custom-select.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('plugins/bower_components/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script>
	jQuery(document).ready(function () {
		// Switchery
		var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
		$('.js-switch').each(function () {
			new Switchery($(this)[0], $(this).data());
		});
		// For select 2
		$(".select2").select2();
		$('.selectpicker').selectpicker();

	});
	function reloadPlis(){
		setTimeout(function(){location.reload()},500);
	}
</script>
<script src="{{ URL::asset('plugins/bower_components/styleswitcher/jQuery.style.switcher.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		var kls = $('#kelas').val();
		console.log("change!");
		console.log(kls);
		var nama_kls = <?php echo json_encode($data->masterKelas); ?>;
		console.log(nama_kls);
		for (i = 0; i < nama_kls.length; i ++){
			if (nama_kls[i]['nama'] == kls) {
				console.log(nama_kls[i]['jam_SK']);
				document.getElementById("jam_SK").innerHTML = nama_kls[i]['jam_SK'];
				document.getElementById("jam_J").innerHTML = nama_kls[i]['jam_J'];
				if (kls.includes("S") || kls.includes("s")) {
					document.getElementById("mkperday").style.display = "none";
				}
				else {
					document.getElementById("mkperday").style.display = "block";
				}
			}
		}
	});
	function getKelas(){
		var kls = $('#kelas').val();
		console.log("change!");
		console.log(kls);
		var nama_kls = <?php echo json_encode($data->masterKelas); ?>;
		console.log(nama_kls);
		for (i = 0; i < nama_kls.length; i ++){
			if (nama_kls[i]['nama'] == kls) {
				console.log(nama_kls[i]['jam_SK']);
				document.getElementById("jam_SK").innerHTML = nama_kls[i]['jam_SK'];
				document.getElementById("jam_J").innerHTML = nama_kls[i]['jam_J'];
				if (kls.includes("S") || kls.includes("s")) {
					document.getElementById("mkperday").style.display = "none";
				}
				else {
					document.getElementById("mkperday").style.display = "block";
				}
			}
		}
	}
</script>
@endsection