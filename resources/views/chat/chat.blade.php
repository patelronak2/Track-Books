@extends('layouts.default')

@section('content')
<script>
		//Implement logic of posts and use ajax to create illusion on  user to user messaging
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
</script>
<div class="container-fluid">
	<div class="row">
	<div class="col-md-5 offset-md-3">
		<h2>Group Chat</h2>
	<div class="card">
		<div class="card-header"> 
			<h4>{{ Auth::user()->name }}</h4>
		</div>
		<div class="card-body" id="card-content">
			 <ul class="chat" id="chatMessages">
				
			</ul> 
			<!-- This content needs to be generated dynamically! -->
		</div>
		<div class="card-footer">
			<div class="input-group mb-3">
			  <input type="text" class="form-control" id="typedMessage" placeholder="Type Message Here...">
			  <div class="input-group-append">
				<button class="btn btn-light button" type="button" id="sendMessage">Send</button>
			  </div>
			</div>
		</div>
		
	</div>
	</div>
	</div>
</div>	
@endsection('content')