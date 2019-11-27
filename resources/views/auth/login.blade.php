@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="row no-gutter">
    <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
    <div class="col-md-8 col-lg-6">
      <div class="login d-flex align-items-center py-5">
        <div class="container">
          <div class="row">
            <div class="col-md-9 col-lg-8 mx-auto">
			  @if (session('message'))
					<div class="alert alert-danger">{{ session('message') }}</div>
				@endif
              <h3 class="login-heading mb-4">Welcome back!</h3>
              <form method="POST" action="{{ route('login') }}">
				@csrf
                <div class="form-label-group">
					@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
                  <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email address" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                  <label for="email">{{ __('E-Mail Address') }}</label>
                </div>

                <div class="form-label-group">
				  @error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
                  <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
                  <label for="password">{{ __('Password') }}</label>
                </div>

                <div class="custom-control custom-checkbox mb-3">
				
                  <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                  <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                </div>
				
				
				
                <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">{{ __('Login') }}</button>
                @if (Route::has('password.request'))
					<div class="text-center">
					  <a class="small" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
					</div>
				@endif
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
