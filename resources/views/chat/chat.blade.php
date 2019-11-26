@extends('layouts.default')

@section('content')
<div class="container-fluid">
	<div class="row">
	<div class="col-md-5 offset-md-3">
		<h2>Group Chat</h2>
	<div class="card">
		<div class="card-header"> 
			<h4>{{ Auth::user()->name }}</h4>
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
			  <input type="text" class="form-control" placeholder="Type Message Here...">
			  <div class="input-group-append">
				<button class="btn btn-light button" type="button" id="button-addon2">Button</button>
			  </div>
			</div>
		</div>
		
	</div>
	</div>
	</div>
</div>	
@endsection('content')