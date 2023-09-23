@extends("layouts.dashboard")
@section("seo")
<title>Manage Salary | {{config("app.name")}} </title>
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
            <h1>Manage Salary</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Salary</li>
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
          @include("layouts.messages")

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <a href="/admin/manage-salary/create" class="btn btn-primary"> <i class="fa fa-plus-circle"></i> Create New User Salary</a>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Area Of Work</th>
                <th>Position</th>
                <th>Salary Type</th>
                <th>Total</th>
                <th>Date Created</th>
                <th>Created By</th>
                <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                       @forelse ($salaries as $key => $salary )
                        <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{$salary->user->name}}</td>
                        <td>{{$salary->area->name}}</td>
                        <td>{{$salary->position->name}}</td>
                        <td>{{$salary->salaryType->title}}</td>
                        <td>{{number_format($salary->total, 2)}}</td>
                        <td>@if($salary->created_at) {{ $salary->created_at->format("d M Y h:i A") }} @endif</td>
                        <td>@if ($salary->creator){{$salary->creator->name}}@else <p class="text-danger">No Creater</p>  @endif</td>
                        <td><button  class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        <a href="/admin/manage-salary/{{ $salary->id }}/edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                        </td>
                        </tr>
                        @empty
                        <tr><td colspan="8" class="text-center">No User Salaries Found</td></tr>
                        @endforelse

                  </tbody>
                  <tfoot>
                  <tr>
                  <th>ID</th>
                <th>Name</th>
                <th>Area Of Work</th>
                <th>Position</th>
                <th>Salary Type</th>
                <th>Total</th>
                <th>Date Created</th>
                <th>Created By</th>
                <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
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
@include("layouts.tables");
@endsection
