@extends('layouts.auth')
@section("seo")
<title>Verify Email | {{config("app.name")}}</title>
@endsection
@section('content')
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
    <a href="/" class="h1 text-primary" style="font-size:20px;"><b>{{config("app.name")}}</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">
     {{ __('Verify Your Email Address') }}
      </p>

    @if (session('resent'))
    <div class="alert alert-success" role="alert">
        {{ __('A fresh verification link has been sent to your email address.') }}
    </div>
    @endif
 {{ __('Before proceeding, please check your email for a verification link.') }}
 {{ __('If you did not receive the email') }},
<form method="POST" action="{{ route('verification.resend') }}">
    @csrf
    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
</form>



    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->





@endsection
