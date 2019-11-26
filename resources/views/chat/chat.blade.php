@extends('layouts.default')

@section('content')
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Chats</div>

				<div class="panel-body">
					<chat-messages :messages="messages"></chat-messages>
				</div>
				<div class="panel-footer">
					<chat-form
						v-on:messagesent="addMessage"
						:user="{{ Auth::user() }}"
					></chat-form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection('content')