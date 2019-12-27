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
				<div style="text-align: left;">
					<h3 class="box-title m-b-0">Proyek Akhir</h3>
					<p class="text-muted m-b-30">{{$data->tahun}}</p>
                </div>
                
                <div class="row" id="tombol">
                    <div class="col-md-6">
                        <a href="{{route('pakp.pilih', ['jenis' => 'pa', 'tahun' => $data->tahun])}}"><button class="btn btn-info">Tambah Mahasiswa</button></a>
                    </div>
                    <div class="col-md-6" style="text-align: right">
                        <a href="{{route('pakp.download_template', ['jenis' => 'pa', 'tahun' => $data->tahun])}}"><button class="btn btn-danger">Download Template Penilaian</button></a>
                        <a><button type="button" id="tombolUp" data-toggle="modal" data-target="#modalUpload" class="btn btn-warning">Upload Penilaian</button></a>
                    </div>
                </div><br>
                
                <form action="{{route('pakp.submit', ['jenis' => 'pa', 'tahun' => $data->tahun])}}" method="POST">
                @csrf
				<table style="width:100%;" border="">
                    <thead>
                        <tr name="pa">
                            <th style="width: 1%">No.</th>
                            <th style="width: 5%">Kelas</th>
                            <th style="width: 11%">NRP</th>
                            <th style="width: 19%">Nama</th>
                            <th style="width: 25%">Judul PA</th>
                            <th style="width: 25%">Pembimbing PA</th>
                            <th style="width: 9%">Nilai PA</th>
                            <th style="width: 5%">Hapus</th>
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
                            <td>
                                <input class="form-control" name="{{$data->data[$i]->mhs_id}}|judul" type="text" placeholder="Contoh: Pengembangan Sistem Informasi" value="{{$data->data[$i]->judul}}">
                            </td>
                            <td>
                                <input class="form-control" name="{{$data->data[$i]->mhs_id}}|pembimbing" type="text" placeholder="Contoh: Dini Adni Navastara S.Kom, M.Sc." value="{{$data->data[$i]->pembimbing}}">
                            </td>
                            <td><input style="text-align: center;" class="form-control" name="{{$data->data[$i]->mhs_id}}|nilai_pa" type="text" placeholder="*AB" value="{{$data->data[$i]->nilai_pa}}"></td>
                            <td>
                                <a><button type="button" id="tombolDel" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete" value="{{$data->data[$i]->mhs_id}}"><i class="material-icons" style="font-size: 18px;">delete</i></button></a>
                            </td>
                        </tr>
                        @endfor
                    </tbody>
                </table><br>
                
                <div style="text-align: center;">
                    <a><button type="submit" class="btn btn-success">Simpan</button></a>
                </div>
                </form>

                <div id="modalDelete" class="w3-modal w3-round-xlarge" style="z-index: 99999;">
                    <div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round-large" style="width: 40%;">
                        <header class="w3-container w3-light-grey w3-round-large"> 
                            <span 
                            class="w3-button w3-display-topright w3-round-large" data-dismiss="modal">&times;</span>
                            <h2>Konfirmasi</h2>
                        </header>
                        <div class="w3-container" style="margin-top: 2%;">
                            <p>Apakah Anda yakin akan menghapus mahasiswa ini dari PA?</p>
                        </div>
                        <footer class="w3-container w3-light-grey w3-round-large" style="text-align: right;">
                            <form action="{{route('pakp.delete', ['jenis' => 'pa', 'tahun' => $data->tahun])}}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="mhs_id" id="valueId" value="">
                                <button type="submit" id="DeleteButton" class="btn btn-success" style="margin: 1%;">Ya</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin: 1%;">Tidak</button>
                            </form>
                        </footer>
                    </div>
                </div>
                <div id="modalUpload" class="w3-modal w3-round-xlarge" style="z-index: 99999;">
                    <div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round-large" style="width: 40%;">
                        <header class="w3-container w3-light-grey w3-round-large"> 
                            <span data-dismiss="modal" 
                            class="w3-button w3-display-topright w3-round-large">&times;</span>
                            <h2>Upload</h2>
                        </header>
                        <form action="{{route('pakp.upload_template', ['jenis' => 'pa', 'tahun' => $data->tahun])}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="w3-container" style="margin-top: 2%;">
                            <input type="file" name="upload"><br>
                        </div>
                        <footer class="w3-container w3-light-grey w3-round-large" style="text-align: right;">
                            <input type="hidden" name="id" id="UpValueId" value="">
                            <button type="submit" class="btn btn-success" id="UploadButton" style="margin: 1%;">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin: 1%;">Batal</button>
                        </footer>
                        </form>
                    </div>
                </div>
			</div>
		</div>
	</div>
@endsection

@section('js')
	<script type="text/javascript" src="{{ URL::asset('js/sipikti.js') }}"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('js/bootstrap.js') }}">
    <script>
        $(document).ready(function() {
			$("#modalSuccess").modal({
				fadeDuration: 100
			});
		});
        var Id;
		$(document).ready(function(){
			$(document).on('click', '#tombolDel', function () {
				console.log('id yg passing');
				Id = $(this).val();
				console.log(Id);
				document.getElementById("valueId").value = Id;
			});
		});
    </script>
@endsection