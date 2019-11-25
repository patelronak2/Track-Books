@extends('layouts.default')

@section('content')
<div class="container-fluid">
	<section class="row new-post">
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
	<section class="row posts">
		<div class="col-md-6 offset-md-3">
			<header>
				<h3>What other people are doing</h3>
			</header>
			<article class="post">
				<p>Post Content Goes here</p>
				<div class="info">
					<h5>Posted by: Ronak Patel</h5>
				</div>
			</article>
		</div>
	</section>

</div>
@endsection
