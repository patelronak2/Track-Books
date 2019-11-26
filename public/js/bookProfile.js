/* This File contains JavaScript for bookProfile.blade.php
Created By: Ronak Patel */

$(document).ready(function(){
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	var book_id = $("#bookID").text();
	var noOfUser = $("#totalRatingByUser").text();
	var bookRating = $("#finalRating").text();
	var currentUserRating = $("#currentUserRating").text();
	
	//Coloring the stars to show book ratings
	for (var i = 1; i <= Math.round(bookRating); i++){
		var id1 = "#ratedStar" + i;
		$(id1).addClass("clicked");
		$("#totalRatings").html(noOfUser);
	}
	
	//coloring the stars to indicate the current user's rating for the book
	for (var i = 1; i <= Math.round(currentUserRating); i++){
		var id = "#rateStar" + i;
		$(id).addClass("clicked");
	}
	
	//Finding out what the user entered for his rating
	//Highlight those stars
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
				console.log("Attempt to rate the book Failed");
				console.log(error);
			}
		});
		
	});
	
	//This function update database to reflect the changes on shelf
	$("#bookShelf").change(function(){
		var bookShelf = $(this).children("option:selected").val();
		$.ajax({
			url: '/public/addToShelf',
			type: 'POST',
			data: {_token: CSRF_TOKEN, bookShelf: bookShelf, book_id: book_id},
			success: function(data){
				
				},
			error: function(error){
				console.log("Attempt to add the book to shelf failed");
				console.log(error);
			}
		});
	});
	
	//Add Reviews for the current Book
	$("#addReview").click(function(){			
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
	
	//Post Requests to delete reviews
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
				
				if(!(temphtml != '')){
					location.reload(true);
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