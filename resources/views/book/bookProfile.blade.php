@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
			<h2 class="text-center">{{ $book->title }}</h2>
			<div class="card bg-dark text-white">
			  <img src="{{ $book->img_link }}" class="card-img" alt="...">
			  <div class="card-img-overlay">
				<h5 class="card-title">Card title</h5>
				<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
				<p class="card-text">Last updated 3 mins ago</p>
			  </div>
			</div>
        </div>
    </div>
</div>
@endsection
