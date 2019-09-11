<!-- 
"SOA: I Ronak Patel, 000744055 certify that this material is my original work. No other person's work has been used without due acknowledgement. 
			  I have not made my work available to anyone else."
-->
@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-md-6 col-sm-12 bg-primary text-white p-4" style="height: 80vh;">
			<h5 class="text-center">Information Goes Here!</h5>
		</div>
		<div class="col-md-6 col-sm-12 bg-light text-dark p-4" style="height: 80vh;">
			<h5 class="text-center text-primary">See Who is trending in Book world!</h5>
			<h5 class="text-center text-secondary">Join the community now!</h5>
			<div class="text-center mt-5">
				<a class="btn btn-primary btn-lg" href="{{ route('login') }}" role="button">{{ __('Login') }}</a>
				
				<a class="btn btn-outline-primary btn-lg" href="{{ route('register') }}" role="button">{{ __('Register') }}</a>
			</div>
		</div>
	</div>
		
@endsection