/* This File Contain Java Script that is required on addMultipleEntries.blade.php
Created By: Ronak Patel */

var data = "";

//This gunction makes a request to google books api and display top 5 results
function searchApi(){
	$("#error").html("").removeClass("alert alert-danger alert-success");
	var value = "https://www.googleapis.com/books/v1/volumes?q=" + $("#searchTerm").val();
	$.ajax({url: value, success: function(results){
		data = results;
		var htmlOutput = '<ul class="list-group">';
		for(var i = 0; i < 5 && i < results['totalItems']; i++){
			
			var title = results.items[i].volumeInfo.title;
			var author = "";
			if(results.items[i].volumeInfo.hasOwnProperty('authors')){
				author = 'By: ' +  results.items[i].volumeInfo.authors[0];
			}
			var img_link = '';
			if(results.items[i].volumeInfo.hasOwnProperty('imageLinks')){
				img_link = results.items[i].volumeInfo.imageLinks.smallThumbnail;
			}
			
			htmlOutput += '<li class="list-group-item">';
			htmlOutput += '<div>';
			htmlOutput += '<div class="row no-gutters">';
			htmlOutput += '<div class="col-auto d-none d-lg-block">';
			htmlOutput += '<img src="'+ img_link +'" alt="image not available" class="img-thumbnail" style="max-height: 90px; max-width: 75px;"></div>';
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

//This function adds top 5 results from the google books api and save them to app's database
function addmultipleRecords(){
	var alertMessage = '<div class="alert alert-danger" role="alert">No data to add</div>';
	if(data == ""){
		$("#searchResult").html(alertMessage);
		return false;
	}else{
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');	
		var title = "";
		var description = "";
		var author = "";
		var category = "";
		var publisher = "";
		var publishedDate = "";
		var imgLink = "";
		var j = 0;
		var flag = true;
		for (var i = 0; i < 5 && i < data.totalItems; i++){
			title = data.items[i].volumeInfo.title;
			
			if(data.items[i].volumeInfo.hasOwnProperty('description')){
				description = data.items[i].volumeInfo.description;
			}else{
				description = "Information not Available"	
			}
			if(data.items[i].volumeInfo.hasOwnProperty('authors')){
				author = data.items[i].volumeInfo.authors[0];
			}else{
				author = "Information not Available"
			}
			if(data.items[i].volumeInfo.hasOwnProperty('categories')){
				category = data.items[i].volumeInfo.categories[0];
			}else{
				category = "Information not Available"
			}
			if(data.items[i].volumeInfo.hasOwnProperty('publisher')){
				publisher = data.items[i].volumeInfo.publisher;
			}else{
				publisher = "Information not Available"
			}
			if(data.items[i].volumeInfo.hasOwnProperty('publishedDate')){
				publishedDate = data.items[i].volumeInfo.publishedDate;
			}else{
				publishedDate = "Information not Available"
			}
			if(data.items[i].volumeInfo.hasOwnProperty('imageLinks')){
				imgLink = data.items[i].volumeInfo.imageLinks.smallThumbnail;
			}
			
			$.ajax({
				url: '/public/ajaxBookInsert',
				type: 'POST',
				data: {_token: CSRF_TOKEN, title: title, description: description, author: author, category: category, publisher: publisher, publishedDate: publishedDate, imgLink: imgLink},
				success: function(data){
					alertMessage = '<div class="alert alert-success" role="alert">' ;
					alertMessage += 'Books added to database.</div>';
					$("#searchResult").html(alertMessage);
					
				},
				error: function(error){
					alertMessage = '<div class="alert alert-danger" role="alert">' ;
					alertMessage += 'Book is already in the database.</div>';
					$("#searchResult").html(alertMessage);
				}
			});
			
		}
					
		return false;
	}
}