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
            <div class="row row-in">
                <table id="list" class="table table-striped table-hover table-bordered" style="text-align: center; width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No.</th>
                            <th style="width: 20%;text-align: center;">NRP</th>
                            <th style="width: 50%;text-align: center;">Nama</th>
                            <th style="width: 25%;text-align: center;">Kwitansi Toga</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $individu)
                    @if (isset($individu->nrp))
                        <tr>
                            <td style="vertical-align: middle"></td>
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