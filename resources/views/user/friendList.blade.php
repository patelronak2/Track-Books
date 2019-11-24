@extends('layouts.default')

@section('content')
<div class="container-fluid">
	<div class="my-3">
		<h2>{{ $user->name }}'s Friend List</h2>
	</div>
	<div class="row">
		<div class="col-md-6">
			<ul class="list-group">
			  <li class="list-group-item d-flex justify-content-between align-items-center">
				Friends
				<span class="badge badge-primary badge-pill">12</span>
			  </li>
			  <li class="list-group-item d-flex justify-content-between align-items-center">
				Ads
				<span class="badge badge-primary badge-pill">50</span>
			  </li>
			  <li class="list-group-item d-flex justify-content-between align-items-center">
				Junk
				<span class="badge badge-primary badge-pill">99</span>
			  </li>
			</ul>
		</div>
		<div class="col-md-6">
			<ul class="list-group">
			  <li class="list-group-item d-flex justify-content-between align-items-center">
				Requests
				<span class="badge badge-primary badge-pill">12</span>
			  </li>
			  <li class="list-group-item d-flex justify-content-between align-items-center">
				Ads
				<a href="#" class="btn btn-primary" >Unfriend</a>
			  </li>
			  <li class="list-group-item d-flex justify-content-between align-items-center">
				Junk
				<span class="badge badge-primary badge-pill">99</span>
			  </li>
			</ul>
		</div>
	</div>
</div>

@endsection