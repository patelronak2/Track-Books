@extends('layouts.default')

@section('content')
<div class="container">
<div class="row new-post p-3">
	<div class="col-md-6 offset-md-3">
		<header>
			<h2>What's on your mind?</h2>
		</header>
		@if ($alert)
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
		@if(count($posts) > 0)
			@foreach($posts as $post)
				<article class="post pl-3 my-3" style="border-left: 2px solid #756446;">
					<p>{{ $post->body }}</p>
					<div class="font-italic">
						<h5>Posted by: {{ $post->user->name }}</h5>
					</div>
					<small>{{ $post->created_at->diffForHumans() }}</small>
					@if($post->user_id == Auth::id())
						<a href="/public/deletePost/{{ $post->id}}" class="">Delete</a>
					@endif
				</article>
			@endforeach
		@else
			<article class="post pl-3 my-3" style="border-left: 2px solid #756446;">
				<p>No Posts to display</p>
			</article>
		@endif		
	</div>
</div>
</div>
@endsection
