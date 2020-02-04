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
                                            <a data-toggle="tooltip" data-placement="top" title="Hapus User">
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete" id="tombolDel" value="{{$item->id}}"
                                                @if ($item->email == 'admin')
                                                    disabled
                                                @endif
                                                >Hapus</button>
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Modal -->
                <div id="modalDelete" class="w3-modal w3-round-xlarge" style="z-index: 99999;">
                    <div class="w3-modal-content w3-animate-zoom w3-card-4 w3-round-large" style="width: 40%;">
                        <header class="w3-container w3-light-grey w3-round-large"> 
                            <span data-dismiss="modal" 
                            class="w3-button w3-display-topright w3-round-large">&times;</span>
                            <h2>Konfirmasi</h2>
                        </header>
                        <div class="w3-container" style="margin-top: 2%;">
                            <p>Apakah Anda yakin akan menghapus user ini?</p>
                        </div>
                        <footer class="w3-container w3-light-grey w3-round-large" style="text-align: right;">
                            <form action="{{route('user.delete')}}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" id="valueId" value="">
                                <button type="submit" class="btn btn-success" id="DeleteButton" style="margin: 1%;">Ya</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin: 1%;">Tidak</button>
                            </form>
                        </footer>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
@endsection

@section('js')
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
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