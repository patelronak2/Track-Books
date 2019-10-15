@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Manage Authors</div>

                <div class="card-body">
					<div class="text-center">
						<a href="/public/addEntries" class="btn btn-primary m-1 p-2">Add Books </a>
						<a href="/public/admin" class="btn btn-secondary m-1 p-2">Back to Dashboard</a>
					</div>
                    <div class="mt-5 text-center"><h3>No book in the database yet</h3></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
