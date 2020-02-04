@extends('layouts.master')

@section('pagetitle')
	User Administrator
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">
	<style type="text/css">
		i.material-icons {
			vertical-align: middle;
		}
        th, td {
            text-align: center;
            vertical-align: middle;
        }
	</style>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="row row-in" style="margin-bottom: 1%;">
                <a href="{{route('user.create')}}"><button class="btn btn-info">Tambah User</button></a>
            </div>
            <div class="row row-in">
                <table id="list" class="table table-striped table-hover table-bordered" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 10%;">No</th>
                            <th style="width: 30%;">Nama</th>
                            <th style="width: 30%;">Username</th>
                            <th style="width: 30%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td style="vertical-align: middle;"></td>
                            <td style="vertical-align: middle;">{{$item->name}}</td>
                            <td style="vertical-align: middle;">{{$item->email}}</td>
                            <td>
                                <table>
                                    <tr>
                                        <td>
                                            <form action="{{route('user.edit')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$item->id}}">
                                                <button type="submit" class="btn btn-warning"
                                                @if ($item->email == 'admin')
                                                    disabled
                                                @endif
                                                >Ubah</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{route('user.editPassword')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$item->id}}">
                                                <button type="submit" class="btn btn-primary"
                                                @if ($item->email == 'admin')
                                                    disabled
                                                @endif
                                                >Ganti Password</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{route('user.delete')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$item->id}}">
                                                <button type="submit" class="btn btn-danger"
                                                @if ($item->email == 'admin')
                                                    disabled
                                                @endif
                                                >Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
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
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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
	</script>
@endsection