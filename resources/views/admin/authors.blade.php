@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h4 class="card-header">Manage Authors</h4>

                <div class="card-body">
					<div class="text-center">
						<a href="/public/addEntries" class="btn btn-primary m-1 p-2">Add Authors</a>
						<a href="/public/admin" class="btn btn-dark m-1 p-2">Back to Dashboard</a>
					</div>
                    <div class="mt-5 text-center"><h3>No Author in the database yet</h3></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
