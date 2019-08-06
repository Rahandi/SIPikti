@extends('layouts.master')

@section('pagetitle')
	Tambah Jadwal
@endsection

@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="white-box">
			<h3 class="box-title m-b-0">Form Jadwal</h3>
			<p class="text-muted m-b-30">Tambahkan Jadwal</p>
			<form action="{{route('jadwal.store')}}" method="POST" data-toggle="validator">
				{{csrf_field()}}
				<div class="form-group">
					<label for="inp1" class="control-label">Termin</label>
					<input type="text" class="form-control" id="inp1" name="termin" placeholder="1" required>
				</div>
				<div class="form-group">
					<label for="inp2" class="control-label">Kelas</label>
					<input type="text" class="form-control" id="inp2" name="kelas" placeholder="A" required>
				</div>
				<div class="form-group">
					<label for="inp3" class="control-label">Jam</label>
					<div style="width: 100%;">
						<input type="time" class="form-control col-sm-4" id="inp3" name="start_time" style="width: 10%;" required>
						<p id="inp3" class="col-sm-1" style="text-align: center;vertical-align: middle;padding: 7px 12px;">s/d</p>
						<input type="time" class="form-control col-sm-4" id="inp3" name="end_time" style="width: 10%;" required>
					</div>
				</div>
				<br><br>
				<div class="form-group">
					<label for="inp4" class="control-label">Mata Kuliah</label>
					<input type="text" class="form-control" id="inp4" name="mata_kuliah" placeholder="Aplikasi Perkantoran, Desain Web Profesional, Pemrograman Java, Teknik Multimedia Pendukung Game, Teknologi Basis Data." required> </div>

				<div class="form-group">
					<label for="matkul" class="control-label">Mata Kuliah</label>
					<select class="form-control" name="matkul" id="matkul" required="" onchange="getMK()">
						<option value="0">Select Here</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
				</div>
				<div class="form-group">
					<label class="control-label">Detail Angsuran</label>
					<div id="ang1" style="display: none;">
						Angsuran 1:
						<div class="input-group">
							<span class="input-group-addon">Rp</span>
							<input type="text" class="form-control" id="a1" name="a1" placeholder="1500000">
						</div>
						<div style="margin-top: 1%;"></div>
						Terbilang:
						<input type="text" class="form-control" id="ter_a1" name="ter_a1" placeholder="Satu Juta Lima Ratus Ribu Rupiah"><br>
					</div>
					<div id="ang2" style="display: none;">
						Angsuran 2:
						<div class="input-group">
							<span class="input-group-addon">Rp</span>
							<input type="text" class="form-control" id="a2" name="a2" placeholder="1500000">
						</div>
						<div style="margin-top: 1%;"></div>
						Terbilang:
						<input type="text" class="form-control" id="ter_a2" name="ter_a2" placeholder="Satu Juta Lima Ratus Ribu Rupiah"><br>
					</div>
					<div id="ang3" style="display: none;">
						Angsuran 3:
						<div class="input-group">
							<span class="input-group-addon">Rp</span>
							<input type="text" class="form-control" id="a3" name="a3" placeholder="1500000">
						</div>
						<div style="margin-top: 1%;"></div>
						Terbilang:
						<input type="text" class="form-control" id="ter_a3" name="ter_a3" placeholder="Satu Juta Lima Ratus Ribu Rupiah"><br>
					</div>
					<div id="ang4" style="display: none;">
						Angsuran 4:
						<div class="input-group">
							<span class="input-group-addon">Rp</span>
							<input type="text" class="form-control" id="a4" name="a4" placeholder="1500000">
						</div>
						<div style="margin-top: 1%;"></div>
						Terbilang:
						<input type="text" class="form-control" id="ter_a4" name="ter_a4" placeholder="Satu Juta Lima Ratus Ribu Rupiah"><br>
					</div>
					<div id="ang5" style="display: none;">
						Angsuran 5:
						<div class="input-group">
							<span class="input-group-addon">Rp</span>
							<input type="text" class="form-control" id="a5" name="a5" placeholder="1500000">
						</div>
						<div style="margin-top: 1%;"></div>
						Terbilang:
						<input type="text" class="form-control" id="ter_a5" name="ter_a5" placeholder="Satu Juta Lima Ratus Ribu Rupiah"><br>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
	function getMK(){
		var from = $('#matkul').val();
		console.log("change!");
		$jml = from;
		console.log($jml);
		for (i = 1; i <= 5; i++){
			document.getElementById(i).style.display = "none";
		}
		for (i = 1; i <= $jml; i++){
			document.getElementById(i).style.display = "block";
		}
	}
</script>
@endsection