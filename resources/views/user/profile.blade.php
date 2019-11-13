@extends('layouts.default')

@section('content')
<div class="container">
    <div class="my-3">
		<h2>{{ $profile->name }}'s Profile</h2>
	</div>
	<div class="my-3">
		<div class="row no-gutters p-3">
			<div class="col-md-3 m-1 shadow-sm bg-light">
				<h4>Personal Information</h4>
				<p><span class="font-weight-bold">Email:</span> {{ $profile->email }}</p>
				@if($profile->birthday)
					<p><span class="font-weight-bold">Birth date:</span> {{ $profile->birthday }}</p>
				@else
					<p><span class="font-weight-bold">Birth date:</span> Information not entered</p>
				@endif
				@if($profile->gender)
					<p><span class="font-weight-bold">Gender:</span> </p>
				@else	
					<p><span class="font-weight-bold">Gender:</span> Information not entered</p>
				@endif
				
				<a href="/public/editProfile" class="btn btn-primary m-3">Edit Profile</a>
			</div>
			<div class="col-md-3 m-1 shadow-sm bg-light">
				<h4>Book Shelf</h4>
			</div>
			<div class="col-md-3 m-1 shadow-sm bg-light">
				<h4>Friend List</h4>
			</div>
		</div>
	</div>
</div>
@endsection
