@extends('layouts.default')

@section('content')
<div class="container-fluid">
	<h2>Manage Authors</h2>
	<div class="container-fluid">
		<a href="/public/addEntries" class="badge badge-light m-1 p-2">Add Author</a>
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
		@if(count($authors) > 0)
			<table class="table table-hover">
				<thead class="thead-light">
				  <tr>
					<th>Author Name</th>
					<th>Delete</th>
				  </tr>
				</thead>
				@foreach ($authors as $author)
					<tr>
						<td>{{ $author->name }}</td>
						<td><a href="/public/deleteAuthor/{{ $author->id }}" class="text-danger"><i class="fa fa-trash" style="font-size:24px"></i></a></td>
					</tr>
				@endforeach
			</table>
		@else
			<div class="my-3 bg-light shadow-sm p-5">
				<h5 class="text-center">No Authors in the database.</h5>
			</div>
		@endif
	</div>
</div>
@endsection
