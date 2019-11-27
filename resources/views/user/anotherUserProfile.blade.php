@extends('layouts.default')

@section('content')
<script type="text/javascript" src="{{ asset('js/anotherUserProfile.js') }}"></script>
<p class="sr-only" id="anotherUserId">{{ $user->id }}</p>
@if($user->profile->isPrivate  && !$isFriend)
	<div class="my-3 text-center">
		<div class="px-3">
			<i class="fa fa-lock my-2" style="font-size:48px"></i>
		</div>
		<h2 class="p-3">{{ $user->name }}'s Profile is Private.</h2>
		<div class="p-3">
			<h4>Add {{ $user->name }} as friend to view more details.</h4>
			<div class="my-2">
				@if($isFriend)
				<a href="#" class="btn btn-danger" id="removeFriend">Unfriend</a>
				@elseif($hasRecievedRequest)
					<a href="#" class="btn btn-light button-pm" id="acceptRequest">Accept Request</a>
					<a href="#" class="btn btn-danger button" id="decline">Decline</a>
				@elseif($isRequestSent)
					<button class="btn btn-info" disabled>Request Sent</button>
				@else
					<a href="/public/sendFriendRequest/{{$user->id}}" class="btn btn-light button">Add Friend</a>
				@endif
			</div>
		</div>
	
	</div>
@else
	<div class="container-fluid">
		<div class="my-3">
			<h2>{{ $user->name }}'s Profile</h2>
		</div>
		<div class="my-3">
		<div class="shadow-sm bg-light p-3">
			<h4>Personal Information</h4>
			<div class="row">
				<p class="col-md-3"><span class="font-weight-bold">Email:</span> {{ $user->email }}</p>
				@if($user->profile->birthday)
					<p class="col-md-3"><span class="font-weight-bold">Birth date:</span> {{ $user->profile->birthday }}</p>
				@endif
				@if($user->profile->gender)
					<p class="col-md-3"><span class="font-weight-bold">Gender:</span> {{ $user->profile->gender }}</p>
				@endif
				<div class="col-md-3">
					<p><span class="font-weight-bold">Total Friends: </span><span id="totalFriends">{{ $totalFriends}}</span></p>
				</div>
			</div>
			<!-- check here if this user is already friend or request is sent to him/her -->
			@if($isFriend)
				<a href="#" class="btn btn-danger" id="removeFriend">Unfriend</a>
			@elseif($hasRecievedRequest)
				<a href="#" class="btn btn-light button-pm" id="acceptRequest">Accept Request</a>
				<a href="#" class="btn btn-danger button" id="decline" >Decline</a>
			@elseif($isRequestSent)
				<button class="btn btn-info" disabled>Request Sent</button>
			@else
				<a href="/public/sendFriendRequest/{{$user->id}}" class="btn btn-light button">Add Friend</a>
			@endif
			
		</div>
		</div>
		<div class="my-3">
		<div class="my-3">
			<h3>Book Shelves</h3>
		</div>
		<div class="my-2">
			<h5>Want To Read</h5>
			<div class="container-fluid table-responsive">
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
	   <div class="my-2">
			<h5>Currently Reading</h5>
			<div class=" container-fluid table-responsive">
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
		   <div class="my-2">
				<h5>Finished Reading</h5>
				<div class="container-fluid table-responsive">
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
	
@endif
@endsection
