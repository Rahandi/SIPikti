@extends('layouts.master')

@section('pagetitle')
	Ganti Password User
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
			<form action="{{route('user.update')}}" method="POST" data-toggle="validator" style="text-align: center">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$data->id}}">
                <table style="width: 70%">
                    <tr>
                        <td style="width: 25%;">
                            <label for="password">Password Baru:</label>
                        </td>
                        <td style="width: 50%;">
                            <input type="password" name="password" class="form-control" required>
                        </td>
                        <td style="width: 25%;">
                            <button type="submit" class="btn btn-info" style="width: 100%">Submit</button>
                        </td>
                    </tr>
                </table>
			</form>
		</div>
	</div>
</div>
@endsection