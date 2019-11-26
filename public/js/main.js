/* Main JavaScript file that will be loaded on all pages
Created By: Ronak Patel, #000744055 */


$(document).ready(function(){
	var searchBy = "Books";
	var searchResult = "";
	var clickedId = -1;
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	getNotificationCount();
	
	$("#navSubmit").click(function(){
		return false;
	});
	
	//Display Search Results based on the searchBy term
	$("#navSearch").keyup(function(){
		switch(searchBy) {
		  case "User":
				var searchTerm = $("#navSearch").val().toLowerCase().trim();
				$.ajax({
					url: '/public/getUserList',
					type: 'GET',
					success: function(data){
						var searchResult = JSON.parse(data);
						var temphtml = "";
						var flag = false;
						for(var i = 0; i < 5 && i < searchResult.length; i++){
							if(searchTerm != "" && searchResult[i]['name'].toLowerCase().indexOf(searchTerm) !== -1){
								flag = true;
								temphtml += '<a class="list-group-item list-group-item-action flex-column align-items-start" href="/public/showProfile/'+ searchResult[i]['id'] +'">';
								temphtml += '<div class="d-flex w-100 justify-content-between">';
								temphtml += '<h5 class="mb-1">' + searchResult[i]['name'] + '</h5></div>';
								temphtml += '</a>';
							}
						}
						if(!flag && searchTerm != ""){
							
							temphtml += '<p class="list-group-item">No User Found</p>';
							$("#navSearchResults").html(temphtml).removeClass("d-none");
						}else{
							$("#navSearchResults").html(temphtml).removeClass("d-none");
						}
					},
					error: function(error){
						alert("cannot get User List");
					}
				});
				//-----------------------------------------------------------------------------------------------------
			break;
		  case "Author":
				var searchURL = "https://www.googleapis.com/books/v1/volumes?q=" + $("#navSearch").val() + "+inauthor:"+ $("#navSearch").val();
				getBooksFromGoogleAPI(encodeURI(searchURL));
			break;
		  default:	
				var searchURL = "https://www.googleapis.com/books/v1/volumes?q=" + $("#navSearch").val();
				getBooksFromGoogleAPI(encodeURI(searchURL));
		}
		
	});
	
	//Enter information in modal and show it
	$('#navSearchResults').on('click', 'a', function() {
		switch(searchBy){
			case "User":
				//No need to handle the click here
				//The a tag contains the link where the user will be directed 
				break;
			default:
				clickedId = parseInt($(this).find('#index').text());
				$('#bookTitle').html(searchResult.items[clickedId].volumeInfo.title);
				$('#modalBookID').html(clickedId);
				var img_Link = "";
				if(searchResult.items[clickedId].volumeInfo.hasOwnProperty('imageLinks')){
					img_Link = searchResult.items[clickedId].volumeInfo.imageLinks.smallThumbnail;
				}
				var author = "";
				if(searchResult.items[clickedId].volumeInfo.hasOwnProperty('authors')){
					author = 'Author: ' +  searchResult.items[clickedId].volumeInfo.authors[0];
				}else{
					author = 'Author name not available';
				}
				var publisher = "";
				if(searchResult.items[clickedId].volumeInfo.hasOwnProperty('publisher')){
					publisher = 'Publisher: ' + searchResult.items[clickedId].volumeInfo.publisher;
				}else{
					publisher = 'Publisher Information Not Available';
				}
				var publishedDate = ""
				if(searchResult.items[clickedId].volumeInfo.hasOwnProperty('publishedDate')){
					publishedDate = 'Published Date: ' + searchResult.items[clickedId].volumeInfo.publishedDate;
				}else{
					publishedDate = "Published Date not Available"
				}
				var temphtml = '<img src="'+ img_Link +'" class="card-img" alt="Image Not Available">';
				$('#modalImage').html(temphtml);
				$('#modalAuthorName').html(author);
				$('#modalBookPublisher').html(publisher);
				$('#modalBookPublishedDate').html(publishedDate);
				$('#bookModal').modal('show');
				
				
		}
		
	});
	

	$("#modalMoreInfo").click(function(){
			//hiding search results and clearing the form
			var container = $("#navSearchResults");
			container.addClass("d-none");
			container.val("")
			$("#navSearch").val("");

			var title = searchResult.items[clickedId].volumeInfo.title;
			var description = "";
			var author = "";
			var category = "";
			var publisher = "";
			var publishedDate = "";
			var imgLink = "";
			if(searchResult.items[clickedId].volumeInfo.hasOwnProperty('description')){
			description = searchResult.items[clickedId].volumeInfo.description;
			}else{
				description = "Information not Available"	
			}
			if(searchResult.items[clickedId].volumeInfo.hasOwnProperty('authors')){
				author = searchResult.items[clickedId].volumeInfo.authors[0];
			}else{
				author = "Information not Available"
			}
			if(searchResult.items[clickedId].volumeInfo.hasOwnProperty('categories')){
				category = searchResult.items[clickedId].volumeInfo.categories[0];
			}else{
				category = "Information not Available"
			}
			if(searchResult.items[clickedId].volumeInfo.hasOwnProperty('publisher')){
				publisher = searchResult.items[clickedId].volumeInfo.publisher;
			}else{
				publisher = "Information not Available"
			}
			if(searchResult.items[clickedId].volumeInfo.hasOwnProperty('publishedDate')){
				publishedDate = searchResult.items[clickedId].volumeInfo.publishedDate;
			}else{
				publishedDate = "Information not Available"
			}
			if(searchResult.items[clickedId].volumeInfo.hasOwnProperty('imageLinks')){
				imgLink = searchResult.items[clickedId].volumeInfo.imageLinks.smallThumbnail;
			}
			$.ajax({
				url: '/public/searchInsert',
				type: 'POST',
				data: {_token: CSRF_TOKEN, title: title, description: description, author: author, category: category, publisher: publisher, publishedDate: publishedDate, imgLink: imgLink},
				success: function(data){
					location.href = "/public/showBook/" + data;							
				},
				error: function(error){
					
				}
			});
			
			$('#bookModal').modal('hide');
	});
		
	//Remove the search results
	$(document).mouseup(function(event){ 
		var container = $("#navSearchResults, #allNotifications");
		var container1 = $("#bookModal");
		// if the target of the click isn't the container nor a descendant of the container
		if (!container.is(event.target) && container.has(event.target).length === 0 && !container1.is(event.target) && container1.has(event.target).length === 0) 
		{
			container.addClass("d-none");
			$("#navSearchResults").val("")
			$("#navSearch").val("");
			
		}
	});
	
	$("#searchCategory").change(function(){
		searchBy = $(this).children("option:selected").val();
	});
	
	//Display all Notifications
	$("#notifications").on('click', function(){			
		//get all notifications from here
		//ajax call to get unread notifications
		$.ajax({
			url: '/public/getNotification',
			type: 'GET',
			success: function(response){
				if(response.timeStamp.length < 1){
					var temphtml = '<div class="text-center m-2 p-2"><h5>No Notifications Yet</h5></div>';
					$("#allNotifications").html(temphtml);
				}else{
					var temphtml = '<div class="overflow-auto" style="width: 360px; max-height: 400px;">';							
					for(var i = 0; i < response.timeStamp.length; i++){
						temphtml  += '<div class="card mb-1"><div class="card-body">';
						if(response.notification[i].type == "App\\Notifications\\ShelfUpdated"){
							//User is notified about change made to the book shelf
							temphtml += '<h5 class="card-title">'+ response.notification[i].data.book_name +'</h5>';
							temphtml += '<p class="card-text">'+ response.notification[i].data.shelf +'</p>';
							temphtml += '<p class="card-text"><small class="text-muted">'+ response.timeStamp[i] +'</small></p>';
							temphtml += '<a href="/public/profile" class="stretched-link"></a>';
						}
						if(response.notification[i].type == "App\\Notifications\\FriendRequestSent"){
							//User is notified about the friend request
							temphtml += '<h5 class="card-title">New Friend Request</h5>';
							temphtml += '<p class="card-text">'+ response.notification[i].data.sender_name +' wants to be your friend.</p>';
							temphtml += '<p class="card-text"><small class="text-muted">'+ response.timeStamp[i] +'</small></p>';
							temphtml += '<a href="/public/showProfile/'+ response.notification[i].data.sender_id +'" class="stretched-link"></a>';
						}
						if(response.notification[i].type == "App\\Notifications\\FriendRequestAccepted"){
							temphtml += '<h5 class="card-title text-success">Friend Request Accepted</h5>';
							temphtml += '<p class="card-text">'+ response.notification[i].data.accepting_user_name +' accepted your friend request.</p>';
							temphtml += '<p class="card-text"><small class="text-muted">'+ response.timeStamp[i] +'</small></p>';
							temphtml += '<a href="/public/showProfile/'+ response.notification[i].data.accepting_user_id +'" class="stretched-link"></a>';
						}
						temphtml += '</div></div>';
					}
					temphtml += '</div>';
					$("#allNotifications").html(temphtml);
				}
				
				},
			error: function(){
				alert("Cannot get the notifications. Try logging in again");
				}
		});
		$("#allNotifications").removeClass("d-none");
	});
	
	//Ajax call to Google Api
	function getBooksFromGoogleAPI(searchURL){
	$.ajax({
		url: searchURL,
		success: function(data){
			var temphtml = '';
			searchResult = data;
			for(var i = 0; i < 5 && i < data['totalItems']; i++){
				var title = data.items[i].volumeInfo.title;
				var author = "";
				if(data.items[i].volumeInfo.hasOwnProperty('authors')){
					author = 'By: ' +  data.items[i].volumeInfo.authors[0];
				}
				temphtml += '<a class="list-group-item list-group-item-action flex-column align-items-start" href="#">';
				temphtml += '<div class="d-flex w-100 justify-content-between">';
				temphtml += '<h5 class="mb-1">' + title + '</h5></div>';
				temphtml += '<p class="mb-1">' + author + '</p>';
				temphtml += '<p class="sr-only" id="index">' + i + '</p>';
				temphtml += '</a>';
			}
			$("#navSearchResults").html(temphtml).removeClass("d-none");
		}
	});
}
});


//keep checking for new notifications constantly
function getNotificationCount() {
  setInterval(function(){ 
	//alert("Checked for notification");
	$.ajax({
		url: '/public/count',
		type: 'GET',
		success: function(data){
			if(data.count > 0){
				$("#unreadNotifications").removeClass("d-none").html(data.count);
			}else{
				$("#unreadNotifications").removeClass("d-none").html("")
			}
			},
		error: function(error){
				console.log(error);
				console.log("Couldn't Get Notifications");
			}
	});
  }, 1000);
}