@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
			<p class="display-4">Add Multiple Books</p>
			<div class="mt-2">
				<div class="card">
					<div class="card-header">Through Google Api</div>
					<div class="card-body">
						<p>Search for the term. Top 10 results will be added to the database.</p>
						<form>
						  <div class="form-row align-items-center">
							<div class="col-auto">
							  <label class="sr-only" for="searchTerm">Search Term</label>
							  <input type="text" class="form-control mb-2" id="searchTerm" placeholder="Harry Potter" onkeyup = "searchApi();">
							</div>
							<div class="col-auto">
							  <button type="submit" class="btn btn-primary mb-2">Add Multiple Books</button>
							</div>
						  </div>
						</form>
						<div id="searchResult">
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>
<script>
	function searchApi(){
		var value = "https://www.googleapis.com/books/v1/volumes?q=harry";
		$.ajax({url: "https://www.googleapis.com/books/v1/volumes?q=harry", success: function(results){
			var data = JSON.parse(results);
			//alert(data);
			alert("Inside ajax function");
			//alert(data['totalItems']);
		}});
	}
</script>
@endsection
