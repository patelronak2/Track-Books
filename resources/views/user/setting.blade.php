@extends('layouts.default')

@section('content')
<div class="container">
    <h2>Account Setting</h2>
	<p class="sr-only" id="userID">{{ Auth::id() }}</p>
	<div class="my-3 bg-light shadow-sm p-3">
		<h4>Edit Profile</h4>
		<form method="POST" action="/public/editProfile" class="px-1">
			 <div class="form-group row">
				<label for="name" class="col-sm-2 col-form-label font-weight-bold">Name</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="name" value="John Doe">
				</div>
			  </div>
			  <div class="form-group row">
				<label for="birthday" class="col-sm-2 col-form-label font-weight-bold">Birth Date</label>
				<div class="col-sm-10">
				  <input type="date" class="form-control" id="birthday" name="birthday" value="">
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
		No Books added to the shelves
	</div>
</div>
<script>
	$(document).ready(function(){
		var userID = $("#userID").text();
		
		$.ajax({
			url: '/public/getProfileDetails',
			type: 'GET',
			success: function(data){
				alert(data.name);
				$("#name").value(data.name);
				$("#birthday").value(data.birthday);
				//$("#name").value(data.gender);
				//$("#name").value(data.isPrivate);
				alert("Gender: " + data.gender + "\n isPrivate: " + data.isPrivate);
				
			},
			error: function(error){
				alert("Couldn't get profile data");
			}
		});
	});
</script>
@endsection
