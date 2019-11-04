@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<div class="mb-3 shadow-sm">
			  <h3 class="text-center mb-3">{{ $book->title }}</h3>	
			  <div class="row no-gutters">
				<div class="col-md-4 px-2">
				  <img src="{{ $book->img_link }}" class="img-thumbnail" alt="Image not Available" width="100%">
				</div>
				<div class="col-md-8 p-2">
					<h5 class="card-title">Author: {{ $book->author }}</h5>
					<p class="card-text">{{ $book->description }}</p>
					<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
				</div>
			  </div>
			</div>
        </div>
    </div>
</div>
@endsection
