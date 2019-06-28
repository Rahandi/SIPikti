@extends('layouts.master')

@section('pagetitle')
	Tambah Angsuran
@endsection

@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="white-box">
			<h3 class="box-title m-b-0">Form Angsuran</h3>
			<p class="text-muted m-b-30">Tambahkan Angsuran</p>
			<form action="{{route('angsuran.store')}}" method="POST" data-toggle="validator">
				{{csrf_field()}}
				<div class="form-group">
					<label for="inp1" class="control-label">Nama</label>
					<input type="text" class="form-control" id="inp1" name="nama" placeholder="Angsuran Cara 1" required> </div>
				<div class="form-group">
					<label for="inp2" class="control-label">Gelombang</label>
					<input type="text" class="form-control" id="inp2" name="gelombang" placeholder="1" required> </div>
				
				<div class="form-group">
					<label class="control-label">Detail Pembayaran</label>
					<br>
					Daftar Ulang 1:
					<div class="input-group">
						<span class="input-group-addon">Rp</span>
						<input type="text" class="form-control" id="du1" name="du1" placeholder="1500000" required>
					</div><br>
					Daftar Ulang 2:
					<div class="input-group">
						<span class="input-group-addon">Rp</span>
						<input type="text" class="form-control" id="du2" name="du2" placeholder="1500000" required>
					</div>
				</div>

				<div class="form-group">
					<label for="kali_pembayaran" class="control-label">Kali Angsuran</label>
					<select class="form-control" name="kali_pembayaran" id="kali_pembayaran" required="" onchange="getAng()">
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
						</div><br>
					</div>
					<div id="ang2" style="display: none;">
						Angsuran 2:
						<div class="input-group">
							<span class="input-group-addon">Rp</span>
							<input type="text" class="form-control" id="a2" name="a2" placeholder="1500000">
						</div><br>
					</div>
					<div id="ang3" style="display: none;">
						Angsuran 3:
						<div class="input-group">
							<span class="input-group-addon">Rp</span>
							<input type="text" class="form-control" id="a3" name="a3" placeholder="1500000">
						</div><br>
					</div>
					<div id="ang4" style="display: none;">
						Angsuran 4:
						<div class="input-group">
							<span class="input-group-addon">Rp</span>
							<input type="text" class="form-control" id="a4" name="a4" placeholder="1500000">
						</div><br>
					</div>
					<div id="ang5" style="display: none;">
						Angsuran 5:
						<div class="input-group">
							<span class="input-group-addon">Rp</span>
							<input type="text" class="form-control" id="a5" name="a5" placeholder="1500000">
						</div><br>
					</div>
				</div>
				<div class="form-group">
					<label for="inp3" class="control-label">Keterangan</label>
					<input type="text" class="form-control" id="inp3" name="keterangan" placeholder="Informasi tambahan"> </div>
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
	function getAng(){
		var from = $('#kali_pembayaran').val();
		console.log("change!");
		$kali = from;
		console.log($kali);
		for (i = 1; i <= 5; i++){
			document.getElementById("ang"+i).style.display = "none";
		}
		for (i = 1; i <= $kali; i++){
			document.getElementById("ang"+i).style.display = "block";
		}
	}
</script>
@endsection