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
				<span class="badge badge-primary badge-pill" id="totalFriends">{{ $totalFriends }}</span>
			  </li>
			  <!-- For loop to display all the students -->
			  @foreach($friends as $friend)
				<li class="list-group-item d-flex justify-content-between align-items-center">
				{{ $friend->name }}
				<a href="#" class="btn btn-light btn-sm">Unfriend</a>
				</li>
			  @endforeach
			</ul>
		</div>
		<div class="col-md-6">
			<ul class="list-group">
			  <li class="list-group-item d-flex justify-content-between align-items-center">
				Requests
				<span class="badge badge-primary badge-pill" id="totalRequests">{{ $totalPendingRequest }}</span>
			  </li>
			  <!-- For loop here and print all pending requests -->
			  @foreach($pendingRequests as $pendingRequest)
				<li class="list-group-item d-flex justify-content-between align-items-center">
				{{ $pendingRequest->name }}
				<a href="#" class="btn btn-danger btn-sm">Decline</a>
				</li>
			  @endforeach
			</ul>
		</div>
	</div>
</div>

@endsection