@extends('layouts.master')

@section('pagetitle')
	Penilaian PA-KP
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
	</style>
@endsection

@section('content')
	<div class="row">
		<div class="col-sm-12">
			<div class="white-box">
				<div style="text-align: left;">
					<h3 class="box-title m-b-0">Penilaian PA-KP</h3>
					<p class="text-muted m-b-30"><i>Proyek Akhir, Kerja Praktek, dan Komprehensif</i></p>
                </div>
                <div class="form-group" style="width:30%;">
                    <label for="kat">Kategori</label>
                    <select class="form-control selectpicker" data-style="btn-info btn-outline" name="kategori" id="kat" onchange="getMhs()">
                        <option value="pa">Proyek Akhir (PA)</option>
                        <option value="kp">Kerja Praktek (KP)</option>
                        <option value="kompre">Komprehensif</option>
                        <option value="pakp">PA - KP</option>
                    </select>
                </div>
                
                <p><b>Mahasiswa</b></p>
                <a><button class="btn btn-info">Tambah Mahasiswa</button></a>
                <a><button class="btn btn-warning">Download Template Penilaian</button></a>
                <a><button class="btn btn-primary">Upload Penilaian</button></a>
                <a><button class="btn btn-success">Download Hasil</button></a>
                
				<table style="width:100%" border="">
                    <thead>
                        {{-- if pa: width msg2 th berapa, if kp: brp, dll --}}
                        <tr id="pa">
                            <th>No.</th>
                            <th>Kelas</th>
                            <th>NRP</th>
                            <th>Nama</th>
                            {{-- if pa/pakp --}}
                            <th>Judul PA</th>
                            <th>Pembimbing PA</th>
                            <th>Nilai PA</th>
                            {{-- if kp/pakp --}}
                            <th>Nilai KP</th>
                            {{-- if kompre --}}
                            <th>Nilai Kompre</th>
                        </tr>
                        <tr id="kp">
                            <th>No.</th>
                            <th>Kelas</th>
                            <th>NRP</th>
                            <th>Nama</th>
                            {{-- if pa/pakp --}}
                            <th>Judul PA</th>
                            <th>Pembimbing PA</th>
                            <th>Nilai PA</th>
                            {{-- if kp/pakp --}}
                            <th>Nilai KP</th>
                            {{-- if kompre --}}
                            <th>Nilai Kompre</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- foreach mahasiswa --}}
                        <tr>
                            <td></td>
                            <td>A</td>
                            <td>8839949</td>
                            <td>Rahandi </td>
                            <td>
                                <input class="form-control" type="text" placeholder="Contoh: Pengembangan Sistem Informasi">
                            </td>
                            <td>
                                <input class="form-control" type="text" placeholder="Contoh: Dini Adni Navastara S.Kom, M.Sc.">
                            </td>
                            <td><input class="form-control" type="text" placeholder="Contoh: AB"></td>
                            <td><input class="form-control" type="text" placeholder="Contoh: AB"></td>
                            <td><input class="form-control" type="text" placeholder="Contoh: AB"></td>
                        </tr>
                    </tbody>
                </table>
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
		$(document).ready(function(){
			var t = $('#list2').DataTable( {
				"columnDefs": [ {
					"searchable": false,
					"orderable": false,
					"targets": 0,

				} ],
				"order": [[ 1, 'asc' ]],
			} );

			t.on( 'order.dt search.dt', function () {
				t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
					cell.innerHTML = i+1;
				} );
			} ).draw();
		});
        function getMhs(){
            var kat = $('#kat').val();
            console.log("change!");
            console.log(kat);
            listKat = ['pa','kp','kompre','pakp'];
            // clear all tr th
            for (i=0; i<listKat.length; i++){
                i=0;
            }
            // var nama_kls = <?php echo json_encode($data->masterKelas); ?>;
            // console.log(nama_kls);
            // for (i = 0; i < nama_kls.length; i ++){
            //     if (nama_kls[i]['nama'] == kls) {
            //         console.log(nama_kls[i]['jam_SK']);
            //         document.getElementById("jam_SK").innerHTML = nama_kls[i]['jam_SK'];
            //         document.getElementById("jam_J").innerHTML = nama_kls[i]['jam_J'];
            //         if (kls.includes("S") || kls.includes("s")) {
            //             document.getElementById("mkperday").style.display = "none";
            //         }
            //         else {
            //             document.getElementById("mkperday").style.display = "block";
            //         }
            //     }
            // }
        }
	</script>
@endsection