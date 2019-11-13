@extends('layouts.default')

@section('content')
<div class="container">
    <h2>Account Setting</h2>
	<div class="my-3 bg-light shadow-sm p-3">
		<h5>Edit Profile</h5>
		<form method="POST" action="/public/editProfile">
			<div class="form-group row">
				<label for="name" class="col-md-3 col-form-label">Name</label>

				<div class="col-md-4">
					<input id="name" type="text" class="form-control" name="name" value="Ronak Patel">
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
