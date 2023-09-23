@extends("layouts.dashboard")

@section("seo")
<title>Update User Attendance | {{config("app.name")}} </title>
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
<h1>Uper User Attendance</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Update Attendance</li>
</ol>
</div>
</div>
</div><!-- /.container-fluid -->
</section>


<!-- Main content -->
<section class="content">
<div class="container-fluid">

<div class="row">
<div class="col-12">
<div class="card">

@include("layouts.messages")

<form class="mt-3"  autocomplete="off" novalidate="novalidate" method="post" action="/admin/user_attendancies/edit/{{$attendance->id}}">
@csrf
@method("PUT")
<div class="row m-3">

<div class="form-group col-md-4">
<label for="user">User</label>
<input type="hidden" value="{{$attendance->user_id}}" name="user" class="form-control">
<input value="{{$attendance->user->name}}" readonly  class="form-control">
</div>


<div class="form-group col-md-4">
<label for="attendance_date">Attendance Date</label>
<input type="date"  readonly name="attendance_date"   value="{{$attendance->attendance_date }}" placeholder="Attendance Date" class="form-control @error('attendance_date') is-invalid @enderror" />
@error("attendance_date")
<span class="invalid-feedback" role="alert">
    <strong>{{$message}}</strong>
</span>
@enderror
</div>

<div class="form-group col-md-4">
<label for="status">Status</label>
<select name="status"  class="form-control @error('status') is-invalid @enderror">
<option value="">Select Status</option>
<option value="0" {{ $attendance->status === 0 ? "selected" : "" }}>Present</option>
<option value="1" {{ $attendance->status === 1 ? "selected" : "" }}>Absent</option>
</select>
@error("status")
<span class="invalid-feedback" role="alert">
    <strong>{{$message}}</strong>
</span>
@enderror
</div>

</div>


<!-- /.card-header -->
<div class="card-body">
<a href="/admin/user_attendancies" class="btn btn-dark"><i class="fa fa-backward"></i> Back</a>
<button type="submit"
class="btn btn-primary mt-2  float-right" >
</i> Update Attendance
</button>
</div>
<!-- /.card-body -->

</form>

</div>
<!-- /.card -->




</div>
<!-- /.col -->
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection

@section("scripts")

@endsection

