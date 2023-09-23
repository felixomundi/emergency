
@extends("layouts.dashboard")
@section("seo")
<title>Admin Update User  | {{config("app.name")}} </title>
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
         <h1>Update User Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update User Form</li>
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
                <h3 class="card-title">Update User Form</h3>
              </div>
              <!-- /.card-header -->
        @include("layouts.messages")
        <form class="mt-3" autocomplete="off" id="StudentForm"
        action="/admin/users/{{ $user->id }}/edit"
         method="POST"
         novalidate="novalidate"
        enctype="multipart/form-data"
         >
        @csrf
      @method("PUT")

    <input id="userId"  name="userId" type="hidden" value="{{ $user->id }}">

        <ul class="nav nav-pills mb-3 mx-2" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-basic-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Basic Details</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-parent-tab" data-toggle="pill" href="#pills-parent" role="tab" aria-controls="pills-parent" aria-selected="false">Parent Details</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-origin-tab" data-toggle="pill" href="#pills-origin" role="tab" aria-controls="pills-origin" aria-selected="false">Origin</a>
        </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-basic-tab">

        {{-- card-body --}}
        <div class="card-body">

        <div class="row">

        <div class="form-group col-md-6">
        <label for="name">Name </label>
        <input type="text" class="form-control
        @error('name') is-invalid @enderror
        "
         id="name" name="name" placeholder="Enter User Name"
          value="{{ $user->name }}"
          autofocus>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>

         <div class="form-group col-md-6">
        <label for="email">Email </label>
        <input type="email" name="email" value="{{  $user->email }}"
         class="form-control @error('email') is-invalid @enderror"
          id="email" placeholder="Enter User Email">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>


        <div class="form-group col-md-6">
        <label for="phone">Phone </label>
        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Enter User Phone" value="{{ $user->phone }}">
         @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="status">Status </label>
            <select  class="form-control @error('status') is-invalid @enderror" name="status" id="status" >
                <option value="">Select Status</option>
                <option value="0" {{$user->status == '0' ? "selected" : ""}}>Active</option>
                <option value="1" {{$user->status == '1' ? "selected" : "" }}>Inactive</option>
            </select>
            @error('status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="role_as">Role</label>
            <select  class="form-control @error('role_as') is-invalid @enderror" name="role_as" id="role_as" >
                <option value="">Select Role</option>
                <option value="0" {{$user->role_as == '0' ? "selected" : ""}}>User</option>
                <option value="2" {{$user->role_as  == '2' ? "selected" : ""}}>Accountant</option>
                <option value="3" {{$user->role_as  == '3' ? "selected" : ""}}>Manager</option>
                <option value="1" {{$user->role_as  == '1' ? "selected" : "" }}>Admin</option>
            </select>
            @error('role_as')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

       <div class="form-group col-md-6">
        <label for="password">Password </label>
        <input type="password" name="password"  class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter Student Password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        </div>



        <div class="form-group col-md-6">
        <label for="gender">Gender </label>
        <select  class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender" >

        <option value="Male" {{ $user->gender == "Male" ? "selected" : "" }}>Male</option>
        <option value="Female" {{ $user->gender == "Female" ? "selected" : "" }}>Female</option>
        </select>
        @error('gender')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror


        </div>


        <div class="form-group col-md-6">
        <label for="image">Photo </label>
        <input type="file" name="image"  class="form-control @error('image') is-invalid @enderror" id="image" accept="image/png, image/jpeg, image/jpg"/>
        @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
        </div>

        {{--
            <div class="form-group col-md-6">
            <label for="course">Course</label>
            <select   name="course" class="form-control @error('course') is-invalid @enderror" id="course">
            <option value="">Select Course</option>
            @forelse ($courses as $course )
            <option value="{{$course->id  }}" {{ $courses_id == $course->id ? "selected" : "" }} >  {{ $course->title }}   </option>
            @empty

            @endforelse
            </select>
            @error('course')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
        </div>

            --}}



        </div>


        {{-- <div class="row"></div>
        <div class="row"></div> --}}

        </div>

        <!-- /.card-body -->

        <div class="card-footer">
         <a href="/admin/students" class="btn btn-dark"><i class="fa fa-backward"></i> Back</a>
          <a class="btn btn-primary float-right btnNext">Next &#8594;</a>
        </div>
        </div>

        {{-- parent tab --}}
        <div class="tab-pane fade" id="pills-parent" role="tabpanel" aria-labelledby="pills-parent-tab">
        {{-- card-body --}}
        <div class="card-body">

        <div class="row">
        <div class="form-group col-md-6">
        <label for="father_name">Father's Name</label>
        <input type="text" name="father_name" value="{{  $user->father_name }}" class="form-control @error('father_name') is-invalid @enderror" id="father_name" placeholder="Enter Father's Name">
        @error('father_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
        </div>


        <div class="form-group col-md-6">
        <label for="father_occupation">Father Occupation</label>
        <input type="text" name="father_occupation" value="{{$user->father_occupation }}" class="form-control @error('father_occupation') is-invalid @enderror" id="father_occupation" placeholder="Enter Father's Occupation">
        @error('father_occupation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
        </div>


         <div class="form-group col-md-6">
        <label for="father_phone_number">Father Phone</label>
        <input type="text" name="father_phone_number"  value="{{ $user->father_phone_number }}" class="form-control @error('father_phone_number') is-invalid @enderror" id="father_phone_number" placeholder="Enter Father's Phone Number">
         @error('father_phone_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
        </div>


       <div class="form-group col-md-6">
        <label for="mother_name">Mother's Name</label>
        <input type="text" name="mother_name" value="{{ $user->mother_name }}" class="form-control @error('mother_name') is-invalid @enderror" id="mother_name" placeholder="Enter Mother's Name">
        @error('mother_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
        </div>


        <div class="form-group col-md-6">
       <label for="mother_occupation">Mother Occupation</label>
        <input type="text" name="mother_occupation" value="{{$user->mother_occupation }}" class="form-control @error('mother_occupation') is-invalid @enderror" id="mother_occupation" placeholder="Enter Mother's Occupation">
         @error('mother_occupation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
          </div>



         <div class="form-group col-md-6">
        <label for="mother_phone_number">Mother Phone</label>
        <input type="text" name="mother_phone_number" value="{{$user->mother_phone_number }}" class="form-control @error('mother_phone_number') is-invalid @enderror" id="mother_phone_number" placeholder="Enter Mother's Phone Number">
        @error('mother_phone_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
        </div>

         </div>

        </div>
        {{-- card-body --}}


        <div class="card-footer">
        <a  class="btn btn-primary float-right btnNext">Next &#8594;</a>
        <a  class="btn btn-primary float-left btnPrevious">&#8592; Previous</a>

        </div>

        </div>
       {{-- parent tab --}}

        <div class="tab-pane fade" id="pills-origin" role="tabpanel" aria-labelledby="pills-origin-tab">

       {{-- card-body --}}
        <div class="card-body">

        <div class="row">

       <div class="form-group col-md-6">
        <label for="dob">DOB</label>
        <input type="date" value="{{ $user->dob }}"  name="dob" class="form-control @error('dob') is-invalid @enderror" id="dob"/>
        @error('dob')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
        </div>


        <div class="form-group col-md-6">
        <label for="county">County of Birth</label>
        <input type="text" name="county" value="{{$user->county }}" class="form-control @error('county') is-invalid @enderror" id="county" placeholder="Enter County of Birth">
       @error('county')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
        </div>


        <div class="form-group col-md-6">
        <label for="district">District</label>
        <input type="text" value="{{ $user->district }}" class="form-control @error('district') is-invalid @enderror" id="district" name="district" placeholder="Enter District of Birth">
       @error('district')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
        </div>

        <div class="form-group col-md-6">
        <label for="division">Division</label>
        <input type="text" value="{{ $user->division }}" class="form-control @error('division') is-invalid @enderror" id="division" name="division" placeholder="Enter Division of Birth">
        @error('division')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
        </div>


        <div class="form-group col-md-6">
        <label for="location">Location</label>
        <input type="text" name="location" value="{{ $user->location }}" class="form-control @error('location') is-invalid @enderror" id="location" placeholder="Enter Location of Birth">
       @error('location')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
        </div>
        <div class="form-group col-md-6">
        <label for="sub_location">Sub Location</label>
        <input type="text" name="sub_location" value="{{ $user->sub_location }}" class="form-control @error('sub_location') is-invalid @enderror" id="sub_location" placeholder="Enter Sub-Location of Birth">
        @error('sub_location')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
        </div>


        </div>

        </div>
        {{-- card-body --}}


        <div class="card-footer">
        <a  class="btn btn-primary float-left btnPrevious">&#8592; Previous</a>
        <button type="submit"  class="btn btn-primary float-right">Update User</button>
        </div>



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
