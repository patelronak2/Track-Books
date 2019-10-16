@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mt-2">
				<div class="card">
					<div class="card-header">Add users</div>
					<div class="card-body">
						<form method="POST" action="/public/insertUser">
							@csrf
							<div class="form-group row">
								<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

								<div class="col-md-6">
									<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

									@error('name')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>

							<div class="form-group row">
								<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

								<div class="col-md-6">
									<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

									@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>

							<div class="form-group row">
								<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

								<div class="col-md-6">
									<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

									@error('password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>

							<div class="form-group row">
								<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

								<div class="col-md-6">
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
								</div>
							</div>
							
							<div class="form-group row mb-0">
								<div class="col-md-6 offset-md-4">
									<button type="submit" class="btn btn-primary">
										Add User
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="mt-2">
				<div class="card">
					<div class="card-header">Add Books</div>
					<div class="card-body">
						<form method="POST" action="/public/insertBook">
							@csrf
							<div class="form-group row">
								<label for="bookName" class="col-md-4 col-form-label text-md-right">Book Name</label>

								<div class="col-md-6">
									<input id="bookName" type="text" class="form-control @error('bookName') is-invalid @enderror" name="bookName" value="{{ old('bookName') }}" required autocomplete="bookName" autofocus>

									@error('bookName')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
							<div class="form-group row">
								<label for="authorName" class="col-md-4 col-form-label text-md-right">Author Name</label>

								<div class="col-md-6">
									<input id="authorName" type="text" class="form-control @error('authorName') is-invalid @enderror" name="authorName" value="{{ old('authorName') }}" autocomplete="authorName" autofocus>

									@error('authorName')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
							<div class="form-group row">
								<label for="category" class="col-md-4 col-form-label text-md-right">Category</label>

								<div class="col-md-6">
									<input id="category" type="text" class="form-control @error('category') is-invalid @enderror" name="category" value="{{ old('category') }}"  autocomplete="category" autofocus>

									@error('category')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
							<div class="form-group row">
								<label for="year" class="col-md-4 col-form-label text-md-right">Year</label>

								<div class="col-md-6">
									<input id="year" type="number" class="form-control @error('year') is-invalid @enderror" name="year" value="{{ old('year') }}"  autocomplete="year" autofocus>

									@error('year')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
							<div class="form-group row mb-0">
								<div class="col-md-6 offset-md-4">
									<button type="submit" class="btn btn-primary">
										Add Book
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="mt-2">
				<div class="card">
					<div class="card-header">Add Authors</div>
					<div class="card-body">
						<form method="POST" action="/public/insertAuthor">
							<div class="form-group row">
								<label for="authorName" class="col-md-4 col-form-label text-md-right">Author Name</label>

								<div class="col-md-6">
									<input id="authorName" type="text" class="form-control @error('authorName') is-invalid @enderror" name="authorName" value="{{ old('authorName') }}" required autocomplete="authorName" autofocus>

									@error('authorName')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
							<div class="form-group row mb-0">
								<div class="col-md-6 offset-md-4">
									<button type="submit" class="btn btn-primary">
										Add Author
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection
