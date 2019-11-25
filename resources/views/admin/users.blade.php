@extends('layouts.default')

@section('content')
<div class="container-fluid">
	<h2>Manage Users</h2>
	<div class="container-fluid">
		<a href="/public/addEntries" class="badge badge-light m-1 p-2">Add Users </a>
		<a href="/public/manageUsers" class="badge badge-light button-pm m-1 p-2">Refresh</a>
		<a href="/public/admin" class="badge badge-secondary m-1 p-2">Back to Dashboard</a>
	</div>
	@if(Session::has('message'))
		@if(session('alert'))
			<div class="alert alert-danger">{{ session('message') }}</div>
		@else
			<div class="alert alert-success">{{ session('message') }}</div>
		@endif
	@endif					
	<div class="my-3 table-responsive">
		@if(count($users) > 0)
			<table class="table table-hover">
				<thead class="thead-light">
				  <tr>
					<th>Name</th>
					<th>Email</th>
					<th>Account Type</th>
					<th>isBan</th>
					<th>Delete</th>
					<th>Ban</th>
				  </tr>
				</thead>
				@foreach ($users as $user)
				  <tr>
					<td>{{ $user->name }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->type }}</td>
					<td>
						@if($user->isBan)
							yes
						@else
							No
						@endif
					</td>
					<td>
						<a href="/public/deleteUser/{{ $user->id }}" class="text-danger"><i class="fa fa-trash" style="font-size:24px"></i></a>
					</td>
					<td>
						<a href="/public/banUser/{{ $user->id }}" class="text-warning"><i class="fa fa-ban" style="font-size:24px"></i></a>
					</td>
				  </tr>								  
				@endforeach
			</table>
		@else
			<div class="bg-light shadow-sm p-5">
				<h5 class="text-center">No Users in the Database</h5>
			</div>
		@endif
		
	</div>
              
</div>
@endsection
