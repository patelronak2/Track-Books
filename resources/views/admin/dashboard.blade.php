@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
			<h1>Admin Dashboard</h1>
			<div class="row">
				<div class="col-md-4">
					<div class="card">
						<div class="card-header">Manage users</div>

						<div class="card-body">
							Add User, Delete User, Ban User
						</div>
					</div>
					</div>
				<div class="col-md-4">
					<div class="card">
						<div class="card-header">Manage Books</div>

						<div class="card-body">
							Add Books, Delete Books
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card">
						<div class="card-header">Manage Authors</div>

						<div class="card-body">
							Add User, Delete User, Ban User
						</div>
					</div>	
				</div>
			</div>
        </div>
    </div>
</div>
@endsection
