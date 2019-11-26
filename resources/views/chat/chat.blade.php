@extends('layouts.default')

@section('content')
<div class="container-fluid">
	<div class="row">
	<div class="col-md-6 offset-md-6">
	<div class="card">
		<div class="card-header"> 
			<h4>Chat</h4>
		</div>
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
			<div class="input-group mb-3">
			  <input type="text" class="form-control" placeholder="Type your message here!" >
			  <div class="input-group-append">
				<span class="input-group-text badge badge-primary" id="basic-addon2">Send</span>
			  </div>
			</div>
		</div>
		
	</div>
	</div>
	</div>
</div>	
@endsection('content')