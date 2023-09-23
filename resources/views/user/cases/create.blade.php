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



<div class="form-group col-md-4">
<label for="county">County</span></label>
<select  class="form-control @error('county') is-invalid @enderror" name="county" id="county" >
<option value="">Select County</option>
<option value="0" {{old('county') == '0' ? "selected" : ""}}>Active</option>
<option value="1" {{old('county') == '1' ? "selected" : "" }}>Inactive</option>
</select>
@error('county')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>

<div class="form-group col-md-4">
<label for="sub_county">Sub County</span></label>
<select  class="form-control @error('sub_county') is-invalid @enderror" name="sub_county" id="sub_county" >
<option value="">Select Sub County</option>
<option value="0" {{old('county') == '0' ? "selected" : ""}}>Active</option>
<option value="1" {{old('county') == '1' ? "selected" : "" }}>Inactive</option>
</select>
@error('county')
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
<textarea  name="message" class="form-control @error('message') is-invalid @enderror" id="message" placeholder="Enter Case Message">
</textarea>
@error('message')
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



@endsection
