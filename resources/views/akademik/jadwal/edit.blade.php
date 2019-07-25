@extends('layouts.master')

@section('pagetitle')
	Ubah Jadwal
@endsection

@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="white-box">
			<h3 class="box-title m-b-0">Form Jadwal</h3>
			<p class="text-muted m-b-30">Ubah Jadwal</p>
			<form action="{{route('jadwal.update')}}" method="POST">
				{{csrf_field()}}
				<input type="hidden" name="id" value="{{$data->id}}">
				<div class="form-group">
					<label for="inp1" class="control-label">Termin</label>
					<input type="text" class="form-control" id="inp1" name="termin" placeholder="1" value="{{$data->termin}}" required>
				</div>
				<div class="form-group">
					<label for="inp2" class="control-label">Kelas</label>
					<input type="text" class="form-control" id="inp2" name="kelas" placeholder="A" value="{{$data->kelas}}" required>
				</div>
				<div class="form-group">
					<label for="inp3" class="control-label">Jam</label>
					<div style="width: 100%;">
						<input type="time" class="form-control col-sm-4" id="inp3" name="start_time" style="width: 10%;" value="{{$data->start_time}}" required>
						<p id="inp3" class="col-sm-1" style="text-align: center;vertical-align: middle;padding: 7px 12px;">s/d</p>
						<input type="time" class="form-control col-sm-4" id="inp3" name="end_time" style="width: 10%;" value="{{$data->end_time}}" required>
					</div>
				</div>
				<br><br>
				<div class="form-group">
					<label for="inp4" class="control-label">Mata Kuliah</label>
					<input type="text" class="form-control" id="inp4" name="mata_kuliah" placeholder="Aplikasi Perkantoran, Desain Web Profesional, Pemrograman Java, Teknik Multimedia Pendukung Game, Teknologi Basis Data." value="{{$data->mata_kuliah}}" required> </div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection