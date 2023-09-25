@extends("layouts.dashboard")
@section("seo")
<title>Update Case | {{config('app.name')}} </title>
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
<h1>Update Case Form</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Update Case Form</li>
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
<h3 class="card-title">Update  Case</h3>
</div>
<!-- /.card-header -->
@include("layouts.messages")
<form class="mt-3" autocomplete="off" method="post" action="/admin/cases/edit/{{$case->id}}" novalidate="novalidate" enctype="multipart/form-data">
@method("PUT")
@csrf

{{-- card-body --}}
<div class="card-body">

<div class="row">



<div class="form-group col-md-6">
<label for="county">County</span></label>
<input   class="form-control" value="{{$case->subcounty->county->name}}" readonly name="county" id="county" >

</div>

<div class="form-group col-md-6">
<label for="sub_county">Sub County</span></label>
<input   class="form-control" value="{{$case->subcounty->name}}" readonly name="county" id="county" >

</div>



<div class="form-group col-md-12">
<label for="title">Title </label>
<input type="text" class="form-control @error('title') is-invalid @enderror"
id="title" name="title" placeholder="Enter Case Title" readonly value="{{ $case->title }}">
@error('title')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>



<div class="form-group col-md-12">
<label for="message">Message</label>
<textarea  name="message_case" class="form-control @error('message_case') is-invalid @enderror" readonly  id="message_case" placeholder="Enter Case Message">
{{$case->message}}
</textarea>
@error('message_case')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>


<div class="form-group col-md-12">
<label for="status">Status</label>
<select name="status" class="form-control">
<option value="Reported" {{$case->status === "Reported" ? "selected" : "" }} >Reported</option>
<option value="In Progress" {{$case->status === "In Progress" ? "selected" : "" }} > In Progress</option>
<option value="Completed" {{$case->status === "Completed" ? "selected" : "" }}>Completed</option>
<option value="Cancelled" {{$case->status === "Cancelled" ? "selected" : "" }}>Cancelled</option>
</select>
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
<a href="/admin/cases" class="btn btn-dark"><i class="fa fa-backward"></i> Back</a>
<button type="submit" class="btn btn-primary float-right">Update Case</button>
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
