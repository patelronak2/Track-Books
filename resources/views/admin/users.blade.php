@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Manage Users</div>

                <div class="card-body">
					<div class="text-center mt-1 p-2">
						<a href="/public/addEntries" class="btn btn-primary m-1 p-2">Add Users </a>
						<a href="/public/admin" class="btn btn-secondary m-1 p-2">Back to Dashboard</a>
					</div>
                    <div class="mt-5 text-center">
						@if($users)
							<table class="table table-hover">
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
									<td></td>
									<td><a href="" class="text-danger"><i class="fa fa-remove" style="font-size:24px"></i></a></td>
									<td><a href="" class="text-warning"><i class="fa fa-ban" style="font-size:24px"></i></a></td>
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
