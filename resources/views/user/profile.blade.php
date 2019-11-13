@extends('layouts.default')

@section('content')
<div class="container">
    <div class="my-3">
		<h2>{{ $profile->name }}'s Profile</h2>
	</div>
	<div class="my-3">
		<div class="row no-gutters shadow-sm bg-light p-3">
			<div class="col-md-6">
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
			</div>
			<div class="col-md-3">
				<h4>Book Shelf</h4>
			</div>
			<div class="col-md-3">
				<h4>Friend List</h4>
			</div>
		</div>
	</div>
</div>
@endsection
