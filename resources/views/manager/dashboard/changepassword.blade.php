@extends("layouts.manager")
@section("seo")
<title>Manager Change Password | Kadesea Agency</title>
@endsection
@section("styles")

@endsection

@section("content")


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update Password Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update Password</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


  <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title"><span  style="font:15px; color:blue">{{ Auth::user()->name }}</span> Update Your Password</h3>
              </div>
              <!-- /.card-header -->


           @include("layouts.messages")

        <form  autocomplete="off" method="POST" action="{{ url("/manager/change_password") }}">
         @csrf
        {{-- card-body --}}
        <div class="card-body">

        <div class="row">
        <div class="form-group col-md-6">
        <label for="current_password">Current Password</label>
        <input type="password" name="current_password" value="{{ old("current_password") }}" class="form-control @error('current_password') is-invalid @enderror" id="current_password" placeholder="Enter Current Password">
          @error('current_password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>


        <div class="form-group col-md-6">
        <label for="password">Password</label>
        <input  class="form-control @error('password') is-invalid @enderror" value="{{ old("password") }}" placeholder="Your New Password" type="password" name="password" id="password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
        <label for="password_confirmation">Confirm Password</label>
        <input  class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old("password_confirmation") }}" placeholder="Confirm Password" type="password" name="password_confirmation" id="password_confirmation">
        @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>



        </div>

        </div>

        <!-- /.card-body -->

        <div class="card-footer">
        <button type="submit" class="btn btn-primary">Update Password</button>
        </div>
        </div>


         </form>

</div>
<!-- /.card -->



          </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



@endsection
@section("scripts")

<script>
</script>


@endsection
