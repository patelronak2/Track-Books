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
	<script>
		$(document).ready(function(){
			$("#submit").click(function(){
				$("#search").val("")
				
				return false;
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
								<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="search">
								<button class="sr-only" id="submit" type="submit">Search</button>
							</form>
						</li>
						<!--<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" id="notifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							  <span class="badge badge-danger ml-l">4</span>
							  <i class="fas fa-bell" style="font-size: 20px"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary" aria-labelledby="notifications">
							  <a class="dropdown-item" href="#">No Notifications yet</a>
							</div>
						</li> -->
						
						<li class="nav-item dropdown">
							<a id="notifications" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								<i class="fas fa-bell" style="font-size: 20px"></i>
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

        <main class="py-4" style="margin-top: 80px;">
            @yield('content')
        </main>
		<div class="footer-copyright text-center py-4">© 2018 Copyright:
			<a href="https://ronakjpatel.com"> ronakjpatel.com</a>
		</div>
    </div>
</body>
</html>
