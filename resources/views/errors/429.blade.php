@extends('errors::minimal')

@section('title', __('Too Many Requests'))
@section('code', '429')

@section("error")
  <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-danger">429</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! you have made many too many requests</h3>
          <p>
            <a href="/">Return to dashboard</a>.
          </p>
        </div>
      </div>
      <!-- /.error-page -->

    </section>
    <!-- /.content -->
@endsection
