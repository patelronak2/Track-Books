@extends('layouts.default')

@section('content')
<div class="container">
<div class="row new-post p-3">
	<div class="col-md-6 offset-md-3">
		<header>
			<h2>What's on your mind?</h2>
		</header>
		@if ($message)
			<div class="alert alert-success">{{ $message }}</div>
		@endif
		<form action="/public/createPost" method="POST">
			@csrf
			<div class="form-group">
				<textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body" rows="5" placeholder="Write some thing here..."></textarea>
			</div>
			<button class="btn btn-light button" type="submit">Create Post</button>
		</form>
	</div>
	<hr>
</div>

<div class="row posts mt-3 p-3">
	<div class="col-md-6 offset-md-3">
		<header class="my-2">
			<h3>What other people are doing</h3>
		</header>
		<article class="post pl-3 my-3" style="border-left: 2px solid #756446;">
			<p>Post Content Goes here</p>
			<div class="font-italic">
				<h5>Posted by: Ronak Patel</h5>
			</div>
		</article>
		<article class="post pl-3 my-3" style="border-left: 2px solid #756446;">
			<p>Post Content Goes here</p>
			<div class="font-italic">
				<h5>Posted by: Ronak Patel</h5>
			</div>
		</article>
		<article class="post pl-3 my-3" style="border-left: 2px solid #756446;">
			<p>Post Content Goes here</p>
			<div class="font-italic">
				<h5>Posted by: Ronak Patel</h5>
			</div>
		</article>
		<article class="post pl-3 my-3" style="border-left: 2px solid #756446;">
			<p>Post Content Goes here</p>
			<div class="font-italic">
				<h5>Posted by: Ronak Patel</h5>
			</div>
		</article>
		<article class="post pl-3 my-3" style="border-left: 2px solid #756446;">
			<p>Post Content Goes here</p>
			<div class="font-italic">
				<h5>Posted by: Ronak Patel</h5>
			</div>
		</article>
		
	</div>
</div>
</div>
@endsection
