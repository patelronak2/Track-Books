@extends('layouts.default')

@section('content')
<div class="container">
    <div class="my-3">
		<h2>{{ $profile->name }}'s Profile</h2>
	</div>
	@if($profile->isPrivate)
				<div class="my-3">
					<div class="row no-gutters shadow-sm bg-light p-3">
						<div class="justify-content-center">
							<i class="fa fa-lock" style="font-size:48px"></i>
							<h4>This User's Profile is Private</h4>
						</div>
					</div>
				</div>
			@else
				<div class="my-3">
					<div class="row no-gutters shadow-sm bg-light p-3">
						<div class="col-md-4">
							<h5>Personal Information</h5>
							<p><span class="font-weight-bold">Email:</span> {{ $profile->email }}</p>
							@if($profile->birthday)
								<p><span class="font-weight-bold">Birth date:</span> {{ $profile->birthday }}</p>
							@endif
							@if($profile->gender)
								<p><span class="font-weight-bold">Gender:</span> {{ $profile->gender }}</p>
							@endif
							
							<a href="#" class="btn btn-primary m-3">Add Friend</a>
						</div>
					</div>
				</div>
				<div class="my-3">
					<h3>Book Shelves</h3>
					<div class="row no-gutters shadow-sm p-3">
						<div class="col-md-4">
							<h5 class="sticky-top">Want To Read</h5>
							<div class="overflow-auto" style="max-height: 600px;">
								@foreach($shelves as $shelf)
									@if($shelf->wantToRead)
										<div class="card m-1" style="width: 18rem;">
										  <div class="card-body">
											<p class="card-title text-center font-weight-bold">{{ $shelf->book->title }}</p>
											<div class="text-center">
											  <a href="/public/showBook/{{ $shelf->book->id }}" ><img src="{{$shelf->book->img_link}}" class="rounded" width="75px" height="90px" alt="Image Not Available"></a>
											</div>
										  </div>
										</div>
									@endif
								@endforeach
							</div>
						</div>
						<div class="col-md-4">
							<h5 class="sticky-top">Currently Reading</h5>
							<div class="overflow-auto" style="max-height: 600px;">
								@foreach($shelves as $shelf)
									@if($shelf->currentlyReading)
										<div class="card m-1" style="width: 18rem;">
										  <div class="card-body">
											<p class="card-title text-center font-weight-bold">{{ $shelf->book->title }}</p>
											<div class="text-center">
											  <a href="/public/showBook/{{ $shelf->book->id }}" ><img src="{{$shelf->book->img_link}}" class="rounded" width="75px" height="90px" alt="Image Not Available"></a>
											</div>
										  </div>
										</div>
									@endif
								@endforeach
							</div>
						</div>
						<div class="col-md-4">
							<h5 class="sticky-top">Finished Reading</h5>
							<div class="overflow-auto" style="max-height: 600px;">
								@foreach($shelves as $shelf)
									@if($shelf->finishedReading)
										<div class="card m-1" style="width: 18rem;">
										  <div class="card-body">
											<p class="card-title text-center font-weight-bold">{{ $shelf->book->title }}</p>
											<div class="text-center">
											  <a href="/public/showBook/{{ $shelf->book->id }}" ><img src="{{$shelf->book->img_link}}" class="rounded" width="75px" height="90px" alt="Image Not Available"></a>
											</div>
										  </div>
										</div>
									@endif
								@endforeach
							</div>
						</div>
					</div>
				</div>
			@endif
	
</div>
@endsection
