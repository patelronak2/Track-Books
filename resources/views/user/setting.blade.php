@extends('layouts.default')

@section('content')
<div class="container">
    <h2>Account Setting</h2>
	<div class="my-3 bg-light shadow-sm p-3">
		<h5>Edit Profile</h5>
		<form method="POST" action="/public/editProfile">
			 <div class="form-group row">
				<label for="name" class="col-sm-2 col-form-label">Name</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="name" value="John Doe">
				</div>
			  </div>
			  <div class="form-group row">
				<label for="birthday" class="col-sm-2 col-form-label">Birth Date</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="birthday" name="birthday" placeholder="18th November, 1998">
				</div>
			  </div>
			  <div class="form-group row">
				<label for="gender" class="col-sm-2 col-form-label">Gender</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="gender" placeholder="Male" name="gender">
				</div>
			  </div>
			  <div class="form-group row">
				<label for="accountVisiblity" class="col-sm-2 col-form-label">Gender</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="accountVisiblity" placeholder="Pulbic" name="accountVisiblity">
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
</div>
@endsection
