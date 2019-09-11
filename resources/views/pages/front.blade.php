<!-- 
"SOA: I Ronak Patel, 000744055 certify that this material is my original work. No other person's work has been used without due acknowledgement. 
			  I have not made my work available to anyone else."
-->
@extends('layouts.app')

@section('content')
	<div class="row" style="margin: 0px !important;">
		<div class="col-md-6 col-sm-12 bg-primary text-white p-4" style="height: 80vh;">
			<div class="text-center mt-5 pt-5 justify-content-center">
				<div class="m-2 p-2">
					<h3>Explore</h3>
				</div>
				<div class="m-2 p-2">
					<h3>Explore</h3>
				</div>
				<div class="m-2 p-2">
					<h3>Explore</h3>
				</div>
				
			</div>
		</div>
		<div class="col-md-6 col-sm-12 bg-light text-dark p-4" style="height: 80vh;">
			<div class="text-center mt-5 pt-5 justify-content-center">
				<i class="fas fa-book-reader text-primary" style="font-size: 48px;"></i>
				<h5 class="text-center text-primary mt-5">See Who is trending in Book world!</h5>
				<h5 class="text-center text-secondary">Join the community now!</h5>
				<div class="text-center mt-5">
					<a class="btn btn-primary btn-lg" href="{{ route('login') }}" role="button">{{ __('Login') }}</a>
					
					<a class="btn btn-outline-primary btn-lg" href="{{ route('register') }}" role="button">{{ __('Register') }}</a>
				</div>
			</div>
		</div>
	</div>
		
@endsection