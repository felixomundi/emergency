@extends("layouts.dashboard")
@section("seo")
<title>Update Salary Type | {{config("app.name")}}</title>
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
            <h1>Update Salary Type</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update Salary Type</li>
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
              <div class="card-header">
                <h3 class="card-title">Update Salary Type {{ $type->title}}</h3>
              </div>
              <!-- /.card-header -->

            @include("layouts.messages")

        <form class="mt-3" method="POST" action="/admin/salary/types/{{$type->id}}/edit" autocomplete="off">
        @method("PUT")
        @csrf
        {{-- card-body --}}
        <div class="card-body">

        <div class="row">
        <div class="form-group col-md-12">
        <label for="title">Salary Type Title</label>
        <input type="text" name="title" value="{{ $type->title }}" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Enter Salary Type Title">
          @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <input type="hidden" value="{{$type->id}}" name="salary_id" class="form-control">

        </div>

        </div>

        <!-- /.card-body -->

        <div class="card-footer">
            <a href="/admin/salary/types" class="float-start btn btn-dark"> <i class="fa fa-backward"></i> Back</a>
          <button type="submit" class="btn btn-primary float-right">Update</button>
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
