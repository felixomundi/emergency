@extends("layouts.dashboard")
@section("seo")
<title>Assign User Salary | {{config("app.name")}}</title>
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
            <h1>Assign User Salary</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Assign User Salary</li>
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
                <h3 class="card-title">Assign User Salary Form</h3>
              </div>
              <!-- /.card-header -->

            @include("layouts.messages")

        <form class="mt-3" method="POST" action="/admin/manage-salary/create" autocomplete="off">

        @csrf
        {{-- card-body --}}
        <div class="card-body">

        <div class="row">

        <div class="form-group col-md-6">
            <label for="user">User</label>
            <select  class="form-control @error('user_id') is-invalid @enderror" name="user_id" id="user_id">
            <option value="">Select User</option>
            @forelse ($users as $user)
            <option value="{{$user->id}}" {{ old("user_id") == $user->id ? "selected" : "" }}>{{$user->name}}</option>
            @empty
            <option value="">No User Available User</option>
            @endforelse
            </select>
            @error('user_id')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="area_of_work">Area Of Work</label>
            <select  class="form-control @error('areas_of_work_id') is-invalid @enderror" name="areas_of_work_id" id="areas_of_work_id">
            <option value="">Select Area Of Work</option>
            @forelse ($areas as $area)
            <option value="{{$area->id}}" {{ old("areas_of_work_id") == $area->id ? "selected" : "" }}>{{$area->name}}</option>
            @empty
            <option value="">No Areas Of Work Available </option>
            @endforelse
            </select>
            @error('areas_of_work_id')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="position_id">Position</label>
            <select  class="form-control @error('position_id') is-invalid @enderror" name="position_id" id="position_id">
            <option value="">Select User Position</option>
            @forelse ($positions as $position)
            <option value="{{$position->id}}" {{ old("position_id") == $position->id ? "selected" : "" }}>{{$position->name}}</option>
            @empty
            <option value="">No Areas Of Work Available </option>
            @endforelse
            </select>
            @error('position_id')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <div class="form-group col-md-6">
            <label for="salary_type_id">Salary Type</label>
            <select  class="form-control @error('salary_type_id') is-invalid @enderror" name="salary_type_id" id="salary_type_id">
            <option value="">Select Salary Type</option>
            @forelse($types as $type)
            <option value="{{$type->id}}" {{ old("salary_type_id") == $type->id ? "selected" : "" }}>{{$type->title}}</option>
            @empty
            <option value="">No Salary Type Available </option>
            @endforelse
            </select>
            @error('salary_type_id')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <div class="form-group col-md-6">
        <label for="total">Amout</label>
        <input type="number" min="0" name="total" value="{{ old("total") }}" class="form-control @error('total') is-invalid @enderror" id="total" placeholder="Enter Salary Total">
          @error('total')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        </div>

        </div>

        <!-- /.card-body -->

        <div class="card-footer">
        <a href="/admin/manage-salary" class="float-start btn btn-dark"> <i class="fa fa-backward"></i> Back</a>
        <button type="submit" class="btn btn-primary float-right">Submit</button>
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
