@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Manage Authors</div>

                <div class="card-body">
					@if($insertBook)
                        <div class="alert alert-success" role="alert">
                            {{ $alert }}
                        </div>
                    @endif
					@if($deleteBook)
                        <div class="alert alert-success" role="alert">
                            {{ $alert }}
                        </div>
                    @endif
					<div class="text-center">
						<a href="/public/addEntries" class="btn btn-primary m-1 p-2">Add Books </a>
						<a href="/public/admin" class="btn btn-secondary m-1 p-2">Back to Dashboard</a>
					</div>
                    <div class="mt-1 text-center">
						@if(count($books) > 0)
							<p class="display-4">Users List</p>
							<table class="table table-hover">
								<thead>
								  <tr>
									<th>Book Name</th>
									<th>Description</th>
									<th>Author</th>
									<th>Rating</th>
									<th>Category</th>
									<th>Publisher</th>
									<th>Published Date</th>
									<th>Delete</th>
								  </tr>
								</thead>
								@foreach ($books as $book)
									<tr>
										<td>{{ $book->title }}</td>
										<td>{{ $book->description }}</td>
										<td>{{ $book->author }}</td>
										<td>{{ $book->rating }}</td>
										<td>{{ $book->category }}</td>
										<td>{{ $book->publisher }}</td>
										<td>{{ $book->publishedDate }}</td>
										<td><a href="/public/deleteBook" class="text-danger"><i class="fa fa-trash" style="font-size:24px"></i></a></td>
									</tr>
								@endforeach
							</table>
						@else
							<h3>No book in the database yet</h3>
						@endif
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
