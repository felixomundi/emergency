@extends("layouts.dashboard")
@section("seo")
<title>Departments  | {{config("app.name")}} </title>
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
            <h1>Departments</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Departments</li>
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
                <a href="/admin/departments/create" class="btn btn-primary"> <i class="fa fa-plus-circle"></i> Create New Department</a>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Date Created</th>
                <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

               @forelse ($departments as $key => $department )
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $department->name }}</td>
                     <td> @if ($department->status == "0")
                    <label class="badge badge-primary">Active</label>
                    @else
                     <label class="badge badge-danger">Inactive</label>
                    @endif</td>

                    <td>
                    @if ($department->created_at)
                    {{ $department->created_at->format("d M Y h:i A") }}
                    @endif</td>
                    <td><button  class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        <a href="/admin/departments/{{ $department -> id }}/edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                    </td>
                  </tr>
                  @empty
                  <tr><td colspan="4" class="text-center">No Department Found</td></tr>
                  @endforelse

                  </tbody>
                  <tfoot>
                  <tr>
                  <th>ID</th>
                <th>Name</th>
                <th>Date Created</th>
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
