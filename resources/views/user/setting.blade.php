@extends('layouts.default')

@section('content')
<div class="container">
    <h2>Account Setting</h2>
	<p class="sr-only" id="userID">{{ Auth::id() }}</p>
	<div class="my-3 bg-light shadow-sm p-3">
		<h4>Edit Profile</h4>
		<form class="px-1">
			@csrf
			 <div class="form-group row">
				<label for="name" class="col-sm-2 col-form-label font-weight-bold">Name</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="name" value="John Doe">
				</div>
			  </div>
			  <div class="form-group row">
				<label for="birthday" class="col-sm-2 col-form-label font-weight-bold">Birth Date</label>
				<div class="col-sm-10">
				  <input type="date" class="form-control" id="birthday" name="birthday" max="" value="">
				</div>
			  </div>
			  <div class="form-group row">
				<label for="gender" class="col-sm-2 col-form-label font-weight-bold">Gender</label>
				<div class="col-sm-10">
				  <div class="custom-control custom-radio custom-control-inline">
					  <input type="radio" id="male" name="gender" class="custom-control-input">
					  <label class="custom-control-label" for="male">Male</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
					  <input type="radio" id="female" name="gender" class="custom-control-input">
					  <label class="custom-control-label" for="female">Female</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
					  <input type="radio" id="notToSay" name="gender" class="custom-control-input">
					  <label class="custom-control-label" for="notToSay">Prefer not to say</label>
					</div>
				</div>
			  </div>
			  <div class="form-group row">
				<label for="accountVisiblity" class="col-sm-2 col-form-label font-weight-bold">Account Visiblity</label>
				<div class="col-sm-10">
				  <div class="custom-control custom-radio custom-control-inline">
					  <input type="radio" id="public" name="accountVisiblity" checked class="custom-control-input" value="public">
					  <label class="custom-control-label" for="public">Public</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
					  <input type="radio" id="private" value="private" name="accountVisiblity" class="custom-control-input">
					  <label class="custom-control-label" for="private">Private</label>
					</div>
				</div>
			  </div>
			<div class="form-group row mb-0">
				<div class="col-sm-10 offset-sm-2">
					<button type="submit" class="btn btn-primary">
						Save Changes
					</button>
				</div>
			</div>
		</form>
	</div>
	<h3>Delete from Book Shelves</h3>
	<div class="my-3 p-3 shadow-sm">
		<div class="row no-gutters">
				<div class="col-md-4">
					<h5 class="sticky-top">Want to Read</h5>
					<div class="overflow-auto" style="max-height: 400px;">
						@foreach($shelves as $shelf)
							@if($shelf->wantToRead)
								<div class="card m-1" style="width: 18rem;">
								  <div class="card-body">
									<p class="card-title font-weight-bold">{{ $shelf->book->title }}</p>
									<a href="#" class="btn btn-outline-danger btn-sm" id="{{ $shelf->book->id }}">Delete</a>
								  </div>
								</div>
							@endif
						@endforeach
					</div>
				</div>
				<div class="col-md-4">
					<h5 class="sticky-top">Currently Reading</h5>
					<div class="overflow-auto" style="max-height: 400px;">
						@foreach($shelves as $shelf)
							@if($shelf->currentlyReading)
								<div class="card m-1" style="width: 18rem;">
								  <div class="card-body">
									<p class="card-title font-weight-bold">{{ $shelf->book->title }}</p>
									<a href="#" class="btn btn-outline-danger btn-sm" id="{{ $shelf->book->id }}">Delete</a>
								  </div>
								</div>
							@endif
						@endforeach
					</div>
				</div>
				<div class="col-md-4">
					<h5 class="sticky-top">Finished Reading</h5>
					<div class="overflow-auto" style="max-height: 400px;">
						@foreach($shelves as $shelf)
							@if($shelf->finishedReading)
								<div class="card m-1" style="width: 18rem;">
								  <div class="card-body">
									<p class="card-title font-weight-bold">{{ $shelf->book->title }}</p>
									<a href="/public/deleteShelfBook/{{ $shelf->id }}" class="btn btn-outline-danger btn-sm" id="{{ $shelf->id }}">Delete</a>
								  </div>
								</div>
							@endif
						@endforeach
					</div>
				</div>
			</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		var userID = $("#userID").text();
		//set minimum birthdate entry here
		var d = new Date(Date.now());
		var maxDate = d.toISOString().split('T')[0];
		$("#birthday").attr("max", maxDate);
		$.ajax({
			url: '/public/getProfileDetails',
			type: 'GET',
			success: function(data){
				//alert(data.name);
				$("#name").val(data.name);
				$("#birthday").attr("value", data.birthday);
				if(data.gender){
					if(data.gender == "male"){
						 $("#male").prop("checked", true);
					}else if(data.gender == "female"){
						$("#female").prop("checked", true);
					}else{
						$("#notToSay").prop("checked", true);
					}
				}
				if(data.isPrivate){
					$("#private").prop("checked", true);
				}else{
					$("#public").prop("checked", true);
				}
				//alert("Gender: " + data.gender + "\n isPrivate: " + data.isPrivate);
				
			},
			error: function(error){
				alert("Couldn't get profile data");
			}
		});
		
		$('.card-body').on('click','a', function(){
			var id = $(this).attr('id');
			//Ajax call to delete from the shelf
		});
		
		$('form').submit(function(){

			var birthday = $("#birthday").val();
			var name = $("#name").val();
			var gender = "";
			if($("#male").prop("checked")){
				gender = "Male";
			}else if($("#female").prop("checked")){
				gender = "Female"
			}else if($("#notToSay").prop("checked")){
				gender = "Prefer Not To Say"
			}
			var isPrivate = false;
			if($("#private").prop("checked")){
				isPrivate = true
			}
			alert("Name: " + name + "\nBirthDay: " + birthday + "\ngender: " + gender +"\nisPrivate " + isPrivate);
			return false;
		});
	});
</script>
@endsection
