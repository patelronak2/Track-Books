<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
	
	<!-- Icons -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
		
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<style type="text/css">
		h2, h1{
			color: #756446;
		}
		h4, h5{
			color: #6A6F75;
		}
		h3{
			color: #292621;
		}
		
		h1,h2,h3,h4,h5{
			font-family: 'Roboto', sans-serif;
		}
		
		.button{
			background-color: #6A6F75;
			color: white;
		}
		
		.button-pm{
			background-color: #756446;
			color: white
		}
		.button-sd{
			background-color: #E7E89F;
			color: white;
		}
		
		p{
			font-family: 'Roboto', sans-serif;
			font-size: 16px;
		}
		::-webkit-scrollbar {
			  width: 5px;
			  height: 5px;
			}

			::-webkit-scrollbar-track {
			  box-shadow: inset 0 0 2px grey; 
			  border-radius: 5px;
			}
			 
			::-webkit-scrollbar-thumb {
			  background: #756446; 
			  border-radius: 10px;
			}
		#navSearchResults{
			position: absolute; 
			top: 50px; 
			min-width: 300px; 
			height: auto;
			margin-right: 15px;
		}
		
		#allNotifications{
			position: absolute; 
			top: 50px;
			width: auto; 
			height: auto;
			margin-right: 15px;
		}
		
		@media only screen and (max-width: 768px){
			#navSearchResults, #allNotifications{
				position: absolute; 
				top: 100px; 
				width: auto; 
				height: auto; 
				z-index: 1;
				margin-right: 15px;
			}
			#allNotifications{
				z-index: 1;
				top: auto;
			}
		}
	</style>
	
	<script>
		$(document).ready(function(){
			var searchBy = "Books";
			var searchResult = "";
			var clickedId = -1;
			var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			getNotificationCount();
			
			$("#navSubmit").click(function(){
				return false;
			});
			
  
			$("#navSearch").keyup(function(){
				
				switch(searchBy) {
				  case "User":
						//-------------------------------------------------------------------------------------------------
						//Ajax Call 
						//Get all the users in the database and print 5 names that have accountVisiblity set to public
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
						var temphtml = '';
						temphtml += '<a class="list-group-item" href="">SearchBy Author</a>';
						temphtml += '</div>';
						$("#navSearchResults").html(temphtml).removeClass("d-none");
					break;
				  default:	
						var searchURL = "https://www.googleapis.com/books/v1/volumes?q=" + $("#navSearch").val();
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
			
			//Enter information in modal and show it
			$('#navSearchResults').on('click', 'a', function() {
				switch(searchBy){
					case "User":
						//No need to handle the click here
						//The a tag contains the link where the user will be directed 
						break;
					case "Author":
					
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
					var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
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
		});
		
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
				error: function(){
					}
			});
		  }, 3000);
		}
	</script>								
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
			
                <div class="collapse navbar-collapse" id="navbarSupportedContent">            
                    <ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<form class="form-inline my-2 my-md-0">
								<div class="input-group">
								  <div class="input-group-prepend">
									<select id="searchCategory" class="form-control btn btn-outline-secondary">
										<option>Books</option>
										<option>User</option>
										<option>Author</option>
									</select>
								  </div>
								  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="navSearch">
								  <button class="sr-only" id="navSubmit" type="submit">Search</button>
								</div>
							</form>
							<div id="navSearchResults" class="d-none list-group">
							</div>
						</li>
						
						<li class="nav-item dropdown">
							<a id="notifications" class="nav-link" href="#" >
								<span class="badge badge-danger badge-pill ml-2 d-none" id="unreadNotifications"></span>Notifications
							</a>

							<div class="d-none bg-white shadow-sm" id="allNotifications">								
							</div>
						</li>
						<li class="nav-item">
							<a href="/public/friendList" class="nav-link">Friend List</a>
						</li>
						
                    </ul>
					
                    <ul class="navbar-nav ml-auto">
						
						
						<li class="nav-item dropdown">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								{{ Auth::user()->name }} <span class="caret"></span>
							</a>

							<div class="dropdown-menu dropdown-menu-right animate slideIn" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="{{ url('/home') }}">Home</a>
								@if (Auth::user()->type == 'admin')
									<a class="dropdown-item" href="/public/admin">Admin Dashboard</a>
								@endif
								<a class="dropdown-item" href="/public/profile">Profile</a>
								<a class="dropdown-item" href="/public/setting">Account Settings</a>
								<a class="dropdown-item" href="{{ route('logout') }}"
								   onclick="event.preventDefault();
												 document.getElementById('logout-form').submit();">
									{{ __('Logout') }}
								</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
							</div>
						</li>
                        
                    </ul>
                </div>
            </div>
        </nav>
		<!-- Modal to show Book Details -->
		<div class="modal fade" id="bookModal" tabindex="-1" role="dialog" aria-labelledby="bookTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-scrollable" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="bookTitle"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				<div class="card mb-3" style="max-width: 540px;">
				  <div class="row no-gutters">
					<div class="col-md-4" id="modalImage">	
					  
					</div>
					<div class="col-md-8">
					  <div class="card-body" >
						 <h5 class="card-title" id="modalAuthorName"></h5>
						 <p class="card-text" id="modalBookPublisher"></p>
						 <p class="card-text" id="modalBookPublishedDate"></p>
						 <p class="sr-only" id="modalBookID"></p>
					  </div>
					</div>
				  </div>
				</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="modalMoreInfo">More Info</button>
			  </div>
			</div>
		  </div>
		</div>
        <main class="py-4" style="margin-top: 80px;">
            @yield('content')
        </main>
		<div class="footer-copyright text-center p-4">© 2018 Copyright:
			<a href="https://ronakjpatel.com"> ronakjpatel.com</a>
		</div>
    </div>
</body>
</html>