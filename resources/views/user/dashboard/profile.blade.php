@extends("layouts.user")
@section("seo")
<title>Profile | {{config("app.name")}} </title>
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
            <h1>{{ $user->name }} Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ $user->name }} Profile</li>
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
            <div class="card card-primary">
              {{-- <div class="card-header">
                <h3 class="card-title">Update Staff Form</h3>
              </div> --}}
              <!-- /.card-header -->

        @include("layouts.messages")

        <form class="mt-3" autocomplete="off">
         @csrf


        {{-- card-body --}}
        <div class="card-body">

        <div class="row">

        <div class="form-group col-md-6">
        <label for="name">Name </label>
        <input type="text" readonly  class="form-control @error('name') is-invalid @enderror"
         id="name" name="name" placeholder="Enter Staff Name" value="{{ $user->name }}" autofocus>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>

         <div class="form-group col-md-6">
        <label for="email">Email </label>
        <input type="email" readonly name="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter Staff Email">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>


        <div class="form-group col-md-6">
        <label for="phone">Phone </label>
        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Enter Staff Phone" readonly value="{{  $user->phone }}">
         @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>      

        </div>

        </div>

        <!-- /.card-body -->

     

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

{{-- <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script> --}}

<!-- Page specific script -->

<script>
$('.btnNext').click(function(e) {
  e.preventDefault();
  $('.nav-pills .active').parent().next('li').find('a').trigger('click');
});

$('.btnPrevious').click(function(e) {
  e.preventDefault();
  $('.nav-pills .active').parent().prev('li').find('a').trigger('click');
});
</script>


@endsection
