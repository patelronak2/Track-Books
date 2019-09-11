<!-- 
"SOA: I Ronak Patel, 000744055 certify that this material is my original work. No other person's work has been used without due acknowledgement. 
			  I have not made my work available to anyone else."
-->
@extends('layouts.app')

@section('content')
	<div class="row" style="margin: 0px!important;">
		<div class="col-md-6 col-sm-12 bg-primary text-white" style="height: 80vh;">
			<h5 class="text-center">Information Goes Here!</h5>
		</div>
		<div class="col-md-6 col-sm-12 bg-light text-dark" style="height: 80vh;">
			<h5 class="text-center">Login Form Goes Here!</h5>
			<!--<button type="button" class="btn btn-primary">Primary</button> -->
			<a class="btn btn-primary" href="{{ route('login') }}">{{ __('Login') }}</a>
			<!-- <button type="button" class="btn btn-outline-primary">Primary</button> -->
			<a class="btn btn-outline-primary" href="{{ route('register') }}">{{ __('Register') }}</a>
		</div>
	</div>
		
@endsection