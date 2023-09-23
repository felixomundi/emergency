@extends("layouts.user")
@section("seo")
<title>Create Sub County | {{config('app.name')}} </title>
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
<h1>Create Sub County</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Create Sub County</li>
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
<h3 class="card-title">Create Sub County</h3>
</div>
<!-- /.card-header -->
@include("layouts.messages")
<form class="mt-3" autocomplete="off" method="post" action="/admin/sub-counties/create" novalidate="novalidate" enctype="multipart/form-data">
@csrf

{{-- card-body --}}
<div class="card-body">

<div class="row">



<div class="form-group col-md-6">
<label for="name">Name</span></label>
<input  class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}">
@error('name')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>


<div class="form-group col-md-6">
<label for="county">County</span></label>
<select  class="form-control @error('county') is-invalid @enderror" name="county" id="county">
<option value="">Select County</option>
@forelse ($counties as $county )
<option value="{{$county->id}}" {{ old('county') === $county->id ? "selected" : ""}}>{{$county->name}}</option>  
@empty
    
@endforelse
</select>
@error('county')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>



</div>      

</div>

<!-- /.card-body -->

<div class="card-footer">
<a href="/admin/sub-counties" class="btn btn-dark"><i class="fa fa-backward"></i> Back</a>
<button type="submit" class="btn btn-primary float-right">Create</button>
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
