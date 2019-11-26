/* This file contains JavaScript for chat.blade.php
Created By: Ronak Patel */

$(document).ready(function(){
	//Retrive old messages from the database
	fetchMessages();
	setInterval(fetchMessages, 1000);
	$("#sendMessage").click(function(){
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var message = $("#typedMessage").val();
		if(message != ""){
			//post request to send the message
			$("#typedMessage").val("");
			$.ajax({
				url: '/public/messages',
				type: 'POST',
				data: {_token: CSRF_TOKEN, message: message},
				success: function(response){
					//Message sent!
					//Display all new messages
					fetchMessages();
					
				},
				error: function(error){
					console.log(error);
				}
			});
		}
	});
});

function fetchMessages(){
	$.ajax({
		url: '/public/messages',
		type: 'GET',
		success: function(response){
			var data = JSON.parse(response);
			var temphtml = "";
			for (var i = 0; i < data.length; i++){
				temphtml += '<li class="left clearfix">';
				temphtml += '<div class="chat-body clearfix">';
				temphtml += '<div class="header"><strong class="primary-font">' + data[i].user.name;
				temphtml += '</strong> '+ data[i].created_at +'</div>';
				temphtml += '<p>'+ data[i].message +'</p>';
				temphtml += '</div></li>';
			}
			$("#chatMessages").html(temphtml);
			
		},
		error: function(error){
			console.log("Couldn't Fetch the messages");
			console.log(error);
			
		}
	});
}