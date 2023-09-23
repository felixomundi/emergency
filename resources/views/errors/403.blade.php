@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')

@section("error")
  <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-warning">403</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! you are not allowed to access the identified resource.</h3>
<p>Please clear your browser cache or</p>
          <p>
            <a href="/">Return to dashboard</a>.
          </p>
        </div>
      </div>
      <!-- /.error-page -->

    </section>
    <!-- /.content -->
@endsection
