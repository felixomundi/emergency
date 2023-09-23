@extends('errors::minimal')

@section('title', __('Payment Required'))
@section('code', '402')

@section("error")
  <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-danger">402</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! a Payment is Required</h3>

          <p>
            <a href="/">Return to dashboard</a>.
          </p>
        </div>
      </div>
      <!-- /.error-page -->

    </section>
    <!-- /.content -->
@endsection
