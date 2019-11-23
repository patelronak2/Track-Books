@extends('layouts.default')

@section('content')
<div class="my-3 container-fluid">
	<h2>{{ $profile->name }}'s Profile</h2>
</div>
@if($profile->isPrivate)
	<!-- <div class="my-3">
	  <div class="justify-content-center">
		<div class="text-center">
			
			
		</div>
	  </div>
	</div> -->
	<div class="my-3 row text-center">
		<div class="col-md-6 p-5" style="min-height: 100px;">
			<i class="fa fa-lock my-2" style="font-size:48px"></i>
			<h4>{{ $profile->name }}'s Profile is Private.</h4>
		</div>
		<div class="col-md-6 p-5" style="min-height: 100px;">
			<button class="btn btn-light button my-2">Add Friend</button>
			<h4>Add {{ $profile->name }} as friend to view more details.</h4>
		</div>
	
	</div>
@else
	<div class="my-3">
		<div class="shadow-sm bg-light py-2 container-fluid">
			<h5>Personal Information</h5>
			<div class="row">
				<p class="col-md-3"><span class="font-weight-bold">Email:</span> {{ $profile->email }}</p>
				@if($profile->birthday)
					<p class="col-md-3"><span class="font-weight-bold">Birth date:</span> {{ $profile->birthday }}</p>
				@endif
				@if($profile->gender)
					<p class="col-md-3"><span class="font-weight-bold">Gender:</span> {{ $profile->gender }}</p>
				@endif
				<div class="col-md-3">
					<p><span class="font-weight-bold">Total Friends: </span><span id="totalFriends">0</span></p>
				</div>
			</div>
			<a href="#" class="btn btn-light button">Add Friend</a>
		</div>
	</div>
	<div class="my-3">
		<div class="my-3 container-fluid">
			<h3>Book Shelves</h3>
		</div>
		<div class="container-fluid my-2">
			<h5>Want To Read</h5>
			<div class="table-responsive">
				<table>
					<tr>
					<?php $flag = 0; ?>
					@foreach($shelves as $shelf)
						@if($shelf->wantToRead)
							<?php $flag = 1; ?>
							<td>
								<div class="card m-1" style="width: 18rem;">
									<div class="card-body">
										<p class="card-title text-center font-weight-bold">{{ $shelf->book->title }}</p>
										<div class="text-center">
											<a href="/public/showBook/{{ $shelf->book->id }}" ><img src="{{$shelf->book->img_link}}" class="rounded" width="75px" height="90px" alt="Image Not Available"></a>
										</div>
									</div>
								</div>
							</td>
						@endif
					@endforeach
					<?php if(!$flag){ ?>
					<p>No books in the shelf</p>

					<?php } ?>
					</tr>
				</table>
			</div>
		</div>
		<div class="container-fluid my-2">
			<h5>Currently Reading</h5>
			<div class="table-responsive">
				<table>
					<tr>
					<?php $flag = 0; ?>
					@foreach($shelves as $shelf)
						@if($shelf->currentlyReading)
						<?php $flag = 1; ?>
						<td>
							<div class="card m-1" style="width: 18rem;">
								<div class="card-body">
									<p class="card-title text-center font-weight-bold">{{ $shelf->book->title }}</p>
									<div class="text-center">
										<a href="/public/showBook/{{ $shelf->book->id }}" ><img src="{{$shelf->book->img_link}}" class="rounded" width="75px" height="90px" alt="Image Not Available"></a>
									</div>
								</div>
							</div>
						</td>
						@endif
					@endforeach
					<?php if(!$flag){ ?>
					<p>No books in the shelf</p>

					<?php } ?>
					</tr>
				</table>
			</div>
		</div>
		<div class="container-fluid my-2">
			<h5>Finished Reading</h5>
			<div class="table-responsive">
				<table>
					<tr>
					<?php $flag = 0; ?>
					@foreach($shelves as $shelf)
						@if($shelf->finishedReading)
							<?php $flag = 1; ?>
							<td>
								<div class="card m-1" style="width: 18rem;">
									<div class="card-body">
										<p class="card-title text-center font-weight-bold">{{ $shelf->book->title }}</p>
										<div class="text-center">
											<a href="/public/showBook/{{ $shelf->book->id }}" ><img src="{{$shelf->book->img_link}}" class="rounded" width="75px" height="90px" alt="Image Not Available"></a>
										</div>
									</div>
								</div>
							</td>
						@endif
					@endforeach
					<?php if(!$flag){ ?>
					<p>No books in the shelf</p>

					<?php } ?>
					</tr>
				</table>
			</div>
		</div>
	</div>
@endif
@endsection
