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
        body{
            font-family: Arial, Helvetica, sans-serif;
        }
		i.material-icons {
			vertical-align: middle;
		}
        .bordering, .bordering th, .bordering td {
            border-collapse: collapse;
            border: 1px black solid;
        }
	</style>
	<style>@page { size: A4 potrait }</style>
</head>
<body class="A4 potrait">
	<div class="container" style="width:100%; margin: 3%;">
		<div class="row" style="text-align: center;">
			<b>TRANSKRIP AKADEMIK SEMENTARA</b><br>
		</div>
		<div class="row" style="text-align: left;">
			<table style="width:100%">
                <tr>
                    <td style="width:25%">Nama</td>
                    <td style="width:1%">:</td>
                    <td style="width:76%">{{$data->nama}}</td>
                </tr>
                <tr>
                    <td>NRP</td>
                    <td>:</td>
                    <td>{{$data->nrp}}</td>
                </tr>
                <tr>
                    <td>Tempat / Tgl lahir</td>
                    <td>:</td>
                    <td>{{$data->ttl}}</td>
                </tr>
                <tr>
                    <td>Tahun Masuk</td>
                    <td>:</td>
                    <td>{{$data->tahun_masuk}}</td>
                </tr>
                <tr>
                    <td>Tahun Lulus</td>
                    <td>:</td>
                    <td>{{$data->tahun_lulus}}</td>
                </tr>
                <tr>
                    <td>Indeks Prestasi Kumulatif (IPK)</td>
                    <td>:</td>
                    <td>{{$data->ipk}}</td>
                </tr>
                <tr>
                    <td>Predikat</td>
                    <td>:</td>
                    <td>{{$data->predikat}}</td>
                </tr>
            </table>
        </div>
        <div class="row" style="text-align: center; margin-right: 6%">
            <table style="width:100%;" class="bordering">
                <thead>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Mata Kuliah</th>
                    <th>Semester</th>
                    <th>SKS</th>
                    <th>Nilai</th>
                </thead>
                <tbody>
                    @for ($i = 0; $i < count($data->nilai); $i++)
                        <tr>
                            <td>{{$i+1}}</td>
                            <td></td>
                            <td style="text-align: left">{{$data->nilai[$i]->nama}}</td>
                            <td>{{$data->nilai[$i]->semester}}</td>
                            <td>{{$data->nilai[$i]->sks}}</td>
                            <td>{{$data->nilai[$i]->nilai_huruf}}</td>
                        </tr>
                    @endfor
                    <tr>
                        <td colspan="4"><b>Jumlah SKS</b></td>
                        <td colspan="2"><b>{{$data->total_sks}}</b></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <table>
                <thead>
                    <th>KETERANGAN NILAI</th>
                    <th></th>
                    <th>KETERANGAN PREDIKAT</th>
                </thead>
                <tbody>
                    <td>
                        <table>
                            <tr>
                                <td>Nilai A</td>
                                <td>:</td>
                                <td>4</td>
                                <td>(Istimewa)</td>
                            </tr>
                            <tr>
                                <td>Nilai AB</td>
                                <td>:</td>
                                <td>3.5</td>
                                <td>(Sangat Baik)</td>
                            </tr>
                            <tr>
                                <td>Nilai B</td>
                                <td>:</td>
                                <td>3</td>
                                <td>(Baik)</td>
                            </tr>
                            <tr>
                                <td>Nilai BC</td>
                                <td>:</td>
                                <td>2.5</td>
                                <td>(Cukup Baik)</td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table>
                            <tr>
                                <td>Nilai C</td>
                                <td>:</td>
                                <td>2</td>
                                <td>(Cukup)</td>
                            </tr>
                            <tr>
                                <td>Nilai D</td>
                                <td>:</td>
                                <td>1</td>
                                <td>(Kurang)</td>
                            </tr>
                            <tr>
                                <td>Nilai E</td>
                                <td>:</td>
                                <td>0</td>
                                <td>(Sangat Kurang)</td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table>
                            <tr>
                                <td>IPK 2,00 – 2,75</td>
                                <td>:</td>
                                <td>Memuaskan</td>
                            </tr>
                            <tr>
                                <td>IPK 2,76 – 3,50</td>
                                <td>:</td>
                                <td>Sangat Memuaskan</td>
                            </tr>
                            <tr>
                                <td>IPK 3,51 – 4,00</td>
                                <td>:</td>
                                <td>Dengan Pujian</td>
                            </tr>
                        </table>
                    </td>
                </tbody>
            </table>
        </div>
	</div>

<link rel="stylesheet" type="text/css" href="{{ URL::asset('js/bootstrap.js') }}">
</body>
</html>