@extends("layouts.manager")
@section("seo")
<title>Manager Profile | Kadesea Agency</title>
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

        @include("layouts.messages")

        <form class="mt-3" autocomplete="off" method="post"
        {{--  action="{{url("/manager/profile")}}"  --}}
        novalidate="novalidate" enctype="multipart/form-data">
         @csrf


    <input id="userId"  name="userId" type="hidden" value="{{ $user->id }}">

        <ul class="nav nav-pills mb-3 mx-2" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-basic-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Basic Details</a>
        </li>
       <li class="nav-item">
            <a class="nav-link" id="pills-cv-tab" data-toggle="pill" href="#pills-cv" role="tab" aria-controls="pills-cv" aria-selected="false">Employment</a>
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

        <div class="form-group col-md-4">
        <label for="name">Name </label>
        <input type="text" readonly  class="form-control @error('name') is-invalid @enderror"
         id="name" name="name" placeholder="Enter Staff Name" value="{{ $user->name }}" autofocus>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>

         <div class="form-group col-md-4">
        <label for="email">Email </label>
        <input type="email" readonly name="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter Staff Email">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>


        <div class="form-group col-md-4">
        <label for="phone">Phone </label>
        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Enter Staff Phone" readonly value="{{  $user->phone }}">
         @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>

        <div class="form-group col-md-4">
        <label for="staff_number">Staff No </label>
        <input readonly value="{{ $user->staff ? $user->staff->staff_number : ""}}"    class="form-control"    id="staff_number">
          </div>


        <div class="form-group col-md-4">
        <label for="gender">Gender </label>
        <select readonly  class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender" >
         <option value="Male" {{ $user->gender == 'Male' ? "selected" : "" }}>Male</option>
         <option value="Female" {{$user->gender == 'Female' ? "selected" : "" }}>Female</option>
        </select>
        @error('gender')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror


        </div>


        {{--  <div class="form-group col-md-6">
        <label for="image">Photo </label>
        <input type="file" name="image"  class="form-control @error('image') is-invalid @enderror" id="image" accept="image/png, image/jpeg, image/jpg"/>
        @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror

        </div>  --}}


         <div class="form-group col-md-4">
        <label for="branch_id">Your Branch </label>
        <input  readonly class="form-control" type="text"  value="{{ $user->staff ? $user->staff->_branch->title : "" }}" />

        </div>

        <div class="form-group col-md-12">
        <label for="dob">DOB</label>
        <input type="date" readonly value="{{ $user->dob }}"  name="dob" class="form-control @error('dob') is-invalid @enderror" id="dob"/>
        @error('dob')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
        </div>

        <div class="form-group col-md-6">
        <label for="image" class="d-flex">Current Profile Photo </label>
       @if($user->image)
       <img src="/users/{{$user->image}}" alt="{{$user->name}}" class="img-fluid" style="width:150px; height:150px">
       @endif

        </div>



        </div>


        {{-- <div class="row"></div>
        <div class="row"></div> --}}

        </div>

        <!-- /.card-body -->

        <div class="card-footer">
         <a href="/manager/dashboard"  class="btn btn-dark">Back</a>
          <a class="btn btn-primary float-right btnNext">Next &#8594;</a>
        </div>
        </div>


        {{-- cv tab --}}
 <div class="tab-pane fade" id="pills-cv" role="tabpanel" aria-labelledby="pills-cv-tab">
 {{-- card-body --}}
        <div class="card-body">

        <div class="row">
        <div class="form-group col-md-12">
        <label for="date_joined">Date Joined </label>
        <input type="date" name="date_joined" readonly value="{{ $user->staff ? $user->staff->date_joined : ""}}" class="form-control @error('date_joined') is-invalid @enderror" id="date_joined"/>
        @error('date_joined')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
        </div>

       <div class="form-group col-md-12">
        <label for="experience">Experience</label>
        <textarea  readonly name="experience"  class="form-control @error('experience') is-invalid @enderror" id="experience">
     {{ $user->staff ? $user->staff->experience : ""}}
        </textarea>
        @error('experience')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
        </div>

  <div class="form-group col-md-12">
        <label for="qualification">Qualification</label>
        <textarea name="qualification"  readonly  class="form-control @error('qualification') is-invalid @enderror" id="qualification">
     {{ $user->staff ? $user->staff->qualification : "" }}
        </textarea>
        @error('qualification')
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

        {{-- cv tab --}}

        {{-- parent tab --}}
        <div class="tab-pane fade" id="pills-parent" role="tabpanel" aria-labelledby="pills-parent-tab">
        {{-- card-body --}}
        <div class="card-body">

        <div class="row">
        <div class="form-group col-md-6">
        <label for="father_name">Father's Name</label>
        <input type="text" name="father_name" readonly value="{{  $user->father_name }}" class="form-control @error('father_name') is-invalid @enderror" id="father_name" placeholder="Enter Father's Name">
        @error('father_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
        </div>


        <div class="form-group col-md-6">
        <label for="father_occupation">Father Occupation</label>
        <input type="text" name="father_occupation" readonly value="{{   $user->father_occupation  }}" class="form-control @error('father_occupation') is-invalid @enderror" id="father_occupation" placeholder="Enter Father's Occupation">
        @error('father_occupation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
        </div>


         <div class="form-group col-md-6">
        <label for="father_phone_number">Father Phone</label>
        <input type="text" name="father_phone_number" readonly value="{{ $user->father_phone_number  }}" class="form-control @error('father_phone_number') is-invalid @enderror" id="father_phone_number" placeholder="Enter Father's Phone Number">
         @error('father_phone_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
        </div>


       <div class="form-group col-md-6">
        <label for="mother_name">Mother's Name</label>
        <input type="text" name="mother_name" readonly value="{{$user->mother_name   }}" class="form-control @error('mother_name') is-invalid @enderror" id="mother_name" placeholder="Enter Mother's Name">
        @error('mother_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
        </div>


        <div class="form-group col-md-6">
       <label for="mother_occupation">Mother Occupation</label>
        <input type="text" name="mother_occupation" readonly value="{{ $user->mother_occupation   }}" class="form-control @error('mother_occupation') is-invalid @enderror" id="mother_occupation" placeholder="Enter Mother's Occupation">
         @error('mother_occupation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
          </div>



         <div class="form-group col-md-6">
        <label for="mother_phone_number">Mother Phone</label>
        <input type="text" name="mother_phone_number" readonly value="{{$user->mother_phone_number  }}" class="form-control @error('mother_phone_number') is-invalid @enderror" id="mother_phone_number" placeholder="Enter Mother's Phone Number">
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
        <label for="county">County of Birth</label>
        <input type="text" name="county" readonly value="{{ $user->county }}" class="form-control @error('county') is-invalid @enderror" id="county" placeholder="Enter County of Birth">
       @error('county')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
        </div>


        <div class="form-group col-md-6">
        <label for="district">District</label>
        <input type="text" readonly value="{{ $user->district  }}" class="form-control @error('district') is-invalid @enderror" id="district" name="district" placeholder="Enter District of Birth">
       @error('district')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
        </div>

        <div class="form-group col-md-6">
        <label for="division">Division</label>
        <input type="text" value="{{$user->division   }}" readonly class="form-control @error('division') is-invalid @enderror" id="division" name="division" placeholder="Enter Division of Birth">
        @error('division')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
        </div>


        <div class="form-group col-md-6">
        <label for="location">Location</label>
        <input type="text" name="location" readonly value="{{$user->location  }}" class="form-control @error('location') is-invalid @enderror" id="location" placeholder="Enter Location of Birth">
       @error('location')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
        @enderror
        </div>
        <div class="form-group col-md-6">
        <label for="sub_location">Sub Location</label>
        <input type="text" name="sub_location" readonly value="{{$user->sub_location  }}" class="form-control @error('sub_location') is-invalid @enderror" id="sub_location" placeholder="Enter Sub-Location of Birth">
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
        <a href="/manager/dashboard"  class="btn btn-dark float-right">Back</a>
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
