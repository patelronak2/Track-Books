@extends('layouts.default')

@section('content')
<script type="text/javascript" src="{{ asset('js/chat.js') }}"></script>
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