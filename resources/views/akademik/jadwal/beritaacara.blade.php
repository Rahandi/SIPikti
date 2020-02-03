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
		@page {
			margin-top: 5%;
			margin-left: 6%;
			margin-right: 6%;
			margin-bottom: 5%;
		}
        hr.r1 {
            border-top: 1px solid black;
        }
        hr.r2 {
            border-top: 2px solid black;
        }
        hr.r3 {
            border-top: 3px solid black;
        }
        hr.r4 {
            /* border-style: dashed none dotted; */
            border-top: 2px dashed black;
            
        }
        hr.r5 {
            border-top: 1px dotted black;
        }
	</style>
	<style>@page { size: legal potrait }</style>
</head>
<body onload="window.print()" class="legal potrait">
	<div class="container" style="font-size: 18px;
	font-family: Tahoma; margin: 2%;
	/*font-weight: 1000;*/
    ">
        <hr class="r1">
        <hr class="r3">
		<div class="row" id="presensi_dosen" style="text-align: center; font-size: 30px; line-height: 1.3; font-weight: 500">
			BERITA ACARA PENYELENGGARAAN<br>
            {{$data->jenis}} {{$data->semester}}<br>
            TAHUN AJARAN {{$data->tahun}}<br>
            PIKTI - ITS
        </div>
        <hr class="r2">
		<div>
			<div class="row" style="text-align: left;">
				<table style="margin-top: 3%; width: 100%">
					<tr>
                        <td style="width: 20%"><b>Mata Kuliah</b></td>
                        <td style="width: 1%">:</td>
                        <td style="width: 79%">{{$data->mata_kuliah}}</td>
                    </tr>
                    <tr>
                        <td><b>Kelas</b></td>
                        <td>:</td>
                        <td>{{$data->kelas}}</td>
                    </tr>
                    <tr>
                        <td><b>Dosen</b></td>
                        <td>:</td>
                        <td>{{$data->dosen}}</td>
                    </tr>
				</table>
            </div><br>
            <hr class="r4"><br>
			<div class="row">
				<table style="width: 100%">
					<tr>
                        <td style="width: 30%;"><b>Hari dan Tanggal</b></td>
                        <td style="width: 1%;">:</td>
                        <td style="width: 69%;">{{$data->hari}}, {{$data->tanggal}}</td>
                    </tr>
                    <tr>
                        <td><b>Waktu</b></td>
                        <td>:</td>
                        <td>{{$data->waktu}}</td>
                    </tr>
                    <tr>
                        <td><b>Jumlah Mhs yg hadir</b></td>
                        <td>:</td>
                        <td>......... Mhs</td>
                    </tr>
                    <tr>
                        <td><b>Jumlah Mhs yg tdk hadir</b></td>
                        <td>:</td>
                        <td>......... Mhs</td>
                    </tr>
				</table>
			</div>
        </div><br><br><br>
        <div class="row" style="text-align: left; font-size: 18px;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hal-hal yang penting yang perlu di catat dalam berita acara ini selama ujian berlangsung :<br><br>
            <hr class="r5"><br>
            <hr class="r5"><br>
            <hr class="r5"><br>
            <hr class="r5"><br>
        </div>
        <div class="row" style="text-align: left; font-size: 18px;">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Berita acara ini di buat dalam rangkap 2 (dua), masing-masing disertakan pada Daftar Presensi Ujian ( Daftar Nilai ), yaitu untuk :<br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;1. Dosen mata kuliah yang bersangkutan ( lembar pertama )<br>
            &nbsp;&nbsp;&nbsp;&nbsp;2. Sekretariat PIKTI - ITS ( lembar kedua )
        </div><br><br><br>
        <div class="row" style="text-align: center; font-size: 18px; margin-left: 60%;">
            Surabaya, {{$data->tanggal}}<br>
            Mengetahui,<br>
            Dosen Penguji,<br>
            <br><br><br><br><br>
            ({{$data->dosen}})
        </div>
        <div class="row" style="text-align: left; font-size: 18px; margin-top: 20%;">
            <table style="border: 1px double solid black; width: 100%;" border="">
                <tr>
                    <td style="padding: 2%;">
                        <b><i><u>Perhatian :</u></i></b><br>
                        <ul>
                            <li>Nilai diserahkan langsung ke Sekretariat PIKTI - ITS</li>
                            <li>Dosen diharuskan hadir dalam pelaksanaan ujian.</li>
                        </ul>
                    </td>
                </tr>
                
            </table>
		</div>
	</div>

<link rel="stylesheet" type="text/css" href="{{ URL::asset('js/bootstrap.js') }}">
</body>
</html>