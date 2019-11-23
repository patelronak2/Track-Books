@extends('layouts.default')

@section('content')
<div class="">
    <div class="my-3 container-fluid">
		<h2>{{ $profile->name }}'s Profile</h2>
	</div>
	<div class="my-3">
		<div class="shadow-sm bg-light container-fluid py-3">
				<h4>Personal Information</h4>
				<div class="row">
					<p class="col-md-3"><span class="font-weight-bold">Email:</span> {{ $profile->email }}</p>
					<div class="col-md-3">
					@if($profile->birthday)
						<p><span class="font-weight-bold">Birth date:</span> {{ $profile->birthday }}</p>
					@else
						<p><span class="font-weight-bold">Birth date:</span> Information not entered</p>
					@endif
					</div>
					<div class="col-md-3">
					@if($profile->gender)
						<p><span class="font-weight-bold">Gender:</span> {{ $profile->gender }}</p>
					@else	
						<p><span class="font-weight-bold">Gender:</span> Information not entered</p>
					@endif
					</div>
					<div class="col-md-3">
						<p><span class="font-weight-bold">Total Friends: </span><span id="totalFriends">0</span></p>
					</div>
				</div>
			<div class="my-2">
				<h4>Account Preferences</h4>
				@if($profile->isPrivate)
					<p><span class="font-weight-bold">Account Visibility:</span> Private
						<small>(User's will not be able to see your profile)</small>
					</p>
					
				@else	
					<p><span class="font-weight-bold">Account Visibility:</span> Public</p>
				@endif
			</div>
			<a href="/public/setting" class="btn btn-light button">Edit Profile</a>
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
</div>

@endsection
