@extends('layouts.default')

@section('content')

<script>
	$(document).ready(function(){
		
		$.ajax({
			url: '/public/pendingRequest',
			type: 'GET',
			success: function(response){
				var data = JSON.parse(response);
				if(data.length){
					
				}else{
					$("#totalRequests").html(data.length);
					var temphtml = '<li class="list-group-item d-flex justify-content-between align-items-center">';
					temphtml += 'No Pending Requests</li>';
					$("#pendingList").html(temphtml);
				}
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
				if(data.length){
					
				}else{
					$("#totalFriends").html(data.length);
					var temphtml = '<li class="list-group-item d-flex justify-content-between align-items-center">';
					temphtml += 'No Friends to Display</li>';
					$("#friendList").html(temphtml);
				}
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
			  
			</ul>
		</div>
		<div class="col-md-6">
			<ul class="list-group">
			  <li class="list-group-item d-flex justify-content-between align-items-center">
				<h5>Requests</h5>
				<span class="badge badge-primary badge-pill" id="totalRequests"></span>
			  </li>
			  <span id="pendingList">
			  
			  </span>
			</ul>
		</div>
	</div>
</div>

@endsection