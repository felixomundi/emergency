@extends('layouts.auth')
@section("seo")
<title>Forgot Password | {{config("app.name")}}</title>
@endsection
@section('content')
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
    <a href="/" class="h1 text-primary" style="font-size:20px;"><b>{{config("app.name")}}</a>
    </div>
    <div class="card-body">

      @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

      <p class="login-box-msg">You forgot your password? </p>
      <form method="POST" action="{{ route('password.email') }}">
                        @csrf
        <div class="input-group mb-3">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">   {{ __('Send Password Reset Link') }}</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mt-3 mb-1">
      @if (Route::has('login'))
    <a  href="{{ route('login') }}">
        <i class="fa fa-sign-in"></i> {{ __('Login') }}
    </a>
     @endif
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
@endsection
