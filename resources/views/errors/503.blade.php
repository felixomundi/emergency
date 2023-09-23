@extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section("error")

    <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-warning">503</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Our site is down.</h3>

          <p>
            Keep checking we'are working on it to be up soon or try <a href="/">return to dashboard</a> .
          </p>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
@endsection
