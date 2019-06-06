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
					<input type="text" class="form-control" id="inp1" name="nama" placeholder="Angsuran 1" value="{{$data->nama}}" required> </div>
				<div class="form-group">
					<label for="inp2" class="control-label">Gelombang</label>
					<input type="text" class="form-control" id="inp2" name="gelombang" placeholder="1" value="{{$data->gelombang}}" required> </div>
				<div class="form-group">
					<label for="inp3" class="control-label">Detail</label>
					<input type="text" class="form-control" id="inp3" name="detail" placeholder="Pembayaran 1-2: Rp 2.000.000; Pembayaran 3-4: Rp 1.500.000" value="{{$data->detail}}" required> </div>
				<div class="form-group">
					<label for="inp4" class="control-label">Kali Pembayaran</label>
					<input type="number" class="form-control" id="inp4" name="kali_pembayaran" placeholder="4" value="{{$data->kali_pembayaran}}" disabled="disabled"> </div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection