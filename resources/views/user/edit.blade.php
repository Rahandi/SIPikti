@extends('layouts.master')

@section('pagetitle')
	Ubah User
@endsection

@section('css')
<style type="text/css">
	#tableMK tr th, td{
		padding: 15px;
	}
</style>
@endsection

@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="white-box">
			<h3 class="box-title m-b-0">Form User</h3>
			<p class="text-muted m-b-30">Ubah User Administrator</p>
			<form action="{{route('user.update')}}" method="POST" data-toggle="validator" style="text-align: center">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$data->id}}">
                <table style="width: 100%">
                    <tr>
                        <td>
                            <label for="name">Nama</label>
                            <input type="text" name="name" class="form-control" value="{{$data->name}}" required>
                        </td>
                        <td>
                            <label for="username">Username</label>
                           <input type="text" name="username" class="form-control" value="{{$data->email}}" required>
                        </td>
                    </tr>
                </table><br>
                <button type="submit" class="btn btn-info" style="width: 15%">Submit</button>
			</form>
		</div>
	</div>
</div>
@endsection