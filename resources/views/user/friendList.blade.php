@extends('layouts.default')

@section('content')

<script>
	$(document).ready(function(){
		
		$.ajax({
			url: '/public/pendingRequest',
			type: 'GET',
			success: function(response){
				var data = JSON.parse(response);
				$("#totalRequests").html(data.length);
				if(data.length){
					var temphtml = '';
					for(var i = 0; i < data.length; i++){
						temphtml += '<li class="list-group-item d-flex justify-content-between align-items-center">';
						temphtml += '<a href="/public/showProfile/'+ data[i][0] +'" style="text-decoration: none; color: inherit;">'+ data[i][1] +'</a>';
						temphtml += '<a href="#" class="btn btn-warning btn-sm" id="acceptRequest">Accept Request</a>';
						temphtml +=	'<a href="#" class="btn btn-danger btn-sm" id="decline">Decline</a>';
						temphtml += '</li>';
					}
										
					$("#pendingList").html(temphtml);
				}else{
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
				$("#totalFriends").html(data.length);
				if(data.length){
					var temphtml = '';
					for(var i = 0; i < data.length; i++){
						temphtml += '<li class="list-group-item d-flex justify-content-between align-items-center">';
						temphtml += '<a href="/public/showProfile/'+ data[i]['id'] +'" style="text-decoration: none; color: inherit;">'+ data[i]['name'] +'</a>';
						temphtml += '<a href="#" class="btn btn-danger btn-sm" id="removeFriend">Remove Friend</a>';
						temphtml += '</li>';
					}
					$("#friendList").html(temphtml);
				}else{
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