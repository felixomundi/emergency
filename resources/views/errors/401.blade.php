@extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')

@section("error")
  <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-danger">401</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! you are not allowed to access the identified resource.</h3>

          <p>
            <a href="/">Return to dashboard</a>.
          </p>
        </div>
      </div>
      <!-- /.error-page -->

    </section>
    <!-- /.content -->
@endsection
