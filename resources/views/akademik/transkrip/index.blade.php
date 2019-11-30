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
                            <th style="width: 15%;text-align: center;">NRP</th>
                            <th style="width: 45%;text-align: center;">Nama</th>
                            <th style="width: 35%;text-align: center;">Transkrip</th>
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
                                <table>
                                    <tr>
                                    <td>
                                    <form action="{{ route('transkrip.kp') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$individu->id}}">
                                        <a data-toggle="tooltip" data-placement="top" title="Transkrip 1819-KP_KOMPRE">
                                            <button type="submit" class="btn btn-warning"
                                            @if ($individu->nilai == null)
                                                disabled
                                            @endif
                                            >KP</button>
                                        </a>
                                    </form>
                                    </td>
                                    <td>
                                    <form action="{{ route('transkrip.ta') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$individu->id}}">
                                        <a data-toggle="tooltip" data-placement="top" title="Transkrip 1819-TA">
                                            <button type="submit" class="btn btn-danger"
                                            @if($individu->nilai == null)
                                                disabled
                                            @endif
                                            >TA</button>
                                        </a>
                                    </form>
                                    </td>
                                    <td>
                                    <form action="{{ route('transkrip.takp') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$individu->id}}">
                                        <a data-toggle="tooltip" data-placement="top" title="Transkrip 1819-TA-KP">
                                            <button type="submit" class="btn btn-success"
                                            @if($individu->nilai == null)
                                                disabled
                                            @endif
                                            >TA-KP</button>
                                        </a>
                                    </form>
                                    </td>
                                    <td>
                                    <form action="{{ route('transkrip.sementara') }}" method="POST">
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