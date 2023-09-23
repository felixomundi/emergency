@extends('layouts.app')
@section("seo")
<title>Confirm Password Reset | {{config("app.name")}}</title>
@endsection
@section('content')
 <div class="card card-outline card-primary">
    <div class="card-header text-center">
    <a href="/" class="h1 text-primary" style="font-size:20px;"><b>{{config("app.name")}}</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Confirm Password.</p>
       {{ __('Please confirm your password before continuing.') }}
      <form action="login.html" method="post">
        <div class="input-group mb-3">
         <input id="password"  placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block"> {{ __('Confirm Password') }}</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        @if (Route::has('password.request'))
            <a  href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
@endsection
