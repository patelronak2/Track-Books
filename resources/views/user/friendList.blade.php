@extends('layouts.default')

@section('content')

<script>
	$(document).ready(function(){
		
		$.ajax({
			url: '/public/pendingRequest',
			type: 'GET',
			success: function(response){
				var data = JSON.parse(response);
				alert(data);
			},
			error: function(error){
				alert("Couldn't get pendingRequests");
			}
		});
		
		$.ajax({
			url: '/public/getFriendList',
			type: 'GET',
			success: function(response){
				var data = JSON.parse(response);
				alert(data);
			},
			error: function(error){
				alert("Couldn't get FriendList");
			}
		});
	});

</script>

<div class="container-fluid">
	<div class="my-3">
		<h2>{{ Auth::user()->name }}'s Friend List</h2>
	</div>
	<div class="row">
		<div class="col-md-6">
			<ul class="list-group">
			  <li class="list-group-item d-flex justify-content-between align-items-center">
				<h5>Friends</h5>
				<span class="badge badge-primary badge-pill" id="totalFriends"></span>
			  </li>
			  <span id="friendList">
			  
			  </span>
			  <!-- For loop to display all the friends
			  @foreach($friends as $friend)
				<li class="list-group-item d-flex justify-content-between align-items-center">
				{{ $friend->name }}
				<a href="#" class="btn btn-light btn-sm">Unfriend</a>
				</li>
			  @endforeach -->
			</ul>
		</div>
		<div class="col-md-6">
			<ul class="list-group">
			  <li class="list-group-item d-flex justify-content-between align-items-center">
				<h5>Requests</h5>
				<span class="badge badge-primary badge-pill" id="totalRequests"></span>
			  </li>
			  <!-- For loop here and print all pending requests 
			  @foreach($pendingRequests as $pendingRequest)
				<li class="list-group-item d-flex justify-content-between align-items-center">
				{{ $pendingRequest->name }}
				<a href="#" class="btn btn-danger btn-sm">Decline</a>
				</li>
			  @endforeach-->
			</ul>
		</div>
	</div>
</div>

@endsection