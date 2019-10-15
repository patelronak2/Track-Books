@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Manage Authors</div>

                <div class="card-body">
					<div class="text-center">
						<a href="/public/addEntries" class="btn btn-primary m-1 p-2">Add Books </a>
						<a href="/public/admin" class="btn btn-secondary m-1 p-2">Back to Dashboard</a>
					</div>
                    <div class="mt-5 text-center">
						@if($books)
							<table class="table table-hover">
								<thead>
								  <tr>
									<th>Book Name</th>
									<th>Author Name</th>
									<th>Category</th>
									<th>Delete</th>
								  </tr>
								</thead>
								@foreach ($books as $book)
									<tr>
										<td>{{ $book->book_name }}</td>
										<td>{{ $book->author_name }}</td>
										<td>{{ $user->category }}</td>
										<td><a href="" class="text-danger"><i class="fa fa-trash-o" style="font-size:24px"></i></a></td>
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
