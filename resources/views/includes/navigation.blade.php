<!-- 
"SOA: I Ronak Patel, 000744055 certify that this material is my original work. No other person's work has been used without due acknowledgement. 
			  I have not made my work available to anyone else."
 -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm fixed-top">
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
							<select id="searchCategory" class="form-control btn btn-dark">
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
				<li class="nav-item">
					<a href="/public/groupChat" class="nav-link">Group Chat</a>
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