@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Manage Users</div>

                <div class="card-body">
					<div class="text-center mt-1 p-2">
						<a href="#" class="btn btn-primary">Add Users</a>
					</div>
                    <div class="mt-5 text-center"><h3>No User in the database yet</h3></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
