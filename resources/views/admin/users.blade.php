@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Manage Users</div>

                <div class="card-body">
					@if($insertUser)
                        <div class="alert alert-success" role="alert">
                            {{ $alert }} {{$name}}
							
                        </div>
                    @endif
					@if($deleteUser)
                        <div class="alert alert-info" role="alert">
                            {{ $alert }}
                        </div>
                    @endif
					@if($banUser)
                        <div class="alert alert-warning" role="alert">
                            {{ $alert }}
                        </div>
                    @endif
					<div class="text-center mt-1 p-2">
						<a href="/public/addEntries" class="btn btn-primary m-1 p-2">Add Users </a>
						<a href="/public/admin" class="btn btn-dark m-1 p-2">Back to Dashboard</a>
					</div>
                    <div class="mt-1 text-center">
						@if(count($users) > 0)
							<p class="display-4">Users List</p>
							<table class="table table-hover table-responsive">
								<thead>
								  <tr>
									<th>Name</th>
									<th>Email</th>
									<th>Account Type</th>
									<th>isBan</th>
									<th>Delete</th>
									<th>Ban</th>
								  </tr>
								</thead>
								<tbody>
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
									<td><a href="/public/banUser/{{ $user->id }}" class="text-warning"><i class="fa fa-ban" style="font-size:24px"></i></a></td>
								  </tr>								  
								
								@endforeach
							</tbody>
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
