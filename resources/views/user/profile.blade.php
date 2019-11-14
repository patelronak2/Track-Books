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
				
				<a href="/public/setting" class="btn btn-primary m-3">Edit Profile</a>
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
					<h5 class="sticky-top">Want To Read</h5>
					<div class="overflow-auto" style="max-height: 400px;">
						@foreach($shelves as $shelf)
							@if($shelf->wantToRead)
								<div class="card m-1" style="width: 18rem;">
								  <div class="card-body">
									<p class="card-title font-weight-bold">{{ $shelf->book->title }}</p>
									<div class="text-center">
									  <img src="{{$shelf->book->img_link}}" width="65px" height="75px" class="rounded" alt="Image Not Available">
									</div>
									<a href="#" class="stretched-link"></a>
								  </div>
								</div>
							@endif
						@endforeach
					</div>
				</div>
				<div class="col-md-4">
					<h5 class="sticky-top">Currently Reading</h5>
					<div class="overflow-auto" style="max-height: 400px;">
						@foreach($shelves as $shelf)
							@if($shelf->currentlyReading)
								<div class="card m-1" style="width: 18rem;">
								  <div class="card-body">
									<p class="card-title font-weight-bold">{{ $shelf->book->title }}</p>
									<div class="text-center">
									  <img src="{{$shelf->book->img_link}}" width="65px" height="75px" class="rounded" alt="Image Not Available">
									</div>
									<a href="#" class="stretched-link"></a>
								  </div>
								</div>
							@endif
						@endforeach
					</div>
				</div>
				<div class="col-md-4">
					<h5 class="sticky-top">Finished Reading</h5>
					<div class="overflow-auto" style="max-height: 400px;">
						@foreach($shelves as $shelf)
							@if($shelf->finishedReading)
								<div class="card m-1" style="width: 18rem;">
								  <div class="card-body">
									<p class="card-title font-weight-bold">{{ $shelf->book->title }}</p>
									<div class="text-center">
									  <img src="{{$shelf->book->img_link}}" class="rounded" width="65px" height="75px" alt="Image Not Available">
									</div>
									<a href="#" class="stretched-link"></a>
								  </div>
								</div>
							@endif
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
