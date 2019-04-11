<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" style="background-image: url(../images/bg5.png); background-repeat: no-repeat; background-attachment: fixed; background-position: center; background-size: cover;">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>List Pendaftar</title>

	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/form.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">

</head>
<body>
	<div class="row" style="align-content: center; margin-top: 3%; margin-bottom: 5%; width: 100%;">
		<div class="col-sm-10 col-md-offset-10 mx-auto" style="z-index: 1;background-color: white;width: 90%; border-radius: 10px;">
			<h3>List Pendaftar</h3>
			<div class="row" style="margin: 2%; width: 90%;">
				<table class="table table-bordered" style="margin-top: 2%;width: 90%;">
					<thead class="thead-dark">
					<tr style="text-align: center;">
						<th>Nomor Pendaftaran</th>
						<th>Nama</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
					@foreach ($data as $individu)
					<tr>
						<th>{{ $individu->nomor_pendaftaran }}</th>
						<th>{{ $individu->nama }}</th>
						<th><a href="kwitansi/{{ $individu->id }}">kwitansi</a>
						<a href="detail/{{ $individu->id }}">detail</a>
						form
						<input type="hidden" name="">
						<a href="edit/{{ $individu->id }}">edit</a></th>
					</tr>
					@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'></script>
	<script type="text/javascript" src="../js/sipikti.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	
</body>
</html>