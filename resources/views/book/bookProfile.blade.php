@extends('layouts.default')

@section('content')
<style>
	.checked{
		color: orange;
	}
	.clicked{
		color: #FF8C00;
	}
</style>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<div class="mb-3 shadow-sm p-2 bg-light">
			  <h3 class="text-center mb-3">{{ $book->title }}</h3>
			  <p class="sr-only" id="bookID">{{ $book->id }}</p>
			  <p class="sr-only" id="userID">{{ Auth::id() }}</p>
			  <div class="row no-gutters">
				<div class="col-md-4 px-2">
				  <img src="{{ $book->img_link }}" class="img-thumbnail" alt="Image not Available" width="100%">
				</div>
				<div class="col-md-8 p-2">
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
    </div>
</div>
<script>
$(document).ready(function(){
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	var book_id = $("#bookID").text();
	var noOfUser = $("#totalRatingByUser").text();
	var bookRating = $("#finalRating").text();
	var currentUserRating = $("#currentUserRating").text();
	
	for (var i = 1; i <= Math.round(bookRating); i++){
		var id1 = "#ratedStar" + i;
		$(id1).addClass("clicked");
		$("#totalRatings").html(noOfUser);
	}
	
	for (var i = 1; i <= Math.round(currentUserRating); i++){
		var id = "#rateStar" + i;
		$(id).addClass("clicked");
	}
	
	//Find out what current user entered for his rating
	
	$("#rateStar1, #rateStar2, #rateStar3, #rateStar4, #rateStar5").hover(function(){
		var val = $(this).attr("value");
		for (var i = 1; i <= val; i++){
			var id = "#rateStar" + i;
			$(id).addClass("checked");
		}
		
	},function(){
		var val = $(this).attr("value");
		for (var i = 1; i <= val; i++){
			var id = "#rateStar" + i;
			$(id).removeClass("checked");
		}
	});
	
	//Handles the rating of the Book by the user
	$("#rateStar1, #rateStar2, #rateStar3, #rateStar4, #rateStar5").click(function(){
		var val = $(this).attr("value");
		$("#rateStar1, #rateStar2, #rateStar3, #rateStar4, #rateStar5").removeClass("clicked");
		for (var i = 1; i <= val; i++){
			var id = "#rateStar" + i;
			$(id).addClass("clicked");
		}
		
		$.ajax({
			url: '/public/rateBook',
			type: 'POST',
			data: {_token: CSRF_TOKEN, book_id: book_id, rating: val},
			success: function(response){
				//Update the number of user that provided the rating and total rating of the book
				var data = JSON.parse(response);
				$("#totalRatings").html(data.totalRatings);
				var ratings = Math.round(data.finalRating);
				$("#ratedStar1, #ratedStar2, #ratedStar3, #ratedStar4, #ratedStar5").removeClass("clicked");
				for (var i = 1; i <= ratings; i++){
					var id = "#ratedStar" + i;
					$(id).addClass("clicked");
				}
			},
			error: function(error){
				alert("Attempt to rate the book Failed");
			}
		});
		
	});
	
	$("#bookShelf").change(function(){
		var bookShelf = $(this).children("option:selected").val();
		$.ajax({
			url: '/public/addToShelf',
			type: 'POST',
			data: {_token: CSRF_TOKEN, bookShelf: bookShelf, book_id: book_id},
			success: function(data){
				
				},
			error: function(error){
				alert("Attempt to add the book to shelf failed");
			}
		});
	});
	
	$("#addReview").click(function(){
		//post call here and insert review from here
		
		var id = $("#bookID").text();
		var review = $("#review").val();
		var userID = $("#userID").text();
		
		$.ajax({
			url: '/public/addReview',
			type: 'POST',
			data: {_token: CSRF_TOKEN, review: review, id: id},
			success: function(response){
				
				var res = JSON.parse(response);
				//Print all the comments here
				var temphtml = '';
				for(var i = 0; i < res.data.length; i++){
					temphtml += '<div class="bg-light shadow-sm p-2 m-2 row">';
					temphtml += '<div class="col-10"><h6>' + res.data[i].user.name + '</h6><p>' + res.data[i].review + '</p></div>';
					temphtml += '<div class="col-2 text-right my-auto">';
					if(res.userType == 'admin' || res.userId == res.data[i].user_id){
						temphtml += '<a href="#" class="text-danger" id="' + res.data[i].id + '"><i class="fa fa-trash" style="font-size:24px"></i></a>';
					}
					
					temphtml += '</div></div>';
				}
				
				$("#reviews").html(temphtml);	
			},
			error: function(error){
			}
		});
		$("#review").val("");
		return false;
	});
	$("#reviews").on("click","a",function(){
		var review_id = $(this).attr("id");
		$.ajax({
			url: '/public/deleteReview',
			type: 'POST',
			data: {_token: CSRF_TOKEN, review_id: review_id, book_id: book_id},
			success: function(response){
				var res = JSON.parse(response);
				//Print all the comments here
				var temphtml = '';
				for(var i = 0; i < res.data.length; i++){
					temphtml += '<div class="bg-light shadow-sm p-2 m-2 row">';
					temphtml += '<div class="col-10"><h6>' + res.data[i].user.name + '</h6><p>' + res.data[i].review + '</p></div>';
					temphtml += '<div class="col-2 text-right my-auto">';
					if(res.userType == 'admin' || res.userId == res.data[i].user_id){
						temphtml += '<a href="#" class="text-danger" id="' + res.data[i].id + '"><i class="fa fa-trash" style="font-size:24px"></i></a>';
					}
					
					temphtml += '</div></div>';
				}
				
				$("#reviews").html(temphtml);	
			},
			error: function(error){
				alert("Something went wrong");
			}
		});
		return false;
	});
});
</script>
@endsection
