@extends('layouts.master')

@section('pagetitle')
	Detail Penilaian PA
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
        th {
            text-align: center;
        }
	</style>
@endsection

@section('content')
	<div class="row">
		<div class="col-sm-12">
			<div class="white-box">
				<div style="text-align: left;">
					<h3 class="box-title m-b-0">Proyek Akhir</h3>
					<p class="text-muted m-b-30">{{$data->tahun}}</p>
                </div>
                
                <div class="row" id="tombol">
                    <div class="col-md-6">
                        <a href="{{route('pakp.pilih', ['jenis' => 'kompre', 'tahun' => $data->tahun])}}"><button class="btn btn-info">Tambah Mahasiswa</button></a>
                    </div>
                    <div class="col-md-6">
                        <a><button class="btn btn-danger">Download Template Penilaian</button></a>
                        <a><button class="btn btn-warning">Upload Penilaian</button></a>
                        <a><button class="btn btn-primary">Download Hasil</button></a>
                    </div>
                </div><br>
                
                <form action="{{route('pakp.submit', ['jenis' => 'kompre', 'tahun' => $data->tahun])}}" method="POST">
                @csrf
				<table style="width:100%;" border="">
                    <thead>
                        <tr name="kompre">
                            <th style="width: 1%">No.</th>
                            <th style="width: 5%">Kelas</th>
                            <th style="width: 25%">NRP</th>
                            <th style="width: 40%">Nama</th>
                            <th style="width: 29%">Nilai Komprehensif</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count($data->data); $i++)
                        <tr>
                            <td style="text-align: center;">{{$i+1}}.</td>
                            <td style="text-align: center;">{{$data->data[$i]->kelas}}</td>
                            <td style="text-align: center;">{{$data->data[$i]->nrp}}</td>
                            <td>{{$data->data[$i]->nama}}</td>
                            <input type="hidden" name="id_mhs[]" value="{{$data->data[$i]->mhs_id}}">
                            <td><input style="text-align: center;" class="form-control" name="{{$data->data[$i]->mhs_id}}|nilai_kompre" type="text" placeholder="*AB" value="{{$data->data[$i]->nilai_kompre}}"></td>
                        </tr>
                        @endfor
                    </tbody>
                </table><br>
                
                <div style="text-align: center;">
                    <a><button type="submit" class="btn btn-success">Simpan</button></a>
                </div>
                </form>
			</div>
		</div>
	</div>
@endsection

@section('js')
	<script type="text/javascript" src="{{ URL::asset('js/sipikti.js') }}"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('js/bootstrap.js') }}">
@endsection