@extends("layouts.dashboard")

@section("seo")
<title>Admin Profile Page | {{config("app.name")}} </title>
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
            <h1>Admin Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admin Profile</li>
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
                <h3 class="card-title"><span  style="font:15px; color:blue">{{ Auth::user()->name }}</span> Update Your Profile Photo</h3>
              </div>
              <!-- /.card-header -->

           @include("layouts.messages")

        <form  autocomplete="off" method="POST" action="{{ url("/admin/profile") }}">
         @csrf
        {{-- card-body --}}
        <div class="card-body">
        <div class="row">
        <div class="form-group col-md-6">
        <label for="image">Image</label>
        <input type="file" name="image"  class="form-control @error('image') is-invalid @enderror" >
          @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        </div>

        </div>

        <!-- /.card-body -->

        <div class="card-footer">
        <button type="submit" class="btn btn-primary">Update Photo</button>
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


@endsection
