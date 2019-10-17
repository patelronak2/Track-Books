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
							  <input type="text" class="form-control mb-2" id="searchTerm" placeholder="Harry Potter" onkeyup="searchApi();">
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
			var htmlOutput = '<ul class="list-group">';
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
				
				htmlOutput += '<li class="list-group-item">';
				htmlOutput += '<div class="card mb-3">';
				htmlOutput += '<div class="row no-gutters">';
				htmlOutput += '<div class="col-md-4">';
				htmlOutput += '<img src="'+ img_link + '" class="card-img"></div>';
				htmlOutput += '<div class="col-md-8">';
				htmlOutput += '<div class="card-body"><h5 class="card-title">' + title + '</h5>';
				htmlOutput += '<p class="card-text">Author: '+ author +'</p>';
				htmlOutput += '</div></div></div>';
				htmlOutput += '</div></li>';		
				
				//alert(title +"\n"+ description+"\n"+ author+"\n"+ category+"\n"+ publisher+"\n"+publishedDate+"\n"+img_link);		
			}
			
			htmlOutput += '</ul>';
			$("#searchResult").val(htmlOutput);
		}});
	}
</script> 
@endsection
