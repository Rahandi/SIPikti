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
{{dd($data)}}
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