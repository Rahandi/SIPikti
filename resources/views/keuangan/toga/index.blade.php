@extends('layouts.master')

@section('pagetitle')
	Toga
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">
	<style type="text/css">
		i.material-icons {
			vertical-align: middle;
		}
		#tableMK tr th, td{
			padding: 8px;
		}
	</style>
@endsection

@section('content')
<div class="row" style="padding 8px">
    <div class="col-sm-12">
        <div class="white-box">
                <div id="modalBiaya" class="w3-modal w3-round-xlarge" style="z-index: 99999;">
                    <div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round-large" style="width: 40%;">
                        <header class="w3-container w3-light-grey w3-round-large"> 
                            <span data-dismiss="modal" 
                            class="w3-button w3-display-topright w3-round-large">&times;</span>
                            <h2>Biaya Toga</h2>
                        </header>
                        <form action="" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="w3-container" style="margin-top: 2%;">
                            Biaya (tanpa titik) <input class="form-control" type="number" value="300000" placeholder="contoh: 300000"><br>
                            Terbilang (tanpa Rupiah) <input class="form-control" type="text" value="Tiga Ratus Ribu" placeholder="contoh: Tiga Ratus Ribu"><br>
                        </div>
                        <footer class="w3-container w3-light-grey w3-round-large" style="text-align: right;">
                            <button type="submit" class="btn btn-success" id="BiayaSubmit" style="margin: 1%;">Simpan</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin: 1%;">Batal</button>
                        </footer>
                        </form>
                    </div>
                </div>

                <h3 class="box-title m-b-0">Biaya Toga</h3>
                <p>Rp 300.000<br>Tiga Ratus Ribu Rupiah</p>
                <a><button type="button" id="editBiaya" data-toggle="modal" class="btn btn-warning" data-target="#modalBiaya">Ubah Biaya Toga</button></a>

                <h3 class="box-title m-b-0" style="margin-top:3%;">Kwitansi Toga</h3>
                <table id="list" class="table table-striped table-hover table-bordered" style="text-align: center; width: 100%; margin-top:1%;">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No.</th>
                            <th style="width: 10%;text-align: center;">Kelas</th>
                            <th style="width: 15%;text-align: center;">NRP</th>
                            <th style="width: 45%;text-align: center;">Nama</th>
                            <th style="width: 25%;text-align: center;">Kwitansi Toga</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $individu)
                    @if (isset($individu->nrp))
                        <tr>
                            <td style="vertical-align: middle"></td>
                            <td></td>
                            <td style="vertical-align: middle">{{ $individu->nrp }}</td>
                            <td class="sorting_1" style="text-align: left;vertical-align: middle">{{ $individu->nama }}</td>
                            <td>
                                <a data-toggle="tooltip" data-placement="top" title="Print Kwitansi" target="_blank" href="{{ route('toga.kwitansi',$individu->id) }}">
                                    <button type="button" class="btn btn-info"
                                        @if ($individu->jadwal == null)
                                            disabled
                                        @endif>
                                        <i class="material-icons" style="font-size: 18px;">print</i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endif
                    @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>
</div>
@endsection

@section('js')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('js/bootstrap.js') }}">
<script>
    $(document).ready(function(){
        var t = $('#list').DataTable( {
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