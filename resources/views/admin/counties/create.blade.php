@extends("layouts.user")
@section("seo")
<title>Create County| {{config('app.name')}} </title>
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
<h1>Create County</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Create County</li>
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
<h3 class="card-title">Create County</h3>
</div>
<!-- /.card-header -->
@include("layouts.messages")
<form class="mt-3" autocomplete="off" method="post" action="/admin/counties/create" novalidate="novalidate" enctype="multipart/form-data">
@csrf

{{-- card-body --}}
<div class="card-body">

<div class="row">



<div class="form-group col-md-12">
<label for="name">Name</span></label>
<input  class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}">
@error('name')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>



</div>      

</div>

<!-- /.card-body -->

<div class="card-footer">
<a href="/admin/counties" class="btn btn-dark"><i class="fa fa-backward"></i> Back</a>
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
