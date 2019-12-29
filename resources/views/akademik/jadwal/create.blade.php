@extends('layouts.master')

@section('pagetitle')
	Tambah Jadwal
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
		table tr th, td{
			padding: 8px;
		}
	</style>
@endsection

@section('content')
@if (session('status'))
	<div id="modalSuccess" class="modal fade" role="dialog" style="z-index: 9999; width:100%;">
		<div class="modal-dialog" style="width: 75%;">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" style="text-align: center"><b>{{session('status')}}</b></h4>
				</div>
			</div>
		</div>
	</div>
@endif
<div class="row">
	<div class="col-sm-12">
		<div class="white-box">
			<h3 class="box-title m-b-0">Form Jadwal</h3>
			<p class="text-muted m-b-30">Tambahkan Jadwal</p>
			<form action="{{route('jadwal.store')}}" method="POST" data-toggle="validator">
				{{csrf_field()}}
				<div class="form-group" style="width: 100%;">
					<div class="col-md-3">
						<label for="inp1" class="control-label">Tahun</label>
						<input type="text" class="form-control text" data-style="btn-info btn-outline" id="inp1" name="tahun" placeholder="2019" required>
					</div>
					<div class="col-md-3">
						<label for="inp1" class="control-label">Semester</label>
						<input type="text" class="form-control text" data-style="btn-info btn-outline" id="inp1" name="termin" placeholder="1" required>
					</div>
					<div class="col-md-6">
						<label for="kelas" class="control-label">Kelas</label>
						<select class="form-control selectpicker" name="kelas" id="kelas" required="" onchange="getKelas()">
							<option value="0">Select Here</option>
							@foreach ($data->masterKelas as $mkelas)
							<option value="{{$mkelas->nama}}">{{$mkelas->nama}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<br><br>
				<table style="width: 100%; text-align: center; margin-top: 5%;">
					<tr>
						<th style="text-align: center; display: none" id="jml">Jumlah Pertemuan</th>
						<th style="text-align: center;" id="judul_SK">Senin-Kamis (Jam)</th>
						<th style="text-align: center;" id="judul_J">Jumat (Jam)</th>
					</tr>
					<tr>
						<td style="display: none" id="val_jml"><input style="text-align: center;" id="inp_jml" type="text" value="" placeholder="16" onchange="generateJml()"></td>
						<td id="jam_SK">--:-- s/d --:--</td>
						<td id="jam_J">--:-- s/d --:--</td>
					</tr>
				</table>
				
				<h4 class="box-title m-b-0" style="margin-top: 2%;">Pilih Mata Kuliah</h4>
				<p class="text-muted m-b-30">Tambahkan Mata Kuliah</p>

				<div id="mkperday">
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
								<option value="{{$mmk->id}}">{{$mmk->nama}}</option>
								@endforeach
							</select>
						</td>
						<td>
							<select class="form-control selectpicker" data-style="btn-primary btn-outline" name="dosen[]" id="dosen">
								<option value="">Select Here</option>
								@foreach ($data->masterDosen as $mdosen)
								<option value="{{$mdosen->id}}">{{$mdosen->nama}}</option>
								@endforeach
							</select>
						</td>
						<td>
							<select class="form-control selectpicker" data-style="btn-danger btn-outline" name="asisten[]" id="asisten">
								<option value="">Select Here</option>
								@foreach ($data->masterAsisten as $masist)
								<option value="{{$masist->id}}">{{$masist->nama}}</option>
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
								<option value="{{$mmk->id}}">{{$mmk->nama}}</option>
								@endforeach
							</select>
						</td>
						<td>
							<select class="form-control selectpicker" data-style="btn-primary btn-outline" name="dosen[]" id="dosen">
								<option value="">Select Here</option>
								@foreach ($data->masterDosen as $mdosen)
								<option value="{{$mdosen->id}}">{{$mdosen->nama}}</option>
								@endforeach
							</select>
						</td>
						<td>
							<select class="form-control selectpicker" data-style="btn-danger btn-outline" name="asisten[]" id="asisten">
								<option value="">Select Here</option>
								@foreach ($data->masterAsisten as $masist)
								<option value="{{$masist->id}}">{{$masist->nama}}</option>
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
								<option value="{{$mmk->id}}">{{$mmk->nama}}</option>
								@endforeach
							</select>
						</td>
						<td>
							<select class="form-control selectpicker" data-style="btn-primary btn-outline" name="dosen[]" id="dosen">
								<option value="">Select Here</option>
								@foreach ($data->masterDosen as $mdosen)
								<option value="{{$mdosen->id}}">{{$mdosen->nama}}</option>
								@endforeach
							</select>
						</td>
						<td>
							<select class="form-control selectpicker" data-style="btn-danger btn-outline" name="asisten[]" id="asisten">
								<option value="">Select Here</option>
								@foreach ($data->masterAsisten as $masist)
								<option value="{{$masist->id}}">{{$masist->nama}}</option>
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
								<option value="{{$mmk->id}}">{{$mmk->nama}}</option>
								@endforeach
							</select>
						</td>
						<td>
							<select class="form-control selectpicker" data-style="btn-primary btn-outline" name="dosen[]" id="dosen">
								<option value="">Select Here</option>
								@foreach ($data->masterDosen as $mdosen)
								<option value="{{$mdosen->id}}">{{$mdosen->nama}}</option>
								@endforeach
							</select>
						</td>
						<td>
							<select class="form-control selectpicker" data-style="btn-danger btn-outline" name="asisten[]" id="asisten">
								<option value="">Select Here</option>
								@foreach ($data->masterAsisten as $masist)
								<option value="{{$masist->id}}">{{$masist->nama}}</option>
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
								<option value="{{$mmk->id}}">{{$mmk->nama}}</option>
								@endforeach
							</select>
						</td>
						<td>
							<select class="form-control selectpicker" data-style="btn-primary btn-outline" name="dosen[]" id="dosen">
								<option value="">Select Here</option>
								@foreach ($data->masterDosen as $mdosen)
								<option value="{{$mdosen->id}}">{{$mdosen->nama}}</option>
								@endforeach
							</select>
						</td>
						<td>
							<select class="form-control selectpicker" data-style="btn-danger btn-outline" name="asisten[]" id="asisten">
								<option value="">Select Here</option>
								@foreach ($data->masterAsisten as $masist)
								<option value="{{$masist->id}}">{{$masist->nama}}</option>
								@endforeach
							</select>
						</td>
					</tr>
				</table>
				</div>
				<table style="width: 100%;text-align: center; display:none;" id="tableMK_S" border="">
				<thead>
					<tr>
						<th style="text-align: center; width: 10%;">Tanggal</th>
						<th style="text-align: center; width: 30%;">Mata Kuliah</th>
						<th style="text-align: center; width: 10%;">Bagian</th>
						<th style="text-align: center; width: 25%;">Dosen (Optional)</th>
						<th style="text-align: center; width: 25%;">Asisten (Optional)</th>
					</tr>
				</thead>
				<tbody></tbody>
				</table>
				<div style="margin-top: 3%; width: 100%; text-align: center;">
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
	$(document).ready(function() {
		$("#modalSuccess").modal({
			fadeDuration: 100
		});
	});
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
	function getKelas(){
		var kls = $('#kelas').val();
		var nama_kls = <?php echo json_encode($data->masterKelas); ?>;
		for (i = 0; i < nama_kls.length; i ++){
			if (nama_kls[i]['nama'] == kls) {
				console.log(nama_kls[i]['jam_SK']);
				document.getElementById("jam_SK").innerHTML = nama_kls[i]['jam_SK'];
				document.getElementById("jam_J").innerHTML = nama_kls[i]['jam_J'];
				if (kls.includes("S") || kls.includes("s")) {
					document.getElementById('judul_SK').style.display = "none";
					document.getElementById('judul_J').innerHTML = "Sabtu (Jam)";
					document.getElementById('jam_SK').style.display = "none";
					document.getElementById('jml').style.display = "";
					document.getElementById('val_jml').style.display = "";
					document.getElementById("mkperday").style.display = "none";
					document.getElementById("tableMK_S").style.display = "";

					let matkul = document.getElementsByName("matkul[]");
					for(j=0;j<matkul.length;j++)
					{
						matkul[j].required = false
						matkul[j].disabled = true
					}

					let dosen = document.getElementsByName("dosen[]");
					for(j=0;j<dosen.length;j++)
					{
						dosen[j].required = false
						dosen[j].disabled = true
					}

					let asisten = document.getElementsByName("asisten[]");
					for(j=0;j<asisten.length;j++)
					{
						asisten[j].required = false
						asisten[j].disabled = true
					}

					generateJml();
				}
				else {
					$("#tableMK_S tbody tr").remove();
					document.getElementById('jml').style.display = "none";
					document.getElementById('val_jml').style.display = "none";
					document.getElementById('judul_J').innerHTML = "Jumat (Jam)";
					document.getElementById('judul_SK').style.display = "";
					document.getElementById('jam_SK').style.display = "";
					document.getElementById("mkperday").style.display = "block";
					document.getElementById("tableMK_S").style.display = "none";

					let matkul = document.getElementsByName("matkul[]");
					for(j=0;j<matkul.length;j++)
					{
						matkul[j].required = true
						matkul[j].disabled = false
					}

					let dosen = document.getElementsByName("dosen[]");
					for(j=0;j<dosen.length;j++)
					{
						dosen[j].required = true
						dosen[j].disabled = false
					}

					let asisten = document.getElementsByName("asisten[]");
					for(j=0;j<asisten.length;j++)
					{
						asisten[j].required = true
						asisten[j].disabled = false
					}
				}
			}
		}
	}
	function generateJml(){
		$("#tableMK_S tbody tr").remove();
		let from = $('#inp_jml').val();

		let dosen = <?php echo json_encode($data->masterDosen); ?>;
		let asisten = <?php echo json_encode($data->masterAsisten); ?>;
		let mk = <?php echo json_encode($data->masterMK); ?>;

		let table_body = document.getElementById('tableMK_S').getElementsByTagName('tbody')[0]
		for (var i = 0; i < from; i++)
		{
			table_body.insertRow()
			let row = table_body.getElementsByTagName('tr')[table_body.getElementsByTagName('tr').length - 1]

			let tanggal_place = row.insertCell()
			let tanggal_input = document.createElement("input")
			tanggal_input.class = 'form-control'
			tanggal_input.type = 'date'
			tanggal_input.name = 'tgl_mk[]'
			tanggal_input.style.width = '100%'
			tanggal_input.required = true
			tanggal_place.appendChild(tanggal_input)

			let mk_place = row.insertCell()
			let mk_select = document.createElement("select")
			// mk_select.className = "form-control selectpicker"
			mk_select.class = "form-control selectpicker"
			mk_select.name = 'matkul[]'
			mk_select.style.width = '100%'
			mk_select.required = true

			let option = document.createElement('option')
			option.value = '-'
			option.text = 'Select Here'
			mk_select.appendChild(option)

			for(var j = 0; j < mk.length; j++)
			{
				option = document.createElement('option')
				option.value = mk[j].id
				option.text = mk[j].nama
				mk_select.appendChild(option)
			}
			mk_place.appendChild(mk_select)

			let bagian_place = row.insertCell()
			let bagian_input = document.createElement("input")
			bagian_input.class = 'form-control'
			bagian_input.type = 'text'
			bagian_input.name = 'bagian_mk[]'
			bagian_input.placeholder = '1'
			bagian_input.value = ''
			bagian_input.style.width = '100%'
			bagian_input.style.textAlign = 'center'
			bagian_input.required = true
			bagian_place.appendChild(bagian_input)

			let dosen_place = row.insertCell()
			let dosen_select = document.createElement("select")
			dosen_select.class = "form-control selectpicker"
			dosen_select.name = 'dosen[]'
			dosen_select.style.width = '100%'

			let option2 = document.createElement('option')
			option2.value = '-'
			option2.text = 'Select Here'
			dosen_select.appendChild(option2)

			for(var j = 0; j < dosen.length; j++)
			{
				option2 = document.createElement('option')
				option2.value = dosen[j].id
				option2.text = dosen[j].nama
				dosen_select.appendChild(option2)
			}
			dosen_place.appendChild(dosen_select)

			let asisten_place = row.insertCell()
			let asisten_select = document.createElement("select")
			asisten_select.class = "form-control selectpicker"
			asisten_select.name = 'asisten[]'
			asisten_select.style.width = '100%'
			let option3 = document.createElement('option')
			option3.value = '-'
			option3.text = 'Select Here'
			asisten_select.appendChild(option3)

			for(var j = 0; j < asisten.length; j++)
			{
				option3 = document.createElement('option')
				option3.value = asisten[j].id
				option3.text = asisten[j].nama
				asisten_select.appendChild(option3)
			}
			asisten_place.appendChild(asisten_select)
		}
	};
</script>
@endsection