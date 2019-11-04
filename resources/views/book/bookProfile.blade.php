@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
			<div class="mb-3">
			<h3 class="text-center">{{ $book->title }}</h3>	
			  <div class="row no-gutters">
				<div class="col-md-4">
				  <img src="{{ $book->img_link }}" class="img-thumbnail" alt="...">
				</div>
				<div class="col-md-8">
				  <div class="">
					<h5 class="card-title">Author: {{ $book->author }}</h5>
					<p class="card-text">{{ $book->description }}</p>
					<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
				  </div>
				</div>
			  </div>
			</div>
        </div>
    </div>
</div>
@endsection
