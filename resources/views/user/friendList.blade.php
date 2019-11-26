@extends('layouts.default')

@section('content')

<script>
	$(document).ready(function(){
					
		$('#pendingList').on('click','a.btn-warning',function(){
			var id = $(this).attr('id');
			$.ajax({
				url: '/public/acceptRequest/'+id,
				type: 'GET',
				success: function(data){
					location.reload(true);
				},
				error: function(error){
					console.log("Something went wrong while accepting the request");
					console.log(error);
				}
			})
		});
		
	});

</script>

<div class="container-fluid">
	<div class="my-3">
		<h2>{{ Auth::user()->name }}'s Friend List</h2>
	</div>
	@if(Session::has('message'))
		@if(session('alert'))
			<div class="alert alert-danger">{{ session('message') }}</div>
		@else
			<div class="alert alert-success">{{ session('message') }}</div>
		@endif
	@endif
	<div class="row">
		<div class="col-md-6 my-2">
			<ul class="list-group">
			  <li class="list-group-item d-flex justify-content-between align-items-center">
				<h5>Requests</h5>
				<span class="badge badge-primary badge-pill">{{ count($requests) }}</span>
			  </li>			  
			  @if(count($requests) > 0)
				  @foreach($requests as $request)
					<li class="list-group-item d-flex justify-content-between align-items-center">
						<a href="/public/showProfile/{{ $request[0] }}" style="text-decoration: none; color: inherit;">{{ $request[1] }}</a>
						<div>
							<a href="#" class="badge badge-light button-pm p-2" >Accept</a>
							<a href="/public/declineRequest/{{ $request[0] }}" class="badge badge-danger button p-2" >Decline</a>
						</div>
					</li>
				 @endforeach 	
			  @else
				  <li class="list-group-item d-flex justify-content-between align-items-center">No Friends to Display</li>
			  @endif
			</ul>
		</div>
		
		<div class="col-md-6 my-2">
			<ul class="list-group">
			  <li class="list-group-item d-flex justify-content-between align-items-center">
				<h5>Friends</h5>
				<span class="badge badge-primary badge-pill">{{ count($friends) }}</span>
			  </li>
			  @if(count($friends) > 0)
				  @foreach($friends as $friend)
					<li class="list-group-item d-flex justify-content-between align-items-center">
						<a href="/public/showProfile/{{ $friend->id }}" style="text-decoration: none; color: inherit;">{{ $friend->name }}</a>
						<a href="/public/unFriend/{{ $friend->id }}" class="badge badge-danger p-2" >UnFriend</a>
					</li>
				 @endforeach 	
			  @else
				  <li class="list-group-item d-flex justify-content-between align-items-center">No Friends to Display</li>
			  @endif
			  
			</ul>
		</div>
		
	</div>
</div>

@endsection