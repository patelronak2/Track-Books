@extends('layouts.default')

@section('content')
<div class="container">
    <h2>Account Setting</h2>
	<div class="my-3 bg-light shadow-sm p-3">
		<h3>Edit Profile</h3>
		<form method="POST" action="/public/editProfile">
			<div class="form-group row">
				<label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

				<div class="col-md-6">
					<input id="name" type="text" class="form-control" name="name" value="" autofocus>
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
