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
						<p>Search for the term. Top 5 results will be added to the database.</p>
						<form method="post" action="/public/insertMultipleBooks">
						  <div class="form-row align-items-center">
							<div class="col-auto">
							  <label class="sr-only" for="searchTerm">Search Term</label>
							  <input type="text" class="form-control mb-2" id="searchTerm" placeholder="Harry Potter" onkeyup="searchApi();">
							</div>
							<div class="col-auto">
							  <button type="submit" class="btn btn-primary mb-2" onclick="return addmultipleRecords()">Add Multiple Books</button>
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
	var data = "";
	function searchApi(){
		var value = "https://www.googleapis.com/books/v1/volumes?q=" + $("#searchTerm").val();
		$.ajax({url: value, success: function(results){
			data = results;
			var htmlOutput = '<ul class="list-group">';
			for(var i = 0; i < 5 && i < results['totalItems']; i++){
				
				var title = results.items[i].volumeInfo.title;
				var author = 'By: ' +  results.items[i].volumeInfo.authors[0];
				var img_link = results.items[i].volumeInfo.imageLinks.smallThumbnail;
				
				htmlOutput += '<li class="list-group-item">';
				htmlOutput += '<div>';
				htmlOutput += '<div class="row no-gutters">';
				htmlOutput += '<div class="col-auto d-none d-lg-block">';
				htmlOutput += '<img src="'+ img_link +'" class="img-thumbnail" style="max-height: 90px; max-width: 75px;"></div>';
				htmlOutput += '<div class="col-auto">';
				htmlOutput += '<div class="ml-2"><h5>' + title + '</h5>';
				htmlOutput += '<p>'+ author +'</p>';
				htmlOutput += '</div></div></div>';
				htmlOutput += '</div></li>';		
					
			}
			
			htmlOutput += '</ul>';
			
			$("#searchResult").html(htmlOutput);
		}, error: function(){
			$("#searchResult").html("<h5>No Result Found</h5>");
		}});
		if($("#searchTerm").val() == ""){
				$("#searchResult").html("");
				data = "";	
			}
	}
	
	function addmultipleRecords(){
		var alertMessage = '<div class="alert alert-danger" role="alert">No data to add</div>';
		if(data == ""){
			$("#searchResult").html(alertMessage);
		}else{
			alert(results.items[0].volumeInfo.title);
		}
		
		return false;
	}
</script> 
@endsection
