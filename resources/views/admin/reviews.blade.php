@extends('layouts.default')

@section('content')
<div class="container-fluid">
	<h2>Manage Reviews</h2>
	<div class="container-fluid">
		<a href="/public/manageReviews" class="badge badge-light button-pm m-1 p-2">Refresh</a>
		<a href="/public/admin" class="badge badge-secondary m-1 p-2">Back to Dashboard</a>
	</div>
	@include('error.error')
	<div class="my-3 table-responsive">
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
			<div class="my-3 bg-light shadow-sm p-5">
				<h5 class="text-center">No Reviews in the database.</h5>
			</div>
		@endif
	</div>
</div>
@endsection
