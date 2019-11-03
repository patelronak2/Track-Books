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
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
	
	<style type="text/css">
		#navSearchResults{
			position: absolute; 
			top: 50px; 
			width: auto; 
			height: auto;
			margin-right: 15px;
		}
		
		@media only screen and (max-width: 768px){
			#navSearchResults{
				position: absolute; 
				top: 100px; 
				width: auto; 
				height: auto; 
				z-index: 1;
				margin-right: 15px;
			}
		}
	</style>
	
	<script>
		$(document).ready(function(){
			var searchBy = "Books";
			var searchResult = "";
			$("#navSubmit").click(function(){
				return false;
			});
			
  
			$("#navSearch").keyup(function(){
				
				switch(searchBy) {
				  case "User":
						var temphtml = '<div class="list-group">';
						temphtml += '<a class="list-group-item" href="">SearchBy UserSearchBy UserSearchBy User</a>';
						temphtml += '</div>';
						$("#navSearchResults").html(temphtml).removeClass("d-none");
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
								var temphtml = '<div class="list-group">';
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
			$('.list-group').on('click', 'a', function() {
				
				var i = parseInt($(this).find('#index').text());
				$('#bookTitle').html(searchResult.items[i].volumeInfo.title);
				$('#bookModal').modal('show');
				
				
			});
				
			//Remove the search results
			$(document).mouseup(function(event){ 
				var container = $("#navSearchResults");
				var container1 = $("#bookModal");
				// if the target of the click isn't the container nor a descendant of the container
				if (!container.is(event.target) && container.has(event.target).length === 0 && !container1.is(event.target) && container1.has(event.target).length === 0) 
				{
					container.addClass("d-none");
					container.val("")
					$("#navSearch").val("");
				}
			});
			
			$("#searchCategory").change(function(){
				searchBy = $(this).children("option:selected").val();
			});
			
		});
	</script>								
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow fixed-top">
            <div class="container">
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
							<a id="notifications" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								<span class="badge badge-danger ml-2">4</span>Notifications
							</a>

							<div class="dropdown-menu dropdown-menu-right animate slideIn" aria-labelledby="notifications">
								<a class="dropdown-item" href="#">No Notifications Yet</a>
							</div>
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
				Image on left and Author Name Description on right
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">More Info</button>
			  </div>
			</div>
		  </div>
		</div>
        <main class="py-4" style="margin-top: 80px;">
            @yield('content')
        </main>
		<div class="footer-copyright text-center py-4">© 2018 Copyright:
			<a href="https://ronakjpatel.com"> ronakjpatel.com</a>
		</div>
    </div>
</body>
</html>
