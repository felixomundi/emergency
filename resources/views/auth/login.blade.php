@extends('layouts.auth')
@section("seo")
<title>Login | {{config("app.name")}}</title>
@endsection

@section("content")


<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
   <div class="card-header text-center">
      <a href="/" class="h1 text-primary" style="font-size:20px;"><b>{{config("app.name")}}</a>
    </div>
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form method="POST" action="{{ route('login') }}">
      @csrf
        <div class="input-group mb-3">
          <select name="email" id="email"
          class="form-control @error('email') is-invalid @enderror" name="email"
          >
            <option value="">Select</option>
            <option value="omundifelix30@gmail.com">Admin</option>
            <option value="fomundi34@gmail.com">User</option>
          </select>
          {{-- <input id="email" type="email" placeholder="Your Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> --}}

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
        <div class="input-group mb-3">
          <input id="password" type="password" placeholder="Your Password" value="12345678"  class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

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
          <div class="col-8">
            <div class="icheck-primary">

              <input type="checkbox"  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <p class="mb-1">
       @if (Route::has('password.request'))
                                    <a  href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
      </p>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
@endsection
