@extends("layouts.dashboard")
@section("seo")
<title>Salary Types | {{config("app.name")}} </title>
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
            <h1>Salary Types</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Salary Types</li>
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
                  <a href="/admin/salary/types/create" class="btn btn-primary"> <i class="fa fa-plus-circle"></i> Create New Salary Type</a>
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

            @forelse ($types as $key => $type )
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $type->title }}</td>
                    <td>@if ($type->created_at) {{ $type->created_at->format("d M Y h:i A") }} @endif</td>
                    <td><button  class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        <a href="/admin/salary/types/{{ $type->id }}/edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                    </td>
                  </tr>
                  @empty
                  <tr><td colspan="5" class="text-center">No Salary Type Found</td></tr>
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
