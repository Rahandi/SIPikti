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
    <div class="container" style="margin: 3%; font-family: Tahoma;">
        <table style="width:100%">
            <tr>
                <td style="width:31%; font-size:13px; border: 1px solid black; padding:2%;">
                    <p>Kwitansi No. _________</p><br>
                    <p>Kepada : <b>PIKTI - ITS</b></p>
                    <p>Sudah terima dari : </p>
                    <p>{{$data->mahasiswa}}, Kelas : {{$data->kelas}}</p>
                    <p>Jumlah Uang :</p>
                    <p style="text-align: center"><b>Rp 300.000</b></p>
                    <p>Untuk Pembayaran : </p>
                    <p style="text-align: center"><b>JAMINAN TOGA</b></p>
                    <p>Tgl : _________</p>
                </td>
                <td style="width:2%;">

                </td>
                <td style="width:67%; border: 1px solid black; padding:2%;">
                    <table style="width:100%">
                        <tr>
                            <td style="width: 10%; border: 1px solid black; font-size: 40px; text-align: center; font-family: 'Times New Roman', Times, serif;">
                                <p>P<br>I<br>K<br>T<br>I</p>
                            </td>
                            <td style="width:90%; padding:2%; font-size:14px;">
                                <p>NO. __________</p>
                                <p><b>Telah terima dari&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;{{$data->mahasiswa}}&nbsp;&nbsp;&nbsp;&nbsp;<b>Kelas : </b>{{$data->kelas}}</p>
                                <p><b>Uang sejumlah&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;Tiga Ratus Ribu Rupiah</b></p>
                                <p><b>Untuk Pembayaran:&nbsp;</b><b style="font-size: 20px;">JAMINAN TOGA</b></p>
                                <table style="width:100%;">
                                    <tr>
                                        <td style="font-size:11px">
                                            <p>Toga sudah diambil, tgl : _______</p>
                                        </td>
                                        <td style="text-align: right">
                                            <p>Sby, _____________</p>
                                        </td>
                                    </tr>
                                </table>
                                <p style="font-size:11px;">Jaminan toga sudah diambil, tgl : __________</p>
                                <table style="width:100%;">
                                    <tr>
                                        <td>
                                            <p style="font-size: 18px;"><b>Rp 300,000</b></p>
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