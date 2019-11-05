@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <h4 class="card-header">Manage Reviews</h4>
				<div class="card-body">
				@if($deleteReview)
					<div class="alert alert-success" role="alert">
						{{ $alert }}
					</div>
				@endif
                <div class="text-center">
					<a href="/public/admin" class="btn btn-dark m-1 p-2">Back to Dashboard</a>
				</div>
				<div class="mt-1 text-center table-responsive">
					@if(count($reviews) > 0)
						<table class="table table-hover">
							<thead class="thead-light">
							  <tr>
								<th>Book Name</th>
								<th>User Name</th>
								<th>Review</th>
								<th>Delete</th>
							  </tr>
							</thead>
							@foreach ($reviews as $review)
								<tr>
									<td>{{ $review->book->title }}</td>
									<td>{{ $review->user->name }}</td>
									<td>{{ $review->review }}</td>
									<td><a href="/public/deleteReview/{{ $review->id }}" class="text-danger"><i class="fa fa-trash" style="font-size:24px"></i></a></td>
								</tr>
							@endforeach
						</table>
					@else
						<h3>No Reviews in the database yet</h3>
					@endif
				</div>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
