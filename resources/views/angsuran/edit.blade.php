@extends('layouts.master')

@section('pagetitle')
	Ubah Angsuran
@endsection

@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="white-box">
			<h3 class="box-title m-b-0">Form Angsuran</h3>
			<p class="text-muted m-b-30">Ubah Angsuran</p>
			<form action="{{route('angsuran.update')}}" method="POST">
				{{csrf_field()}}
				<input type="hidden" name="id" value="{{$data->id}}">
				<div class="form-group">
					<label for="inp1" class="control-label">Nama</label>
					<input type="text" class="form-control" id="inp1" name="nama" placeholder="Cara 1" value="{{$data->nama}}" required> </div>
				<div class="form-group">
					<label for="inp2" class="control-label">Gelombang</label>
					<input type="text" class="form-control" id="inp2" name="gelombang" placeholder="2" value="{{$data->gelombang}}" required> </div>
				<div class="form-group">
					<label class="control-label">Detail Pembayaran</label>
					<br>
					Daftar Ulang 1:
					<div class="input-group">
						<span class="input-group-addon">Rp</span>
						<input type="text" class="form-control" id="du1" name="du1" placeholder="1500000" value="{{$data['template']['Daftar ulang 1']['biaya']}}" required>
					</div>
					<div style="margin-top: 1%;"></div>
					Terbilang:
					<input type="text" class="form-control" id="ter_du1" name="ter_du1" placeholder="Satu Juta Lima Ratus Ribu Rupiah" value="{{$data['template']['Daftar ulang 1']['terbilang']}}" required><br>
					Daftar Ulang 2:
					<div class="input-group">
						<span class="input-group-addon">Rp</span>
						<input type="text" class="form-control" id="du2" name="du2" placeholder="1500000" value="{{$data['template']['Daftar ulang 2']['biaya']}}" required>
					</div>
					<div style="margin-top: 1%;"></div>
					Terbilang:
					<input type="text" class="form-control" id="ter_du2" name="ter_du2" placeholder="Satu Juta Lima Ratus Ribu Rupiah" value="{{$data['template']['Daftar ulang 2']['terbilang']}}" required><br>
				</div>

				<div class="form-group">
					<label for="kali_pembayaran" class="control-label">Kali Angsuran</label>
					<select class="form-control" name="kali_pembayaran" id="kali_pembayaran" required="" onchange="getAng()">
						<option value="1"
						@if ($data->kali_angsuran == 1)
							selected=""
						@endif
						>1</option>
						<option value="2"
						@if ($data->kali_angsuran == 2)
							selected=""
						@endif
						>2</option>
						<option value="3"
						@if ($data->kali_angsuran == 3)
							selected=""
						@endif
						>3</option>
						<option value="4"
						@if ($data->kali_angsuran == 4)
							selected=""
						@endif
						>4</option>
						<option value="5"
						@if ($data->kali_angsuran == 5)
							selected=""
						@endif
						>5</option>
					</select>
				</div>
				<div class="form-group">
					<label class="control-label">Detail Angsuran</label>
					<div id="ang1" 
					@if ($data->kali_angsuran < 1)
						style="display: none;"
					@endif
					>
						Angsuran 1:
						<div class="input-group">
							<span class="input-group-addon">Rp</span>
							<input type="text" class="form-control" id="a1" name="a1" placeholder="1500000"
							@if ($data->kali_angsuran >= 1)
								value="{{$data['template']['Angsuran 1']['biaya']}}"
							@endif
							>
						</div>
						<div style="margin-top: 1%;"></div>
						Terbilang:
						<input type="text" class="form-control" id="ter_a1" name="ter_a1" placeholder="Satu Juta Lima Ratus Ribu Rupiah"
						@if ($data->kali_angsuran >= 1)
							value="{{$data['template']['Angsuran 1']['terbilang']}}"
						@endif
						><br>
					</div>
					<div id="ang2"
					@if ($data->kali_angsuran < 2)
						style="display: none;"
					@endif
					>
						Angsuran 2:
						<div class="input-group">
							<span class="input-group-addon">Rp</span>
							<input type="text" class="form-control" id="a2" name="a2" placeholder="1500000"
							@if ($data->kali_angsuran >= 2)
								value="{{$data['template']['Angsuran 2']['biaya']}}"
							@endif
							>
						</div>
						<div style="margin-top: 1%;"></div>
						Terbilang:
						<input type="text" class="form-control" id="ter_a2" name="ter_a2" placeholder="Satu Juta Lima Ratus Ribu Rupiah"
						@if ($data->kali_angsuran >= 2)
							value="{{$data['template']['Angsuran 2']['terbilang']}}"
						@endif
						><br>
					</div>
					<div id="ang3"
					@if ($data->kali_angsuran < 3)
						style="display: none;"
					@endif
					>
						Angsuran 3:
						<div class="input-group">
							<span class="input-group-addon">Rp</span>
							<input type="text" class="form-control" id="a3" name="a3" placeholder="1500000"
							@if ($data->kali_angsuran >= 3)
								value="{{$data['template']['Angsuran 3']['biaya']}}"
							@endif
							>
						</div>
						<div style="margin-top: 1%;"></div>
						Terbilang:
						<input type="text" class="form-control" id="ter_a3" name="ter_a3" placeholder="Satu Juta Lima Ratus Ribu Rupiah"
						@if ($data->kali_angsuran >= 3)
							value="{{$data['template']['Angsuran 3']['terbilang']}}"
						@endif
						><br>
					</div>
					<div id="ang4"
					@if ($data->kali_angsuran < 4)
						style="display: none;"
					@endif
					>
						Angsuran 4:
						<div class="input-group">
							<span class="input-group-addon">Rp</span>
							<input type="text" class="form-control" id="a4" name="a4" placeholder="1500000"
							@if ($data->kali_angsuran >= 4)
								value="{{$data['template']['Angsuran 4']['biaya']}}"
							@endif
							>
						</div>
						<div style="margin-top: 1%;"></div>
						Terbilang:
						<input type="text" class="form-control" id="ter_a4" name="ter_a4" placeholder="Satu Juta Lima Ratus Ribu Rupiah"
						@if ($data->kali_angsuran >= 4)
							value="{{$data['template']['Angsuran 4']['terbilang']}}"
						@endif
						><br>
					</div>
					<div id="ang5"
					@if ($data->kali_angsuran < 5)
						style="display: none;"
					@endif
					>
						Angsuran 5:
						<div class="input-group">
							<span class="input-group-addon">Rp</span>
							<input type="text" class="form-control" id="a5" name="a5" placeholder="1500000"
							@if ($data->kali_angsuran >= 5)
								value="{{$data['template']['Angsuran 5']['biaya']}}"
							@endif
							>
						</div>
						<div style="margin-top: 1%;"></div>
						Terbilang:
						<input type="text" class="form-control" id="ter_a5" name="ter_a5" placeholder="Satu Juta Lima Ratus Ribu Rupiah"
						@if ($data->kali_angsuran >= 5)
							value="{{$data['template']['Angsuran 5']['terbilang']}}"
						@endif
						><br>
					</div>
				</div>
				<div class="form-group">
					<label for="inp3" class="control-label">Keterangan</label>
					<input type="text" class="form-control" id="inp3" name="keterangan" placeholder="Informasi tambahan" value="{{$data->keterangan}}"> </div>
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