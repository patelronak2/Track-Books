@extends('layouts.default')

@section('content')
<script>
		//Implement logic of posts and use ajax to create illusion on  user to user messaging
		$(document).ready(function(){
			//Retrive old messages from the database
			fetchMessages();
			$("#sendMessage").click(function(){
				var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
				var message = $("#typedMessage").val();
				if(message != ""){
					//post request to send the message
					
					$.ajax({
						url: '/public/messages',
						type: 'POST',
						data: {_token: CSRF_TOKEN, message: message},
						success: function(response){
							alert(response);
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
					alert(data);
					
				},
				error: function(error){
					console.log(error);
					alert("Couldn't FFetch the messages");
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
		<div class="card-body">
			 <ul class="chat" id="chatMessages">
				<!-- <li class="left clearfix">
					<div class="chat-body clearfix">
						<div class="header">
							<strong class="primary-font">
								Ronak Patel
							</strong>
						</div>
						<p>
							Hey There!
						</p>
					</div>
				</li> -->
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