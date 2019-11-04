@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
			<h2 class="text-center">{{ $book->title }}</h2>
			<div class="card mb-3" style="max-width: 540px;">
			  <div class="row no-gutters">
				<div class="col-md-4">
				  <img src="{{ $book->img_link }}" class="card-img" alt="...">
				</div>
				<div class="col-md-8">
				  <div class="card-body">
					<h5 class="card-title">Card title</h5>
					<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
					<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
				  </div>
				</div>
			  </div>
			</div>
        </div>
    </div>
</div>
@endsection
