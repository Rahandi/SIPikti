<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('plugins/images/iconITS.png')}}">
	<title>SIM PIKTI</title>
	<!-- Bootstrap Core CSS -->
	<link href="{{ URL::asset('ample/bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link href="{{ URL::asset('ample/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
	<!-- Menu CSS -->
	<link href="{{ URL::asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">
	<!-- toast CSS -->
	<link href="{{ URL::asset('plugins/bower_components/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
	<!-- chartist CSS -->
	<link href="{{ URL::asset('plugins/bower_components/chartist-js/dist/chartist.min.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css') }}" rel="stylesheet">
	
	<!-- animation CSS -->
	<link href="{{ URL::asset('ample/css/animate.css') }}" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="{{ URL::asset('ample/css/style.css') }}" rel="stylesheet">
	<!-- color CSS -->
	<link href="{{ URL::asset('ample/css/colors/megna.css') }}" id="theme" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	@yield('css')
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header">
	<!-- ============================================================== -->
	<!-- Preloader -->
	<!-- ============================================================== -->
	<div class="preloader">
		<svg class="circular" viewBox="25 25 50 50">
			<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> 
		</svg>
	</div>
	<!-- ============================================================== -->
	<!-- Wrapper -->
	<!-- ============================================================== -->
	<div id="wrapper">
		<!-- ============================================================== -->
		<!-- Topbar header - style you can find in pages.scss -->
		<!-- ============================================================== -->
		<nav class="navbar navbar-default navbar-static-top m-b-0">
			<div class="navbar-header">
				<div class="top-left-part">
					<!-- Logo -->
					<a class="logo" href="{{ route('dashboard') }}">
						<!-- Logo icon image, you can use font-icon also --><b>
						<!--This is dark logo icon--><img src="{{ URL::asset('plugins/images/LogoITS.png') }}" alt="home" class="dark-logo" /><!--This is light logo icon--><img src="{{ URL::asset('plugins/images/LogoITS.png') }}" alt="home" class="light-logo" />
					 </b>
						<!-- Logo text image you can use text also --><span class="hidden-xs">
						<!--This is dark logo text--><img src="{{ URL::asset('plugins/images/LogoPIKTI.png') }}" alt="home" class="dark-logo" /><!--This is light logo text--><img src="{{ URL::asset('plugins/images/LogoPIKTI.png') }}" alt="home" class="light-logo" />
					 </span> </a>
				</div>
				<!-- /Logo -->
				<!-- Search input and Toggle icon -->
				<ul class="nav navbar-top-links navbar-left">
					<li><a href="javascript:void(0)" class="open-close waves-effect waves-light"><i class="ti-menu"></i></a></li>
				</ul>
				<ul class="nav navbar-top-links navbar-right pull-right">
					@guest
						<li class="nav-item">
							<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
						</li>
					@else
						<li class="dropdown">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"><b class="hidden-xs">{{ Auth::user()->name }}</b><span class="caret"></span> </a>
							<ul class="dropdown-menu dropdown-user animated flipInY">
								<li>
									<div class="dw-user-box">
										<div class="u-text">
											<h4>{{ Auth::user()->name }}</h4>
										</div>
									</div>
								</li>
								<li role="separator" class="divider"></li>
								<li><a href="{{ route('logout') }}" onclick="event.preventDefault();	 document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> {{ __('Logout') }}</a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
								</li>
							</ul>
							<!-- /.dropdown-user -->
						</li>
						
					@endguest
					
					
					<!-- /.dropdown -->
				</ul>
			</div>
			<!-- /.navbar-header -->
			<!-- /.navbar-top-links -->
			<!-- /.navbar-static-side -->
		</nav>
		<!-- End Top Navigation -->
		<!-- ============================================================== -->
		<!-- Left Sidebar - style you can find in sidebar.scss  -->
		<!-- ============================================================== -->
		<div class="navbar-default sidebar" role="navigation">
			<div class="sidebar-nav slimscrollsidebar">
				<div class="sidebar-head">
					<h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3> </div>
				<ul class="nav" id="side-menu" style="margin-top: 5%;">
					<li><a href="{{ route('dashboard') }}" class="waves-effect"><i class="material-icons">dvr</i> <span class="hide-menu">Dashboard</span></span></a>
					</li>
					<li><a href="{{ route('pendaftaran') }}" class="waves-effect"><i class="material-icons">description</i> <span class="hide-menu">Pendaftaran</span></span></a>
					</li>
					<li><a class="dropdown-toggle waves-effect" data-toggle="dropdown" href="/akademik"><i class="material-icons">account_balance</i> <span class="hide-menu">Akademik<span class="fa arrow"></span></span></a>
						<ul class="nav nav-second-level">
							<li><a href="{{ route('calon_mahasiswa') }}"><i class="material-icons">group</i><span class="hide-menu">  Calon Mahasiswa</span></a></li>
							<li><a href="{{ route('mahasiswa') }}"><i class="material-icons">how_to_reg</i><span class="hide-menu">  Mahasiswa</span></a></li>
							<li><a href="{{ route('jadwal') }}"><i class="material-icons">date_range</i><span class="hide-menu">  Jadwal</span></a></li>
							<li><a href="{{ route('nilai') }}"><i class="material-icons">ballot</i><span class="hide-menu">  Nilai</span></a></li>
							<li><a href="{{ route('transkrip') }}"><i class="material-icons">ballot</i><span class="hide-menu">  Transkrip</span></a></li>
						</ul>
					</li>
					<li><a class="dropdown-toggle waves-effect" data-toggle="dropdown" href="/keuangan"><i class="material-icons">attach_money</i> <span class="hide-menu">Keuangan<span class="fa arrow"></span></span></a>
						<ul class="nav nav-second-level">
							<li><a href="{{ route('angsuran') }}" class="waves-effect"><i class="material-icons">style</i> <span class="hide-menu">Angsuran</span></a></li>
							<li><a href="{{ route('pembayaran') }}"><i class="material-icons">local_atm</i><span class="hide-menu">  Pembayaran</span></a></li>
							<li><a href="{{ route('pembayaran.rekap') }}"><i class="material-icons">poll</i><span class="hide-menu">  Rekap Pembayaran</span></a></li>
							<li><a href="{{ route('toga') }}" class="waves-effect"><i class="material-icons">style</i> <span class="hide-menu">Toga</span></a></li>
						</ul>
					</li>
					<li><a class="dropdown-toggle waves-effect" data-toggle="dropdown" href="/master"><i class="material-icons">language</i> <span class="hide-menu">Master<span class="fa arrow"></span></span></a>
						<ul class="nav nav-second-level">
							<li><a href="{{ route('master.mk.index') }}"><i class="material-icons">laptop_windows</i><span class="hide-menu">  Mata Kuliah</span></a></li>
							<li><a href="{{ route('master.kelas.index') }}"><i class="material-icons">av_timer</i><span class="hide-menu">  Kelas</span></a></li>
							<li><a href="{{ route('master.dosen.index') }}"><i class="material-icons">airline_seat_recline_extra</i><span class="hide-menu">  Dosen</span></a></li>
							<li><a href="{{ route('master.asisten.index') }}"><i class="material-icons">perm_identity</i><span class="hide-menu">  Asisten</span></a></li>
							<li><a href="{{ route('master.gelombang.index') }}"><i class="material-icons">date_range</i><span class="hide-menu">  Gelombang</span></a></li>
						</ul>
					</li>
					<li class="devider"></li>
					<li><a href="documentation.html" class="waves-effect"><i class="fa fa-circle-o text-danger"></i> <span class="hide-menu">Documentation</span></a></li>
					<li><a href="gallery.html" class="waves-effect"><i class="fa fa-circle-o text-info"></i> <span class="hide-menu">Faqs</span></a></li>
				</ul>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- End Left Sidebar -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Page Content -->
		<!-- ============================================================== -->
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row bg-title">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<h4 class="page-title">@yield('pagetitle')</h4> </div>
				</div>
				@yield('content')
			</div>
			<!-- /.container-fluid -->
			<footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by themedesigner.in </footer>
		</div>
		<!-- ============================================================== -->
		<!-- End Page Content -->
		<!-- ============================================================== -->
	</div>
	<!-- ============================================================== -->
	<!-- End Wrapper -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	<!-- All Jquery -->
	<!-- ============================================================== -->
	<script src="{{ URL::asset('plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="{{ URL::asset('ample/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<!-- Menu Plugin JavaScript -->
	<script src="{{ URL::asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
	<!--slimscroll JavaScript -->
	<script src="{{ URL::asset('ample/js/jquery.slimscroll.js') }}"></script>
	<!--Wave Effects -->
	<script src="{{ URL::asset('ample/js/waves.js') }}"></script>
	<!--Counter js -->
	<script src="{{ URL::asset('plugins/bower_components/waypoints/lib/jquery.waypoints.js') }}"></script>
	<script src="{{ URL::asset('plugins/bower_components/counterup/jquery.counterup.min.js') }}"></script>
	<script src="{{ URL::asset('plugins/bower_components/raphael/raphael-min.js') }}"></script>
	<!-- chartist chart -->
	<script src="{{ URL::asset('plugins/bower_components/chartist-js/dist/chartist.min.js') }}"></script>
	<script src="{{ URL::asset('plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js') }}"></script>
	<!-- Custom Theme JavaScript -->
	<script src="{{ URL::asset('ample/js/custom.min.js') }}"></script>
	<!-- Custom tab JavaScript -->
	<script src="{{ URL::asset('ample/js/cbpFWTabs.js') }}"></script>
	<script src="{{ URL::asset('plugins/bower_components/toast-master/js/jquery.toast.js') }}"></script>
	<!--Style Switcher -->
	<script src="{{ URL::asset('plugins/bower_components/styleswitcher/jQuery.style.switcher.js') }}"></script>
	@yield('js')
</body>
</html>