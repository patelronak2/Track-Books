@extends('layouts.default')

@section('content')

<section class="row new-post p-3 border-bottom-2">
	<div class="col-md-6 offset-md-3">
		<header>
			<h2>What's on your mind?</h2>
		</header>
		<form action="" >
			@csrf
			<div class="form-group">
				<textarea class="form-control" name="new-post" id="new-post" rows="5" placeholder="Write some thing here..."></textarea>
			</div>
			<button class="btn btn-light button" type="submit">Create Post</button>
		</form>
	</div>
</section>
<section class="row posts mt-3 p-3">
	<div class="col-md-6 offset-md-3">
		<header class="my-2">
			<h3>What other people are doing</h3>
		</header>
		<article class="post pl-1">
			<p>Post Content Goes here</p>
			<div class="info">
				<h5>Posted by: Ronak Patel</h5>
			</div>
		</article>
	</div>
</section>
@endsection
