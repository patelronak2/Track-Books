@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <h4 class="card-header">Manage Users</h4>
				
                <div class="card-body">
					@if(Session::has('message'))
						@if(session('alert'))
							<div class="alert alert-danger">{{ session('message') }}</div>
						@else
							<div class="alert alert-success">{{ session('message') }}</div>
						@endif
					@endif
					<div class="text-center">
						<a href="/public/addEntries" class="btn btn-primary m-1 p-2">Add Users </a>
						<a href="/public/manageUsers" class="btn btn-outline-primary m-1 p-2">Refresh</a>
						<a href="/public/admin" class="btn btn-dark m-1 p-2">Back to Dashboard</a>
					</div>
                    <div class="mt-1 text-center table-responsive">
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
							<h3>No User in the database yet</h3>
						@endif
						
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
