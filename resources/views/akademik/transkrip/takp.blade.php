<!DOCTYPE html>
<html>
<head>
	<title>Transkrip Akademik</title>
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
	<style>@page { size: legal potrait }</style>
</head>
<body onload="window.print()" class="legal potrait" style="width: 100%">
	<div class="container" style="width:100%; margin-top: 27%; padding-right: 14%; margin-bottom: 10%; margin-left: 12%;">
		<div class="row" style="text-align: center; font-size: 17px;">
            <b>TRANSKRIP AKADEMIK</b><br>
            No. : {{$data->nomor_transkrip}}<br>
		</div>
		<div class="row" style="text-align: left; font-size: 14px; margin-top: 3%;">
			<table style="width:100%">
                <tr>
                    <td style="width:30%"><b>Nama</b></td>
                    <td style="width:1%">:</td>
                    <td style="width:69%">{{$data->nama}}</td>
                </tr>
                <tr>
                    <td><b>NRP</b></td>
                    <td>:</td>
                    <td>{{$data->nrp}}</td>
                </tr>
                <tr>
                    <td><b>Tempat / Tgl lahir</b></td>
                    <td>:</td>
                    <td>{{$data->ttl}}</td>
                </tr>
                <tr>
                    <td><b>Tahun Masuk</b></td>
                    <td>:</td>
                    <td>{{$data->tahun_masuk}}</td>
                </tr>
                <tr>
                    <td><b>Tahun Lulus</b></td>
                    <td>:</td>
                    <td>{{$data->tahun_lulus}}</td>
                </tr>
                <tr>
                    <td><b>Indeks Prestasi Kumulatif (IPK)</b></td>
                    <td>:</td>
                    <td>{{$data->ipk}}</td>
                </tr>
                <tr>
                    <td><b>Predikat</b></td>
                    <td>:</td>
                    <td>{{$data->predikat}}</td>
                </tr>
            </table>
        </div>
        <div class="row" style="text-align: center; margin-right: 8%; font-size: 15px; margin-top: 3%;">
            <table style="width:100%;" class="bordering">
                <thead>
                    <th style="width: 5%;">No</th>
                    <th style="width: 15%;">Kode</th>
                    <th style="width: 41%;">Mata Kuliah</th>
                    <th style="width: 13%;">Semester</th>
                    <th style="width: 13%;">SKS</th>
                    <th style="width: 13%;">Nilai</th>
                </thead>
                <tbody>
                    @for ($i = 0; $i < count($data->nilai); $i++)
                        <tr>
                            <td>{{$i+1}}</td>
                            <td>{{$data->nilai[$i]->kode}}</td>
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
        <div class="row" style="font-size: 15px;">
            <p><b>JUDUL PROYEK AKHIR</b><br>{{$data->judul}}</p>
            <p><b>PEMBIMBING PROYEK AKHIR</b><br>{{$data->pembimbing}}</p>
        </div>
        <div class="row" style="font-size: 12px; margin-top: 3%;">
            <table>
                <thead style="text-align: left">
                    <th>KETERANGAN NILAI</th>
                    <th></th>
                    <th>KETERANGAN PREDIKAT</th>
                </thead>
                <tbody>
                    <td style="width: 30%;">
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
                    <td style="width: 40%;">
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
                    <td style="width: 30%;">
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
        <table style="margin-top: 3%; font-size: 14px; width:100%">
            <tr>
                <td style="width:65%">
                    <p>Mengetahui,<br>
                    {{$data->pejabat->satu->jabatan}}</p>
                    <p><br><br><br><br><br><br></p>
                    <p>{{$data->pejabat->satu->nama}}<br>
                    NIP {{$data->pejabat->satu->nip}}</p>
                </td>
                <td>
                    <p>Surabaya, 31 Oktober 2019<br>
                    {{$data->pejabat->dua->jabatan}}</p>
                    <p><br><br><br><br><br><br></p>
                    <p>{{$data->pejabat->dua->nama}}<br>
                    NIP {{$data->pejabat->dua->nip}}</p>
                </td>
            </tr>
        </table>
	</div>

<link rel="stylesheet" type="text/css" href="{{ URL::asset('js/bootstrap.js') }}">
</body>
</html>