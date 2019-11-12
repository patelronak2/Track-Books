@extends('layouts.default')

@section('content')
<div class="container">
    <div class="my-3">
		<h2>{{ $profile->name }}'s Profile</h2>
	</div>
	<div class="my-3">
		<div class="row no-gutters shadow-sm bg-light p-3">
			<div class="col-md-6">
				<h5>Email: {{ $profile->email }}</h5>
				@if($profile->birthday)
					<h5>Birth date: {{ $profile->birthday }}</h5>
				@else
					<h5>Birth date: Not entered</h5>
				<h5>Gender: </h5>
				<h5>Account Setting</h5>
			</div>
			<div class="col-md-3"></div>
			<div class="col-md-3"></div>
		</div>
	</div>
</div>
@endsection
