@extends("layouts.user")
@section("seo")
<title>Report New Case | {{config('app.name')}} </title>
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
<h1>Report New Case Form</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Report New Case Form</li>
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
<h3 class="card-title">Report Case</h3>
</div>
<!-- /.card-header -->
@include("layouts.messages")
<form class="mt-3" autocomplete="off" method="post" action="/user/cases/create" novalidate="novalidate" enctype="multipart/form-data">
@csrf



{{-- card-body --}}
<div class="card-body">

<div class="row">



<div class="form-group col-md-6">
<label for="county">County</span></label>
<select  class="form-control @error('county') is-invalid @enderror" name="county" id="county" >
<option value="">Select County</option>
@forelse ($counties as $county)
<option value="{{$county->id}}" {{old('county') == $county->id ? "selected" : ""}}>{{$county->name}}</option>    
@empty
    
@endforelse
</select>
@error('county')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>

<div class="form-group col-md-6">
<label for="sub_county">Sub County</span></label>
<select  class="form-control @error('sub_county') is-invalid @enderror" name="sub_county" id="sub_county" >
<option value="">Select Sub County</option>

</select>
@error('sub_county')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>



<div class="form-group col-md-12">
<label for="title">Title </label>
<input type="text" class="form-control @error('title') is-invalid @enderror"
id="title" name="title" placeholder="Enter Case Title" value="{{ old('title') }}">
@error('title')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>



<div class="form-group col-md-12">
<label for="message">Message</label>
<textarea  name="message_case" class="form-control @error('message_case') is-invalid @enderror"  id="message_case" placeholder="Enter Case Message">
</textarea>
@error('message_case')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>


</div>      

</div>

<!-- /.card-body -->

<div class="card-footer">
<a href="/user/cases" class="btn btn-dark"><i class="fa fa-backward"></i> Back</a>
<button type="submit" class="btn btn-primary float-right">Report Case</button>
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
<script src="/assets/js/axios.js"></script>
<script>
    $(document).ready(function () {
        $("#county").on("change", async function () {
          let id = $('#county').val();
          if(id){
            try {
            let url = "/user/cases/counties/"+id;
            const response = await axios.get(url);           
            if(response.data.subcounties.length > 0){
              var html = "<option value=''>Select Sub County</option>";
              $.each(response.data.subcounties, function (key, value) {
              html += '<option {{old("county") === "'+ value.id +'" ? "selected": "" }} value="' + value.id + '">' + value.name + '</option>';
              });
              $("#sub_county").html(html);
            }
            else{
              var html = "<option value=''>No Sub County available</option>";
              $("#sub_county").html(html);
            }
           } catch (error) {
            
           }
          }else{
            
          }
        })
    })
</script>


@endsection
