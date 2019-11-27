<!-- 
"SOA: I Ronak Patel, 000744055 certify that this material is my original work. No other person's work has been used without due acknowledgement. 
			  I have not made my work available to anyone else."
-->
@extends('layouts.app')

@section('content')

<header>
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
	  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
	  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
	  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
	</ol>
	<div class="carousel-inner" role="listbox">
	  <div class="carousel-item active" style="background-image: url('https://images.unsplash.com/photo-1572061486732-b528a9b293a3?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjUxMjV9&auto=format&fit=crop&w=1051&q=80')">
		<div class="carousel-caption">
		  <p class="display-4">Explore Books</p>
		  <p class="lead">Get information about books.</p>
		</div>
	  </div>
	  <div class="carousel-item" style="background-image: url('https://images.unsplash.com/photo-1479142506502-19b3a3b7ff33?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60')">
		<div class="carousel-caption">
		  <p class="display-4">Book Shelves</p>
		  <p class="lead">Add books to show on your profile!</p>
		</div>
	  </div>
	  <div class="carousel-item" style="background-image: url('https://images.unsplash.com/photo-1481142889578-dda440dacfe1?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60')">
		<div class="carousel-caption">
		  <p class="display-4">Make Friends</p>
		  <p class="lead">Find People with similar interests.</p>
		</div>
	  </div>
	</div>
	<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		  <span class="sr-only">Previous</span>
		</a>
	<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		  <span class="carousel-control-next-icon" aria-hidden="true"></span>
		  <span class="sr-only">Next</span>
		</a>
  </div>
</header>

<!-- Page Content -->

<div class="container py-5">
	<div class="row no-gutters align-items-center">
		@guest
	  <div class="col-md-6">
		<h1 class="font-weight-light">Join Community Now</h1>
		<p class="lead">See what's trending in book world!</p>
	  </div>
	  <div class="col-md-6">
		<div class="text-center">
			<a href="{{ route('login') }}" class="btn btn-light button-pm btn-lg">Login</a>
			<a href="{{ route('register') }}" class="btn btn-light button-sd btn-lg">Register</a>
		</div>
	  </div>
	  @else
	  
		<h1 class="font-weight-light">Welcome Back!</h1>
		<p class="lead">See what's trending in book world! Click <a href="/public/home">here</a> to visit your home Page.</p>
	  
	  @endguest
	</div>
</div>

@endsection