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
				<label for="birthdate" class="col-sm-2 col-form-label">Birth Date</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" id="birthdate" placeholder="18th November, 1998">
				</div>
			  </div>
			<div class="form-group row mb-0">
				<div class="col-md-6 offset-md-4">
					<button type="submit" class="btn btn-primary">
						Add Book
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection
