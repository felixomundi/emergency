@extends("layouts.dashboard")

@section("seo")
<title>Update Users Advance | {{config("app.name")}} </title>
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
<h1>Update Users Advance</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active">Update Advance</li>
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

<form class="mt-3"  autocomplete="off" novalidate="novalidate" method="post" action="/admin/advance/edit/{{$advance->id}}">
@csrf
@method("put")

<div class="row m-3">

<div class="form-group col-md-6">
    <label for="user">User</label>
    <input name="user" readonly value="{{$advance->user->name}}"  class="form-control">
    <input type="hidden" value="{{$advance->user->id}}" class="form-control" name="user">
</div>

<div class="form-group col-md-6">
            <label for="purpose">Purpose</label>
            <select  class="form-control @error('purpose') is-invalid @enderror" name="purpose" id="purpose" >
                <option value="">Select Purpose</option>
                @forelse ($purposes as $purpose)
                <option value="{{$purpose->id}}" {{ $advance->purpose_id == $purpose->id ? "selected" : ""}}>{{$purpose->name}}</option>
                @empty
                <option value="">No Purpose Available</option>
                @endforelse
            </select>
            @error('purpose')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
</div>

<div class="form-group col-md-6">
            <label for="status">Status</label>
            <select  class="form-control @error('status') is-invalid @enderror" name="status" id="status" >
                <option value="">Select Status</option>
                <option value="0" {{ $advance->status == '0' ? "selected" : ""}}>Approved</option>
                <option value="1" {{ $advance->status == '1' ? "selected" : "" }}>Pending</option>
                <option value="2" {{ $advance->status == '2' ? "selected" : "" }}>Under Consideration</option>
                <option value="3" {{ $advance->status == '3' ? "selected" : "" }}>Cancelled</option>
            </select>
            @error('status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
</div>

<div class="form-group col-md-6">
<label for="effective_date">Effective Deduction Date</label>
<input name="effective_date" type="date"  value="{{ $advance->effective_date }}" class="form-control @error('effective_date') is-invalid @enderror">
@error("effective_date")
<span class="invalid-feedback" role="alert">
    <strong>{{$message}}</strong>
</span>
@enderror
</div>
<div class="form-group col-md-6">
<label for="closing_date">Closing Deduction Date</label>
<input name="closing_date" type="date" value="{{ $advance->closing_date }}"   class="form-control @error('closing_date') is-invalid @enderror">
@error("closing_date")
<span class="invalid-feedback" role="alert">
    <strong>{{$message}}</strong>
</span>
@enderror
</div>

<div class="form-group col-md-6">
    <label for="period">Period</label>
    <input type="number" min="0" step="0"   name="period"   value="{{$advance->period }}" placeholder="Period" class="form-control @error('period') is-invalid @enderror" />
    @error("period")
    <span class="invalid-feedback" role="alert">
        <strong>{{$message}}</strong>
    </span>
    @enderror
</div>



<div class="form-group col-md-6">
            <label for="duration">Duration</label>
            <select  class="form-control @error('duration') is-invalid @enderror" name="duration" id="duration" >
                <option value="">Select Duration</option>
                <option value="Day" {{ $advance->duration === 'Day' ? "selected" : ""}}>Day</option>
                <option value="Week" {{ $advance->duration === 'Week' ? "selected" : "" }}>Week</option>
                <option value="Month" {{ $advance->duration === 'Month' ? "selected" : "" }}>Month</option>
                <option value="Year" {{ $advance->duration === 'Year' ? "selected" : "" }}>Year</option>
            </select>
            @error('duration')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
</div>



<div class="form-group col-md-6">
    <label for="installment">Installment Amount</label>
    <input type="text"   name="installment"   value="{{$advance->installment }}" placeholder="Installment Amount" class="form-control @error('installment') is-invalid @enderror" />
    @error("installment")
    <span class="invalid-feedback" role="alert">
        <strong>{{$message}}</strong>
    </span>
    @enderror
</div>

<div class="form-group col-md-6">
<label for="amount">Advance Amount</label>
<input name="amount" placeholder="Advance Amount" type="number" value={{$advance->amount}} min="0" step="0.01" class="form-control @error('amount') is-invalid @enderror">
@error("amount")
<span class="invalid-feedback" role="alert">
    <strong>{{$message}}</strong>
</span>
@enderror
</div>


</div>


<!-- /.card-header -->
<div class="card-body">
<a href="/admin/advance" class="btn btn-dark"><i class="fa fa-backward"></i> Back</a>
<button type="submit"
class="btn btn-primary mt-2  float-right" >
</i> Update Advance
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

