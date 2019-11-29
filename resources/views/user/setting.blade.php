@extends('layouts.default')

@section('content')
<div class="container-fluid">
    <div class="my-3">
		<h2>Account Setting</h2>
	</div>
	<p class="sr-only" id="userID">{{ Auth::id() }}</p>
	<div class="alert alert-success d-none" id="alert" role="alert">
	  <span id="message"></span>
	</div>
	<div class="alert alert-danger d-none" id="emptyField" role="alert">
	  Name Cannot be blank!
	</div>
	<div class="my-3">
		<div class="shadow-sm bg-light p-3">
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
					<button type="submit" class="btn btn-light button-pm">
						Save Changes
					</button>
				</div>
			</div>
		</form>
	</div>
	</div>
	<div class="my-3">
		<div class="my-3">
			<h3>Delete from Book Shelves</h3>
		</div>
		<div class="my-2">
			<h5>Want To Read</h5>
			<div class="container-fluid table-responsive">
				<table>
					<tr>
						<?php $flag = 0; ?>
							@foreach($shelves as $shelf)
								@if($shelf->wantToRead)
									<?php $flag = 1; ?>
									<td>
									<div class="card m-1" style="width: 18rem;">
									  <div class="card-body">
										<p class="card-title font-weight-bold">{{ $shelf->book->title }}</p>
										<a href="#" class="badge badge-danger p-2" id="{{ $shelf->book->id }}">Delete</a>
									  </div>
									</div>
									</td>
								@endif
							@endforeach
							<?php if(!$flag){ ?>
								<p>No books in the shelf</p>
							
							<?php } ?>
					  </tr>
				</table>
			  </div>
		</div>
	   <div class="my-2">
			<h5>Currently Reading</h5>
			<div class=" container-fluid table-responsive">
				<table>
					<tr>
						<?php $flag = 0; ?>
							@foreach($shelves as $shelf)
								@if($shelf->currentlyReading)
									<?php $flag = 1; ?>
									<td>
									<div class="card m-1" style="width: 18rem;">
									  <div class="card-body">
										<p class="card-title font-weight-bold">{{ $shelf->book->title }}</p>
										<a href="#" class="badge badge-danger p-2" id="{{ $shelf->book->id }}">Delete</a>
									  </div>
									</div>
									</td>
								@endif
							@endforeach
							<?php if(!$flag){ ?>
								<p>No books in the shelf</p>
							
							<?php } ?>
					  </tr>
				</table>
			  </div>
		   </div>
		   <div class="my-2">
				<h5>Finished Reading</h5>
				<div class="container-fluid table-responsive">
					<table>
						<tr>
						<?php $flag = 0; ?>
							@foreach($shelves as $shelf)
								@if($shelf->finishedReading)
									<?php $flag = 1; ?>
									<td>
									<div class="card m-1" style="width: 18rem;">
									  <div class="card-body">
										<p class="card-title font-weight-bold">{{ $shelf->book->title }}</p>
										<a href="#" class="badge badge-danger p-2" id="{{ $shelf->book->id }}">Delete</a>
									  </div>
									</div>
									</td>
								@endif
							@endforeach
							<?php if(!$flag){ ?>
								<p>No books in the shelf</p>
							
							<?php } ?>
						</tr>
					</table>
				  </div>
			   </div>
	</div>
</div>
<script type="text/javascript" src="{{ asset('js/setting.js') }}"></script>
@endsection
