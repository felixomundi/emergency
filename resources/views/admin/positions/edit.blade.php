@extends("layouts.dashboard")
@section("seo")
<title>Update Position | {{config("app.name")}}</title>
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
            <h1>Update Position</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update Position</li>
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
                <h3 class="card-title">Update Position {{ $position->name}}</h3>
              </div>
              <!-- /.card-header -->

            @include("layouts.messages")

        <form class="mt-3" method="POST" action="/admin/positions/{{$position->id}}/edit" autocomplete="off">
        @method("PUT")
        @csrf
        {{-- card-body --}}
        <div class="card-body">

        <div class="row">
        <div class="form-group col-md-6">
        <label for="name">Job Position Name/Title</label>
        <input type="text" name="name" value="{{ $position->name }}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Name">
          @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>


          <div class="form-group col-md-6">
            <label for="department_id">Department</label>
            <select  class="form-control @error('department_id') is-invalid @enderror" name="department_id" id="department_id">
            <option value="">Select DepartMent</option>
            @forelse ($departments as $department)
            <option value="{{$department->id}}" {{ $position->department_id == $department->id ? "selected" : "" }}>{{$department->name}}</option>

            @empty

            @endforelse
            </select>
            @error('department_id')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="status">Status</label>
            <select  class="form-control @error('status') is-invalid @enderror" name="status" id="status">
            <option value="">Select Status</option>
            <option value="0" {{ $position->status == "0" ? "selected" : "" }}>Active</option>
            <option value="1" {{ $position->status == "1" ? "selected" : "" }}>Inactive</option>
            </select>
            @error('status')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <input type="hidden" value="{{$position->department_id}}" name="pos_dep_id" class="form-control">

        <input type="hidden" value="{{$position->id}}" name="position_id" class="form-control @error('position_id')
        is-invalid
        @enderror">
        @error('position_id')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        </div>

        <!-- /.card-body -->

        <div class="card-footer">
            <a href="/admin/positions" class="float-start btn btn-dark"> <i class="fa fa-backward"></i> Back</a>
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
