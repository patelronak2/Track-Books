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
	<style>
      body {
		  font-size: .875rem;
		}

		.feather {
		  width: 16px;
		  height: 16px;
		  vertical-align: text-bottom;
		}

		/*
		 * Sidebar
		 */

		.sidebar {
		  position: fixed;
		  top: 0;
		  bottom: 0;
		  left: 0;
		  z-index: 100; /* Behind the navbar */
		  padding: 48px 0 0; /* Height of navbar */
		  box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
		}

		.sidebar-sticky {
		  position: relative;
		  top: 0;
		  height: calc(100vh - 48px);
		  padding-top: .5rem;
		  overflow-x: hidden;
		  overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
		}

		@supports ((position: -webkit-sticky) or (position: sticky)) {
		  .sidebar-sticky {
			position: -webkit-sticky;
			position: sticky;
		  }
		}

		.sidebar .nav-link {
		  font-weight: 500;
		  color: #333;
		}

		.sidebar .nav-link .feather {
		  margin-right: 4px;
		  color: #999;
		}

		.sidebar .nav-link.active {
		  color: #007bff;
		}

		.sidebar .nav-link:hover .feather,
		.sidebar .nav-link.active .feather {
		  color: inherit;
		}

		.sidebar-heading {
		  font-size: .75rem;
		  text-transform: uppercase;
		}

    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
               
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <ul class="navbar-nav ml-auto">
						<li class="nav-item dropdown">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								{{ Auth::user()->name }} <span class="caret"></span>
							</a>

							<div class="dropdown-menu dropdown-menu-right animate slideIn" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="/public">Home</a>
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
		<div class="container-fluid">
			<div class="row">
				<nav class="col-md-2 d-none d-md-block bg-light sidebar">
				  <div class="sidebar-sticky">
					<ul class="nav flex-column">
					  <li class="nav-item">
						<a class="nav-link active" href="#">Dashboard</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" href="#">	  
						  Users
						</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" href="#">
						  Books
						</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" href="#">
						  Authors
						</a>
					  </li>
					</ul>					
				  </div>
				</nav>
				<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
				@yield('content')
				</main>
			</div>
		</div>

		<div class="footer-copyright text-center py-3">© 2018 Copyright:
			<a href="#"> ronakjpatel.com</a>
		</div>
    </div>
</body>
</html>
