<!-- 
"SOA: I Ronak Patel, 000744055 certify that this material is my original work. No other person's work has been used without due acknowledgement. 
			  I have not made my work available to anyone else."
-->
@extends('layouts.app')

@section('content')
	<div class="row" style="margin: 0px !important;">
		<div class="col-md-6 col-sm-12 bg-primary text-white p-4" style="height: 80vh;">
			<div class="mt-5 pt-5 d-flex flex-column">
				<div class="m-1 justify-content-center">
					<div class="d-flex flex-row">
						<div class="m-2 p-2">
							<i class="far fa-compass text-white mt-1" style="font-size: 36px"></i>
						</div>
						<div class="m-2 p-2">
							<p><strong>Explore</strong><br>	Get information about the books!</p>
						</div>
					</div>
				</div>
				<div class="m-1">
					<div class="d-flex flex-row">
						<div class="m-2 p-2">
							<i class="	fas fa-thumbs-up text-white mt-1" style="font-size: 36px"></i>
						</div>
						<div class="m-2 p-2">
							<p><strong>Favorites</strong><br> Add books to showcase on your profile!</p>
						</div>
					</div>
				</div>
				<div class="m-1">
					<div class="d-flex flex-row">
						<div class="m-2 p-2">
							<i class="	fas fa-user-friends text-white mt-1" style="font-size: 36px"></i>
						</div>
						<div class="m-2 p-2">
							<p><strong>Make Friends</strong><br> Find people with similar interest!</p>
						</div>
					</div>
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