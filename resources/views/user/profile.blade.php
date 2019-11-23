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
		<div class="container-fluid">
			<h5>Want To Read</h5>
			<div class="table-responsive">
				<table>
					<tr id="wantToReadResult">
						@foreach($shelves as $shelf)
							@if($shelf->wantToRead)
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
					  </tr>
				</table>
			  </div>
		</div>
	   <div class="container-fluid">
			<h5>Currently Reading</h5>
			<div class="table-responsive">
				<table>
					<tr id="currentlyReadingResult">
						@foreach($shelves as $shelf)
							@if($shelf->currentlyReading)
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
					  </tr>
				</table>
			  </div>
		   </div>
		   <div class="container-fluid">
				<h5>Finished Reading</h5>
				<div class="table-responsive">
					<table>
						<tr id="finishedReadingResult">
							<td>
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
							</td>
						</tr>
					</table>
				  </div>
			   </div>
	</div>
</div>
<script>
	$(document).ready(function(){
		if($("#finishedReadingResult").html()){
			var tempHtml = "<td><p>No Books in the shelf</p></td>";
			$("#finishedReadingResult").html(tempHtml);
		}
		if($("#currentlyReadingResult").html()){
			var tempHtml = "<td><p>No Books in the shelf</p></td>";
			$("#currentlyReadingResult").html(tempHtml);
		}
		if($("#wantToReadResult").html()){
			var tempHtml = "<td><p>No Books in the shelf</p></td>";
			$("#wantToReadResult").html(tempHtml);
		}
	});

</script>
@endsection
