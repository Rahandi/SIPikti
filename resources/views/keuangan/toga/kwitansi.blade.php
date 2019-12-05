<!DOCTYPE html>
<html>
<head>
	<title>Kwitansi Toga</title>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style2.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
	<style>@page { size: A4 potrait }</style>
</head>
<body onload="window.print()" class="A4 potrait">
    {{-- {{dd($data)}} --}}
    <div class="container" style="margin: 3%; font-family: Tahoma;">
        <table style="width:100%">
            <tr>
                <td style="width:27%; font-size:13px; border: 1px solid black; padding:2%;">
                    <p>Kwitansi No. PKT{{$data->nomor}}</p>
                    <p>Kepada : <b>PIKTI - ITS</b></p>
                    <p>Telah terima dari : </p>
                    <p>{{$data->mahasiswa}}</p>
                    <p>NRP: {{$data->nrp}}, Kelas : {{$data->kelas}}</p>
                    <p>Jumlah Uang :</p>
                    <p style="text-align: center"><b>Rp {{$data->harga}}</b></p>
                    <p>Untuk Pembayaran : </p>
                    <p style="text-align: center"><b>JAMINAN TOGA</b></p>
                    <p>Tgl : {{$data->date}}</p>
                </td>
                <td style="width:2%;">

                </td>
                <td style="width:71%; border: 1px solid black; padding:2%;">
                    <table style="width:100%">
                        <tr>
                            <td style="width: 10%; border: 1px solid black; font-size: 40px; text-align: center; font-family: 'Times New Roman', Times, serif;">
                                <p>P<br>I<br>K<br>T<br>I</p>
                            </td>
                            <td style="width:90%; padding:0% 2% 0% 2%; font-size:14px;">
                                <p>NO. PKT{{$data->nomor}}</p>
                                <table>
                                    <tr>
                                        <td><b>Telah terima dari</b></td>
                                        <td>:</td>
                                        <td>{{$data->mahasiswa}}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td><b>NRP</b>: {{$data->nrp}}, <b>Kelas</b> {{$data->kelas}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Uang sejumlah</b></td>
                                        <td>:</td>
                                        <td><b>{{$data->terbilang}} Rupiah</b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Untuk Pembayaran</b></td>
                                        <td>:</td>
                                        <td><b style="font-size: 20px;">JAMINAN TOGA</b></td>
                                    </tr>
                                </table>
                                <table style="width:100%;">
                                    <tr>
                                        <td style="font-size:11px">
                                            <p>Toga telah diambil, tgl : _______________</p>
                                        </td>
                                        <td style="text-align: right; font-size:13px;">
                                            <p>Sby, {{$data->date}}</p>
                                        </td>
                                    </tr>
                                </table>
                                <p style="font-size:11px;">Jaminan toga telah diambil, tgl : _______________</p>
                                <table style="width:100%;">
                                    <tr>
                                        <td>
                                            <p style="font-size: 18px;"><b>Rp {{$data->harga}}</b></p>
                                        </td>
                                        <td style="text-align: right">
                                            (_______________)
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
	</div>
</body>
</html>