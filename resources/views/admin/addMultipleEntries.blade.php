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
		var value = "https://www.googleapis.com/books/v1/volumes?q=" + $("#searchTerm").val();
		$.ajax({url: value, success: function(results){
			
			for(var i = 0; i < 5 && i < results['totalItems']; i++){
				
				var title = results['items'][i]['volumeInfo']['title'];
				var description = results['items'][i]['volumeInfo']['description'];
				var len = results['items'][i]['volumeInfo']['authors'].length;
				var author = "";
				for(var j = 0; j < len; j++){
					author += results['items'][i]['volumeInfo']['authors'][j];
				}
				var category = results['items'][i]['volumeInfo']['categories'][0];
				var publisher = results['items'][i]['volumeInfo']['publisher'];
				var publishedDate = results['items'][i]['volumeInfo']['publishedDate'];
				var img_link = results['items'][i]['volumeInfo']['imageLinks']['thumbnail'];

				alert(title + description+ author+ category+ publisher+publishedDate+img_link);		
			}
		}});
	}
</script>
@endsection
