@extends('layouts.master')

@section('pagetitle')
	Tambah User
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
			<p class="text-muted m-b-30">Tambahkan User</p>
			<form action="{{route('user.store')}}" method="POST" data-toggle="validator" style="text-align: center">
                {{csrf_field()}}
                <table style="width: 100%">
                    <tr>
                        <td>
                            <label for="name">Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </td>
                        <td>
                            <label for="username">Username</label>
                           <input type="text" name="username" class="form-control" required>
                        </td>
                        <td>
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </td>
                    </tr>
                </table><br>
                <button type="submit" class="btn btn-info" style="width: 15%">Submit</button>
			</form>
		</div>
	</div>
</div>
@endsection