@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Manage Users</div>

                <div class="card-body">
					<div class="text-center mt-1 p-2">
						<a href="/public/addEntries" class="btn btn-primary m-1 p-2">Add Users </a>
						<a href="/public/admin" class="btn btn-secondary m-1 p-2">Back to Dashboard</a>
					</div>
                    <div class="mt-5 text-center">
						@if(users)
							@foreach ($users as $user)
								<p>This is user {{ $user->name }}</p>
							@endforeach
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
