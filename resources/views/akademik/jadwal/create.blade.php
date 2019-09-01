@extends('layouts.master')

@section('pagetitle')
	Tambah Jadwal
@endsection

@section('css')
<style type="text/css">
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
			<p class="text-muted m-b-30">Tambahkan Jadwal</p>
			<form action="{{route('jadwal.store')}}" method="POST" data-toggle="validator">
				{{csrf_field()}}
				<div class="form-group" style="width: 100%;">
					<div class="col-md-4">
						<label for="inp1" class="control-label">Termin</label>
						<input type="text" class="form-control" id="inp1" name="termin" placeholder="1" required>
					</div>
					<div class="col-md-8">
						<label for="kelas" class="control-label">Kelas</label>
						<select class="form-control" name="kelas" id="kelas" required="" onchange="getKelas()">
							<option value="0">Select Here</option>
							<!-- foreach data kelas -->
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
							<option value="D">D</option>
							<option value="E">E</option>
							<option value="F">F</option>
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
						<td>10:00 s/d 12.30</td>
						<td>10:00 s/d 12.30</td>
					</tr>
				</table>

				<!-- if kelas != 'S' -->
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
							<select class="form-control" name="matkul[]" id="matkul" required="">
								<option value="">Select Here</option>
								<!-- foreach master MK -->
								<option value="1">Aplikasi Perkantoran</option>
								<option value="2">Pemrograman Java</option>
							</select>
						</td>
						<td>
							<select class="form-control" name="dosen[]" id="dosen">
								<option value="">Select Here</option>
								<!-- foreach master Dosen -->
								<option value="1">Dini Adni Navastara, S.Kom</option>
								<option value="2">Hadziq Fabroyir, S.Kom, Ph.D</option>
							</select>
						</td>
						<td>
							<select class="form-control" name="asisten[]" id="asisten">
								<option value="">Select Here</option>
								<!-- foreach master Asisten -->
								<option value="1">Yoshima Syach Putri</option>
								<option value="2">Rahandi Noor Pasha</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><label class="control-label">SELASA</label></td>
						<td>
							<select class="form-control" name="matkul[]" id="matkul" required="">
								<option value="">Select Here</option>
								<!-- foreach master MK -->
								<option value="1">1</option>
								<option value="2">2</option>
							</select>
						</td>
						<td>
							<select class="form-control" name="dosen[]" id="dosen">
								<option value="">Select Here</option>
								<!-- foreach master Dosen -->
								<option value="1">1</option>
								<option value="2">2</option>
							</select>
						</td>
						<td>
							<select class="form-control" name="asisten[]" id="asisten">
								<option value="">Select Here</option>
								<!-- foreach master Asisten -->
								<option value="1">1</option>
								<option value="2">2</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><label class="control-label">RABU</label></td>
						<td>
							<select class="form-control" name="matkul[]" id="matkul" required="">
								<option value="">Select Here</option>
								<!-- foreach master MK -->
								<option value="1">1</option>
								<option value="2">2</option>
							</select>
						</td>
						<td>
							<select class="form-control" name="dosen[]" id="dosen">
								<option value="">Select Here</option>
								<!-- foreach master Dosen -->
								<option value="1">1</option>
								<option value="2">2</option>
							</select>
						</td>
						<td>
							<select class="form-control" name="asisten[]" id="asisten">
								<option value="">Select Here</option>
								<!-- foreach master Asisten -->
								<option value="1">1</option>
								<option value="2">2</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><label class="control-label">KAMIS</label></td>
						<td>
							<select class="form-control" name="matkul[]" id="matkul" required="">
								<option value="">Select Here</option>
								<!-- foreach master MK -->
								<option value="1">1</option>
								<option value="2">2</option>
							</select>
						</td>
						<td>
							<select class="form-control" name="dosen[]" id="dosen">
								<option value="">Select Here</option>
								<!-- foreach master Dosen -->
								<option value="1">1</option>
								<option value="2">2</option>
							</select>
						</td>
						<td>
							<select class="form-control" name="asisten[]" id="asisten">
								<option value="">Select Here</option>
								<!-- foreach master Asisten -->
								<option value="1">1</option>
								<option value="2">2</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><label class="control-label">JUMAT</label></td>
						<td>
							<select class="form-control" name="matkul[]" id="matkul" required="">
								<option value="">Select Here</option>
								<!-- foreach master MK -->
								<option value="1">1</option>
								<option value="2">2</option>
							</select>
						</td>
						<td>
							<select class="form-control" name="dosen[]" id="dosen">
								<option value="">Select Here</option>
								<!-- foreach master Dosen -->
								<option value="1">1</option>
								<option value="2">2</option>
							</select>
						</td>
						<td>
							<select class="form-control" name="asisten[]" id="asisten">
								<option value="">Select Here</option>
								<!-- foreach master Asisten -->
								<option value="1">1</option>
								<option value="2">2</option>
							</select>
						</td>
					</tr>
				</table>
				
				<div style="margin-top: 3%; width: 100%; text-align: center;">
					<button type="submit" style="width: 15%;" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">

</script>
@endsection