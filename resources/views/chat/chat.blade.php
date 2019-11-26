@extends('layouts.default')

@section('content')
<div class="container-fluid">
	<h2>Show some content here!</h2>
	<div class="card">
		<div class="card-header">Chat</div>
		<div class="card-body">
			<ul class="chat">
				<li class="left clearfix">
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
				</li>
			</ul>
		</div>
		<div class="card-footer">
			<div class="input-group">
				<input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here..." >

				<span class="input-group-btn">
					<button class="btn btn-primary btn-sm" id="btn-chat">
						Send
					</button>
				</span>
			</div>
		</div>
	</div>
</div>	
@endsection('content')