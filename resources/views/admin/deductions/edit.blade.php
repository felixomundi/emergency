@extends("layouts.dashboard")

@section("seo")
<title>Update User Deduction | {{config("app.name")}} </title>
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
<h1>Update User Deduction</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Update Deduction</li>
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

<form class="mt-3"  autocomplete="off" novalidate="novalidate" method="post" action="/admin/user_deductions/edit/{{$deduction->id}}">
@csrf
@method("PUT")
<div class="row m-3">

<div class="form-group col-md-6">
<label for="user">User</label>
<input type="hidden" value="{{$deduction->user_id}}" name="user" class="form-control">
<input value="{{$deduction->user->name}}" readonly  class="form-control">
</div>


<div class="form-group col-md-6">
            <label for="status">Deduction Status</label>
            <select  class="form-control @error('status') is-invalid @enderror" name="status" id="status" >
                <option value="">Select Status</option>
                <option value="0" {{$deduction->status == '0' ? "selected" : ""}}>Active</option>
                <option value="1" {{$deduction->status == '1' ? "selected" : "" }}>Inactive</option>
            </select>
            @error('status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
</div>

<div class="form-group col-md-6">
<label for="deduction_name">Deduction Name</label>
<input type="text"   name="deduction_name"   value="{{$deduction->deduction_name }}" placeholder="Allowance Name" class="form-control @error('deduction_name') is-invalid @enderror" />
@error("deduction_name")
<span class="invalid-feedback" role="alert">
    <strong>{{$message}}</strong>
</span>
@enderror
</div>

<div class="form-group col-md-6">
<label for="effective_date">Effective Date</label>
<input name="effective_date" type="date"  readonly value="{{$deduction->effective_date }}" class="form-control @error('effective_date') is-invalid @enderror">
@error("effective_date")
<span class="invalid-feedback" role="alert">
    <strong>{{$message}}</strong>
</span>
@enderror
</div>
<div class="form-group col-md-6">
<label for="closing_date">Closing Date</label>
<input name="closing_date" type="date" readonly value="{{$deduction->closing_date }}" class="form-control @error('closing_date') is-invalid @enderror">
@error("closing_date")
<span class="invalid-feedback" role="alert">
    <strong>{{$message}}</strong>
</span>
@enderror
</div>


<div class="form-group col-md-6">
<label for="amount">Amount</label>
<input name="amount" type="number" value={{$deduction->amount }} min="0" step="0.01" class="form-control @error('amount') is-invalid @enderror">
@error("amount")
<span class="invalid-feedback" role="alert">
    <strong>{{$message}}</strong>
</span>
@enderror
</div>


</div>


<!-- /.card-header -->
<div class="card-body">
<a href="/admin/user_deductions" class="btn btn-dark"><i class="fa fa-backward"></i> Back</a>
<button type="submit"
class="btn btn-primary mt-2  float-right" >
</i> Update Deduction
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

