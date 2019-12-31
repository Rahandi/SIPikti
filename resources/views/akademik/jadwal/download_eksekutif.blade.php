<!DOCTYPE html>
<html>
<head>
	<title>Download Absensi</title>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style2.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">
	<style type="text/css">
		i.material-icons {
			vertical-align: middle;
		}
		.bordering, .bordering th, .bordering td {
            border-collapse: collapse;
            border: 1px black solid;
        }
	</style>
	<style>@page { size: legal landscape }</style>
</head>
<body onload="window.print()" class="legal landscape">
	<div class="container" style="font-size: 14px;
	font-family: Tahoma;
	/*font-weight: 1000;*/
    ">
        @for ($i = 0; $i < count($data->absen_dosen); $i++)
        @if (($i+1)%2 == 0)
            <div style="margin-right: 6%; margin-left: 6%; page-break-after: always;">
        @else
            <div style="margin-top: 5%; margin-right: 6%; margin-left: 6%;">
        @endif
        @if (($i)%2 == 0)
            <div class="row" id="presensi_dosen" style="text-align: center; font-size: 20px;">
                PRESENSI DOSEN<br>
                SEMESTER {{$data->semester}} TA. {{$data->tahun}}-{{$data->tahun+1}}<br>
            </div>
        @endif
        <div class="row" style="text-align: left;">
			<table style="margin-top: 3%; width: 100%">
				<tr>
					<td style="width: 10%;">Kelas</td>
					<td style="width: 55%;">: Eksekutif Sabtu</td>
                    <td style="width: 10%;">Jam Kuliah</td>
                    <td style="width: 25%;">: 08.00 - 16.00</td>
				</tr>
				<tr>
					<td>Hari Kuliah</td>
					<td>: Sabtu</td>
                    <td>Mata Kuliah</td>
                    <td>: {{$data->absen_dosen[$i]->matkul}}</td>
				</tr>
				<tr>
					<td>Dosen Pengajar</td>
					<td>: {{$data->absen_dosen[$i]->dosen}}</td>
                    <td>Asisten Dosen</td>
                    <td>: {{$data->absen_dosen[$i]->asisten}}</td>
				</tr>
			</table>
        </div><br>
        <div class="row">
            <table style="width: 100%" class="bordering">
                <thead>
                    <tr>
                        <th rowspan="2" style="width: 5%">Kuliah ke</th>
                        <th rowspan="2" style="width: 15%">Hari, Tanggal</th>
                        <th rowspan="2" style="width: 13%">Materi</th>
                        <th colspan="2" style="width: 19%">Tanda Tangan</th>
                        <th colspan="2" style="width: 19%">Pengganti Dosen</th>
                        <th colspan="2" style="width: 19%">Pengganti Asisten</th>
                        <th rowspan="2" style="width: 10%">Keterangan</th>
                    </tr>
                    <tr>
                        <th style="width: 11%">Dosen Pengajar</th>
                        <th style="width: 8%">Asisten</th>
                        <th style="width: 10%">Nama Dosen</th>
                        <th style="width: 9%">Tanda Tangan</th>
                        <th style="width: 10%">Nama Asisten</th>
                        <th style="width: 9%">Tanda Tangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: center; vertical-align: middle"><br><br><br><br>{{$i+1}}<br><br><br><br><br></td>
                        <td style="text-align: center; vertical-align: middle"><br><br><br><br>{{$data->absen_dosen[$i]->tanggal}}<br><br><br><br><br></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
        @endfor
        <br>
        @foreach ($data->absen_mahasiswa as $item)
        <div style="margin: 5% 6% 3% 6%; page-break-after: always">
            <div class="row" id="presensi" style="text-align: center; font-size: 18px;">
                <b>PRESENSI AKADEMIK<br>
                TAHUN AJARAN {{$data->tahun}}/{{$data->tahun+1}}<br>
                Semester {{$data->semester}}<br></b>
            </div>
            <div class="row" style="text-align: left;">
                <table style="margin-top: 3%; width: 100%;">
                    <tr>
                        <td style="width: 10%;"><b>Kelas</b></td>
                        <td><b>: Eksekutif Sabtu</b></td>
                    </tr>
                    <tr>
                        <td><b>Mata Kuliah</b></td>
                        <td><b>: {{$item->nama}}</b></td>
                    </tr>
                </table>
            </div><br>
            <div class="row" style="text-align: center;width: 100%;">
                <table class="bordering" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 5%;" rowspan="2">No</th>
                            <th style="width: 15%;" rowspan="2">NRP</th>
                            <th style="width: 30%;" rowspan="2">NAMA</th>
                            <th style="width: 50%" colspan="{{$item->bagian}}">Pertemuan ke-</th>
                        </tr>
                        <tr>
                            @for ($i = 1; $i <= $item->bagian; $i++)
                                <th>{{$i}}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->mahasiswa as $mhs)
                        <tr>
                            <td>{{$mhs->urut}}</td>
                            <td>{{$mhs->nrp}}</td>
                            <td style="text-align: left">{{$mhs->nama}}</td>
                            @for ($i = 1; $i <= $item->bagian; $i++)
                                <td></td>
                            @endfor
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="3">Jumlah  Mhs  Tidak  Hadir  Kuliah</td>
                            @for ($i = 1; $i <= $item->bagian; $i++)
                                <td></td>
                            @endfor
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
	</div>

<link rel="stylesheet" type="text/css" href="{{ URL::asset('js/bootstrap.js') }}">
</body>
</html>