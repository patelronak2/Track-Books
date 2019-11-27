@extends('layouts.default')

@section('content')
<div class="container-fluid">
	<h2>Add Multiple Books</h2>
	<div class="container-fluid">
		<a href="/public/manageBooks" class="badge badge-light m-1 p-2">All Books</a>
		<a href="/public/admin" class="badge badge-secondary m-1 p-2">Back to Dashboard</a>
	</div>
	<div class="my-3 bg-light shadow-sm p-3">
			<h4>Through Google Api</h4>

			<p>Search for the term. Top 5 results will be added to the database.</p>
			@include('error.error')
			<form method="post" action="/public/insertMultipleBooks" class="px-1">
			  @csrf
			  <div class="form-row align-items-center">
				<div class="col-auto">
				  <label class="sr-only" for="searchTerm">Search Term</label>
				  <input type="text" class="form-control mb-2" id="searchTerm" placeholder="Harry Potter" onkeyup="searchApi();">
				</div>
				<div class="col-auto">
				  <button type="submit" class="btn btn-light button-pm mb-2" onclick="return addmultipleRecords()">Add Multiple Books</button>
				</div>
			  </div>
			</form>
			<div id="searchResult">
			</div>
	</div>
</div>
<script type="text/javascript" src="{{ asset('js/addMultipleEntries.js') }}"></script>
@endsection
