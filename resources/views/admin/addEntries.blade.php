@extends('layouts.default')

@section('content')
<div class="container-fluid">
    <!--<div class="row justify-content-center">
        <div class="col-md-8"> -->
		<h2>Insert Record Into Database</h2>
            <div class="my-3 bg-light shadow-sm p-3">
				<h4>Add a User</h4>					
						
				<form method="POST" action="/public/insertUser" class="px-1">
					@csrf
					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label font-weight-bold">{{ __('Name') }}</label>

						<div class="col-sm-10">
							<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="John Doe">

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
						<label for="password-confirm" class="col-sm-2 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

						<div class="col-sm-10">
							<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
						</div>
					</div>
					
					<div class="form-group row mb-0">
						<div class="col-sm-2 offset-sm-2">
							<button type="submit" class="btn btn-primary button">
								Add User
							</button>
						</div>
					</div>
				</form>					
			</div>
			<div class="mt-2">
				<div class="card">
					<h4 class="card-header">Add Books</h4>
					<div class="card-body">
					<!----------------- Book Form ------------------------------>
						<form method="POST" action="/public/insertBook">
							@csrf
							<div class="form-group row">
								<label for="title" class="col-md-4 col-form-label text-md-right">Book Name</label>

								<div class="col-md-6">
									<input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

									@error('title')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
							<div class="form-group row">
								<label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
								<div class="col-md-6">
									<input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" autocomplete="description" autofocus>

									@error('description')
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
								<label for="publisher" class="col-md-4 col-form-label text-md-right">Publisher</label>

								<div class="col-md-6">
									<input id="publisher" type="text" class="form-control @error('publisher') is-invalid @enderror" name="publisher" value="{{ old('publisher') }}"  autocomplete="publisher" autofocus>

									@error('publisher')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
								</div>
							</div>
							<div class="form-group row">
								<label for="publishedDate" class="col-md-4 col-form-label text-md-right">Published Date</label>

								<div class="col-md-6">
									<input id="publishedDate" type="text" class="form-control @error('publishedDate') is-invalid @enderror" name="publishedDate" value="{{ old('publishedDate') }}"  autocomplete="publishedDate" autofocus>

									@error('publishedDate')
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
					<h4 class="card-header">Add Authors</h4>
					<div class="card-body">
						<!-- Author Form -->
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
        <!--</div>
    </div>-->
</div>
@endsection
