@extends('layouts.default')

@section('content')
<div class="container-fluid">
	<h2>Insert Record Into Database</h2>
		<div class="my-3 bg-light shadow-sm p-3">
			<h4>Add an User</h4>					
			<form method="POST" action="/public/insertUser" class="px-1">
				@csrf
				<div class="form-group row">
					<label for="name" class="col-sm-2 col-form-label font-weight-bold">{{ __('Name') }}</label>

					<div class="col-sm-10">
						<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name"  placeholder="John Doe">

						@error('name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>

				<div class="form-group row">
					<label for="email" class="col-sm-2 col-form-label font-weight-bold">{{ __('E-Mail Address') }}</label>
					<div class="col-sm-10">
						<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="abc@gmail.com">

						@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
				<div class="form-group row">
					<label for="password" class="col-sm-2 col-form-label font-weight-bold">{{ __('Password') }}</label>

					<div class="col-sm-10">
						<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

						@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
				<div class="form-group row">
					<label for="password-confirm" class="col-sm-2 col-form-label font-weight-bold">{{ __('Confirm Password') }}</label>

					<div class="col-sm-10">
						<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
					</div>
				</div>
				
				<div class="form-group row mb-0">
					<div class="col-sm-2 offset-sm-2">
						<button type="submit" class="btn btn-light button">
							Add User
						</button>
					</div>
				</div>
			</form>					
		</div>
		<div class="my-3 bg-light shadow-sm p-3">
			<h4>Add a Books</h4>
			<!----------------- Book Form ------------------------------>
			<form method="POST" action="/public/insertBook" class="px-1">
				@csrf
				<div class="form-group row">
					<label for="title" class="col-sm-2 col-form-label font-weight-bold">Book Name</label>

					<div class="col-sm-10">
						<input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" placeholder="Harry Potter and the deathly hallows">
						@error('title')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
				<div class="form-group row">
					<label for="description" class="col-sm-2 col-form-label font-weight-bold">Description</label>
					<div class="col-sm-10">
						<input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" autocomplete="description">

						@error('description')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
				<div class="form-group row">
					<label for="authorName" class="col-sm-2 col-form-label font-weight-bold">Author Name</label>

					<div class="col-sm-10">
						<input id="authorName" type="text" class="form-control @error('authorName') is-invalid @enderror" name="authorName" value="{{ old('authorName') }}" autocomplete="authorName" placeholder="J.K. Rowling">

						@error('authorName')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
				<div class="form-group row">
					<label for="category" class="col-sm-2 col-form-label font-weight-bold">Category</label>

					<div class="col-sm-10">
						<input id="category" type="text" class="form-control @error('category') is-invalid @enderror" name="category" value="{{ old('category') }}"  autocomplete="category"  placeholder="Young Fiction">

						@error('category')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
				<div class="form-group row">
					<label for="publisher" class="col-sm-2 col-form-label font-weight-bold">Publisher</label>

					<div class="col-sm-10">
						<input id="publisher" type="text" class="form-control @error('publisher') is-invalid @enderror" name="publisher" value="{{ old('publisher') }}"  autocomplete="publisher" >

						@error('publisher')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
				<div class="form-group row">
					<label for="publishedDate" class="col-sm-2 col-form-label font-weight-bold">Published Date</label>

					<div class="col-md-10">
						<input id="publishedDate" type="text" class="form-control @error('publishedDate') is-invalid @enderror" name="publishedDate" value="{{ old('publishedDate') }}"  autocomplete="publishedDate"  placeholder="2005">

						@error('publishedDate')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
				<div class="form-group row mb-0">
					<div class="col-sm-2 offset-sm-2">
						<button type="submit" class="btn btn-light button">
							Add Book
						</button>
					</div>
				</div>
			</form>
		</div>
		<div class="my-3 bg-light shadow-sm p-3">
			<h4>Add an Author</h4>
			<!-- Author Form -->
			<form method="POST" action="/public/insertAuthor" class="px-1">
				<div class="form-group row">
					<label for="authorName" class="col-sm-2 col-form-label font-weight-bold">Author Name</label>

					<div class="col-sm-10">
						<input id="authorName" type="text" class="form-control @error('authorName') is-invalid @enderror" name="authorName" value="{{ old('authorName') }}" required autocomplete="authorName" placeholder="J.K. Rowling">

						@error('authorName')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
				<div class="form-group row mb-0">
					<div class="col-sm-2 offset-md-2">
						<button type="submit" class="btn btn-light button">
							Add Author
						</button>
					</div>
				</div>
			</form>
		</div>
</div>
@endsection
