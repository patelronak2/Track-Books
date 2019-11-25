@extends('layouts.default')

@section('content')
<div class="container-fluid">
	<section class="row new-post">
		<div class="col-md-6 col-md-offset-3">
			<header>
				<h2>What's on your mind?</h2>
			</header>
			<form>
				<div class="form-group">
					<textarea class="form-control" name="new-post" id="new-post" rows="5" placeholder="Write some thing here..."></textarea>
				</div>
				<button class="btn btn-light button" type="submit">Create Post</button>
			</form>
		</div>
	</section>

</div>
@endsection
