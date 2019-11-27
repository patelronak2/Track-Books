<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">
	<!-- Scripts -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<!-- Icons -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
	<style type="text/css">
		:root {
		  --input-padding-x: 1.5rem;
		  --input-padding-y: .75rem;
		}

		body {
		  background: #756446;
		  background: linear-gradient(to right, #FFDA99, #B3986B);
		}

		.card-signin {
		  border: 0;
		  border-radius: 1rem;
		  box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
		  overflow: hidden;
		}

		.card-signin .card-title {
		  margin-bottom: 2rem;
		  font-weight: 300;
		  font-size: 1.5rem;
		}

		.card-signin .card-img-left {
		  width: 45%;
		  /* Link to your background image using in the property below! */
		  background: scroll center url('https://source.unsplash.com/WEQbe2jBg40/414x512');
		  background-size: cover;
		}

		.card-signin .card-body {
		  padding: 2rem;
		}

		.form-signin {
		  width: 100%;
		}

		.form-signin .btn {
		  font-size: 80%;
		  border-radius: 5rem;
		  letter-spacing: .1rem;
		  font-weight: bold;
		  padding: 1rem;
		  transition: all 0.2s;
		}

		.form-label-group {
		  position: relative;
		  margin-bottom: 1rem;
		}

		.form-label-group input {
		  height: auto;
		  border-radius: 2rem;
		}

		.form-label-group>input,
		.form-label-group>label {
		  padding: var(--input-padding-y) var(--input-padding-x);
		}

		.form-label-group>label {
		  position: absolute;
		  top: 0;
		  left: 0;
		  display: block;
		  width: 100%;
		  margin-bottom: 0;
		  /* Override default `<label>` margin */
		  line-height: 1.5;
		  color: #495057;
		  border: 1px solid transparent;
		  border-radius: .25rem;
		  transition: all .1s ease-in-out;
		}

		.form-label-group input::-webkit-input-placeholder {
		  color: transparent;
		}

		.form-label-group input:-ms-input-placeholder {
		  color: transparent;
		}

		.form-label-group input::-ms-input-placeholder {
		  color: transparent;
		}

		.form-label-group input::-moz-placeholder {
		  color: transparent;
		}

		.form-label-group input::placeholder {
		  color: transparent;
		}

		.form-label-group input:not(:placeholder-shown) {
		  padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
		  padding-bottom: calc(var(--input-padding-y) / 3);
		}

		.form-label-group input:not(:placeholder-shown)~label {
		  padding-top: calc(var(--input-padding-y) / 3);
		  padding-bottom: calc(var(--input-padding-y) / 3);
		  font-size: 12px;
		  color: #777;
		}
	</style>
</head>
<body>
    <div id="app">
		@include('includes.navigation1')
		<div class="container">
			<div class="row">
			  <div class="col-lg-10 col-xl-9 mx-auto">
				<div class="card card-signin flex-row my-5">
				  <div class="card-img-left d-none d-md-flex">
					 <!-- Background image for card set in CSS! -->
				  </div>
				  <div class="card-body">
					<h5 class="card-title text-center">{{ __('Register') }}</h5>
					<form class="form-signin" method="POST" action="{{ route('register') }}">
					@csrf
					  <div class="form-label-group">
						@error('name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
						<input type="text" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
						<label for="name">{{ __('Name') }}</label>
					  </div>

					  <div class="form-label-group">
						@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
						<input type="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email address" name="email" value="{{ old('email') }}" required autocomplete="email">
						<label for="email">{{ __('E-Mail Address') }}</label>
					  </div>
					  
					  <hr>

					  <div class="form-label-group">
						@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
						<input type="password" id="password" class="form-control form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password" required>
						<label for="password">{{ __('Password') }}</label>
					  </div>
					  
					  <div class="form-label-group">
						<input type="password" id="password-confirm" class="form-control" placeholder="Password" name="password_confirmation" required autocomplete="new-password">
						<label for="password-confirm">{{ __('Confirm Password') }}</label>
					  </div>

					  <button class="btn btn-lg btn-light button-sd btn-block text-uppercase" type="submit">{{ __('Register') }}</button>
					  <a class="d-block text-center mt-2 small" href="{{ route('login') }}">Login In</a>
					</form>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
    </div>
</body>
</html>
