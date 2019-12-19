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
		#tableMK tr th, td{
			padding: 8px;
		}
	</style>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <div id="modalUbahNo" class="w3-modal w3-round-xlarge" style="z-index: 99999;">
                <div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round-large" style="width: 40%;">
                    <header class="w3-container w3-light-grey w3-round-large"> 
                        <span data-dismiss="modal" 
                        class="w3-button w3-display-topright w3-round-large">&times;</span>
                        <h2>Ubah Nomor Transkrip</h2>
                    </header>
                    <form action="{{route('transkrip.update')}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="w3-container" style="margin-top: 2%;">
                        (Tanpa Tahun)<input class="form-control" type="text" value="{{$nomor_transkrip}}" name="nomor_transkrip" placeholder="contoh: B/81861/IT2.VIII.2.3/DL.01/"><br>
                    </div>
                    <footer class="w3-container w3-light-grey w3-round-large" style="text-align: right;">
                        <button type="submit" class="btn btn-success" id="noTranskripnya" style="margin: 1%;">Simpan</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin: 1%;">Batal</button>
                    </footer>
                    </form>
                </div>
            </div>
            <div style="text-align: right">
                <a><button type="button" class="btn btn-default" id="editNo" data-toggle="modal" data-target="#modalUbahNo">Ubah Nomor Transkrip</button></a>
                <a href="{{route('pejabat')}}"><button type="button" class="btn btn-warning">Ubah Data Pejabat</button></a>
            </div>
            <br>
                <table id="list" class="table table-striped table-hover table-bordered" style="text-align: center; width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No.</th>
                            <th style="width: 10%;text-align: center;">Kelas</th>
                            <th style="width: 15%;text-align: center;">NRP</th>
                            <th style="width: 35%;text-align: center;">Nama</th>
                            <th style="width: 35%;text-align: center;">Transkrip</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $individu)
                    @if (isset($individu->nrp))
                        <tr>
                            <td style="vertical-align: middle"></td>
                            <td style="vertical-align: middle">{{ $individu->kelas }}</td>
                            <td style="vertical-align: middle">{{ $individu->nrp }}</td>
                            <td class="sorting_1" style="text-align: left;vertical-align: middle">{{ $individu->nama }}</td>
                            <td>
                                <table>
                                    <tr>
                                    <td>
                                    <form action="{{ route('transkrip.kp') }}" method="POST" target="_blank">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$individu->id}}">
                                        <a data-toggle="tooltip" data-placement="top" title="Transkrip 1819-KP_KOMPRE">
                                            <button type="submit" class="btn btn-primary"
                                            @if ($individu->nilai == null)
                                                disabled
                                            @endif
                                            >KP</button>
                                        </a>
                                    </form>
                                    </td>
                                    <td>
                                    <form action="{{ route('transkrip.ta') }}" method="POST" target="_blank">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$individu->id}}">
                                        <a data-toggle="tooltip" data-placement="top" title="Transkrip 1819-Proyek Akhir">
                                            <button type="submit" class="btn btn-danger"
                                            @if($individu->nilai == null)
                                                disabled
                                            @endif
                                            >PA</button>
                                        </a>
                                    </form>
                                    </td>
                                    <td>
                                    <form action="{{ route('transkrip.takp') }}" method="POST" target="_blank">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$individu->id}}">
                                        <a data-toggle="tooltip" data-placement="top" title="Transkrip 1819-PA-KP">
                                            <button type="submit" class="btn btn-success"
                                            @if($individu->nilai == null)
                                                disabled
                                            @endif
                                            >PA-KP</button>
                                        </a>
                                    </form>
                                    </td>
                                    <td>
                                    <form action="{{ route('transkrip.sementara') }}" method="POST" target="_blank">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$individu->id}}">
                                        <a data-toggle="tooltip" data-placement="top" title="Transkrip Sementara">
                                            <button type="submit" class="btn btn-info"
                                            @if($individu->nilai == null)
                                                disabled
                                            @endif
                                            >Sementara</button>
                                        </a>
                                    </form>
                                    </td>
                                    </tr>
                                </table>
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