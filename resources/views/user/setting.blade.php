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
		<div class="row no-gutters">
			<div class="justify-content-center">
			@foreach($shelves as $shelf)
				<div class="card m-2" style="width: 18rem;">
				  <div class="card-body">
					<h5 class="card-title">{{ $shelf->book->title }}</h5>
					<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
					<a href="#" class="btn btn-danger">Delete</a>
				  </div>
				</div>	
			@endforeach
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		var userID = $("#userID").text();
		
		$.ajax({
			url: '/public/getProfileDetails',
			type: 'GET',
			success: function(data){
				//alert(data.name);
				$("#name").val(data.name);
				$("#birthday").attr("value", data.birthday);
				//$("#name").value(data.gender);
				//$("#name").value(data.isPrivate);
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
		
		$("#birthday").change(function(){
			alert($("#birthday").val());
		});
	});
</script>
@endsection
