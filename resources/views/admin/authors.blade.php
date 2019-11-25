@extends('layouts.default')

@section('content')
<div class="container-fluid">
	<h2>Manage Authors</h2>
	<div class="card">
		<h4 class="card-header">Manage Authors</h4>
		<div class="container-fluid">
			<a href="/public/addEntries" class="badge badge-light m-1 p-2">Add Author</a>
			<a href="/public/admin" class="badge badge-secondary m-1 p-2">Back to Dashboard</a>
		</div>
		<div class="bg-light shadow-sm p-5">
			<h5 class="text-center">No Authors in the database.</h5>
		</div>
	</div>
        
</div>
@endsection
