@extends('layouts.default')

@section('content')
<div class="container-fluid">
	<h2>Manage Books</h2>
	<div class="container-fluid">
		<a href="/public/addEntries" class="badge badge-light m-1 p-2">Add Books </a>
		<a href="/public/addMultipleEntries" class="badge badge-light button-sd m-1 p-2">Add Multiple Books </a>
		<a href="/public/manageBooks" class="badge badge-light button-pm m-1 p-2">Refresh</a>
		<a href="/public/admin" class="badge badge-secondary m-1 p-2">Back to Dashboard</a>
	</div>
	@if(Session::has('message'))
		@if(session('alert'))
			<div class="alert alert-danger">{{ session('message') }}</div>
		@else
			<div class="alert alert-success">{{ session('message') }}</div>
		@endif
	@endif
	<div class="my-3 table-responsive">
		@if(count($books) > 0)
			<table class="table table-hover">
				<thead class="thead-light">
				  <tr>
					<th>Book Name</th>
					<th>Author</th>
					<th>Category</th>
					<th>Publisher</th>
					<th>Published Date</th>
					<th>Delete</th>
				  </tr>
				</thead>
				@foreach ($books as $book)
					<tr>
						<td>{{ $book->title }}</td>
						<td>{{ $book->author }}</td>
						<td>{{ $book->category }}</td>
						<td>{{ $book->publisher }}</td>
						<td>{{ $book->publishedDate }}</td>
						<td><a href="/public/deleteBook/{{ $book->id }}" class="text-danger"><i class="fa fa-trash" style="font-size:24px"></i></a></td>
					</tr>
				@endforeach
			</table>
		@else
			<div class="bg-light shadow-sm p-5">
				<h5 class="text-center">No Books in the Database</h5>
			</div>
		@endif
	</div>
</div>
@endsection
