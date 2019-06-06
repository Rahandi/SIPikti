@extends('layouts.master')

@section('pagetitle')
	Dashboard
@endsection

@section('content')
	<div class="row">
		<div class="col-sm-12">
			<div class="white-box">
				 <div class="row row-in">
					  <div class="col-lg-4 col-sm-12 row-in-br">
						<ul class="col-in">
								<li>
									<span class="circle circle-md bg-danger"><i class="ti-clipboard"></i></span>
								</li>
								<li class="col-last"><h3 class="counter text-right m-t-15">23</h3></li>
								<li class="col-middle">
									<h4>Total Pendaftar</h4>
									<div class="progress">
									  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> 
										  <span class="sr-only">40% Complete (success)</span> 
									  </div>
									</div>
								</li>
								
						</ul>
					  </div>
					</div>   
			</div>
		</div>
	</div>
@endsection