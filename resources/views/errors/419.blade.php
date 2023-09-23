@extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')

@section("error")
  <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-danger">419</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! the page has expired</h3>
          <p>
            <a href="/">Return to dashboard</a>.
          </p>
        </div>
      </div>
      <!-- /.error-page -->

    </section>
    <!-- /.content -->
@endsection
