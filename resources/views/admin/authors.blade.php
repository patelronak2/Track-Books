@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Manage Authors</div>

                <div class="card-body">
					<div class="text-center">
						<a href="#" class="btn btn-primary mt-1 p-2">Add Authors</a>
					</div>
                    <div class="mt-5 text-center"><h3>No Author in the database yet</h3></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
