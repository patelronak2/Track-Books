@extends('layouts.default')

@section('content')
<div class="container-fluid">
	<h2 class="text-center mb-3">{{ $book->title }}</h2>
			<div class="mb-3 shadow-sm p-2 bg-light">
			  <p class="sr-only" id="bookID">{{ $book->id }}</p>
			  <p class="sr-only" id="userID">{{ Auth::id() }}</p>
			  <div class="row no-gutters">
				<div class="col-md-3 px-2">
				  <img src="{{ $book->img_link }}" class="img-thumbnail" alt="Image not Available" width="100%">
				</div>
				<div class="col-md-9 p-2">
					<div>
						<span class="sr-only" id="totalRatingByUser">{{ $totalRatings }}</span>
						<span class="sr-only" id="finalRating">{{ $finalRating }}</span>
						<span class="sr-only" id="currentUserRating">{{ $currentUserRating }}</span>
						<span class="fa fa-star" id="ratedStar1"></span>
						<span class="fa fa-star" id="ratedStar2"></span>
						<span class="fa fa-star" id="ratedStar3"></span>
						<span class="fa fa-star" id="ratedStar4"></span>
						<span class="fa fa-star" id="ratedStar5"></span>
						<small><span id="totalRatings">0</span> Users</small>
					</div>
					@if($author)
						<h5>Author: {{ $book->author }}</h5>
					@else
						<h5 class="text-danger">Author: Information not Available</h5>
					@endif
					@if($category)
						<h6 class="text-secondary">Category: {{ $book->category }}</h6>
					@endif	
					@if($description)
						<p>{{ $book->description }}</p>
					@endif
					@if($publisher)
						<p>Publisher: {{ $book->publisher }}</p>
					@endif
					@if($publishedDate)
						<p>Published: {{ $book->publishedDate }}</p>
					@endif
					@if($wantToRead)
						<select id="bookShelf" class="btn btn-outline-primary">
							<option disabled hidden>Add to Shelf</option>
							<option selected>Want to Read</option>
							<option>Currently Reading</option>
							<option>Finished Reading</option>
						</select>
					@elseif($currentlyReading)
						<select id="bookShelf" class="btn btn-outline-primary">
							<option disabled hidden>Add to Shelf</option>
							<option>Want to Read</option>
							<option selected>Currently Reading</option>
							<option>Finished Reading</option>
						</select>
					@elseif($finishedReading)
						<select id="bookShelf" class="btn btn-outline-primary">
							<option disabled hidden>Add to Shelf</option>
							<option>Want to Read</option>
							<option>Currently Reading</option>
							<option selected>Finished Reading</option>
						</select>
					@else
						<select id="bookShelf" class="btn btn-outline-primary">
							<option selected disabled hidden>Add to Shelf</option>
							<option>Want to Read</option>
							<option>Currently Reading</option>
							<option>Finished Reading</option>
						</select>
					@endif
					
				</div>
			  </div>
			</div>
			<div class="mb-3">
				<div class="my-3">
					<h5>Rate this Book: 
						<span class="fa fa-star" id="rateStar1" value="1"></span>
						<span class="fa fa-star" id="rateStar2" value="2"></span>
						<span class="fa fa-star" id="rateStar3" value="3"></span>
						<span class="fa fa-star" id="rateStar4" value="4"></span>
						<span class="fa fa-star" id="rateStar5" value="5"></span>
					</h5>
				</div>
				<div class="form-group">
				  <label for="comment">Write a Review:</label>
				  <textarea class="form-control" rows="5" id="review"></textarea>
				</div>
				<button class="btn btn-primary" id="addReview">Add Review</button>
			</div>
			<div class="mb-3" id="reviews">
				@if(count($reviews) > 0)
					@foreach ($reviews as $review)
						<div class="bg-light shadow-sm p-2 m-2 row">
							<div class="col-10">
								<h6>{{ $review->user->name }}</h6>
								<p>{{  $review->review}}</p>
							</div>
							<div class="col-2 text-right my-auto">
								@if(Auth::id() == $review->user_id || Auth::user()->type == 'admin')
									<a href="#" class="text-danger" id="{{ $review->id }}"><i class="fa fa-trash" style="font-size:24px"></i></a>
								@endif
							</div>
						</div>
					@endforeach
				@else
					<div class="bg-light shadow-sm p-5">
						<h5 class="text-center">Be the first to add a review for this book.</h5>
					</div>
				@endif
			</div>
        
</div>
<script type="text/javascript" src="{{ asset('js/bookProfile.js') }}"></script>
@endsection
