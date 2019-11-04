@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
			<h2>{{ $book->title }}</h2>
            <div class="col-md-5">
                <img src="{{ $book->img_link }}" class="img-fluid" alt="Responsive image">
            </div>
			<div class="col-md-7">
				Book Details will go here
			</div>
        </div>
    </div>
</div>
@endsection
