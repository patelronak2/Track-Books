@extends('layouts.default')

@section('content')
<div class="container">
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
					<select id="bookShelf" class="btn btn-outline-primary">
						<option selected disabled hidden>Add to Shelf</option>
						<option>Want to Read</option>
						<option>Currently Reading</option>
						<option>Finished Reading</option>
					</select>
				</div>
			  </div>
			</div>
			<div class="mb-3">
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
					<div class="bg-light shadow-sm p-2">
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
	$("#bookShelf").change(function(){
		var bookShelf = $(this).children("option:selected").val();
		$.ajax({
			url: '/public/addToShelf',
			type: 'POST',
			data: {_token: CSRF_TOKEN, bookShelf: bookShelf, book_id: book_id},
			success: function(data){
				alert(data);
			}
			error: function(){
				alert("Unexpected error");
			}
		});
		// switch(bookShelf){
			// case "Want to Read":
				// break;
			// case "Currently Reading":
				// break;
			// case "Finished Reading":
				// break;
		// }
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
