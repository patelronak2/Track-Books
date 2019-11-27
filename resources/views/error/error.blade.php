<!-- Display Errors if any -->

@if(Session::has('message'))
	@if(session('alert'))
		<div class="alert alert-danger">{{ session('message') }}</div>
	@else
		<div class="alert alert-success">{{ session('message') }}</div>
	@endif
@endif
@if (session('error'))
	<div class="alert alert-danger">{{ session('error') }}</div>
@endif