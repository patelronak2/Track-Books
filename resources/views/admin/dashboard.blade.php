@extends('layouts.default')

@section('content')
<!-- Big Changes expected in term of looks on this page -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
			<h1>Admin Dashboard</h1>
			<div class="mt-2">
				<div class="card">
					<div class="card-header">Manage users</div>
					<div class="card-body">
						Add User account, Delete User account, Ban User account
						<a href="/public/manageUsers" class="stretched-link"></a>
					</div>
				</div>
			</div>
			<div class="mt-2">
				<div class="card">
					<div class="card-header">Manage Books</div>
					<div class="card-body">
						Add Books, Add multiple Books, Delete Books
						<a href="/public/manageBooks" class="stretched-link"></a>
					</div>
				</div>
			</div>
			<div class="mt-2">
				<div class="card">
					<div class="card-header">Manage Authors</div>
					<div class="card-body">
						Add Author, Delete author
						<a href="/public/manageAuthors" class="stretched-link"></a>
					</div>
				</div>
			</div>
			<div class="mt-2">
				<div class="card">
					<div class="card-header">Manage Reviews</div>
					<div class="card-body">
						Read all Reviews, Delete Offensive Reviews
						<a href="/public/manageReviews" class="stretched-link"></a>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection
