@extends('layouts.master')

@section('pagetitle')
	Transkrip
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
			padding: 3%;
		}
	</style>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="box-title m-b-0">Data Pejabat</h3>
            <table style="width:100%;">
                <form action="{{route('pejabat.update')}}" method="POST">
                    @csrf
                <tr>
                    <td>
                        <p style="text-align: center"><b>PEJABAT 1</b></p>
                        <label>Jabatan</label>
                        <input type="text" class="form-control" name="pejabat1_jabatan" value="{{$data->satu->jabatan}}" placeholder="contoh: Kepala UPT Pusat Pelatihan dan Sertifikasi Profesi"><br>
                        <label>Nama</label>
                        <input type="text" class="form-control" name="pejabat1_nama" value="{{$data->satu->nama}}" placeholder="contoh: Arya Yudhi Wijaya, S.Kom., M. Kom."><br>
                        <label>NIP</label>
                        <input type="text" class="form-control" name="pejabat1_nip" value="{{$data->satu->nip}}" placeholder="contoh: 19840904 201012 1 002"><br>
                    </td>
                    <td>
                        <p style="text-align: center"><b>PEJABAT 2</b></p>
                        <label>Jabatan</label>
                        <input type="text" class="form-control" name="pejabat2_jabatan" value="{{$data->dua->jabatan}}" placeholder="contoh: Ketua PIKTI ITS"><br>
                        <label>Nama</label>
                        <input type="text" class="form-control" name="pejabat2_nama" value="{{$data->dua->nama}}" placeholder="contoh: Abdul Munif, S.Kom., M.Sc."><br>
                        <label>NIP</label>
                        <input type="text" class="form-control" name="pejabat2_nip" value="{{$data->dua->nip}}" placeholder="contoh: 19860823 201504 1 004"><br>
                    </td>
                </tr>
            </table>
            <div style="text-align: center"><a><button type="submit" class="btn btn-warning">Simpan Perubahan</button></a></div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection

@section('js')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('js/bootstrap.js') }}">
@endsection