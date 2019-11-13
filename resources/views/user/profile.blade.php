@extends('layouts.default')

@section('content')
<div class="container">
    <div class="my-3">
		<h2>{{ $profile->name }}'s Profile</h2>
	</div>
	<div class="my-3">
		<div class="row no-gutters shadow-sm bg-light p-3">
			<div class="col-md-4">
				<h5>Personal Information</h5>
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
			<div class="col-md-4">
				<h5>Account Preferences</h5>
				@if($profile->isPrivate)
					<p><span class="font-weight-bold">Account Visibility:</span> Private</p>
				@else	
					<p><span class="font-weight-bold">Account Visibility:</span> Public</p>
				@endif
			</div>
			<div class="col-md-4">
				<h5>Friends List</h5>
			</div>
		</div>
	</div>
	<div class="my-3">
		<div class="">
			<h3>Book Shelves</h3>
			<div class="row no-gutters shadow-sm p-3">
				<div class="col-md-4">
					<h5>Want to Read</h5>
					@foreach($shelves as $shelf)
						@if($shelf->wantToRead)
							<div class="row no-gutters">
								<img src="{{ $shelf->book->img_link }}" alt="image not available" class="col p-1" style="max-height: 75px; max-width: 65px;">
								<p class="col p-1 align-middle">{{ $shelf->book->title }}</p>
							</div>
						@endif
					@endforeach
				</div>
				<div class="col-md-4">
					<h5>Currently Reading</h5>
					@foreach($shelves as $shelf)
						@if($shelf->currentlyReading)
							<div class="row no-gutters">
								<img src="{{ $shelf->book->img_link }}" alt="image not available" class="col p-1" style="max-height: 75px; max-width: 65px;">
								<p class="col p-1 align-middle">{{ $shelf->book->title }}</p>
							</div>
						@endif
					@endforeach
				</div>
				<div class="col-md-4">
					<h5>Finished Reading</h5>
					@foreach($shelves as $shelf)
						@if($shelf->finishedReading)
							<div class="row no-gutters">
								<img src="{{ $shelf->book->img_link }}" alt="image not available" class="col p-1" style="max-height: 75px; max-width: 65px;">
								<p class="col p-1 align-middle">{{ $shelf->book->title }}</p>
							</div>
						@endif
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
