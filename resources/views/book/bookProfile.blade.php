@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<div class="mb-3 shadow-sm p-2 bg-light">
			  <h3 class="text-center mb-3">{{ $book->title }}</h3>	
			  <div class="row no-gutters">
				<div class="col-md-4 px-2">
				  <img src="{{ $book->img_link }}" class="img-thumbnail" alt="Image not Available" width="100%">
				</div>
				<div class="col-md-8 p-2">
					@if($author)
						<h5>Author: {{ $book->author }}</h5>
					@else
						<h5 class="text-danger">Author: Information not Available</h5>
					@endif
					@if($category)
						<h6 class="text-secondary">{{ $book->category }}</h6>
					@endif	
					@if($description)
						<p>{{ $book->description }}</p>
					@endif
					@if($publisher)
						<p>Publisher: {{ $book->publisher }}</p>
					@endif
					@if($publishedDate)
						<p>Published: {{ $book->publishedDate }}</p>
					@endif
				</div>
			  </div>
			</div>
        </div>
    </div>
</div>
@endsection
